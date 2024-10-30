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
        Schema::create('planes', function (Blueprint $table) {
            $table->id(); 
            $table->string('nombre'); 
            $table->text('descripcion')->nullable(); 
            $table->decimal('precio', 8, 2); 
            $table->integer('duracion_dias');
            $table->string('estado')->default('activo'); // Estado del plan ('activo', 'inactivo', etc.)
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};
