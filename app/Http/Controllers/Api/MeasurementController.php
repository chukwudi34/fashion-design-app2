<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    // ✅ Get all measurements
    public function index()
    {
        $measurements = Measurement::latest()->get();
        return response()->json($measurements, 200);
    }

    // ✅ Show a single measurement
    public function show($id)
    {
        $measurement = Measurement::findOrFail($id);
        return response()->json($measurement, 200);
    }

    // ✅ Store a new measurement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'customer_name' => 'required|string|max:200',
            'measurement_date' => 'required|date',
            'measurements' => 'required|array',
            'categories' => 'nullable|array',
            'notes' => 'nullable|string',
              'data' => 'nullable|json'
        ]);

        $measurement = Measurement::create([
            'customer_id' => $validated['customer_id'],
            'customer_name' => $validated['customer_name'],
            'measurement_date' => $validated['measurement_date'],
            'measurements' => $validated['measurements'],
            'categories' => $validated['categories'] ?? [],
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json([
            'message' => 'Measurement saved successfully!',
            'data' => $measurement
        ], 201);
    }

    // ✅ Update measurement
    public function update(Request $request, $id)
    {
        $measurement = Measurement::findOrFail($id);

        $validated = $request->validate([
            'measurement_date' => 'nullable|date',
            'measurements' => 'nullable|array',
            'categories' => 'nullable|array',
            'notes' => 'nullable|string',
        ]);

        $measurement->update($validated);

        return response()->json([
            'message' => 'Measurement updated successfully!',
            'data' => $measurement
        ], 200);
    }

    // ✅ Delete a measurement
    public function destroy($id)
    {
        $measurement = Measurement::findOrFail($id);
        $measurement->delete();

        return response()->json([
            'message' => 'Measurement deleted successfully.'
        ], 200);
    }
}
