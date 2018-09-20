<?php

namespace App\Models\Existencias;

use Illuminate\Database\Eloquent\Model;
use App\Models\Config\{Medida, Categoria, Sede};

class Producto extends Model
{
    protected $fillable = ["nombre", "sede_id", "medida", "cantidad", "categoria"];

    public function getMedidaAttribute($value){
    	return Medida::where('id', '=', $value)->get()->first()->nombre;
    }

    public function getSedeIdAttribute($value){
    	return Sede::where('id', '=', $value)->get()->first()->name;
    }    

    public function getCategoriaAttribute($value){
    	return Categoria::where('id', '=', $value)->get()->first()->nombre;
    }

}
