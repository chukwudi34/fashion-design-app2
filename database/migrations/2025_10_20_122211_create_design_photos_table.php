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
    Schema::create('design_photos', function (Blueprint $table) {
        // $table->id();
            $table->uuid('id')->primary();
            
        $table->uuid('design_id');
       $table->foreign('design_id')->references('id')->on('designs');

        $table->string('file_path');
        $table->string('file_name')->nullable();
        $table->timestamps();
        
    });
}

public function down(): void
{
    Schema::dropIfExists('design_photos');
}

};
