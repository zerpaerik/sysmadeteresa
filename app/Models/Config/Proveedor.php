<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = ["nombre", "codigo","telefono"];
}
