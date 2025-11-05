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
        Schema::create('follow_up_materials', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['video', 'pdf', 'task', 'quiz']);
            $table->string('url')->nullable();

            $table->foreignId('course_id')
                ->constrained('courses')
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
        Schema::dropIfExists('follow_up_materials');
    }
};
