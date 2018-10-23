<?php

namespace App\Models\Existencias;

use Illuminate\Database\Eloquent\Model;
use App\Models\Config\{Sede, Proveedor};
use App\Models\Existencias\Producto;

class Transferencia extends Model
{
    protected $fillable = ["code", "producto" , "cantidad", "origen", "destino", "proveedor"];

    public function getProductoAttribute($value){
    	return Producto::find($value);
    }

    public function getOrigenAttribute($value){
    	if($value > 0){
            return Sede::find($value)->name;
        }elseif($value == -1){
            return "Entrada";
        }elseif($value == 0){
            return "Salida";
        }
    }

    public function getDestinoAttribute($value){
    	if($value > 0){
            return Sede::find($value)->name;
        }elseif($value == -1){
            return "Entrada";
        }elseif($value == 0){
            return "Salida";
        }
    }

    public function getProveedorAttribute($value){
    	return Proveedor::find($value);
    }
}
