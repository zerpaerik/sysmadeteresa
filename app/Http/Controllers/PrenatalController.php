<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes\Paciente;

class PrenatalController extends Controller
{
    public function index()
    {

    }

    public function createView()
    {
    	$paciente = Paciente::all();

    	return view('prenatal.create',[
    		'pacientes' => $paciente
    	]); 
    }

    public function create()
    {
    	
    }
}
