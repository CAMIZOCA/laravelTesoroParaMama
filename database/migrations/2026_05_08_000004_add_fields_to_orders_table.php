<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_lastname')->nullable()->after('customer_name');
            $table->string('customer_whatsapp')->nullable()->after('customer_phone');
            $table->decimal('shipping_cost', 10, 2)->default(0)->after('subtotal');
            $table->string('ambassador_code')->nullable()->after('customer_notes');
            $table->foreignId('ambassador_id')->nullable()->constrained('ambassadors')->nullOnDelete()->after('ambassador_code');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['ambassador_id']);
            $table->dropColumn(['customer_lastname', 'customer_whatsapp', 'shipping_cost', 'ambassador_code', 'ambassador_id']);
        });
    }
};
