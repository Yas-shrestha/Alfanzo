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
            'noofpeople' => 'required|numeric',
            'pickuptime' => 'required',
        ]);
        $pickup->name = $validate_data['name'];
        $pickup->email = $validate_data['email'];
        $pickup->phone = $validate_data['phone'];
        $pickup->location = $validate_data['location'];
        $pickup->noofpeople = $validate_data['noofpeople'];
        $pickup->pickuptime = $validate_data['pickuptime'];
        // Generate a unique token and set the expiration time
        $pickup->verification_token = Str::random(60); // Create a random 60-character token
        $pickup->verification_token_expires_at = Carbon::now()->addMinutes(10); // Set the expiry time to 10 minutes from now

        $pickup->save();
        Mail::to($pickup->email)->send(new PickupConfirmation($pickup));

        return redirect()->back()->with('success', 'Successfully Booked Please Check Your Email and Verify it');
    }

    public function confirm($id, $action, $token)
    {
        // Find the pickup request by its ID
        $pickup = Pickup::find($id);

        if ($pickup) {
            // Check if the token is valid and hasn't expired
            if ($pickup->verification_token === $token && Carbon::now()->lt($pickup->verification_token_expires_at)) {
                if ($action == 'accept') {
                    // Update the status to 'confirmed' when accepted
                    $pickup->verification = 'confirmed';
                    $pickup->save();

                    $ownerEmail = SiteConfig::where('siteKey', 'email')->value('siteValue');

                    // Send an email to the owner
                    Mail::to($ownerEmail)->send(new PickupStatusNotification($pickup, 'confirmed'));

                    return redirect()->route('/')->with('success', 'Your pickup has been confirmed!');
                } elseif ($action == 'reject') {
                    // Mark the status as rejected or not verified
                    $pickup->verification = 'not_verified';
                    $pickup->save();

                    return redirect()->route('/')->with('error', 'Your pickup request has been rejected.');
                }
            } else {
                return redirect()->route('/')->with('error', 'Invalid or expired token.');
            }
        } else {
            return redirect()->route('/')->with('error', 'Pickup not found.');
        }
    }
}
