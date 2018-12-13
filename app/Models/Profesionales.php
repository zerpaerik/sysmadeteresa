<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesionales extends Model
{
    protected $fillable = [
    	'name', 'apellidos', 'cmp','dni','nacimiento','centro','especialidad','usuario'
    ];
}
