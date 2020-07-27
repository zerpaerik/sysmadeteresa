<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunica extends Model
{
    protected $fillable = [
    	'asunto', 'descripcion', "profesional","estatus","usuario_r"
    ];
}
