<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('stripe_payment_intent_id', 'payphone_transaction_id');
            $table->renameColumn('stripe_status', 'payphone_client_transaction_id');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('payphone_transaction_id', 'stripe_payment_intent_id');
            $table->renameColumn('payphone_client_transaction_id', 'stripe_status');
        });
    }
};
