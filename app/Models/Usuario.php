<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users'; 

    use HasFactory;
    
    public function clases()
    {  
        return $this->hasMany(Clases::class, 'instructor_id');
    }
}
