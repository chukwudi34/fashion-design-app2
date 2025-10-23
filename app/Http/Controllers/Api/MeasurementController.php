<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
use Illuminate\Http\Request;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $measurements = Measurement::with('customer')->orderBy('measurement_date', 'desc')->get();
        return response()->json(['success' => true, 'data' => $measurements]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $measurement = Measurement::create($request->all());
        return response()->json(['success' => true, 'data' => $measurement->load('customer')], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Measurement $measurement)
    {
        return response()->json(['success' => true, 'data' => $measurement->load('customer')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Measurement $measurement)
    {
        $measurement->update($request->all());
        return response()->json(['success' => true, 'data' => $measurement->load('customer')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Measurement $measurement)
    {
        $measurement->delete();
        return response()->json(['success' => true, 'message' => 'Measurement deleted']);
    }

    /**
     * ✅ NEW METHOD: Get all measurements for a specific customer
     */
    public function getByCustomer($customerId)
    {
        $measurements = Measurement::where('customer_id', $customerId)
            ->with('customer')
            ->orderBy('measurement_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $measurements
        ]);
    }
}