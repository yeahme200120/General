<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoNegocio extends Model
{
    protected $fillable = [
        'negocio',
        'id_Empresa',
        'estatus'
    ];   
}
