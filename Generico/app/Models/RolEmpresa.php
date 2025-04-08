<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolEmpresa extends Model
{
    protected $fillable = [
        'nombre_rol_empresa',
        'estatus_rol_empresa',
        'id_empresa'
    ];
}
