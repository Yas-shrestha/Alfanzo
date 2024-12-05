<?php

namespace App\Http\Controllers;

use App\Models\DiningSpace;
use App\Models\Files;
use Illuminate\Http\Request;

class DiningSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spaces = DiningSpace::paginate(5);
        return view('resturant.admin.DiningSpaces.index', compact('spaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $files = Files::paginate(9);
        return view('resturant.admin.DiningSpaces.create', compact('files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $spaces = new DiningSpace;
        $validate_data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img' => 'required',
        ]);
        $spaces->title = $validate_data['title'];
        $spaces->description = $validate_data['description'];
        // Save the image ID and image name to the database
        $spaces->file_id = $validate_data['img'];
        $spaces->save();
        return redirect('admin/spaces')->with('success', 'Your data have been submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $spaces = new DiningSpace;
        $spaces = $spaces->where('id', $id)->First();
        $files = Files::paginate(9);
        return view('resturant.admin.DiningSpaces.show', compact('spaces', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $spaces = new DiningSpace;
        $spaces = $spaces->where('id', $id)->First();
        $files = Files::paginate(9);
        return view('resturant.admin.DiningSpaces.edit', compact('spaces', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $spaces = new DiningSpace;
        $spaces = $spaces->where('id', $id)->First();
        $validate_data = $request->validate([
            'img' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        $spaces->title = $validate_data['title'];
        $spaces->description = $validate_data['description'];
        // Save the image ID and image name to the database
        $spaces->file_id = $validate_data['img'];
        $spaces->update();
        return redirect('admin/spaces')->with('success', 'Your data have been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spaces = new DiningSpace;
        $spaces = $spaces->where('id', $id)->First();
        $spaces->delete();
        return redirect('admin/spaces')->with('success', 'Your data have been deleted');
    }
}
