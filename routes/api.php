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

    // Customers
    Route::apiResource('customers', CustomerController::class);

    

    // Designs
    Route::apiResource('designs', DesignController::class);

    // Measurements
    Route::apiResource('measurements', MeasurementController::class);

    // Messages
    Route::apiResource('messages', MessageController::class);

    // Route::get('/measurements', [MeasurementController::class, 'index']);
    // Route::post('/measurements', [MeasurementController::class, 'store']);
    // Sync Queue
    Route::apiResource('sync-queue', SyncQueueController::class);
    Route::apiResource('designs', DesignController::class);
    Route::delete('design-photos/{id}', [DesignController::class, 'destroyPhoto']);
});
