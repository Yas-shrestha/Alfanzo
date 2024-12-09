<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::paginate(5);
        return view('resturant.admin.Rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $files = Files::paginate(9);
        return view('resturant.admin.Rooms.create', compact('files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $room = new Room;
        $validate_data = $request->validate([
            'number' => 'required|numeric',
            'name' => 'required',
            'img' => 'required',
            'noofbed' => 'required|numeric|min:1|max:4',
            'noofwindow' => 'required|min:1|max:10',
            'special_feature' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        $room->number = $validate_data['number'];
        $room->noofbed = $validate_data['noofbed'];
        $room->noofwindow = $validate_data['noofwindow'];
        // Save the image ID and image number to the database
        $room->file_id = $validate_data['img'];
        $room->special_feature = $validate_data['special_feature'];
        $room->status = $validate_data['status'];
        $room->name = $validate_data['name'];
        $room->description = $validate_data['description'];

        $room->save();
        return redirect('admin/rooms')->with('success', 'Your data have been submitted');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = new Room;
        $room = $room->where('id', $id)->First();
        $files = Files::paginate(9);
        return view('resturant.admin.Rooms.show', compact('room', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $room = new Room;
        $room = $room->where('id', $id)->First();
        $files = Files::paginate();
        return view('resturant.admin.Rooms.edit', compact('room', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $room = new Room;
        $room = $room->where('id', $id)->First();
        $validate_data = $request->validate([
            'number' => 'required|numeric',
            'name' => 'required',
            'img' => 'required',
            'noofbed' => 'required|numeric|min:1|max:4',
            'noofwindow' => 'required|min:1|max:10',
            'special_feature' => 'required',
            'description' => 'required',
            'status' => 'required',
            'booked_by' => 'nullable'
        ]);
        $room->number = $validate_data['number'];
        $room->noofbed = $validate_data['noofbed'];
        $room->noofwindow = $validate_data['noofwindow'];
        // Save the image ID and image number to the database
        $room->file_id = $validate_data['img'];
        $room->special_feature = $validate_data['special_feature'];
        $room->booked_by = $validate_data['booked_by'] ?? $room->booked_by;

        $room->status = $validate_data['status'];
        $room->name = $validate_data['name'];
        $room->description = $validate_data['description'];

        $room->update();
        return redirect('admin/rooms')->with('success', 'Your data have been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $room = new Room;
        $room = $room->where('id', $id)->First();
        $room->delete();
        return redirect('admin/rooms')->with('success', 'Your data have been deleted');
    }
}
