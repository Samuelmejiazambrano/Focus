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
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('cliente_id'); 
            $table->decimal('peso', 8, 2); 
            $table->integer('altura');
            $table->decimal('imc', 5, 2)->nullable(); 
            $table->timestamps(); 

            $table->foreign('cliente_id')->references('id')->on('cliente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};
