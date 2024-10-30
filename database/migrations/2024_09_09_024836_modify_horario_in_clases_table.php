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
        Schema::table('clases', function (Blueprint $table) {
            $table->dropColumn('horario');

            $table->unsignedBigInteger('horario_id')->after('instructor_id');

            $table->foreign('horario_id')
                  ->references('id')
                  ->on('horario_clase') 
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clases', function (Blueprint $table) {

            $table->dropForeign(['horario_id']);

            $table->dropColumn('horario_id');

            $table->string('horario')->after('instructor_id');
        });
    }
};
