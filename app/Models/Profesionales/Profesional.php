<?php

namespace App\Models\Profesionales;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $fillable = ["nombres", "apellidos", "dni", "cmp", "codigo", "especialidad"];
    public $table = "profesionales";
}
