<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos'; 

    use HasFactory;
    
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'id_plan'); 
    }
    
   
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente'); // Cambiado a belongsTo
    }
    
}
