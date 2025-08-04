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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reviewer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reviewed_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('exchange_id')->nullable()->constrained('exchanges')->onDelete('cascade');
            $table->foreignId('skill_id')->nullable()->constrained('skills')->onDelete('cascade');
            $table->integer('rating');
            $table->string('title');
            $table->text('comment');
            $table->boolean('is_verified')->default(false);
            $table->enum('review_type', ['exchange', 'skill', 'user'])->default('exchange');
            $table->timestamps();
            
            $table->index(['reviewed_user_id', 'rating']);
            $table->index(['skill_id', 'rating']);
            $table->index(['exchange_id', 'created_at']);
            $table->unique(['reviewer_id', 'reviewed_user_id', 'exchange_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
