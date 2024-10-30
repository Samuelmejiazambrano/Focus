<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = 'planes'; 

    use HasFactory;
    
    public function pago()
    {
        return $this->hasMany(Plan::class, 'id_plan');
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_plan'); 
    }
    
}
