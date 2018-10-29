<?php

namespace App\Http\Controllers\Archivos;

use App\Models\Paquetes;
use App\Models\PaqueteServ;
use App\Models\Servicios;
use App\Models\Analisis;
use App\Models\PaqueteLab;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;


class PaquetesController extends Controller
{
    

    public function index()
    {
        

        $paquetes = DB::table('paquetes as a')
        ->select('a.id','a.detalle','a.precio', 'a.porcentaje')
        ->paginate(5000);
        $paquetes_servicios = new PaqueteServ();
        $paquetes_analises = new PaqueteLab();

        return view('archivos.paquetes.index', compact('paquetes','paquetes_servicios','paquetes_analises'));
    }

    public function createView()
    {
      $servicios = Servicios::all();
      $laboratorios = Analisis::all();
       
      return view('archivos.paquetes.create', compact('servicios','laboratorios'));
    }

    public function create(Request $request){
    
      $paquete = new Paquetes;
      $paquete->detalle    = $request->detalle;
      $paquete->precio     = $request->precio;
      $paquete->porcentaje = $request->porcentaje;
     
      if ($paquete->save()) {
          if (isset($request->id_servicio)) {
            foreach ($request->id_servicio['servicios'] as $servicio) {
              $serv = New PaqueteServ;
              $serv->paquete_id  = $paquete->id;
              $serv->servicio_id = $servicio['servicio'];
              $serv->save();
            }
          }
         
          if (isset($request->id_laboratorio)) {
            foreach ($request->id_laboratorio['laboratorios'] as $laboratorio) {
              $lab = new PaqueteLab;
              $lab->paquete_id     = $paquete->id;
              $lab->laboratorio_id = $laboratorio['laboratorio'];
              $lab->save();
            }
          }
      }

      return redirect()->route('paquetes.index');
    }

    public function show($id)
    {
      $paquete = Paquetes::findOrFail($id);
      $servicios = PaqueteServ::where('paquete_id', $paquete->id)->with('servicio')->get();
      $laboratorios = PaqueteLab::where('paquete_id', $paquete->id)->with('laboratorio')->get();
      
      return view('archivos.paquetes.show', compact('paquete', 'servicios', 'laboratorios'));
    }

    public function delete($id)
    {
      $paquete = Paquetes::findOrFail($id);
      $paquete->delete();

      return redirect()->route('paquetes.index');
    }

    public function getPaquete($id)
    {
      return Paquetes::findOrFail($id);
    }
}
