<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Debitos;
use DB;
use Carbon\Carbon;

class GastosController extends Controller
{

	public function index(){

        $initial = Carbon::now()->toDateString();        
          
        $gastos = $this->elasticSearch($initial,$initial);

        return view('movimientos.gastos.index', [
        "icon" => "fa-list-alt",
        "model" => "gastos",
        "headers" => ["id", "Descripciòn", "Monto", "Editar", "Eliminar"],
        "data" => $gastos,
        "fields" => ["id", "descripcion", "monto"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  
	}


  public function search(Request $request){
    
       $gastos = $this->elasticSearch($request->inicio,$request->final);

        return view('movimientos.gastos.search', [
        "icon" => "fa-list-alt",
        "model" => "gastos",
        "headers" => ["id", "Descripciòn", "Monto", "Editar", "Eliminar"],
        "data" => $gastos,
        "fields" => ["id", "descripcion", "monto"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  
  }
  

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'descripcion' => 'required|string|max:255'
      
        ]);
        if($validator->fails()) 
          return redirect()->action('GastosController@createView', ['errors' => $validator->errors()]);
		$gastos = Debitos::create([
	      'descripcion' => $request->descripcion,
	      'monto' => $request->monto,
	      'origen' => 'RELACION DE GASTOS',
	      'id_sede' => $request->session()->get('sede')
   		]);
		return redirect()->action('GastosController@index', ["created" => true, "gastos" => Debitos::all()]);
	}    

  public function delete($id){
    $gastos = Debitos::find($id);
    $gastos->delete();
    return redirect()->action('GastosController@index', ["deleted" => true, "analisis" => Debitos::all()]);
  }

  public function createView() {

    $gastos = Debitos::all();

    return view('movimientos.gastos.create', compact('gastos'));
  }

    public function editView($id){
      $p = Debitos::find($id);
      return view('movimientos.gastos.edit', ["descripcion" => $p->descripcion, "monto" => $p->monto,"id" => $p->id]);
    }

      public function edit(Request $request){
      $p = Debitos::find($request->id);
      $p->descripcion = $request->descripcion;
      $p->monto = $request->monto;
      $res = $p->save();
      return redirect()->action('GastosController@index', ["edited" => $res]);
    }

    private function elasticSearch($initial, $final)
    {
      $gastos = DB::table('debitos as a')
        ->select('a.id','a.descripcion','a.monto','a.created_at')
        ->where('a.created_at','>=',$initial)
        ->where('a.created_at','<=',$final)
        ->orderby('a.id','desc')
        ->paginate(5000);  

        return $gastos;
    }

}
