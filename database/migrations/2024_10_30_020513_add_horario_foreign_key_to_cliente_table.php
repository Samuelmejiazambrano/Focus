<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class AddHorarioForeignKeyToClienteTable extends Migration
{
    public function up()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->unsignedBigInteger('horario')->change(); // Cambia el tipo a unsignedBigInteger si es necesario

            // Agrega la clave foránea con no action
            $table->foreign('horario')->references('id')->on('horario_clase')->onDelete('no action');
        });
    }

    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->dropForeign(['horario']);
        });
    }
}

