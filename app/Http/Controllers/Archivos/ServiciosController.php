<?php

namespace App\Http\Controllers\Archivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Servicios;
use App\Models\ServicioMaterial;
use App\Models\Existencias\Producto;
class ServiciosController extends Controller
{

 public function index(){

      $servicios = Servicios::all();
      return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "servicios",
        "headers" => ["id", "Detalle", "Precio","Porcentaje", "Eliminar"],
        "data" => $servicios,
        "fields" => ["id", "detalle", "precio","porcentaje",],
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
    $servicios->delete();
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
        return Servicios::findOrFail($servicio);
    }

}
