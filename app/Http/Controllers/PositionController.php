<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::all();

        return view('admin.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.positions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only('name');

        $position = Position::create($data);

        if ($request->has('categories')) {
            $position->categories()->attach($request->categories);
        }

        return redirect()->route('positions.index')->with([
            'status' => 'Должность  добавлена'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $position = Position::findOrFail($id);
        $categories = Category::all();

        return view('admin.positions.edit', compact('position', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $position = Position::findOrFail($id);

        $data = $request->only('name');

        $position->update($data);

        if ($request->has('categories')) {
            $position->categories()->sync($request->categories);
        }

        return redirect()->route('positions.index')->with([
            'status' => 'Должность обновлена'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Position::findOrFail($id);

        $category->delete();

        return redirect()->route('positions.index')->with([
            'status' => 'Должность удалена'
        ]);
    }
}
