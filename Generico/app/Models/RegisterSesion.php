<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterSesion extends Model
{
    protected $fillable = [
        'id_usuario',
        'ip',
        'Latitud',
        'longitud',
        'pais',
        'estado',
        'ciudad',
        'cp',
    ];
}
