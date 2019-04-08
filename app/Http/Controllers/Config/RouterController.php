<?php

namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouterController extends Controller
{
    public function getLog (Request $request){
    	return view('generics.logview');
    }
}
