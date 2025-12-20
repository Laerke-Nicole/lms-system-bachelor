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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->integer('duration');
            $table->integer('duration_months');
            $table->integer('max_participants');
            $table->string('image', 255)->nullable();

            $table->foreignId('evaluation_id')
                ->constrained('evaluations')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('follow_up_test_id')
                ->constrained('follow_up_tests')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
