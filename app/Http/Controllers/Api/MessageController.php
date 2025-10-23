<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\CustomerMessage;
use App\Models\Customer;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;  // ← THE MAGIC LINE!

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('customer')->latest()->get();
        return response()->json(['data' => $messages], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|integer|exists:customers,id',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'nullable|string|in:unread,read,archived,sent'
        ]);

        $message = Message::create([
            'customer_id' => $validated['customer_id'],
            'subject' => $validated['subject'],
            'content' => $validated['content'],
            'status' => $validated['status'] ?? 'unread',
        ]);

        $customer = Customer::find($validated['customer_id']);
        if ($customer && $customer->email) {
            try {
                Mail::to($customer->email)->send(
                    new CustomerMessage($customer, $validated['subject'], $validated['content'])
                );
                Log::info('Email sent to: ' . $customer->email);
            } catch (\Throwable $th) {
                Log::error('Email failed: ' . $th->getMessage());
            }
        }

        return response()->json($message, 201);
    }
}