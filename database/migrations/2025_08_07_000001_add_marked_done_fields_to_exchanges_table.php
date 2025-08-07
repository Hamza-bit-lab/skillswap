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
        Schema::table('exchanges', function (Blueprint $table) {
            $table->boolean('initiator_marked_done')->default(false)->after('status');
            $table->boolean('participant_marked_done')->default(false)->after('initiator_marked_done');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exchanges', function (Blueprint $table) {
            $table->dropColumn(['initiator_marked_done', 'participant_marked_done']);
        });
    }
};