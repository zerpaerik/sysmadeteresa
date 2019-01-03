<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Profesionales\Especialidad;
use App\Models\Profesionales\Profesional;
use App\Models\Events\{Event, RangoConsulta};
use App\Models\Creditos;
use App\Models\Servicios;
use App\Models\Personal;
use App\Models\Events;
use App\Models\Atenciones;
use App\Models\Pacientes;
use Calendar;
use Carbon\Carbon;
use DB;
use App\Historial;
use App\Consulta;
use App\Service;

class DatatableController extends Controller
{

	public function index(Request $request)
  	{
    
      return view('datatables.index');
    
   }
  


}