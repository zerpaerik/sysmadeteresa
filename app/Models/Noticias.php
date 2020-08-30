<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $fillable = ["tittle", "description", "link", "url_img","origin","category","date", "estatus", "usuario"];

   
}
