<?php

namespace App\Models\Creditos;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $fillable = ["monto", "event_id"];
    public $table = "creditos";
}
