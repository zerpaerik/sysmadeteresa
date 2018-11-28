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

use Toastr;

class PaquetesController extends Controller
{
    

    public function index()
    {
        

        $paquetes = DB::table('paquetes as a')
        ->select('a.id','a.detalle','a.precio', 'a.porcentaje','a.estatus')
        ->where('a.estatus','=',1)
        ->paginate(5000);
        $paquetes_servicios = new PaqueteServ();
        $paquetes_analises = new PaqueteLab();

        return view('archivos.paquetes.index', [
          'paquetes' => $paquetes,
          'paquetes_servicios' => $paquetes_servicios,
          'paquetes_analises' => $paquetes_analises,
          'model' => 'paquetes'
        ]);
    }

    public function search(Request $request)
    {
      $paquetes = DB::table('paquetes as a')
      ->select('a.id','a.detalle','a.precio', 'a.porcentaje','a.estatus')
      ->where('a.estatus','=',1)
      ->where('a.detalle','like','%'.$request->nom.'%')
      ->paginate(5000);
      $paquetes_servicios = new PaqueteServ();
      $paquetes_analises = new PaqueteLab();

      return view('archivos.paquetes.index', [
        'paquetes' => $paquetes,
        'paquetes_servicios' => $paquetes_servicios,
        'paquetes_analises' => $paquetes_analises,
        'model' => 'paquetes'
      ]);
    }

    public function createView()
    {
      //$servicios = Servicios::all();
      $servicios =Servicios::where("estatus", '=', 1)->get();
      $laboratorios =Analisis::where("estatus", '=', 1)->get();
      //$laboratorios = Analisis::all();
       
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

    public function edit($id)
    {
      $paquete = Paquetes::findOrFail($id);
      $serviciosP = PaqueteServ::where('paquete_id',$id)->with('servicio')->get();
      $laboratoriosP = PaqueteLab::where('paquete_id',$id)->with('laboratorio')->get();
      $servicios = Servicios::all();
      $laboratorios = Analisis::all();
     
      return view('archivos.paquetes.edit', compact('paquete','serviciosP','laboratoriosP','servicios','laboratorios'));  
    }

    public function update(Request $request, $id)
    {
      $paquete = Paquetes::where('id',$id)
                          ->update([
                              'precio' => $request->precio,
                              'porcentaje' => $request->porcentaje
                          ]);
      if ($paquete) {
        if (isset($request->id_servicio)) {
            foreach ($request->id_servicio['servicios'] as $servicio) {
              PaqueteServ::where('id', $servicio['id'])
                          ->update([
                              'servicio_id' => $servicio['servicio']
                          ]);
          }
        }
       
        if (isset($request->id_laboratorio)) {
          foreach ($request->id_laboratorio['laboratorios'] as $laboratorio) {
            PaqueteLab::where('id', $laboratorio['id'])
                          ->update([
                              'laboratorio_id' => $laboratorio['laboratorio']
                          ]);
          }
        }
      }

      return redirect()->route('paquetes.index');
    }

    public function addItems(Paquetes $paquete)
    {
      $servicios = Servicios::all();
      $laboratorios = Analisis::all();
      return view('archivos.paquetes.add_items', compact('paquete', 'servicios', 'laboratorios'));
    }

    public function storeItems(Request $request, $id)
    {
      $paquete = Paquetes::findOrFail($id);
      $paquete->precio = $request->precio;
      $paquete->porcentaje = $request->porcentaje;
      if ($paquete->save()) {
        if (isset($request->id_servicio)) {
            foreach ($request->id_servicio['servicios'] as $servicio) {
              $serv = new PaqueteServ;
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

        Toastr::success('El paquete '.$paquete->detalle.' ha sido actualizado.', 'Paquetes!', ['progressBar' => true]);
      }

      return redirect()->route('paquetes.index');
    }

    public function delete($id)
    {
      $paquete = Paquetes::findOrFail($id);
      $paquete->estatus=0;
      $paquete->save();

      return redirect()->route('paquetes.index');
    }

    public function getPaquete($id)
    {
      return Paquetes::findOrFail($id);
    }

    public function deleteServ($id)
    {
      $serv = PaqueteServ::findOrFail($id);
      return ($serv->delete()) ? 1 : 0;
    }

    public function deleteLab($id)
    {
       $lab = PaqueteLab::findOrFail($id);
       return ($lab->delete()) ? 1 : 0;
    }
}
