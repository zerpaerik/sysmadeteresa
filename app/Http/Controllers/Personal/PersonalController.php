<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Personal;
use App\Models\Historiales;
use App\User;
use Toastr;
use Auth;
use DB;


class PersonalController extends Controller
{

/*	public function index(){
		$personal = Personal::all();
		return view('archivos.personal.index', ["personal" => $personal]);
	}*/

  public function index(){

      //$personal = Personal::all();
    //  $personal =Personal::where("estatus", '=', 1)->get();
	  $personal = DB::table('personals as a')
        ->select('a.id','a.name','a.lastname as apellido','a.dni','a.phone','a.address','a.email','a.cargo','c.name as user','c.lastname')
		    ->join('users as c','c.id','a.usuario')
        ->where('a.estatus','=', 1)
        ->orderBy('a.id','DESC')
        ->get();  
		
      return view('archivos.personal.index', ['personal' => $personal]);  

    }

    public function search(Request $request)
    {
      $search = $request->nom;
      $split = explode(" ",$search);
      
      if (!isset($split[1])) {

        $split[1] = '';
        $personal = Personal::where('name','like','%'.$split[0].'%')
                    ->where('lastname','like','%'.$split[1].'%')
                    ->get();
       return view('archivos.personal.show', [
        "icon" => "fa-list-alt",
        "model" => "personal",
        "headers" => ["Nombre", "Apellido", "DNI", "Telèfono", "Direcciòn","E-mail","Cargo", "Editar", "Eliminar"],
        "data" => $personal,
        "fields" => ["name", "lastname", "dni", "phone", "address","email","cargo"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);                      

      }else{
        $personal = Personal::where('name','like','%'.$split[0].'%')
                    ->where('lastname','like','%'.$split[1].'%')
                    ->get();
       return view('archivos.personal.show', [
        "icon" => "fa-list-alt",
        "model" => "personal",
        "headers" => ["id", "Nombre", "Apellido", "DNI", "Telèfono", "Direcciòn","E-mail","Cargo", "Editar", "Eliminar"],
        "data" => $personal,
        "fields" => ["id", "name", "lastname", "dni", "phone", "address","email","cargo"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);      
      }
      
    }

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'dni' => 'required|unique:personals'
         
        ]);
        if($validator->fails()) {
	     Toastr::error('Error Registrando.', 'Personal- DNI YA REGISTRADO!', ['progressBar' => true]);
          return redirect()->action('Personal\PersonalController@createView', ['errors' => $validator->errors()]);
		} else { 
		$personal = Personal::create([
	      'name' => $request->name,
	      'lastname' => $request->lastname,
	      'phone' => $request->phone,
	      'email' => $request->email,
	      'dni' => $request->dni,
	      'address' => $request->address,
        'cargo' => $request->cargo,
		'tipo' => $request->tipo,
	    'usuario' => 	Auth::user()->id

   		]);

    if($request->tipo == 'Tecnologo'){

    $users= User::create([
        'name' => $request->name,
        'lastname' => $request->lastname,
        'tipo' => '1',
        'dni' => $request->dni,
        'tec' => 1

      ]);
	  } else {

       $users= User::create([
        'name' => $request->name,
        'lastname' => $request->lastname,
        'tipo' => '1',
        'dni' => $request->dni,

      ]);


    }
	
	  
	      $historial = new Historiales();
          $historial->accion ='Registro';
          $historial->origen ='Personal';
		  $historial->detalle =$request->dni;
          $historial->id_usuario = \Auth::user()->id;
		  $historial->sede = $request->session()->get('sede');
          $historial->save();
	  
		}


    Toastr::success('Registrado Exitosamente.', 'Personal!', ['progressBar' => true]);
		return redirect()->action('Personal\PersonalController@index', ["created" => true, "personal" => Personal::all()]);
	}   

     public function editView($id){
      $p = Personal::find($id);
      return view('archivos.personal.edit', ["name" => $p->name, "lastname" => $p->lastname, "dni" => $p->dni,"phone" => $p->phone,"address" => $p->address,"email" => $p->email,"cargo" => $p->cargo, "id" => $p->id,]);
      
    } 

     public function edit(Request $request){
      $p = Personal::find($request->id);
      $p->name = $request->name;
      $p->lastname = $request->lastname;
      $p->dni = $request->dni;
      $p->phone = $request->phone;
      $p->address = $request->address;
      $p->email = $request->email;
      $p->cargo = $request->cargo;
      $res = $p->save();
      return redirect()->action('Personal\PersonalController@index', ["edited" => $res]);
    }

  public function delete($id){
    $personal = Personal::find($id);
    $personal->estatus = 0;
    $personal->save();
    return redirect()->action('Personal\PersonalController@index', ["deleted" => true, "users" => Personal::all()]);
  }

  public function createView() {
    return view('archivos.personal.create');
  }

}
