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
        Schema::create('ab_inventech', function (Blueprint $table) {
            $table->id();
            $table->string('ab_inventech_name');
            $table->string('ab_inventech_web')->unique();
            $table->string('ab_inventech_mail')->unique();
            $table->string('ab_inventech_phone')->unique();
            $table->string('logo')->nullable();

            $table->foreignId('address_id')
                ->constrained('addresses')
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
        Schema::dropIfExists('ab_inventech');
    }
};
