<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vigencia extends Model
{
    protected $fillable = [
        'tipo_vigencia',    
        'id_empresa',
        'dias_restantes',
        'fecha_inicio',
        'fecha_fin',
        'duracion_dias',
        'fecha_actualizacion',
        "autorizado_por",
        'estatus'
    ];
}
