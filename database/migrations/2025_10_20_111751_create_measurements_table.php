<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->foreignId('customer_id')
                  ->constrained('customers')
                  ->onDelete('cascade');
            $table->string('customer_name', 200);
            $table->date('measurement_date');
            $table->json('measurements'); // Store all measurements as JSON
            $table->json('categories')->nullable(); // Optional, for outfit type (e.g., gown, agbada)
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
