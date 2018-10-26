<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Models\Config\{Medida, Categoria, Sede, Proveedor};
use DB;


class ProductoController extends Controller
{

    public function index(){
		//	$producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->get();
			return view('generics.index', [
				"icon" => "fa-list-alt",
				"model" => "existencias",
				"headers" => ["id", "nombre", "medida", "categoria", "Editar", "Eliminar"],
				"data" => $producto,
				"fields" => ["id", "nombre", "medida", "categoria"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
			]);    	
    }

    public function createView($extraArgs = []){
    	return view('existencias.create', ["categorias" => Categoria::all(), "medidas" => Medida::all()] + $extraArgs);
    }

    public function editView($id){
      $p = Producto::find($id);
      return view('existencias.edit', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad, "id" => $p->id]);
      
    }

    public function productInView(){
      return view('existencias.entrada', [
        "productos" => Producto::where("sede_id", '=', \Session::get("sede"))->get(),
        "sedes" => Sede::all(),
        "proveedores" => Proveedor::all()
      ]);
    }

    public function productOutView(){
      return view('existencias.salida', [
        "productos" => Producto::all(),
        "sedes" => Sede::all(),
        "proveedores" => Proveedor::all()
      ]);    
    }

    public function productTransView(){
      $sedes = Sede::whereNotIn("id", [\Session::get('sede')])->get(["id", "name"]);
      return view('existencias.transferir', ["productos" => Producto::where("sede_id", '=', \Session::get("sede"))->get(['id', 'nombre']), "sedes" => $sedes]);    
    }

    public function getProduct($id){
      $p = Producto::find($id);
      return response()->json(["producto" => $p], 200);
    }

    public function addCant(Request $request){

       $searchProduct = DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->first();   

                    $nombre = $searchProduct->nombre;
      
      $p = Existencia::where("producto", "=", $request->id)->where("sede_id", "=", $request->sede)->get()->first();
      if($p){
        $p->cantidad = $p->cantidad + $request->cantidadplus;
        $p->nombre = $nombre;
        $res = $p->save();
      }else{

        $searchProduct = DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->first();   

                    $nombre = $searchProduct->nombre;

        $p = Existencia::create([
          "producto" => $request->id,
          "cantidad" => $request->cantidadplus,
          "sede_id"  => $request->sede,
          "nombre" => $nombre
        ]);

        $p = Producto::find($request->id);
        $p->cantidad = $request->cantidadplus;
        $res = $p->update();

        $res = true;
      }
      if($res){
        $trans = Transferencia::create([
          "code" => $request->code,
          "producto" => $request->id,
          "cantidad" => $request->cantidadplus,
          "origen" => ($request->cantidadplus > 0) ? -1 : 0,
          "destino" => $request->sede,
          "proveedor" => $request->proveedor
        ]);
      }else{$trans = [];}
      return response()->json(["success" => $res, "producto" => $p, "trans" => $trans], 200);
    }

    public function transfer(Request $request){
      $pfrom = Producto::where('sede_id', '=', \Session::get("sede"))
      ->where("id", '=', $request->id)
      ->get()->first();
      $pfrom->cantidad = $pfrom->cantidad - $request->cantidadplus;
      $wasSubs = $pfrom->save();

      $p = Producto::where('sede_id', '=', $request->sede)
      ->where("nombre", '=', $pfrom->nombre)
      ->get()->first();
      if($wasSubs){
        if($p){
          $p->cantidad = $p->cantidad + $request->cantidadplus;
          $res = $p->save();
          return response()->json(["success" => $res, "producto" => $pfrom, "to" => $p]);
        }else{
          $newprod = Producto::create([
            "nombre" => $pfrom->nombre,
            "categoria" => $pfrom->getOriginal("categoria"),
            "medida" => $pfrom->getOriginal("medida"),
            "cantidad" => $request->cantidadplus,
            "sede_id" => $request->sede
          ]);
          return response()->json(["success" => true, "producto" => $pfrom, "to" => $newprod]);
        }
      }
    }

    public function edit(Request $request){
      $p = Producto::find($request->id);
      $p->nombre = $request->nombre;
      $p->categoria = $request->categoria;
      $p->medida = $request->medida;
      $p->cantidad = $request->cantidad;
      $res = $p->save();
      return redirect()->action('Existencias\ProductoController@index', ["edited" => $res]);
    }

    public function delete($id){
      $p = Producto::find($id);
      $res = $p->delete();
      return response()->json(["deleted" => $res]);
    }

    public function getExist($prod, $sede){
      $ex = Existencia::where('producto', '=', $prod)->where("sede_id", "=", $sede)
      ->get(["cantidad"])->first();
      $prod = Producto::where('id', '=', $prod)->get()->first();
      if($ex){
        return response()->json(["existencia" => $ex, "exists" => true, "medida" => $prod->medida]);
      }else{
        return response()->json(["exists" => false, "medida" => $prod->medida]);
      }
    }

    public function create(Request $request){
	  	$validator = \Validator::make($request->all(), [
	  		"nombre" => "required|unique:productos",
	  		"medida" => "required",
	  		"categoria" => "required"
	  	]);
	  	
    	if($validator->fails()) $this->createView(["created" => false]);
    	$producto = Producto::create([
    		"nombre" => $request->nombre,
    		"categoria" => $request->categoria,
    		"medida" => $request->medida,
        "sede_id" => $request->session()->get('sede')
    	]);
    	
    	if($producto){
   			return redirect()->action('Existencias\ProductoController@index', ["created" => true]);
			}
   			return redirect()->action('Existencias\ProductoController@index', ["created" => false]);
    }

    public function historicoView(){
      return view('existencias.historico', ["transferencias" => $this->unique_multidim_array(Transferencia::all(), "code")]);
    }

    public function transView($code){
      $t = Transferencia::where('code', '=', $code)->get();
      return view('existencias.transferencia', ["transferencias" => $t, "code" => $code]);
    }

    function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    }     
}
