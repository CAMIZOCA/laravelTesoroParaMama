<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('ambassador_id')->nullable()->after('customer_notes');
            $table->string('ambassador_code')->nullable()->after('ambassador_id');
            $table->decimal('discount_amount', 8, 2)->default(0)->after('ambassador_code');

            $table->foreign('ambassador_id')->references('id')->on('ambassadors')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['ambassador_id']);
            $table->dropColumn(['ambassador_id', 'ambassador_code', 'discount_amount']);
        });
    }
};
