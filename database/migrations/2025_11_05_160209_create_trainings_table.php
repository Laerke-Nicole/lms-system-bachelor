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
            $table->enum('status', ['Upcoming', 'Completed', 'Expired'])->default('Upcoming');
            $table->boolean('reminder_sent_18_m')->default(false)->nullable();
            $table->boolean('reminder_sent_22_m')->default(false)->nullable();
            $table->date('reminder_before_training')->nullable();

            $table->foreignId('ordered_by_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('training_slot_id')
                ->constrained('training_slots')
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
