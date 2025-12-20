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
            $table->string('ab_inventech_name', 255);
            $table->string('ab_inventech_web', 2048)->unique();
            $table->string('ab_inventech_mail', 254)->unique();
            $table->string('ab_inventech_phone', 20)->unique();
            $table->string('logo', 255)->nullable();

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
