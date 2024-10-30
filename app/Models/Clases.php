<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clases extends Model
{
    protected $table = 'clases'; 

    use HasFactory;
 
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'instructor_id');
    }
    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }
    public function resultados()
    {
        return $this->hasMany(ResultadosClase::class, 'clase_id');
    }
    public function clases_resultado()
    {
        return $this->hasMany(ResultadosClase::class, 'clase_id');
    }
 
}
