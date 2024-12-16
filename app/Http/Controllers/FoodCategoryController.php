<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new FoodCategory;
        $request->validate(
            ['title' => 'unique:food_categories,title|required']
        );
        $category->title = $request->title;
        $category->save();
        return redirect()->back()->with('success', 'Category Added');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodCategory $foodCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodCategory $foodCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FoodCategory $foodCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $food = new FoodCategory();
        $food = $food->where('id', $id)->First();
        $food->delete();
        return redirect()->back()->with('success', 'Your data have been deleted');
    }
}
