<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        $allowed = ['make', 'color', 'year'];   // whitelist
        $query = Vehicle::query();

        foreach ($allowed as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->query($field));
            }
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'make'  => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'color' => 'required|string|max:50',
            'year'  => 'required|integer|min:1886|max:2100',
            'price' => 'required|numeric|min:0',
        ]);

        return response()->json(Vehicle::create($data), 201);
    }

    public function show(Vehicle $vehicle)
    {
        return response()->json($vehicle);
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->validate([
            'make'  => 'sometimes|required|string|max:100',
            'model' => 'sometimes|required|string|max:100',
            'color' => 'sometimes|required|string|max:50',
            'year'  => 'sometimes|required|integer|min:1886|max:2100',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $vehicle->update($data);
        return response()->json($vehicle);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response()->noContent();   // 204
    }
}