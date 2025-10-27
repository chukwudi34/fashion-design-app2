<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DesignController extends Controller
{
    public function index()
    {
        return response()->json(Design::with('customer')->get(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:draft,in_progress,completed,delivered',
            'design_date' => 'nullable|date',
            'fabric_type' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'style' => 'nullable|string|max:100',
            'occasion' => 'nullable|string|max:255',
            'special_instructions' => 'nullable|string',
            'first_fitting' => 'nullable|date',
            'final_fitting' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'estimated_price' => 'nullable|numeric',
            'final_price' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $design = Design::create($validated);

        // Handle multiple photo uploads
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('designs', 'public');
                $design->photos()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return response()->json([
            'message' => 'Design created successfully',
            'data' => $design->load('photos'),
        ], 201);
    }

    public function show($id)
    {
        return response()->json(Design::with('customer')->findOrFail($id), 200);
    }

    public function update(Request $request, $id)
    {
        $design = Design::findOrFail($id);

        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:draft,in_progress,completed,delivered',
            'design_date' => 'nullable|date',
            'fabric_type' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:100',
            'style' => 'nullable|string|max:100',
            'occasion' => 'nullable|string|max:255',
            'special_instructions' => 'nullable|string',
            'first_fitting' => 'nullable|date',
            'final_fitting' => 'nullable|date',
            'completion_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'estimated_price' => 'nullable|numeric',
            'final_price' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $design->update($validated);

        // Add new photos if provided
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('designs', 'public');
                $design->photos()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return response()->json([
            'message' => 'Design updated successfully',
            'data' => $design->load('photos'),
        ], 200);
    }

    public function destroyPhoto($photoId)
    {
        $photo = \App\Models\DesignPhoto::findOrFail($photoId);

        if (Storage::disk('public')->exists($photo->file_path)) {
            Storage::disk('public')->delete($photo->file_path);
        }

        $photo->delete();

        return response()->json(['message' => 'Photo deleted successfully'], 200);
    }

    public function destroy($id)
    {
        $design =  Design::findOrFail($id);
        $design->delete();

        return response()->json(['message' => 'Design deleted'], 204);
    }
}