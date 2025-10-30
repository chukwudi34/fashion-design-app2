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
    Schema::create('sync_queue', function (Blueprint $table) {
        // $table->string('id', 100)->primary();
        $table->uuid('id')->primary();
        $table->timestamp('timestamp')->useCurrent();
        $table->enum('operation', ['create', 'update', 'delete']);
        $table->enum('entity_type', ['customer', 'measurement', 'design', 'message']);
        $table->json('data');
        $table->integer('attempts')->default(0);
        $table->timestamp('last_attempt')->nullable();
        $table->enum('status', ['pending', 'retry', 'failed', 'completed'])->default('pending');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync_queues');
    }
};
