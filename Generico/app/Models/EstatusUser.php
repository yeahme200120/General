<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstatusUser extends Model
{
    protected $fillable = [
        'nombre_estatus',
        'id_empresa',
        'estatus'
    ];
}
