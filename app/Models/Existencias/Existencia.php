<?php

namespace App\Models\Existencias;

use Illuminate\Database\Eloquent\Model;
use App\Models\Config\Sede;

class Existencia extends Model
{

		protected $fillable = ["producto", "sede_id", "cantidad","nombre"];

    public function getSedeIdAttribute($value){
        return Sede::where('id', '=', $value)->get()->first()->name;
    }    

}
