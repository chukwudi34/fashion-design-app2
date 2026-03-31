<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    CustomerController,
    DesignController,
    MeasurementController,
    MessageController,
    SyncQueueController
};

Route::prefix('v1')->group(function () {
    // Health check
    Route::get('/health', function () {
        return response()->json(['status' => 'healthy'], 200);
    });

    // Customers
    Route::apiResource('customers', CustomerController::class);

    

    // Designs
    Route::apiResource('designs', DesignController::class);

    // Measurements
    Route::apiResource('measurements', MeasurementController::class);

    Route::get('measurements/customer/{customerId}', [MeasurementController::class, 'getByCustomer']);


    // Messages
    Route::apiResource('messages', MessageController::class);

    // Sync Queue
    Route::apiResource('sync-queue', SyncQueueController::class);
    Route::apiResource('designs', DesignController::class);
    Route::delete('design-photos/{id}', [DesignController::class, 'destroyPhoto']);
});
