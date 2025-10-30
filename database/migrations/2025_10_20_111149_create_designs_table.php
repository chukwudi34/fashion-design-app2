<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('designs', function (Blueprint $table) {
        // $table->id();
        $table->uuid('id')->primary();
        $table->foreignId('customer_id')
              ->constrained('customers')
              ->onDelete('cascade'); // Delete designs if customer is deleted

        $table->string('name', 255);
        $table->text('description')->nullable();
        $table->enum('status', ['draft', 'in_progress', 'completed', 'delivered'])
              ->default('draft');
              $table->string('photo')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designs');
    }
};
