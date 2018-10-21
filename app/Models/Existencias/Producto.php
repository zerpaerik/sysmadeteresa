<?php

namespace App\Models\Existencias;

use Illuminate\Database\Eloquent\Model;
use App\Models\Config\{Medida, Categoria, Sede};

class Producto extends Model
{

    protected $fillable = ["nombre", "medida", "categoria"];

    public function getMedidaAttribute($value){
        return Medida::where('id', '=', $value)->get()->first()->nombre;
    }

    public function getCategoriaAttribute($value){
        return Categoria::where('id', '=', $value)->get()->first()->nombre;
    }    
}
