<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use App\Mail\TableAndRoomBookedNotification;
use App\Mail\TableAndRoomBookNotification;
use App\Models\DiningSpace;
use App\Models\reservation;
use App\Models\room;
use App\Models\SiteConfig;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingFrController extends Controller
{
    /* Handle the incoming request.
    */
    public function index(Request $request)
    {
        $settings = SiteConfig::all();
        $spaces = DiningSpace::all();
        $rooms = room::all();
        return view('resturant.booking', compact('settings', 'spaces', 'rooms'));
    }

    public function book(Request $request)
    {
        // dd($request);
        $booking = new reservation;
        $validate_data = $request->validate([
            'name' => 'required|min:5',
            'phone' => 'required|min:10',
            'email' => 'required|email',
            'noofpeople' => 'required',
            'spaces' => 'required',
            'room' => 'required',
            'date' => 'required',
            'pickup' => 'required',
            'specialrequest' => 'required',
        ]);
        if ($request->spaces === 'none' && $request->room === 'none') {
            return back()->withErrors([
                'spaces' => 'Please select either a dining space or a room.',
                'room' => 'Please select either a room or a dining space.',
            ])->withInput();
        }
        $booking->name = $validate_data['name'];
        $booking->phone = $validate_data['phone'];
        $booking->email = $validate_data['email'];
        $booking->noofpeople = $validate_data['noofpeople'];
        $booking->spaces = $validate_data['spaces'];
        $booking->room = $validate_data['room'];
        $booking->date = $validate_data['date'];
        $booking->pickup = $validate_data['pickup'];
        $booking->specialrequest = $validate_data['specialrequest'];
        $booking->save();
        Mail::to($booking->email)->send(new TableAndRoomBookNotification($booking));
        $ownerEmail = SiteConfig::where('siteKey', 'email')->value('siteValue');

        // Send an email to the owner
        Mail::to($ownerEmail)->send(new TableAndRoomBookedNotification($booking));
        return redirect()->back()->with('success', 'Successfully Booked Please Check Your Email and Verify it');
    }
}
