<?php

namespace App\Models\Existencias;

use Illuminate\Database\Eloquent\Model;
use App\Models\Config\Medida;

class Producto extends Model
{
    protected $fillable = ["nombre", "sede_id", "medida", "cantidad"];

    public function getMedidaAttribute($value){
    	return Medida::where('id', '=', $value)->get()->first();
    }
}
