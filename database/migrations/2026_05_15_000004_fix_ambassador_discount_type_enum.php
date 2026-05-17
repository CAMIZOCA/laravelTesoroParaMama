<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // First expand the enum to accept both values, then migrate data, then restrict
        DB::statement("ALTER TABLE ambassadors MODIFY discount_type ENUM('percent', 'percentage', 'fixed') NOT NULL DEFAULT 'percentage'");
        DB::statement('UPDATE ambassadors SET discount_type = "percentage" WHERE discount_type = "percent"');
        DB::statement("ALTER TABLE ambassadors MODIFY discount_type ENUM('percentage', 'fixed') NOT NULL DEFAULT 'percentage'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE ambassadors MODIFY discount_type ENUM('percent', 'percentage', 'fixed') NOT NULL DEFAULT 'percent'");
        DB::statement('UPDATE ambassadors SET discount_type = "percent" WHERE discount_type = "percentage"');
        DB::statement("ALTER TABLE ambassadors MODIFY discount_type ENUM('percent', 'fixed') NOT NULL DEFAULT 'percent'");
    }
};
