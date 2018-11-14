<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitas extends Model
{
    protected $fillable = [
    	'id_profesional', 'id_visitador'
    ];
}
