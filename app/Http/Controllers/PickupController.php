<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function index()
    {
        $pickups = Pickup::query()->paginate(7);
        return view('resturant.admin.Pickup.index', compact('pickups'));
    }
    public function create()
    {
        return view('resturant.admin.Pickup.create');
    }
    public function show($id)
    {
        $pickup = new Pickup;
        $pickup = $pickup->where('id', $id)->First();
        return view('resturant.admin.Pickup.show', compact('pickup'));
    }
    public function cancel(Request $request, $id)
    {
        // dd($request);
        $Pickup = Pickup::find($id);
        $Pickup->pickup_status = 'canceled';
        $Pickup->save();
        return redirect()->back()->with('success', 'Pickup is cancelled');
    }
    public function updateStatus(Request $request, $id)
    {
        $pickup = Pickup::query()->where('id', $id)->first();
        $request->validate([
            'status' => 'required',  // Ensure price is a number and greater than or equal to 1
        ]);
        $pickup->pickup_status = $request->status;
        $pickup->save();
        return redirect()->back()->with('success', ' Pickup Status updated successfully!');
    }
}
