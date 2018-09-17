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
        ->select('a.id','a.name','a.costo')
        ->paginate(5000);
        $paquetes_servicios = new PaqueteServ();
        $paquetes_analises = new PaqueteLab();

        return view('archivos.paquetes.index', compact('paquetes','paquetes_servicios','paquetes_analises'));
    }

   
    public function createView()
    {

          $servicios = Servicios::all();
          $analisis = Analisis::all();
       
        return view('archivos.paquetes.create', compact('servicios','analisis'));
    }



    public function create(Request $request){

  
       $paquetes = new Paquetes;
       $paquetes->name =$request->name;
       $paquetes->costo     =$request->costo;
       $paquetes->save();

     dd($request->servicio);
     die();
     
       if(!is_null($request->servicio)){
         foreach ($request->servicio as $key => $value) {
           $paquetesserv = new PaqueteServ;
           $paquetesserv->id_paquete =$paquetes->id;
           $paquetesserv->id_servicio    =$value;
           $paquetesserv->save();
         }
       }



       if(!is_null($request->analisis)){
       foreach ($request->analisis as $key_a => $value_a) {
         $paquetesanalisis = new PaqueteLab();
         $paquetesanalisis->id_paquete  =$paquetes->id;
         $paquetesanalisis->id_analisis=$value_a;
       $paquetesanalisis->save();
       }
        }
      


        return redirect()->route('paquetes.index');



    }


   

    

    

}
