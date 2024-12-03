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
        Schema::create('user_states', function (Blueprint $table) {
            $table->id();
            $table->string('telefono'); // Teléfono del usuario
            $table->string('estado')->default('inicio'); // Estado actual
            $table->unsignedBigInteger('documento_id')->nullable(); // Documento relacionado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_states');
    }
};
