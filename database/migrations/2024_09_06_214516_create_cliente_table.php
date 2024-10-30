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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento');
            $table->string('documento')->unique();
            $table->string('nombres_apellidos');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('direccion');
            $table->date('fecha_nacimiento');
            $table->string('horario');
            $table->date('fecha_proximo_plan')->nullable();
            $table->string('estado')->default('1'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
