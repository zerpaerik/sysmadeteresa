<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaqServ extends Model
{
	protected $table="paqserv";

    protected $fillable = [
    	'paquete', 'servicio', 'paciente','estatus','num'
    ];
}