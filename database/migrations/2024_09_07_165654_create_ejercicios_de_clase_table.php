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
        Schema::create('ejercicios_de_clase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clase_id');
            $table->unsignedBigInteger('ejercicio_id');
            $table->string('tipo_de_entrenamiento'); 

            $table->foreign('clase_id')->references('id')->on('clases')->onDelete('cascade');
            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicios_de_clase');
    }
};
