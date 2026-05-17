<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ambassadors', function (Blueprint $table) {
            if (!Schema::hasColumn('ambassadors', 'last_name')) {
                $table->string('last_name')->default('')->after('name');
            }

            if (!Schema::hasColumn('ambassadors', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('discount_value');
            }

            if (!Schema::hasColumn('ambassadors', 'discount_value')) {
                $table->decimal('discount_value', 8, 2)->default(0)->after('discount_type');
            }
        });

        // Migrate data from old columns to new ones if they exist
        if (Schema::hasColumn('ambassadors', 'lastname') && Schema::hasColumn('ambassadors', 'last_name')) {
            \DB::statement('UPDATE ambassadors SET last_name = lastname WHERE last_name = ""');
        }

        if (Schema::hasColumn('ambassadors', 'is_active') && Schema::hasColumn('ambassadors', 'status')) {
            \DB::statement('UPDATE ambassadors SET status = CASE WHEN is_active = 1 THEN "active" ELSE "inactive" END');
        }
    }

    public function down(): void
    {
        Schema::table('ambassadors', function (Blueprint $table) {
            $table->dropColumn(array_filter(['last_name', 'status'], fn($col) => Schema::hasColumn('ambassadors', $col)));
        });
    }
};
