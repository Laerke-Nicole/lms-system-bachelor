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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->enum('place', ['Online', 'On site']);
            $table->enum('status', ['Upcoming', 'Completed', 'Expired'])->default('Upcoming');
            $table->dateTime('training_date');
            $table->string('participation_link');
            $table->boolean('reminder_sent_18_m')->default(false)->nullable();
            $table->boolean('reminder_sent_22_m')->default(false)->nullable();
            $table->date('reminder_before_training')->nullable();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('ordered_by_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('trainer_id')
                ->constrained('users')
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
        Schema::dropIfExists('trainings');
    }
};
