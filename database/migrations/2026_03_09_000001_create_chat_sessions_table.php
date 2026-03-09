<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->unique();   // Browser-generated UUID stored in localStorage
            $table->string('name')->nullable();        // Visitor's name (set when they start chat)
            $table->string('email')->nullable();       // Visitor's email (optional)
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->integer('unread_by_admin')->default(0);  // count of messages admin hasn't read
            $table->integer('unread_by_client')->default(0); // count of messages client hasn't read
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_sessions');
    }
};
