<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjerciciosClases extends Model
{
    protected $table = 'ejercicios_de_clase'; 
    public function clase()
    {
        return $this->belongsTo(Clases::class, 'clase_id');
    }
    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class, 'ejercicio_id');
    }
    use HasFactory;
}
