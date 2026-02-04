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
        Schema::create('training_slots', function (Blueprint $table) {
            $table->id();
            $table->dateTime('training_date');
            $table->date('training_day');
            $table->enum('place', ['Online', 'On site'])->nullable();
            $table->enum('status', ['Available', 'Unavailable'])->default('Available');
            $table->string('participation_link', 2048)->nullable();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('created_by_admin_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('trainer_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            $table->unique(['course_id', 'training_day'], 'uniq_course_day');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_slots');
    }
};
