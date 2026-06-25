<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('design_uploads', function (Blueprint $table) {
            if (!Schema::hasColumn('design_uploads', 'preferred_material')) {
                $table->string('preferred_material')->nullable()->after('looking_for');
            }
            if (!Schema::hasColumn('design_uploads', 'annual_volume')) {
                $table->string('annual_volume')->nullable()->after('preferred_material');
            }
            if (!Schema::hasColumn('design_uploads', 'part_description')) {
                $table->text('part_description')->nullable()->after('annual_volume');
            }
            if (!Schema::hasColumn('design_uploads', 'program_name')) {
                $table->string('program_name')->nullable()->after('part_description');
            }
            if (!Schema::hasColumn('design_uploads', 'sop_timeline')) {
                $table->string('sop_timeline')->nullable()->after('program_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('design_uploads', function (Blueprint $table) {
            $cols = ['preferred_material', 'annual_volume', 'part_description', 'program_name', 'sop_timeline'];
            foreach ($cols as $col) {
                if (Schema::hasColumn('design_uploads', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
