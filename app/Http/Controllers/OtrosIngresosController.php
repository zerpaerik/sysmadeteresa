<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Creditos;
use DB;

class OtrosIngresosController extends Controller
{

	public function index()
  {
        $inicio = Carbon::now()->toDateString();
        $ingresos = $this->elasticSearch($inicio);
        return view('movimientos.otrosingresos.index', [
        "icon" => "fa-list-alt",
        "model" => "ingresos",
        "headers" => ["id", "Descripciòn", "Monto","Fecha", "Editar", "Eliminar"],
        "data" => $ingresos,
        "fields" => ["id", "descripcion", "monto","created_at"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  
	}

  public function search(Request $request)
  {
    $ingresos = $this->elasticSearch($request->inicio);
    return view('movimientos.otrosingresos.search', [
        "icon" => "fa-list-alt",
        "model" => "ingresos",
        "headers" => ["id", "Descripciòn", "Monto","Fecha", "Editar", "Eliminar"],
        "data" => $ingresos,
        "fields" => ["id", "descripcion", "monto","created_at"],
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
          return redirect()->action('OtrosIngresosController@createView', ['errors' => $validator->errors()]);
		$ingresos = Creditos::create([
	      'descripcion' => $request->descripcion,
	      'monto' => $request->monto,
	      'origen' => 'OTROS INGRESOS',
	      'tipo_ingreso' => $request->tipo_ingreso,
	      'id_sede' => $request->session()->get('sede')
   		]);
		return redirect()->action('OtrosIngresosController@index', ["created" => true, "ingresos" => Creditos::all()]);
	}    

  public function delete($id){
    $ingresos = Creditos::find($id);
    $ingresos->delete();
    return redirect()->action('OtrosIngresosController@index', ["deleted" => true, "ingresos" => Creditos::all()]);
  }

  public function createView() {

    $ingresos = Creditos::all();

    return view('movimientos.ingresos.create', compact('ingresos'));
  }

    public function editView($id){
      $p = Creditos::find($id);
      return view('movimientos.ingresos.edit', ["descripcion" => $p->descripcion, "monto" => $p->monto,"id" => $p->id]);
    }

      public function edit(Request $request){
      $p = Creditos::find($request->id);
      $p->descripcion = $request->descripcion;
      $p->monto = $request->monto;
      $res = $p->save();
      return redirect()->action('OtrosIngresosController@index', ["edited" => $res]);
    }

    private function elasticSearch($initial)
    {
      $ingresos = DB::table('creditos as a')
            ->select('a.id','a.descripcion','a.monto','a.origen','a.created_at')
            ->orderby('a.id','desc')
            ->where('a.origen','=','OTROS INGRESOS')
            ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($initial))])
            ->paginate(20);     
    
        return $ingresos;    
    }

}
