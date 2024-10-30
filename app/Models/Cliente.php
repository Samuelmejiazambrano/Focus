<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente'; 
    protected $fillable = [
        'email',
        'tipo_documento',
        'documento',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'ciudad',
        'horario',
        'nombres_apellidos',
        'plan'
    ];
    public function cliente_resultado()
    {
        return $this->hasMany(ResultadosClase::class, 'cliente_id');
    }
    
    public function plan()
    {
        return $this->belongsTo(Cliente::class, 'planes');
    }
    public function horarios()
    {
        return $this->belongsTo(Horario::class, 'horario'); 
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_cliente'); 
    }
    use HasFactory;
}
