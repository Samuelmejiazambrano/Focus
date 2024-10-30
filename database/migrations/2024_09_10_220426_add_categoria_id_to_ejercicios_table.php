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
        Schema::table('ejercicios', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id')->nullable()->after('grupo_muscular');

            $table->foreign('categoria_id')
                  ->references('id')
                  ->on('categoria')
                  ->onDelete('cascade');
        });
    }

    /**
     */
    public function down(): void
    {
        Schema::table('ejercicios', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
        });
    }
};
