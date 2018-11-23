<?php

namespace App\Models\Profesionales;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profesionales\Especialidad;

class Profesional extends Model
{
    protected $fillable = ["nombres", "apellidos", "dni", "cmp", "codigo", "especialidad", "nacimiento","phone", "tipo"];
    public $table = "profesionales";
/*
    public function getEspecialidadAttribute($value){
    	return Especialidad::where('id', '=', $value)->get(['nombre'])->first()->nombre;
    }
*/
}
