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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('exchange_id')->nullable()->constrained('exchanges')->onDelete('cascade');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->enum('message_type', ['direct', 'exchange', 'system'])->default('direct');
            $table->json('attachments')->nullable();
            $table->timestamps();
            
            $table->index(['sender_id', 'receiver_id']);
            $table->index(['receiver_id', 'is_read']);
            $table->index(['exchange_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
