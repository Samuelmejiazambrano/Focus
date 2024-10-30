<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->unsignedBigInteger('id_cliente');
            $table->string('metodo_pago');
            $table->string('comprobante_pago')->nullable();
            $table->unsignedBigInteger('id_plan');

            $table->foreign('id_cliente')->references('id')->on('cliente')->onDelete('cascade');
            $table->foreign('id_plan')->references('id')->on('planes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
