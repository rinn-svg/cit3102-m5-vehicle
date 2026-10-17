<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    private const FILTERABLE = ['make', 'color', 'year'];

    public function index(Request $request): JsonResponse
    {
        $query = Vehicle::query();

        foreach (self::FILTERABLE as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->query($field));
            }
        }

        return response()->json($query->get());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'make' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:100'],
            'color' => ['required', 'string', 'max:50'],
            'year' => ['required', 'integer', 'min:1886', 'max:2100'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        return response()->json(Vehicle::create($data), 201);
    }

    public function show(Vehicle $vehicle): JsonResponse
    {
        return response()->json($vehicle);
    }

    public function update(Request $request, Vehicle $vehicle): JsonResponse
    {
        $data = $request->validate([
            'make' => ['sometimes', 'required', 'string', 'max:100'],
            'model' => ['sometimes', 'required', 'string', 'max:100'],
            'color' => ['sometimes', 'required', 'string', 'max:50'],
            'year' => ['sometimes', 'required', 'integer', 'min:1886', 'max:2100'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
        ]);

        $vehicle->update($data);

        return response()->json($vehicle);
    }

    public function destroy(Vehicle $vehicle): Response
    {
        $vehicle->delete();

        return response()->noContent();
    }
}