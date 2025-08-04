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
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('initiator_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('participant_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('initiator_skill_id')->constrained('skills')->onDelete('cascade');
            $table->foreignId('participant_skill_id')->nullable()->constrained('skills')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled', 'disputed'])->default('pending');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('estimated_hours')->nullable();
            $table->integer('actual_hours')->nullable();
            $table->json('terms')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_urgent')->default(false);
            $table->string('budget_range')->nullable();
            $table->string('location_preference')->nullable();
            $table->string('communication_preference')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'is_featured']);
            $table->index(['initiator_id', 'status']);
            $table->index(['participant_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchanges');
    }
};
