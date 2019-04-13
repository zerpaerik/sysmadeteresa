<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Existencia, Transferencia};
use App\Models\Config\{Medida, Categoria, Sede, Proveedor};
use DB;
use App\Models\Creditos;
use App\Models\Ventas;
use Toastr;
use Auth;
use Carbon\Carbon;


class ProductoController extends Controller
{

    public function index(){
		//	$producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 1)->orderBy('nombre','ASC')->get();
			return view('generics.index5', [
				"icon" => "fa-list-alt",
				"model" => "existencias",
        "model1" => "Productos en Almacen Central",
				"headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
				"data" => $producto,
				"fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
			]);    	
    }

      public function index2(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->orderBy('nombre','ASC')->get();
      return view('generics.index5', [
        "icon" => "fa-list-alt",
        "model" => "existencias",
        "model1" => "Productos en Almacen Local",
        "headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
        "data" => $producto,
        "fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

     public function indexv(Request $request){

       if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;   




          $atenciones = DB::table('ventas as a')
            ->select('a.id','a.id_producto','a.created_at','a.sede','a.monto','a.id_usuario','a.cantidad','e.name','e.lastname','b.nombre','b.codigo')
            ->join('users as e','e.id','a.id_usuario')
            ->join('productos as b','b.id','a.id_producto')
            ->where('a.sede','=',$request->session()->get('sede'))
            ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->orderby('a.id','desc')
            ->get();

           $aten = Ventas::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',                        strtotime($f2))])
                                    ->where('sede','=',$request->session()->get('sede'))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

            if ($aten->monto == 0) {
        }
          
           $cantidad = Ventas::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59',                        strtotime($f2))])
                       ->where('sede','=',$request->session()->get('sede'))
                        ->select(DB::raw('COUNT(*) as cantidad'))
                       ->first();

        if ($cantidad->cantidad == 0) {
        }


        


        } else {


           $atenciones = DB::table('ventas as a')
            ->select('a.id','a.id_producto','a.created_at','a.sede','a.monto','a.id_usuario','a.cantidad','e.name','e.lastname','b.nombre','b.codigo')
            ->join('users as e','e.id','a.id_usuario')
            ->join('productos as b','b.id','a.id_producto')
            ->where('a.sede','=',$request->session()->get('sede'))
            ->whereDate('a.created_at', '=',Carbon::today()->toDateString())
            ->orderby('a.id','desc')
            ->get();
           

        $aten = Ventas::whereDate('created_at', '=',Carbon::today()->toDateString())
                                            ->where('sede','=',$request->session()->get('sede'))
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
        if ($aten->monto == 0) {
        }

            $cantidad = Ventas::whereDate('created_at', '=',Carbon::today()->toDateString())
                          ->where('sede','=',$request->session()->get('sede'))
                        ->select(DB::raw('COUNT(*) as cantidad'))
                       ->first();

        if ($cantidad->cantidad == 0) {
        }





        }


        return view('existencias.ventas.index', ["atenciones" => $atenciones, "aten" => $aten,"cantidad" => $cantidad]);
  }

     public function recepcion(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->whereNotIn('categoria',[2,4,5])->orderBy('nombre','ASC')->get();
      return view('generics.index5', [
        "icon" => "fa-list-alt",
        "model" => "existencias",
        "model1" => "Productos en Almacen Recepciòn",
        "headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
        "data" => $producto,
        "fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }


     public function lab(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',2)->orderBy('nombre','ASC')->get();
      return view('generics.index5', [
        "icon" => "fa-list-alt",
        "model" => "existencias",
        "model1" => "Productos en Almacen Laboratorio",
        "headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
        "data" => $producto,
        "fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

    public function metodosp(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',3)->orderBy('nombre','ASC')->get();
      return view('generics.index5', [
        "icon" => "fa-list-alt",
        "model" => "existencias",
        "model1" => "Productos en Almacen Mètodos",
        "headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
        "data" => $producto,
        "fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

     public function rayos(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',4)->orderBy('nombre','ASC')->get();
      return view('generics.index5', [
        "icon" => "fa-list-alt",
        "model" => "existencias",
        "model1" => "Productos en Almacen Rayos",
        "headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
        "data" => $producto,
        "fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

    public function obstetra(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',5)->orderBy('nombre','ASC')->get();
      return view('generics.index5', [
        "icon" => "fa-list-alt",
        "model" => "existencias",
        "model1" => "Productos en Almacen Obstetra",
        "headers" => ["id", "Nombre","Medida", "Categoria","Cantidad","Precio Unidad","Precio Venta","Vencimiento", "Editar", "Eliminar"],
        "data" => $producto,
        "fields" => ["id", "nombre","medida", "categoria","cantidad","preciounidad","precioventa","vence"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

    
   public function entrada(Request $request){
    
          $p = Producto::find($request->producto);
          $p->cantidad = $p->cantidad + $request->cantidadplus;
          $res = $p->save();
          Toastr::success('La Entrada se Registro Exitosamente.', 'Producto!', ['progressBar' => true]);
          return redirect()->action('Existencias\ProductoController@index', ["created" => false]);
  
    }

    public function createView($extraArgs = []){
    	return view('existencias.create', ["categorias" => Categoria::all(), "medidas" => Medida::all()] + $extraArgs);
    }

    public function editView($id){
      $p = Producto::find($id);
      return view('existencias.edit', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "vence" => $p->vence,"id" => $p->id,"preciounidad" => $p->preciounidad,"precioventa" => $p->precioventa]);
      
    }

   /* public function productInView(){
      return view('existencias.entrada', [
        "productos" => Producto::where('sede_id', '=', 1)->get(['id', 'nombre']),
        "sedes" => Sede::all(),
        "proveedores" => Proveedor::all()
      ]);
    }*/

     public function productInView(){
      $sedes = Sede::where("id",'=',1)->get(["id", "name"]);
      return view('existencias.entrada', ["productos" => Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 1)->get(['id', 'nombre']),"sedes" => $sedes,"proveedores" => Proveedor::all()]);    
    }

    public function productOutView(){
      return view('existencias.salida', [
        "productos" => Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',1)->get(['id', 'nombre','cantidad']),
        "sedes" => Sede::all(),
        "proveedores" => Proveedor::all()
      ]);    
    }

    public function productTransView(){
      $sedes = Sede::whereNotIn("id", [\Session::get('sede')])->get(["id", "name"]);
      return view('existencias.transferir', ["productos" => Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->get(['id', 'nombre']), "sedes" => $sedes]);    
    }

    public function getProduct($id){
      $p = Producto::find($id);
      return response()->json(["producto" => $p], 200);
    }

    public function addCant(Request $request){
	
       $searchProduct = DB::table('productos')
                    ->select('*')
                    ->where('almacen','=','2')
                    ->where('id','=', $request->producto)
                    ->first();   

                    $nombre = $searchProduct->nombre;
					$cantidadactual = $searchProduct->cantidad;
		if( $request->cantidadplus > $cantidadactual){
		 Toastr::error('Cantidad excede Maximo en stock', 'Error!', ['progressBar' => true]);
		 return redirect()->action('Existencias\ProductoController@index2', ["created" => true]);
		} else {
			
		  Producto::where('id', $request->producto)
                  ->update([
                      'cantidad' => $cantidadactual - $request->cantidadplus,
                  ]);

               $ventas = new Ventas();
              $ventas->id_producto = $request->producto;
              $ventas->monto = $request->monto;
              $ventas->cantidad= $request->cantidadplus;
              $ventas->id_usuario = Auth::user()->id;
              $ventas->sede = $request->session()->get('sede');
              $ventas->save();
				  
		      $creditos = new Creditos();
              $creditos->origen = 'VENTA DE PRODUCTOS';
              $creditos->id_atencion = NULL;
              $creditos->monto= $request->monto;
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'VENTA DE PRODUCTOS';
              $creditos->id_venta = $ventas->id;
              $creditos->save();
			  
       Toastr::success('Registrada Exitosamente', 'Venta!', ['progressBar' => true]);
      return redirect()->action('Existencias\ProductoController@indexv', ["created" => true]);
		}
    
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
            "vence" => $pfrom->getOriginal("vence"),
            "cantidad" => $request->cantidadplus,
            "sede_id" => $request->sede,
            "almacen" => 2
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
	  $p->preciounidad = $request->preciounidad;
      $p->precioventa = $request->precioventa;
      $p->codigo = $request->codigo;
      $p->vence = $request->vence;
      $res = $p->save();
      return redirect()->action('Existencias\ProductoController@index', ["edited" => $res]);
    }

    public function delete($id){
      $p = Producto::find($id);
      $res = $p->delete();
      
       Toastr::success('Eliminado Exitosamente.', 'Producto!', ['progressBar' => true]);
        return redirect()->action('Existencias\ProductoController@index2', ["created" => false]);
    }

    public function getExist($prod, $sede){
      $ex = Producto::where('id', '=', $prod)->where("sede_id", "=", $sede)->where("almacen",'=', 1)
      ->get(["cantidad"])->first();
      $prod = Producto::where('id', '=', $prod)->get()->first();
      if($ex){
        return response()->json(["existencia" => $ex, "exists" => true, "medida" => $prod->medida]);
      }else{
        return response()->json(["exists" => false, "medida" => $prod->medida]);
      }
    }

     public function deleteventas($id){

      $ventas= Ventas::where('id','=',$id)->first();

      $p = Producto::find($ventas->id_producto);
      $p->cantidad= $p->cantidad - $ventas->cantidad;
      $res = $p->save();

      $creditos= Creditos::where('id_venta','=',$id)->first();
      $creditos->delete();

      $ventasp= Ventas::where('id','=',$id)->first();
      $ventasp->delete();

       Toastr::success('Eliminado Exitosamente', 'Venta!', ['progressBar' => true]);
    return redirect()->route('ventas.index');

    }


    public function codigoProduct(Request $request){

        $searchpacienteDNI = DB::table('productos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('codigo','=', $request->codigo)
                    ->where('sede_id','=',$request->session()->get('sede'))
                    ->get();

           if (count($searchpacienteDNI) > 0){

              return true;
           } else {

              return false;
           }

    }

    public function create(Request $request){
      $validator = \Validator::make($request->all(), [
        'nombre' => 'required|unique:productos'
      ]);

        if($validator->fails()) {

          Toastr::error('Error Registrando.', 'Nombre de Producto ya EXISTE!', ['progressBar' => true]);
          return redirect()->action('Existencias\ProductoController@createView', ['errors' => $validator->errors()]);

      } else {
    

       $producto = Producto::create([
        "nombre" => $request->nombre,
        "codigo" => $request->codigo,
        "categoria" => $request->categoria,
        "medida" => $request->medida,
        "preciounidad" => $request->preciounidad,
        "precioventa" => $request->precioventa,
        "vence" => $request->vence,
        "sede_id" => $request->session()->get('sede'),
        "almacen" => 1
      ]);

       }
	  
	    
       Toastr::success('Registrado Exitosamente.', 'Producto!', ['progressBar' => true]);
       return redirect()->action('Existencias\ProductoController@index', ["created" => true]);
       
     


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
