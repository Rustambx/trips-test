<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Category;
use App\Models\Driver;
use App\Models\Employee;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();

        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $drivers = Driver::whereNotIn('id', function($query) {
            $query->select('driver_id')->from('cars');
        })->get();

        return view('admin.cars.create', compact('categories', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only('name', 'model', 'category_id', 'driver_id');

        Car::create($data);

        return redirect()->route('cars.index')->with([
            'status' => 'Автомобиль добавлен'
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
        $car = Car::findOrFail($id);
        $categories = Category::all();
        $drivers = Driver::all();

        return view('admin.cars.edit', compact('car', 'categories', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $car = Car::findOrFail($id);

        $data = $request->only('name', 'model', 'category_id', 'driver_id');

        $car->update($data);

        return redirect()->route('cars.index')->with([
            'status' => 'Автомобиль обновлен'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::findOrFail($id);

        $car->delete();

        return redirect()->route('cars.index')->with([
            'status' => 'Автомобиль удален'
        ]);
    }

    public function getCars(Request $request)
    {
        $employee = Employee::find($request->input('employee_id'));
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');
        $model = $request->input('model');
        $category = $request->input('category');
        $positionId = $employee->position_id;

        $query = $this->getAvailableCarsDate($positionId, $startTime, $endTime, $model, $category);

        $result = $query->get();

        return response()->json($result);
    }

    public function getAvailableCarsDate($positionId, $startTime, $endTime, $model = null, $category = null)
    {
        $query = Car::with('category')
        ->join('categories', 'cars.category_id', '=', 'categories.id')
            ->join('position_category', 'categories.id', '=', 'position_category.category_id')
            ->join('positions', 'position_category.position_id', '=', 'positions.id')
            ->leftJoin('trips', function ($join) use ($startTime, $endTime) {
                $join->on('cars.id', '=', 'trips.car_id')
                    ->where(function ($query) use ($startTime, $endTime) {
                        $query->whereBetween('trips.start_time', [$startTime, $endTime])
                            ->orWhereBetween('trips.end_time', [$startTime, $endTime])
                            ->orWhere(function ($query) use ($startTime, $endTime) {
                                $query->where('trips.start_time', '<=', $startTime)
                                    ->where('trips.end_time', '>=', $endTime);
                            });
                    });
            })
            ->where('positions.id', $positionId)
            ->whereNull('trips.car_id');

        if ($model) {
            $query->where('cars.model', $model);
        }

        if ($category) {
            $query->where('categories.name', $category);
        }

        return $query->select('cars.id', 'cars.name', 'cars.model', 'categories.name as category');
    }
}
