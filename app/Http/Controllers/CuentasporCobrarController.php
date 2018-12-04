<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Debitos;
use App\Models\Analisis;
use App\Models\Creditos;
use Auth;


class CuentasporCobrarController extends Controller

{

	public function index()
  {
        $initial = Carbon::now()->toDateString();
        $cuentasporcobrar = $this->elasticSearch('','');
        return view('movimientos.cuentasporcobrar.index', [
        "icon" => "fa-list-alt",
        "model" => "cuentasporcobrar",
        "model1" => "Cuentas Por Cobrar",
        "headers" => ["id", "Nombre Paciente", "Apellido Paciente","Monto","Monto Abonado","Monto Pendiente","Fecha Atenciòn","Acción"],
        "data" => $cuentasporcobrar,
        "fields" => ["id", "nombres", "apellidos","monto","abono","pendiente","created_at"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]); 
	}

  public function search(Request $request)
  {
    $search = $request->nom;
    $split = explode(" ",$search);

    if (!isset($split[1])) {
     
      $split[1] = '';
      $cuentasporcobrar = $this->elasticSearch($split[0],$split[1]);   
      return view('movimientos.cuentasporcobrar.index', [
      "icon" => "fa-list-alt",
      "model" => "cuentasporcobrar",
      "model1" => "Cuentas Por Cobrar",
      "headers" => ["id", "Nombre Paciente", "Apellido Paciente","Monto","Monto Abonado","Monto Pendiente","Fecha Atenciòn","Acción"],
      "data" => $cuentasporcobrar,
      "fields" => ["id", "nombres", "apellidos","monto","abono","pendiente","created_at"],
        "actions" => [
          '<button type="button" class="btn btn-info">Transferir</button>',
          '<button type="button" class="btn btn-warning">Editar</button>'
        ]
    ]); 
    }else{
      $cuentasporcobrar = $this->elasticSearch($split[0],$split[1]);  
      return view('movimientos.cuentasporcobrar.index', [
      "icon" => "fa-list-alt",
      "model" => "cuentasporcobrar",
      "model1" => "Cuentas Por Cobrar",
      "headers" => ["id", "Nombre Paciente", "Apellido Paciente","Monto","Monto Abonado","Monto Pendiente","Fecha Atenciòn","Acción"],
      "data" => $cuentasporcobrar,
      "fields" => ["id", "nombres", "apellidos","monto","abono","pendiente","created_at"],
        "actions" => [
          '<button type="button" class="btn btn-info">Transferir</button>',
          '<button type="button" class="btn btn-warning">Editar</button>'
        ]
    ]); 
    }          
  }

	public function editView($id){
      $p = Atenciones::find($id);
      return view('movimientos.cuentasporcobrar.edit', ["pendiente" => $p->pendiente,"id" => $p->id]);
    }

	 public function edit(Request $request){

       $searchAtencionID = DB::table('atenciones')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->first();                    
                    //->get();
                    
                    $pendiente = $searchAtencionID->pendiente;
                    $atencion = $searchAtencionID->id;


                    $p = Atenciones::find($request->id);
                    $p->pendiente = $pendiente-$request->monto;
                    $res = $p->save();

                    $creditos = new Creditos();
                    $creditos->origen = 'CUENTAS POR COBRAR';
                    $creditos->id_atencion = $atencion;
                    $creditos->monto= $request->monto;
                    $creditos->id_sede = $request->session()->get('sede');
                    $creditos->tipo_ingreso = 'EF';
                    $creditos->descripcion = 'CUENTAS POR COBRAR';
                    $creditos->save();



      return redirect()->action('CuentasporCobrarController@index', ["edited" => $res]);
    }

  private function elasticSearch($nom, $ape)
  {
     $cuentasporcobrar = DB::table('atenciones as a')
    ->select('a.id','a.created_at','a.id_paciente','a.origen_usuario','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.abono','a.pendiente','b.nombres','b.apellidos','c.detalle as servicio','e.name','e.lastname','d.name as laboratorio')
    ->join('pacientes as b','b.id','a.id_paciente')
    ->join('servicios as c','c.id','a.id_servicio')
    ->join('analises as d','d.id','a.id_laboratorio')
    ->join('users as e','e.id','a.origen_usuario')
    //->join('profesionales as f','f.id','a.origen_usuario')
    ->where('b.nombres','like','%'.$nom.'%')
    ->where('b.apellidos','like','%'.$ape.'%')
    ->where('a.pendiente','>',0)
    ->whereNotIn('a.monto',[0,0.00])
    ->where('a.id_sede','=', \Session::get("sede"))
    ->orderby('a.id','desc')
    ->paginate(15); 

    return $cuentasporcobrar;   
  }
}
