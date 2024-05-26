<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Employee;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = Trip::all();

        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $cars = Car::all();

        return view('admin.trips.create', compact('employees', 'cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only('start_time', 'end_time', 'employee_id', 'car_id');

        Trip::create($data);

        return redirect()->route('trips.index')->with([
            'status' => 'Поездка добавлена'
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
        $trip = Trip::findOrFail($id);
        $employees = Employee::all();
        $cars = Car::all();

        return view('admin.trips.edit', compact('trip', 'employees', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $trip = Trip::findOrFail($id);

        $data = $request->only('start_time', 'end_time', 'employee_id', 'car_id');

        $trip->update($data);

        return redirect()->route('trips.index')->with([
            'status' => 'Поездка обновлена'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trip = Trip::findOrFail($id);

        $trip->delete();

        return redirect()->route('trips.index')->with([
            'status' => 'Поездка удалена'
        ]);
    }

    public function availableCars(Request $request)
    {
        $employee = Employee::find($request->employee_id);
        $startTime = $request->start_time;
        $endTime = $request->end_time;

        $query = $this->getAvailableCarsQuery($employee->position_id, $startTime, $endTime);

        $result = $query->get();

        return response()->json($result);
    }

    private function getAvailableCarsQuery($positionId, $startTime, $endTime)
    {
        $carPosition =  DB::table('cars')
            ->join('categories', 'cars.category_id', '=', 'categories.id')
            ->join('position_category', 'categories.id', '=', 'position_category.category_id')
            ->join('positions', 'position_category.position_id', '=', 'positions.id')
            ->where('positions.id', $positionId)
            ->select('cars.id', 'cars.name')
            ->get();

        $query = Car::leftJoin('trips', function ($join) use ($startTime, $endTime) {
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
            ->whereNull('trips.car_id');

        $carArr = $carPosition->pluck('name')->toArray();

        if ($carPosition) {
            $query->whereIn('cars.name', $carArr);
        }

        $availableCars = $query->select('cars.id', 'cars.name');

        return $availableCars;
    }
}
