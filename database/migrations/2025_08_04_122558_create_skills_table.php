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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('category');
            $table->enum('level', ['beginner', 'intermediate', 'advanced', 'expert']);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->string('portfolio_url')->nullable();
            $table->json('certifications')->nullable();
            $table->integer('experience_years')->default(0);
            $table->timestamps();
            
            $table->index(['category', 'is_verified']);
            $table->index(['user_id', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
