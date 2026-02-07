<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('training_slots', function (Blueprint $table) {
            if (!Schema::hasColumn('training_slots', 'training_day')) {
                $table->date('training_day')->nullable()->after('training_date');
            }
        });

        // Backfill training_day from existing training_date values
        DB::table('training_slots')
            ->whereNull('training_day')
            ->update(['training_day' => DB::raw('DATE(training_date)')]);

        Schema::table('training_slots', function (Blueprint $table) {
            $table->date('training_day')->nullable(false)->change();
        });

        // Only add the unique constraint if it doesn't already exist
        $indexExists = collect(DB::select("SHOW INDEX FROM training_slots WHERE Key_name = 'uniq_course_day'"))->isNotEmpty();
        if (!$indexExists) {
            Schema::table('training_slots', function (Blueprint $table) {
                $table->unique(['course_id', 'training_day'], 'uniq_course_day');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_slots', function (Blueprint $table) {
            $table->dropUnique('uniq_course_day');
            $table->dropColumn('training_day');
        });
    }
};
