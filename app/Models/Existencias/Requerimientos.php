<?php

namespace App\Models\Existencias;

use Illuminate\Database\Eloquent\Model;
use App\Models\Config\Sede;

class Requerimientos extends Model
{

		protected $fillable = ["id_producto","cantidad", "id_sede_solicita", "id_sede_solicitada","usuario",'estatus'];


}
