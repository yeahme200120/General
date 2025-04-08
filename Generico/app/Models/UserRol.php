<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRol extends Model
{
    protected $fillable = [
        'rol',
        'estatus',
        'id_empresa',
    ];
}
