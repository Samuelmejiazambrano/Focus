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
        Schema::create('resultados_de_clase', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clase_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('ejercicio_id');
            $table->integer('repeticiones');
            $table->integer('series');
            $table->decimal('peso', 8, 2);
            $table->timestamp('fecha_creacion')->useCurrent(); 
            $table->timestamps();

            $table->foreign('clase_id')->references('id')->on('clases')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
            $table->foreign('ejercicio_id')->references('id')->on('ejercicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_de_clase');
    }
};
