<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimientos'; 
    protected $fillable = [
        'cliente_id',
        'peso',
        'altura',
        'imc',
    ];

    use HasFactory;
}
