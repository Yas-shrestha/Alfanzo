<?php

namespace App\Http\Controllers\FrontendController;

use App\Http\Controllers\Controller;
use App\Models\Pickup;
use Illuminate\Http\Request;
use App\Mail\PickupConfirmation;
use App\Mail\PickupStatusNotification;
use App\Models\SiteConfig;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class PickupController extends Controller
{
    public function index()
    {
        $pickup = new Pickup;
        return view('pickup.status', compact($pickup));
    }
    public function store(Request $request)
    {
        $pickup = new Pickup;
        $validate_data = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
            'noofpeople' => 'required|numeric|min:1|max:140',
            'pickuptime' => 'required',
        ]);
        $pickup->name = $validate_data['name'];
        $pickup->email = $validate_data['email'];
        $pickup->phone = $validate_data['phone'];
        $pickup->location = $validate_data['location'];
        $pickup->noofpeople = $validate_data['noofpeople'];
        $pickup->pickuptime = $validate_data['pickuptime'];
        // Generate a unique token and set the expiration time

        $pickup->save();
        Mail::to($pickup->email)->send(new PickupConfirmation($pickup));
        $ownerEmail = SiteConfig::where('siteKey', 'email')->value('siteValue');

        // Send an email to the owner
        Mail::to($ownerEmail)->send(new PickupStatusNotification($pickup));
        return redirect()->back()->with('success', 'Successfully Booked We will call you shortly');
    }
}
