<?php

namespace App\Http\Controllers;

use App\Models\DiningSpace;
use App\Models\Files;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spaces = DiningSpace::query()->get()->all();
        $tables = Table::paginate(5);
        return view('resturant.admin.Tables.index', compact('tables', 'spaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $spaces = DiningSpace::query()->get()->all();
        $files = Files::query()->paginate(30);
        return view('resturant.admin.Tables.create', compact('files', 'spaces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $table = new Table;
        $validate_data = $request->validate([
            'img' => 'required',
            'table_status' => 'nullable',
            'table_no' => 'required|unique:tables',
            'space_id' => 'required',
        ]);

        // Save the image ID and image name to the database
        $table->file_id = $validate_data['img'];
        $table->table_status = $validate_data['table_status'];
        $table->table_no = $validate_data['table_no'];
        $table->space_id = $validate_data['space_id'];
        $table->save();
        return redirect('admin/tables')->with('success', 'Your data have been submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $table = new table;
        $table = $table->where('id', $id)->First();
        $files = Files::query()->paginate(30);
        return view('resturant.admin.tables.show', compact('table', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $table = new table;
        $table = $table->where('id', $id)->First();
        $files = Files::query()->paginate(30);
        return view('resturant.admin.tables.edit', compact('table', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $table = new Table;
        $table = $table->where('id', $id)->First();
        $validate_data = $request->validate([
            'img' => 'required',
            'table_status' => 'nullable',

            'space_id' => 'required',
        ]);


        // Save the image ID and image name to the database
        $table->file_id = $validate_data['img'];
        $table->table_status = $validate_data['table_status'];
        $table->space_id = $validate_data['space_id'];
        $table->save();
        return redirect('admin/tables')->with('success', 'Your data have been submitted');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $table = Table::where('id', $id)->first();

        if ($table) {
            if ($table->table_status != 'booked') {
                // Status is 'delivered', proceed with deletion
                $table->delete();
                return redirect('admin/tables')->with(['success' => 'table deleted successfully']);
            } else {
                // Status is not 'delivered', send an error message
                return redirect('admin/tables')->with(['error' => 'table is Booked. Cannot delete.']);
            }
        }
    }
}
