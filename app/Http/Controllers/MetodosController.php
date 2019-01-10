<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes;
use App\Models\Metodos;
use App\Models\Creditos;
use App\Models\Existencias\Producto;
use Carbon\Carbon;
use Toastr;
use Auth;
use DB;

class MetodosController extends Controller
{

	 public function index(Request $request){


      if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;    


      //$laboratorios =Laboratorios::where("estatus", '=', 1)->get();
	  $metodos = DB::table('metodos as a')
        ->select('a.id','a.id_paciente','a.id_usuario','a.monto','a.proximo','a.created_at','a.id_producto','c.name','c.lastname','b.nombres','b.apellidos','b.dni','d.nombre as producto')
		->join('users as c','c.id','a.id_usuario')
		->join('pacientes as b','b.id','a.id_paciente')
		->join('productos as d','d.id','a.id_producto')
		->whereBetween('a.created_at', [date('Y-m-d', strtotime($f1)), date('Y-m-d', strtotime($f2))])
        ->orderBy('a.created_at','desc')
        ->get(); 

      } else {

      	$metodos = DB::table('metodos as a')
        ->select('a.id','a.id_paciente','a.id_usuario','a.monto','a.proximo','a.created_at','a.id_producto','c.name','c.lastname','b.nombres','b.apellidos','b.dni','d.nombre as producto')
		->join('users as c','c.id','a.id_usuario')
		->join('pacientes as b','b.id','a.id_paciente')
		->join('productos as d','d.id','a.id_producto')
        ->orderBy('a.created_at','desc')
        ->get(); 


      }



      return view('metodos.index', ['metodos' => $metodos]);     
    }


	public function create(Request $request){


         $proximo=date("Y-m-d",strtotime($request->created_at."+ 30 days"));

 
		  $metodos = new Metodos();
          $metodos->id_paciente =$request->paciente;
          $metodos->id_producto =$request->producto;
		  $metodos->monto =$request->monto;
		  $metodos->proximo = $proximo;
          $metodos->id_usuario = \Auth::user()->id;
		  $metodos->sede = $request->session()->get('sede');
          $metodos->save();


          $credito = Creditos::create([
		        "origen" => 'METODOS ANTICONCEPTIVOS',
		        "descripcion" => 'METODOS ANTICONCEPTIVOS',
		        "monto" => $request->monto,
		        "tipo_ingreso" => 'EF',
		        "id_sede" => $request->session()->get('sede'),
		        "id_metodo" => $metodos->id
		      ]);


        Toastr::success('Registrado Exitosamente.', 'Método!', ['progressBar' => true]);

		return redirect()->action('MetodosController@index', ["created" => true, "metodos" => Metodos::all()]);
	}    

  public function delete($id){
    $metodo = Metodos::find($id);
    $metodo->delete();

    $cred = Creditos::where('id_metodo','=',$id);
    $cred->delete();

    Toastr::success('Eliminado Exitosamente.', 'Método Anticonceptivo!', ['progressBar' => true]);


    return redirect()->action('MetodosController@index', ["deleted" => true, "metodo" => Metodos::all()]);
  }

  public function createView() {

   $pacientes =Pacientes::where("estatus", '=', 1)->orderby('nombres','asc')->get();
   $productos =Producto::where("almacen",'=',2)->orderby('nombre','asc')->get();

    return view('metodos.create', compact('pacientes','productos'));
  }

   public function editView($id){
   	  $p =Metodos::find($id);
     

      return view('metodos.edit', ["paciente" => $p->id_paciente, "producto" => $p->id_producto, "monto" => $p->monto, "id" => $p->id,"pacientes" =>Pacientes::where("estatus", '=', 1)->orderby('nombres','asc')->get(),"productos" => Producto::where("almacen",'=',2)->orderby('nombre','asc')->get()]);
      
    }   

      public function edit(Request $request){

	          $metodos = Metodos::find($request->id);
	          $metodos->id_paciente =$request->paciente;
	          $metodos->id_producto =$request->producto;
			  $metodos->monto =$request->monto;
			  $res = $metodos->save();



			  DB::table('creditos')
            ->where('id_metodo', $request->id)
            ->update([
              'monto' => $request->monto
            ]);


			/*  $cred = Creditos::where('id_metodo','=',$request->id);
			  $cred->monto = $request->monto;
              $res2 =$cred->save();
*/
		return redirect()->action('MetodosController@index', ["created" => true, "metodos" => Metodos::all()]);
   

    }






}
