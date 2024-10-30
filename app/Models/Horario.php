<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario_clase'; 

    use HasFactory;
    public function clase()
    {
        return $this->hasMany(Clases::class, 'horario_id');
    }
    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'horario'); 
    }
}
