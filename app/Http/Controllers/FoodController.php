<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::paginate(5);
        $foodCategories = FoodCategory::paginate(5);
        return view('resturant.admin.Foods.index', compact('foods', 'foodCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $files = Files::query()->paginate(30);
        $foodCategories = FoodCategory::paginate(5);
        return view('resturant.admin.Foods.create', compact('files', 'foodCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $food = new Food;
        $validate_data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'nullable',
            'img' => 'required',
            'type' => 'required'
        ]);
        $food->name = $validate_data['name'];
        $food->description = $validate_data['description'];

        // Save the image ID and image name to the database
        $food->file_id = $validate_data['img'];
        $food->price = $validate_data['price'];
        $food->category_id = $validate_data['type'];

        $food->save();
        return redirect('admin/foods')->with('success', 'Your data have been submitted');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $food = new Food;
        $food = $food->where('id', $id)->First();
        $files = Files::query()->paginate(30);
        return view('resturant.admin.Foods.show', compact('food', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $food = new Food;
        $food = $food->where('id', $id)->First();
        $files = Files::paginate();
        return view('resturant.admin.Foods.edit', compact('food', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $food = new Food;
        $food = $food->where('id', $id)->First();
        $validate_data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'type' => 'required'
        ]);
        $food->name = $validate_data['name'];
        $food->description = $validate_data['description'];


        // Save the image ID and image name to the database
        $food->file_id = $validate_data['img'];
        $food->price = $validate_data['price'];
        $food->category_id = $validate_data['type'];

        $food->update();
        return redirect('admin/foods')->with('success', 'Your data have been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $food = new Food;
        $food = $food->where('id', $id)->First();
        $food->delete();
        return redirect('admin/foods')->with('success', 'Your data have been deleted');
    }
}
