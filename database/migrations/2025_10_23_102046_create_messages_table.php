<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                  ->nullable()
                  ->constrained('customers')
                  ->onDelete('set null');
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