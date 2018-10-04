<?php

namespace App\Models\Profesionales;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
	protected $fillable = ["nombre"];
	public $table = "especialidades";
}
