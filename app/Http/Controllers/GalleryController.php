<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::paginate(5);
        return view('resturant.admin.Galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $files = Files::query()->paginate(8);
        return view('resturant.admin.Galleries.create', compact('files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $gallery = new Gallery;
        $validate_data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'img' => 'required',
        ]);
        $gallery->title = $validate_data['title'];
        $gallery->description = $validate_data['description'];
        // Save the image ID and image name to the database
        $gallery->file_id = $validate_data['img'];

        $gallery->save();
        return redirect('admin/galleries')->with('success', 'Your data have been submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $gallery = new Gallery;
        $gallery = $gallery->where('id', $id)->First();
        $files = Files::paginate(9);
        return view('resturant.admin.Galleries.show', compact('gallery', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = new Gallery;
        $gallery = $gallery->where('id', $id)->First();
        $files = Files::paginate(9);
        return view('resturant.admin.Galleries.edit', compact('gallery', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $gallery = new Gallery;
        $gallery = $gallery->where('id', $id)->First();
        $validate_data = $request->validate([
            'img' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        $gallery->title = $validate_data['title'];
        $gallery->description = $validate_data['description'];
        // Save the image ID and image name to the database
        $gallery->file_id = $validate_data['img'];

        $gallery->update();
        return redirect('admin/galleries')->with('success', 'Your data have been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = new Gallery;
        $gallery = $gallery->where('id', $id)->First();
        $gallery->delete();
        return redirect('admin/galleries')->with('success', 'Your data have been deleted');
    }
}
