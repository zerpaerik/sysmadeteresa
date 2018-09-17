<?php

namespace App\Http\Controllers\Archivos;

use App\Paquetes;
use App\PaquetesServ;
use App\Servicios;
use App\Empresas;
use App\Analisis;
use App\PaquetesAnalisis;

use App\Locales;
use DB;
use Silber\Bouncer\Database\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Archivos\StorePaquetesRequest;
use App\Http\Requests\Archivos\UpdatePaquetesRequest;

class PaquetesController extends Controller
{
    /**
     * Display a lisitng of User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }

        $id_usuario = Auth::id();

         $searchUsuarioID = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

            foreach ($searchUsuarioID as $usuario) {
                    $usuarioEmp = $usuario->id_empresa;
                    $usuarioSuc = $usuario->id_sucursal;
                }

        $paquetes = DB::table('paquetes as a')
        ->select('a.id','a.name','a.costo'/*,'a.id_empresa','a.id_sucursal','b.id','b.id_paquete','b.id_servicio','c.detalle'*/)
      /*  ->join('paquetes_servs as b','a.id','b.id_paquete')
        ->join('servicios as c','b.id_servicio','c.id')*/
        ->where('a.id_empresa','=',$usuarioEmp)
        ->where('a.id_sucursal','=',$usuarioSuc)
       // ->where('a.estatus','=','1')
        ->orderby('a.created_at','desc')
        ->paginate(5000);
        $paquetes_servicios = new PaquetesServ();
        $paquetes_analises = new PaquetesAnalisis();

        return view('archivos.paquetes.index', compact('paquetes','paquetes_servicios','paquetes_analises'));
    }



     public static function paqbyemp(){


         $id_usuario = Auth::id();

         $searchUsuarioID = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

            foreach ($searchUsuarioID as $usuario) {
                    $usuarioEmp = $usuario->id_empresa;
                    $usuarioSuc = $usuario->id_sucursal;
                }


             $paquetes = DB::table('paquetes as a')
                     ->where('a.id_empresa','=', $usuarioEmp)
                     ->where('a.id_sucursal','=', $usuarioSuc)
                     ->get()->pluck('name','id');
            
         if(!is_null($paquetes)){
           return view("existencias.atencion.paqbyemp",['paquetes'=>$paquetes]);
         }else{
            return view("existencias.atencion.paqbyemp",['paquetes'=>[]]);
         }

    }

    /**
     * Show the form for creating new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_usuario = Auth::id();

         $searchUsuarioID = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

            foreach ($searchUsuarioID as $usuario) {
                    $usuarioEmp = $usuario->id_empresa;
                    $usuarioSuc = $usuario->id_sucursal;
                }

        $servicio = DB::table('servicios')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('detalle','id');

      // $servicio = Servicios::get()->pluck('detalle', 'id');
     //  dd($servicio);
         $analisis = DB::table('analises')
        ->select('*')
        ->where('id_empresa','=', $usuarioEmp)
        ->where('id_sucursal','=', $usuarioSuc)
        ->get()->pluck('name','id');

    //   $analisis = Analisis::get()->pluck('name','id');
    
        return view('archivos.paquetes.create', compact('servicio','analisis'));
    }



    public function store (StorePaquetesRequest $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
          //  print_r($request->all());
          //  die();
          //   dd($request->analisis);
           $id_usuario = Auth::id();

         $searchUsuarioID = DB::table('users')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $id_usuario)
                    ->get();

            foreach ($searchUsuarioID as $usuario) {
                    $usuarioEmp = $usuario->id_empresa;
                    $usuarioSuc = $usuario->id_sucursal;
                }
       
      
       $paquetes = new Paquetes;
       $paquetes->name =$request->name;
       $paquetes->costo     =$request->costo;
      
     //  dd($request->servicio);
       $paquetes->id_empresa     =$usuarioEmp;
       $paquetes->id_sucursal     =$usuarioSuc;
       $paquetes->save();

       if(!is_null($request->servicio)){
         foreach ($request->servicio as $key => $value) {
           $paquetesserv = new PaquetesServ;
           $paquetesserv->id_paquete =$paquetes->id;
           $paquetesserv->id_servicio    =$value;
           $paquetesserv->save();
         }
       }


       if(!is_null($request->analisis)){
       foreach ($request->analisis as $key_a => $value_a) {
         $paquetesanalisis = new PaquetesAnalisis();
         $paquetesanalisis->id_paquete  =$paquetes->id;
         $paquetesanalisis->id_analisis=$value_a;
       $paquetesanalisis->save();
       }
        }
      











        return redirect()->route('admin.paquetes.index');
    }

    /**
     * Show the form for editing User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
     

      $paquetes = Paquetes::find($id);
       $select=json_decode($paquetes->servicio);

    
     
       $servicioIds = [];
       $analisisIds = [];
       $servicio = Servicios::all();
       $analisis = Analisis::all();
       $paquetesserv = PaquetesServ::all()->where('id_paquete',$id );
       $paquetesanalisis = PaquetesAnalisis::all()->where('id_paquete',$id );

       foreach($paquetesserv as $value)
       {
        $servicioIds[] = $value->id_servicio;
      } 
      foreach($paquetesanalisis as $value_ana)
      {
        $analisisIds[] = $value_ana->id_analisis;
      } 




        return view('archivos.paquetes.edit', compact('servicio','analisis','paquetes','servicioIds','analisisIds'));
    }

    /**
     * Update User in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function update(UpdatePaquetesRequest $request, $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }    
       $paquetes=Paquetes::find($id);
       $paquetesserv = PaquetesServ::where('id_paquete',$id )->delete();
        $paquetes_ana = PaquetesAnalisis::where('id_paquete',$id )->delete();
       foreach ($request->servicio as $key => $value) {
         $paquetesserv = new PaquetesServ;
         $paquetesserv->id_paquete =$paquetes->id;
         $paquetesserv->id_servicio    =$value;
         $paquetesserv->save();
     } 


        foreach ($request->analisis as $key_a => $value_a) {
         $paquetesanalisis = new PaquetesAnalisis();
         $paquetesanalisis->id_paquete  =$paquetes->id;
         $paquetesanalisis->id_analisis=$value_a;
       $paquetesanalisis->save();
       }      
       $paquetes->name =$request->name;
       $paquetes->costo     =$request->costo;
       $paquetes->update();


     /*  foreach ($request->servicio as $key => $value) {
       $paquetesserv=PaquetesServ::findOrFail($id);
       $paquetesserv->id_servicio    =$value;
       $paquetesserv->update();
       }*/
      
        return redirect()->route('admin.paquetes.index');
    }

    /**
     * Remove User from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $paquetes=Paquetes::find($id)->delete();
        $paquetesserv = PaquetesServ::where('id_paquete',$id )->delete();
         $paquetes_ana = PaquetesAnalisis::where('id_paquete',$id )->delete();

       /* if ( $paquetes && $paquetesserv) {
            return redirect()->route('admin.paquetes.index');
        } else {
            echo "Se Presento un Error, comunicarse con el Administrador";
        }*/
           return redirect()->route('admin.paquetes.index');

    }

    /**
     * Delete all selected User at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Paquetes::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
