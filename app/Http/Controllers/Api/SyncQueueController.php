<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SyncQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SyncQueueController extends Controller
{
    public function index()
    {
        return response()->json(SyncQueue::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'operation' => 'required|in:create,update,delete',
            'entity_type' => 'required|in:customer,measurement,design,message',
            'data' => 'required|array',
            'status' => 'nullable|string',
        ]);

        $validated['id'] = Str::uuid()->toString();
        $queue = SyncQueue::create($validated);

        return response()->json($queue, 201);
    }

    public function update(Request $request, $id)
    {
        $queue = SyncQueue::findOrFail($id);
        $queue->update($request->all());
        return response()->json($queue, 200);
    }

    public function destroy($id)
    {
        SyncQueue::destroy($id);
        return response()->json(['message' => 'Sync queue record deleted'], 204);
    }
}
