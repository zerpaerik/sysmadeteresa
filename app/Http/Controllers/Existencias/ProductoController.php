<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Existencia, Transferencia,ProductosMovimientos};
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
			return view('existencias.central',compact('producto'));    	
    }

      public function index2(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->orderBy('nombre','ASC')->get();
      return view('existencias.local',compact('producto'));     
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
      return view('existencias.recepcion', compact('producto'));     
    }


     public function lab(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',2)->orderBy('nombre','ASC')->get();
      return view('existencias.lab',compact('producto'));     
    }

    public function metodosp(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',3)->orderBy('nombre','ASC')->get();
      return view('existencias.metodos', compact('producto'));     
    }

     public function rayos(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',4)->orderBy('nombre','ASC')->get();
      return view('existencias.rayos',compact('producto'));     
    }

    public function obstetra(){
    //  $producto = Producto::all();
      $producto =Producto::where("sede_id", '=', \Session::get("sede"))->where("almacen",'=', 2)->where('categoria','=',5)->orderBy('nombre','ASC')->get();
      return view('existencias.obstetra', compact('producto'));     
    }

    
   public function entrada(Request $request){
    
          $p = Producto::find($request->producto);
          $p->cantidad = $p->cantidad + $request->cantidadplus;
          $res = $p->save();

            $productom = new ProductosMovimientos();
              $productom->id_producto = $request->producto;
              $productom->accion = 'ENTRADA EN ALM CENTRAL';
              $productom->origen= 'ENTRADA DE PRODUCTOS';
              $productom->usuario= Auth::user()->id;
              $productom->cantidad=$request->cantidadplus;
              $productom->sede = $request->session()->get('sede');
              $productom->save();
          




          Toastr::success('La Entrada se Registro Exitosamente.', 'Producto!', ['progressBar' => true]);
          return redirect()->action('Existencias\ProductoController@index', ["created" => false]);
  
    }

    public function createView($extraArgs = []){
    	return view('existencias.create', ["categorias" => Categoria::all(), "medidas" => Medida::all()] + $extraArgs);
    }

    public function editViewc($id){
      $p = Producto::find($id);
      return view('existencias.editc', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "vence" => $p->vence,"id" => $p->id,"preciounidad" => $p->preciounidad,"precioventa" => $p->precioventa,"cantidad" => $p->cantidad]);
      
    }

    public function editViewre($id){
      $p = Producto::find($id);
      return view('existencias.editre', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "vence" => $p->vence,"id" => $p->id,"preciounidad" => $p->preciounidad,"precioventa" => $p->precioventa,"cantidad" => $p->cantidad]);
      
    }

    public function editViewme($id){
      $p = Producto::find($id);
      return view('existencias.editme', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "vence" => $p->vence,"id" => $p->id,"preciounidad" => $p->preciounidad,"precioventa" => $p->precioventa,"cantidad" => $p->cantidad]);
      
    }

    public function editViewra($id){
      $p = Producto::find($id);
      return view('existencias.editra', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "vence" => $p->vence,"id" => $p->id,"preciounidad" => $p->preciounidad,"precioventa" => $p->precioventa,"cantidad" => $p->cantidad]);
      
    }
     public function editViewrla($id){
      $p = Producto::find($id);
      return view('existencias.editla', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "vence" => $p->vence,"id" => $p->id,"preciounidad" => $p->preciounidad,"precioventa" => $p->precioventa,"cantidad" => $p->cantidad]);
      
    }

      public function editViewrobs($id){
      $p = Producto::find($id);
      return view('existencias.editobs', ["medidas" => Medida::all(), "categorias" => Categoria::all(), "nombre" => $p->nombre, "cantidad" => $p->cantidad,"codigo" => $p->codigo, "vence" => $p->vence,"id" => $p->id,"preciounidad" => $p->preciounidad,"precioventa" => $p->precioventa,"cantidad" => $p->cantidad]);
      
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

                $productom = new ProductosMovimientos();
              $productom->id_producto = $request->producto;
              $productom->accion = 'SALIDA';
              $productom->origen= 'VENTA DE PRODUCTOS';
              $productom->usuario= Auth::user()->id;
              $productom->cantidad=$request->cantidadplus;
              $productom->sede = $request->session()->get('sede');
              $productom->save();
			  
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

    public function editc(Request $request){
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
    Toastr::success('Editado Exitosamente.', 'Producto!', ['progressBar' => true]);

    return redirect()->action('Existencias\ProductoController@index', ["created" => false]);

    }

    public function editra(Request $request){
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
    Toastr::success('Editado Exitosamente.', 'Producto!', ['progressBar' => true]);

    return redirect()->action('Existencias\ProductoController@rayos', ["created" => false]);

    }

    public function editre(Request $request){
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
    Toastr::success('Editado Exitosamente.', 'Producto!', ['progressBar' => true]);

    return redirect()->action('Existencias\ProductoController@recepcion', ["created" => false]);

    }

    public function editme(Request $request){
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
    Toastr::success('Editado Exitosamente.', 'Producto!', ['progressBar' => true]);

    return redirect()->action('Existencias\ProductoController@metodosp', ["created" => false]);

    }

    public function editobs(Request $request){
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
    Toastr::success('Editado Exitosamente.', 'Producto!', ['progressBar' => true]);

    return redirect()->action('Existencias\ProductoController@obstetra', ["created" => false]);

    }

    public function editla(Request $request){
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
    Toastr::success('Editado Exitosamente.', 'Producto!', ['progressBar' => true]);

    return redirect()->action('Existencias\ProductoController@lab', ["created" => false]);

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


       $productom = new ProductosMovimientos();
              $productom->id_producto = $ventas->id_producto;
              $productom->accion = 'ENTRADA';
              $productom->origen= 'REVERSO DE VENTA DE PRODUCTOS';
              $productom->usuario= Auth::user()->id;
              $productom->cantidad=$ventas->cantidad;
              $productom->sede = $request->session()->get('sede');
              $productom->save();

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
    

  
              $producto = new Producto();
              $producto->nombre = $request->nombre;
              $producto->codigo = $request->codigo;
              $producto->categoria= $request->categoria;
              $producto->medida= $request->medida;
              $producto->preciounidad= $request->preciounidad;
              $producto->precioventa= $request->precioventa;
              $producto->sede_id = $request->session()->get('sede');
              $producto->vence = $request->vence;
              $producto->almacen =1;
              $producto->save();

              $productom = new ProductosMovimientos();
              $productom->id_producto = $producto->id;
              $productom->accion = 'CREACIÒN';
              $productom->origen= 'ALMACEN CENTRAL';
              $productom->usuario= Auth::user()->id;
              $productom->cantidad='0';
              $productom->sede = $request->session()->get('sede');
              $productom->save();






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


    public function movimientos(Request $request){


      if(!is_null($request->fecha) && !is_null($request->fecha2) && !is_null($request->producto)){

         $productosm= DB::table('productos_movimientos as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.sede','a.alm1','a.alm2','a.usuario','a.accion','a.origen','a.created_at','u.name','u.lastname','p.nombre')
                    ->join('productos as p','a.id_producto','p.id')
                    ->join('users as u','u.id','a.usuario')
                    ->where('a.sede','=',$request->session()->get('sede'))
                    ->where('a.id_producto','=',$request->producto)
                    ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
                    ->get();


      }elseif(!is_null($request->fecha) && !is_null($request->fecha2) && is_null($request->producto)){
      $productosm= DB::table('productos_movimientos as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.alm1','a.alm2','a.sede','a.usuario','a.accion','a.origen','a.created_at','u.name','u.lastname','p.nombre')
                    ->join('productos as p','a.id_producto','p.id')
                    ->join('users as u','u.id','a.usuario')
                    ->where('a.sede','=',$request->session()->get('sede'))
                    ->whereBetween('a.created_at',[$request->fecha,$request->fecha2])
                    ->get();



      }elseif(is_null($request->fecha) && is_null($request->fecha2) && !is_null($request->producto)){

         $productosm= DB::table('productos_movimientos as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.alm1','a.alm2','a.sede','a.usuario','a.accion','a.origen','a.created_at','u.name','u.lastname','p.nombre')
                    ->join('productos as p','a.id_producto','p.id')
                    ->join('users as u','u.id','a.usuario')
                    ->where('a.sede','=',$request->session()->get('sede'))
                    ->where('a.id_producto','=',$request->producto)
                    ->get();


      }else{


      $productosm= DB::table('productos_movimientos as a')
                    ->select('a.id','a.id_producto','a.cantidad','a.alm1','a.alm2','a.sede','a.usuario','a.accion','a.origen','a.created_at','u.name','u.lastname','p.nombre')
                    ->join('productos as p','a.id_producto','p.id')
                    ->join('users as u','u.id','a.usuario')
                    ->where('a.sede','=',9)
                    ->get();
      }


           $productos = DB::table('productos as a')
                    ->select('a.id','a.nombre','a.sede_id','a.almacen')
                    ->join('productos_movimientos as pm','pm.id_producto','a.id')
                    ->where('sede_id','=',$request->session()->get('sede'))
                    ->groupBy('a.id')
                    ->get();

      return view('existencias.movimientos.index',compact('movimientos','productos','productosm'));
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
