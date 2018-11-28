<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Servicios;
use App\Models\ServicioMaterial;
use App\Models\Existencias\Producto;

use Toastr;

class ServiciosController extends Controller
{

 public function index(){

      $servicios =Servicios::where("estatus", '=', 1)->get();
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

  public function search(Request $request)
  {
    $servicios =Servicios::where("estatus", '=', 1)
    ->where('detalle','like','%'.$request->non.'%')
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
      return view('archivos.servicios.edit', ["detalle" => $p->detalle, "precio" => $p->precio,"porcentaje" => $p->porcentaje,"id" => $p->id,]);
      
    } 

       public function edit(Request $request){
      $p = Servicios::find($request->id);
      $p->detalle = $request->detalle;
      $p->precio = $request->precio;
      $p->porcentaje = $request->porcentaje;
      $res = $p->save();
      return redirect()->action('Archivos\ServiciosController@index', ["edited" => $res]);
    }

    public function getServicio($servicio)
    {
        return Servicios::where('id', $servicio)->with('materiales.material')->first();      
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
