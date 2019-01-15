<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Servicios;
use App\Models\Historiales;
use App\Models\ServicioMaterial;
use App\Models\Existencias\Producto;
use Auth;
use Toastr;
use DB;

class ServiciosController extends Controller
{

 public function index(){

      //$servicios =Servicios::where("estatus", '=', 1)->get();
	  $servicios = DB::table('servicios as a')
        ->select('a.id','a.detalle','a.precio','a.porcentaje','a.por_per','a.por_tec','a.usuario','c.name as user','c.lastname')
		->join('users as c','c.id','a.usuario')
        ->where('a.estatus','=', 1)
        ->get();  
	  
      return view('archivos.servicios.index', ['servicios' => $servicios]);  
    }

  public function search(Request $request)
  {
    $servicios =Servicios::where("estatus", '=', 1)
    ->where('detalle','like','%'.$request->nom.'%')
    ->get();
    return view('generics.index', [
      "icon" => "fa-list-alt",
      "model" => "servicios",
      "headers" => ["id", "Detalle", "Precio","Porcentaje", "Porcentaje Personal", "Porcentaje Tecnólogo", "Opciones"],
      "data" => $servicios,
      "fields" => ["id", "detalle", "precio","porcentaje","por_per", "por_tec"],
        "actions" => [
          '<button type="button" class="btn btn-info">Transferir</button>',
          '<button type="button" class="btn btn-warning">Editar</button>'
        ]
    ]);     
  }

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'detalle' => 'required|string|max:255',
          'precio' => 'required|string|max:20'
        
        ]);

        if($validator->fails()) {
          return redirect()->action('Archivos\ServiciosController@createView', ['errors' => $validator->errors()]);
        } else {
          $servicio = new Servicios;
          $servicio->detalle = $request->detalle;
          $servicio->precio  = $request->precio;
          $servicio->porcentaje  = $request->porcentaje;
          $servicio->por_per  = $request->por_per;
          $servicio->por_tec  = $request->por_tec;
		  $servicio->programa = $request->programa;
		  $servicio->usuario = Auth::user()->id;


          if ($servicio->save()) {
            if (isset($request->materiales)) {
              foreach ($request->materiales as $mat) {
                ServicioMaterial::create([
                  'servicio_id' => $servicio->id,
                  'material_id' => $mat['material'],
                  'cantidad'    => $mat['cantidad']
                ]);
              }
            }
          }
		  
		  $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Servicio';
		  $historial->detalle =$request->detalle;
          $historial->id_usuario = \Auth::user()->id;
		  $historial->sede = $request->session()->get('sede');
          $historial->save();
          
          return redirect()->action('Archivos\ServiciosController@index', ["created" => true, "centros" => Servicios::all()]);
        }    
  }

  public function delete($id){
    $servicios = Servicios::find($id);
    $servicios->estatus=0;
    $servicios->save();
    return redirect()->action('Archivos\ServiciosController@index', ["deleted" => true, "servicios" => Servicios::all()]);
  }

  public function createView() {
    $materiales = Producto::where('categoria', 1)->get();
    return view('archivos.servicios.create', compact('materiales'));
  }

   
     public function editView($id){
      $p = Servicios::find($id);
      return view('archivos.servicios.edit', ["detalle" => $p->detalle, "precio" => $p->precio,"porcentaje" => $p->porcentaje,"por_per" => $p->por_per,"por_tec" => $p->por_tec,"id" => $p->id,]);
      
    } 

       public function edit(Request $request){
      $p = Servicios::find($request->id);
      $p->detalle = $request->detalle;
      $p->precio = $request->precio;
      $p->porcentaje = $request->porcentaje;
	  $p->por_per = $request->por_per;
      $p->por_tec = $request->por_tec;
      $res = $p->save();
      return redirect()->action('Archivos\ServiciosController@index', ["edited" => $res]);
    }

    public function getServicio($servicio)
    {
        return Servicios::findOrFail($servicio);
    
    }

    public function show($id)
    {
      $servicio = Servicios::where('id', $id)->with('materiales.material')->first();
      return view('archivos.servicios.show', compact('servicio'));
    }

    public function deleteMaterial($id)
    {
      $material = ServicioMaterial::findOrFail($id);
      return ($material->delete()) ? 1 : 0;
    }

    public function addItems(Servicios $servicio)
    {
      $materiales = Producto::where('categoria', 1)->get();
      return view('archivos.servicios.add_items', compact('materiales', 'servicio'));
    }

    public function storeItems(Request $request, $id)
    {
      $servicio = Servicios::findOrFail($id);
      $servicio->detalle = $request->detalle;
      $servicio->precio  = $request->precio;
      $servicio->porcentaje  = $request->porcentaje;

      if ($servicio->save()) {
        if (isset($request->materiales)) {
          foreach ($request->materiales as $mat) {
            ServicioMaterial::create([
              'servicio_id' => $servicio->id,
              'material_id' => $mat['material'],
              'cantidad'    => $mat['cantidad']
            ]);
          }
        }
        Toastr::success('El Servicio '.$servicio->detalle.' ha sido actualizado.', 'Servicios!', ['progressBar' => true]);
      }
      
      return redirect()->action('Archivos\ServiciosController@index', ["created" => true, "centros" => Servicios::all()]);
           
    }

}
