<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre_empresa',
        'representante_empresa',
        'email_empresa',
        'rfc_empresa',
        'direccion_empresa',
        'telefono_empresa',
        'fecha_registro',
        'limite_vigencia',
        'estatus_empresa'
    ];
}
