<?php

namespace App\Http\Controllers\Existencias;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Existencias\{Producto, Requerimientos, Transferencia,ProductosMovimientos};
use App\Models\Config\{Sede, Proveedor};
use DB;
use Toastr;
use Carbon\Carbon;
use Auth;



class RequerimientosController extends Controller
{

    public function index(Request $request){

      $requerimientos = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidadd','a.cantidad','a.almacen_solicita','a.estatus','b.name as sede','a.created_at','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicitada','b.id')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->where('a.id_sede_solicita', '=', $request->session()->get('sede'))
                    ->where('a.usuario','=',Auth::user()->id)
                    ->orderby('a.created_at','desc')
                    ->get();  

			return view('existencias.requerimientos.index',compact('requerimientos'));   	
    }

     public function index2(Request $request){

        if(! is_null($request->fecha) && ! is_null($request->almacen)) {

        $f1 = $request->fecha;
        $f2 = $request->fecha2;  

       $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.almacen_solicita','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                   // ->where('a.usuario','=',Auth::user()->id)
                    ->where('a.almacen_solicita','=',$request->almacen)
                    ->where('a.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->where('a.estatus','=','Solicitado')
                    ->orderby('a.created_at','desc')
                    ->get();

         } else if(! is_null($request->fecha)) {

           $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.almacen_solicita','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                   // ->where('a.usuario','=',Auth::user()->id)
                    ->where('a.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->where('a.estatus','=','Solicitado')
                    ->orderby('a.created_at','desc')
                    ->get();

         } else if(! is_null($request->almacen)) {

          $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.almacen_solicita','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->where('a.almacen_solicita','=',$request->almacen)
                  //  ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                   // ->where('a.usuario','=',Auth::user()->id)
                    ->where('a.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->where('a.estatus','=','Solicitado')
                    ->orderby('a.created_at','desc')
                    ->get();


         } else {



          $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.almacen_solicita','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                   // ->where('a.usuario','=',Auth::user()->id)
                    ->where('a.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->where('a.estatus','=','Solicitado')
                    ->orderby('a.created_at','desc')
                    ->get();



         }   

             $sedes = Sede::all();
       

        return view('existencias.requerimientos.index2', ["requerimientos2" => $requerimientos2,"sedes" => $sedes]);   	
    }

     public function index3(Request $request){


        if(! is_null($request->fecha) && ! is_null($request->almacen)) {

        $f1 = $request->fecha;
        $f2 = $request->fecha2;  



       $requerimientos3 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.almacen_solicita','a.updated_at','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre','d.precioventa')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('a.almacen_solicita','=',$request->almacen)
                    ->where('a.estatus','=','Procesado')
                    //->where('a.usuario','=',Auth::user()->id)
                    ->where('a.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->orderby('a.created_at','desc')
                    ->get();



    $total = Requerimientos::where('id_sede_solicitada','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                                      ->where('almacen_solicita','=',$request->almacen)
                                      ->where('estatus','=','Procesado')
                                     ->select(DB::raw('COUNT(*) as total'))
                                     ->first();

      $totalunidad=DB::table('productos as a')
                    ->select('a.id','a.preciounidad','a.precioventa','r.created_at','r.almacen_solicita','r.estatus','r.id_sede_solicitada',DB::raw('SUM(a.preciounidad) as total'))
                    ->join('requerimientos as r','a.id','r.id_producto')
                    ->whereBetween('r.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('r.almacen_solicita','=',$request->almacen)
                    ->where('r.estatus','=','Procesado')
                    ->where('r.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->first();


     $totalventa=DB::table('productos as a')
                    ->select('a.id','a.preciounidad','a.precioventa','r.created_at','r.almacen_solicita','r.estatus','r.id_sede_solicitada',DB::raw('SUM(a.precioventa) as total'))
                    ->join('requerimientos as r','a.id','r.id_producto')
                    ->whereBetween('r.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('r.almacen_solicita','=',$request->almacen)
                    ->where('r.estatus','=','Procesado')
                    ->where('r.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->first();
        


         } else if(! is_null($request->fecha)) {

            $f1 = $request->fecha;
        $f2 = $request->fecha2;  




          $requerimientos3 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.almacen_solicita','a.updated_at','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre','d.precioventa')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('a.estatus','=','Procesado')
                    //->where('a.usuario','=',Auth::user()->id)
                    ->where('a.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->orderby('a.created_at','desc')
                    ->get();


                   $total = Requerimientos::where('id_sede_solicitada','=', $request->session()->get('sede'))
                                    ->whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                                      ->where('estatus','=','Procesado')
                                     ->select(DB::raw('COUNT(*) as total'))
                                     ->first();

                  $totalunidad=DB::table('productos as a')
                    ->select('a.id','a.preciounidad','a.precioventa','r.created_at','r.almacen_solicita','r.estatus','r.id_sede_solicitada',DB::raw('SUM(a.preciounidad) as total'))
                    ->join('requerimientos as r','a.id','r.id_producto')
                    ->whereBetween('r.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('r.estatus','=','Procesado')
                    ->where('r.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->first();


                  $totalventa=DB::table('productos as a')
                    ->select('a.id','a.preciounidad','a.precioventa','r.created_at','r.almacen_solicita','r.estatus','r.id_sede_solicitada',DB::raw('SUM(a.precioventa) as total'))
                    ->join('requerimientos as r','a.id','r.id_producto')
                    ->whereBetween('r.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('r.estatus','=','Procesado')
                    ->where('r.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->first();
        

        

          } else if(! is_null($request->almacen)) {

             $requerimientos3 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.almacen_solicita','a.updated_at','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre','d.precioventa')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->where('a.almacen_solicita','=',$request->almacen)
                    ->where('a.estatus','=','Procesado')
                    //->where('a.usuario','=',Auth::user()->id)
                    ->where('a.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->orderby('a.created_at','desc')
                    ->get();


    $total = Requerimientos::where('estatus','=','Procesado')
                                     ->where('id_sede_solicitada', '=', $request->session()->get('sede'))
                                    ->where('almacen_solicita','=',$request->almacen)
                                     ->select(DB::raw('COUNT(*) as total'))
                                     ->first();



           } else {

             $f1 = Carbon::today()->toDateString();
        $f2 = Carbon::today()->toDateString();  


       $requerimientos3 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.almacen_solicita','a.updated_at','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre','d.precioventa')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->where('a.id','=',999999999999)
                    ->where('a.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->where('a.updated_at','=',Carbon::today()->toDateString())
                    ->get();

                     $total = Requerimientos::where('estatus','=','Procesado')
                                         ->where('id','=',999999999999)
                                     ->where('id_sede_solicitada', '=', $request->session()->get('sede'))
                                     ->select(DB::raw('COUNT(*) as total'))
                                    ->where('updated_at','=',Carbon::today()->toDateString())
                                     ->first();

                         $totalunidad=DB::table('productos as a')
                    ->select('a.id','a.preciounidad','a.precioventa as venta','r.created_at','r.almacen_solicita','r.estatus','r.id_sede_solicitada',DB::raw('SUM(a.preciounidad) as total'))
                    ->join('requerimientos as r','a.id','r.id_producto')
                    ->whereBetween('r.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('r.estatus','=','Procesado')
                    ->where('r.id_sede_solicitada', '=', $request->session()->get('sede'))
                    ->where('a.id','=',99999999999999)
                    ->first();


                  $totalventa=DB::table('productos as a')
                    ->select('a.id','a.preciounidad','a.precioventa','r.created_at','r.almacen_solicita','r.estatus','r.id_sede_solicitada',DB::raw('SUM(a.precioventa) as total'))
                    ->join('requerimientos as r','a.id','r.id_producto')
                    ->whereBetween('r.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                    ->where('r.estatus','=','Procesado')
                    ->where('r.id_sede_solicitada', '=', $request->session()->get('sede'))
                      ->where('a.id','=',99999999999999)
                    ->first();



           }         

        return view('existencias.requerimientos.index3', compact('requerimientos3','total','totalventa','totalunidad'));    
    }

   

     private function elasticSearch()
  { 
         $requerimientos2 = DB::table('requerimientos as a')
                    ->select('a.id','a.id_sede_solicita','a.id_sede_solicitada','a.usuario','a.id_producto','a.cantidad','a.estatus','b.name as sede','a.created_at','a.cantidadd','c.name as solicitante','d.nombre')
                    ->join('sedes as b','a.id_sede_solicita','b.id','e.name')
                    ->join('users as c','c.id','a.usuario')
                    ->join('productos as d','d.id','a.id_producto')
                    ->join('sedes as e','e.id','a.id_sede_solicita')
                    ->where('a.id_sede_solicitada', '=', \Session::get("sede"))
        //->where('e.name','like','%'.$sede.'%')
        //->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($initial)), date('Y-m-d 23:59:59', strtotime($final))])
      
        ->orderby('a.id','desc')
        ->paginate(20);


        return $requerimientos2;
  }


      public function delete($id){
      $p = Requerimientos::find($id);
      $res = $p->delete();
      
       Toastr::success('Eliminado Exitosamente.', 'Requerimiento!', ['progressBar' => true]);
        return redirect()->action('Existencias\RequerimientosController@index2', ["created" => false]);
    }





    public function createView(){
    	return view('existencias.requerimientos.create', ["productos" => Producto::where('sede_id','=', 1)->where('almacen','=',1)->orderBy('nombre','asc')->get(["id", "nombre"])]);
    }


     public function createView1(){
      return view('existencias.requerimientos.create1', ["productos" => Producto::where('sede_id','=', 1)->where('almacen','=',1)->orderBy('nombre','asc')->get(["id", "nombre"])]);
    }


    public function create(Request $request){

   
    if (isset($request->id_laboratorio)) {
      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {

          $lab = new Requerimientos();
          $lab->id_producto =  $laboratorio['laboratorio'];
          $lab->cantidad =  $request->monto_abol['laboratorios'][$key]['abono'];
          $lab->id_sede_solicita = $request->session()->get('sede');
          $lab->usuario = Auth::user()->id;
          $lab->id_sede_solicitada = 1;
          $lab->estatus = 'Solicitado';
          $lab->almacen_solicita =$request->almacen;
          $lab->save();

 

          if($request->almacen==1){
            $alm='RECEPCION';
          }elseif($request->almacen==2){
           $alm='LABORATORIO';
         }elseif($request->almacen==3){
           $alm='RAYOS';
         }else{
          $alm='OBSTETRA';
        }

              $productosm = new ProductosMovimientos();
              $productosm->id_producto = $laboratorio['laboratorio'];
              $productosm->accion = 'SOLICITADO';
              $productosm->origen= 'REQUERIMIENTO ENVIADO';
              $productosm->usuario= Auth::user()->id;
              $productosm->cantidad=$request->monto_abol['laboratorios'][$key]['abono'];
              $productosm->sede = $request->session()->get('sede');
              $productosm->alm1 =$alm;
              $productosm->alm2 ='CENTRAL';
              $productosm->save();


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
                    $almacen_solicita=$searchRequerimiento->almacen_solicita;



            
                  

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
                    ->where('padre','=', $producto)
                   // ->where('sede_id','=',$sede_solicita)
                   // ->where('almacen','=',2)
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

     
      $p = Producto::where("padre", "=", $producto)->where('sede_id','=',$sede_solicita)->where('almacen','=',2)->first();


      if($p){
        
        $atec=Producto::where("padre","=",$producto)
                          ->update(['cantidad' => $cantidadactualsedesolicita + $request->cantidadd]);



          if($almacen_solicita==1){
            $alm='RECEPCION';
          }elseif($almacen_solicita==2){
           $alm='LABORATORIO';
         }elseif($almacen_solicita==3){
           $alm='RAYOS';
         }else{
          $alm='OBSTETRA';
        }




       
              $productosm = new ProductosMovimientos();
              $productosm->id_producto = $producto;
              $productosm->accion = 'INGRESO EN ALMACEN';
              $productosm->origen= 'REQUERIMIENTO PROCESADO';
              $productosm->usuario= Auth::user()->id;
              $productosm->cantidad=$request->cantidadd;
              $productosm->sede = $request->session()->get('sede');
              $productosm->alm1=$alm;
              $productosm->alm2='CENTRAL';
              $productosm->save();



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
        $prod->padre = $producto;
        $prod->save();

          if($almacen_solicita==1){
            $alm='RECEPCION';
          }elseif($almacen_solicita==2){
           $alm='LABORATORIO';
         }elseif($almacen_solicita==3){
           $alm='RAYOS';
         }else{
          $alm='OBSTETRA';
        }

              $productosm = new ProductosMovimientos();
              $productosm->id_producto = $producto;
              $productosm->accion = 'INGRESO EN ALMACEN';
              $productosm->origen= 'REQUERIMIENTO PROCESADO';
              $productosm->usuario= Auth::user()->id;
              $productosm->cantidad=$request->cantidadd;
              $productosm->sede = $request->session()->get('sede');
              $productosm->alm1=$alm;
              $productosm->alm2='CENTRAL';
              $productosm->save();


      }

        Toastr::success('Procesado Exitosamente.', 'Requerimiento!', ['progressBar' => true]);

          return back();

    }

    public function edit1(Request $request){


        $searchRequerimiento = DB::table('requerimientos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->first();                    
                    //->get();

                  
                    $producto = $searchRequerimiento->id_producto;
                    $sede_solicita = $searchRequerimiento->id_sede_solicita;
                    $almacen_solicita = $searchRequerimiento->almacen_solicita;

             
                  

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
                    ->where('padre','=', $producto)
                    ->first(); 

                    if($searchProductoSedeSolicitad == NULL){
                      $cantidadactualsedesolicita=0;
                    }else{
                    $cantidadactualsedesolicita = $searchProductoSedeSolicitad->cantidad; 
                    }  

  
      

      $p = Producto::find($producto);
      $p->cantidad= $cantidadactual - $request->cantidadd;
      $res = $p->save();



      $p = Requerimientos::find($request->id);
      $p->estatus = 'Procesado';
      $p->cantidadd= $request->cantidadd;
      $res = $p->save();

     
      $p = Producto::where("padre", "=", $producto)->where('sede_id','=',$sede_solicita)->where('almacen','=',2)->first();

      
      if($p){

        $atec=Producto::where("padre","=",$producto)
                          ->update(['cantidad' => $cantidadactualsedesolicita + $request->cantidadd]);

       // $p->cantidad = $cantidadactualsedesolicita + $request->cantidadd;
        //$p->save();
        


        if($almacen_solicita==1){
            $alm='RECEPCION';
          }elseif($almacen_solicita==2){
           $alm='LABORATORIO';
         }elseif($almacen_solicita==3){
           $alm='RAYOS';
         }else{
          $alm='OBSTETRA';
        }

              $productosm = new ProductosMovimientos();
              $productosm->id_producto = $producto;
              $productosm->accion = 'INGRESO EN ALMACEN';
              $productosm->origen= 'REQUERIMIENTO PROCESADO';
              $productosm->usuario= Auth::user()->id;
              $productosm->cantidad=$request->cantidadd;
              $productosm->sede = $request->session()->get('sede');
              $productosm->alm1=$alm;
              $productosm->alm2='CENTRAL';
              $productosm->save();



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
        $prod->padre = $producto;
        $prod->save();


            
              if($almacen_solicita==1){
            $alm='RECEPCION';
          }elseif($almacen_solicita==2){
           $alm='LABORATORIO';
         }elseif($almacen_solicita==3){
           $alm='RAYOS';
         }else{
          $alm='OBSTETRA';
        }

              $productosm = new ProductosMovimientos();
              $productosm->id_producto = $producto;
              $productosm->accion = 'INGRESO EN ALMACEN';
              $productosm->origen= 'REQUERIMIENTO PROCESADO';
              $productosm->usuario= Auth::user()->id;
              $productosm->cantidad=$request->cantidadd;
              $productosm->sede = $request->session()->get('sede');
              $productosm->alm1=$alm;
              $productosm->alm2='CENTRAL';
              $productosm->save();
      }

        Toastr::success('Procesado Exitosamente.', 'Requerimiento!', ['progressBar' => true]);

          return back();

    }

      public function reversar(Request $request,$id){


        $searchRequerimiento = DB::table('requerimientos')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id)
                    ->first();                    
                    //->get();

                  
                    $producto = $searchRequerimiento->id_producto;
                    $solicitada = $searchRequerimiento->cantidad;
                    $entregada = $searchRequerimiento->cantidadd;
                    $sede_solicita = $searchRequerimiento->id_sede_solicita;
                    $almacen_solicita = $searchRequerimiento->almacen_solicita;
            

         
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
                    ->where('nombre','=', $nombre)
                    ->where('sede_id','=',$sede_solicita)
                    ->where('almacen','=',2)
                    ->first(); 

                    if($searchProductoSedeSolicitad == NULL){
                      $cantidadactualsedesolicita=0;
                    }else{
                    $cantidadactualsedesolicita = $searchProductoSedeSolicitad->cantidad; 
                    }  

              

      $p = Requerimientos::find($request->id);
      $p->estatus = 'Solicitado';
      $p->cantidadd=NULL;
      $res = $p->update();

      $p = Producto::find($producto);
      $p->cantidad= $cantidadactual + $entregada;
      $res = $p->save();

     
      $p = Producto::where("nombre", "=", $nombre)->where("sede_id", "=",  $sede_solicita)->where("almacen","=", 2)->get()->first();
      $p->cantidad = $cantidadactualsedesolicita - $entregada;
      $p->update();


              if($almacen_solicita==1){
            $alm='RECEPCION';
          }elseif($almacen_solicita==2){
           $alm='LABORATORIO';
         }elseif($almacen_solicita==3){
           $alm='RAYOS';
         }else{
          $alm='OBSTETRA';
        }

              $productosm = new ProductosMovimientos();
              $productosm->id_producto = $producto;
              $productosm->accion = 'ENTRADA';
              $productosm->origen= 'REVERSO DE REQUERIMIENTO';
              $productosm->usuario= Auth::user()->id;
              $productosm->cantidad=$entregada;
              $productosm->sede = $request->session()->get('sede');
              $productosm->alm1=$alm;
              $productosm->alm2='CENTRAL';
              $productosm->save();
  

        Toastr::success('Reversado Exitosamente.', 'Requerimiento!', ['progressBar' => true]);

      return redirect()->action('Existencias\RequerimientosController@index2', ["edited" => $res]);
    }


       
}
