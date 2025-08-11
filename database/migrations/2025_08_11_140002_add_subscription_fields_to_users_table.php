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
            // Place after 'plan' (string) if present; otherwise just add columns
            $afterColumn = Schema::hasColumn('users', 'plan') ? 'plan' : null;
            if ($afterColumn) {
                $table->string('paypal_subscription_id')->nullable()->after($afterColumn);
            } else {
                $table->string('paypal_subscription_id')->nullable();
            }
            $table->enum('subscription_status', ['active', 'cancelled', 'expired', 'past_due'])->nullable()->after('paypal_subscription_id');
            $table->timestamp('subscribed_at')->nullable()->after('subscription_status');
            $table->timestamp('current_period_end')->nullable()->after('subscribed_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['paypal_subscription_id', 'subscription_status', 'subscribed_at', 'current_period_end']);
        });
    }
};
