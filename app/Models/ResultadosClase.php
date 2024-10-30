<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultadosClase extends Model
{
    protected $table = 'resultados_de_clase'; 

    use HasFactory;
    
    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class, 'ejercicio_id');
    }
    public function clase()
    {
        return $this->belongsTo(Clases::class, 'clase_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
