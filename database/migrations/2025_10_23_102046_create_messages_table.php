<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->uuid('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('subject', 255);
            $table->text('content');
            $table->enum('status', ['unread', 'read', 'archived', 'sent'])->default('unread');
    $table->enum('attachment_type', ['none', 'photo', 'document'])->default('none');
            $table->string('attachment_path', 500)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};