<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Requerimientos, Transferencia};
use App\Models\Config\{Sede, Proveedor};
use Illuminate\Support\Facades\Auth;
use DB;
use Toastr;
use Carbon\Carbon;



class RequerimientosController extends Controller
{

    public function index(){

      $requerimientos = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidadd','a.cantidad','a.estatus','b.name as sede','a.created_at','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicitada','b.id')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->where('a.id_sede_solicita', '=', \Session::get("sede"))
                    ->get();  

			return view('existencias.requerimientos.index',compact('requerimientos'));   	
    }

     public function index2(){

        $inicio = Carbon::now()->toDateString();
        $final = Carbon::now()->addDay()->toDateString();
        $requerimientos2 = $this->elasticSearch($inicio,$final,'','');
        return view('existencias.requerimientos.index2', ["requerimientos2" => $requerimientos2]);   	
    }

     public function search(Request $request)
    {
      $search = $request->sede;
      $split = explode(" ",$search);

      if (!isset($split[1])) {
       
        $split[1] = '';
        $requerimientos2 = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]);
        return view('existencias.requerimientos.index2', ["requerimientos2" => $requerimientos2]); 

      }else{
        $requerimientos2 = $this->elasticSearch($request->inicio,$request->final,$split[0],$split[1]);  
        return view('existencias.requerimientos.index2', ["requerimientos2" => $requerimientos2]); 
          
      }    
    }

     private function elasticSearch($initial, $final,$sede)
  { 
         $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->where('a.id_sede_solicitada', '=', \Session::get("sede"))
        ->where('e.name','like','%'.$sede.'%')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
      
        ->orderby('a.id','desc')
        ->paginate(20);


        return $requerimientos2;
  }





    public function createView(){
    	return view('existencias.requerimientos.create', ["productos" => Producto::where('sede_id','=', 1)->where('almacen','=',1)->get(["id", "nombre"])]);
    }


    public function create(Request $request){

   
    if (isset($request->id_laboratorio)) {
      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {
          $lab = new Requerimientos();
          $lab->id_producto =  $laboratorio['laboratorio'];
          $lab->cantidad =  $request->monto_abol['laboratorios'][$key]['abono'];;
          $lab->id_sede_solicita = $request->session()->get('sede');
          $lab->usuario = 1;
          $lab->id_sede_solicitada = 1;
          $lab->estatus = 'Solicitado';
          $lab->save();

        } 
      }
    }

    return redirect()->route('requerimientos.index');

    }


   /* public function editView($id){

      $p = Requerimientos::find($id);

      return view('existencias.requerimientos.edit', ["cantidad" => $p->cantidad,"id" => $p->id]);
      
    } */

    

      public function edit(Request $request){


        $searchRequerimiento = DB::table('requerimientos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->first();                    
                    //->get();

                  
                    $producto = $searchRequerimiento->id_producto;
                    $sede_solicita = $searchRequerimiento->id_sede_solicita;
                  

        $searchProducto = DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $producto)
                    ->first();  

                    $cantidadactual = $searchProducto->cantidad;
                    $codigo = $searchProducto->codigo;
                    $nombre = $searchProducto->nombre;
                    $categoria = $searchProducto->categoria;
                    $medida = $searchProducto->medida;
                    $preciounidad = $searchProducto->preciounidad;
                    $precioventa = $searchProducto->precioventa;

         $searchProductoSedeSolicitad =  DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('codigo','=', $codigo)
                    ->where('sede_id','=',$sede_solicita)
                    ->where('almacen','=',2)
                    ->first(); 

                    if($searchProductoSedeSolicitad == NULL){
                      $cantidadactualsedesolicita=0;
                    }else{
                    $cantidadactualsedesolicita = $searchProductoSedeSolicitad->cantidad; 
                    }  

      $p = Requerimientos::find($request->id);
      $p->estatus = 'Procesado';
      $p->cantidadd= $request->cantidadd;
      $res = $p->save();

      $p = Producto::find($producto);
      $p->cantidad= $cantidadactual - $request->cantidadd;
      $res = $p->save();

     
      $p = Producto::where("codigo", "=", $codigo)->where("sede_id", "=",  $sede_solicita)->where("almacen","=", 2)->get()->first();

      if($p){
        $p->cantidad = $cantidadactualsedesolicita + $request->cantidadd;
        $p->save();
      }else{

        $prod = new Producto();
        $prod->nombre =  $nombre;
        $prod->categoria =  $categoria;
        $prod->codigo = $codigo;
        $prod->medida =  $medida;
        $prod->preciounidad = $preciounidad;
        $prod->precioventa = $precioventa;
        $prod->sede_id = $sede_solicita;
        $prod->cantidad = $request->cantidadd;
        $prod->almacen = 2;
        $prod->save();

      }

        Toastr::success('Procesado Exitosamente.', 'Requerimiento!', ['progressBar' => true]);

      return redirect()->action('Existencias\RequerimientosController@index2', ["edited" => $res]);
    }

       
}
