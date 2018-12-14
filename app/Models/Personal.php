<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $fillable = [
    	'name', 'email', "lastname", "phone", "dni", "address","cargo","estatus","usuario","tipo"
    ];
}
