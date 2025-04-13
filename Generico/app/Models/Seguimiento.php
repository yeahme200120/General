<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $fillable = [
        'accion',
        'fecha',
        'datos',
        'id_usuario'
    ];
}
