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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->text('bio')->nullable()->after('email');
            $table->string('location')->nullable()->after('bio');
            $table->string('avatar')->nullable()->after('location');
            $table->string('phone')->nullable()->after('avatar');
            $table->string('website')->nullable()->after('phone');
            $table->string('linkedin')->nullable()->after('website');
            $table->string('github')->nullable()->after('linkedin');
            $table->string('twitter')->nullable()->after('github');
            $table->boolean('is_admin')->default(false)->after('twitter');
            $table->boolean('is_verified')->default(false)->after('is_admin');
            $table->decimal('rating', 3, 2)->default(0.00)->after('is_verified');
            $table->integer('total_exchanges')->default(0)->after('rating');
            $table->integer('completed_exchanges')->default(0)->after('total_exchanges');
            $table->timestamp('member_since')->nullable()->after('completed_exchanges');
            $table->timestamp('last_active')->nullable()->after('member_since');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'bio',
                'location',
                'avatar',
                'phone',
                'website',
                'linkedin',
                'github',
                'twitter',
                'is_admin',
                'is_verified',
                'rating',
                'total_exchanges',
                'completed_exchanges',
                'member_since',
                'last_active'
            ]);
        });
    }
};
