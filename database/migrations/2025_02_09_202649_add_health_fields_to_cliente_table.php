<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHealthFieldsToClienteTable extends Migration
{
    public function up()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->string('prestador_servicios_salud')->nullable()->after('horario');
            $table->string('tipo_sangre', 10)->nullable()->after('prestador_servicios_salud');
            $table->text('alergico_medicamento_sustancia')->nullable()->after('tipo_sangre');
            $table->text('observaciones')->nullable()->after('alergico_medicamento_sustancia'); // Nuevo campo
        });
    }

    public function down()
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->dropColumn(['prestador_servicios_salud', 'tipo_sangre', 'alergico_medicamento_sustancia', 'observaciones']);
        });
    }
}
