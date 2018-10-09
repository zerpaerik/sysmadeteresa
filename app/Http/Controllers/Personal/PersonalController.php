<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Personal;

class PersonalController extends Controller
{

/*	public function index(){
		$personal = Personal::all();
		return view('archivos.personal.index', ["personal" => $personal]);
	}*/

  public function index(){

      $personal = Personal::all();
      return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "personal",
        "headers" => ["id", "Nombre", "Apellido", "DNI", "Telèfono", "Direcciòn","E-mail", "Editar", "Eliminar"],
        "data" => $personal,
        "fields" => ["id", "name", "lastname", "dni", "phone", "address","email",],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);     
    }

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'phone' => 'required|unique:personals',
          'dni' => 'required|unique:personals',
          'email' => 'required',
          'address' => 'required'
        ]);
        if($validator->fails()) 
          return redirect()->action('Personal\PersonalController@createView', ['errors' => $validator->errors()]);
		$user = Personal::create([
	      'name' => $request->name,
	      'lastname' => $request->lastname,
	      'phone' => $request->phone,
	      'email' => $request->email,
	      'dni' => $request->dni,
	      'address' => $request->address,
   		]);
		return redirect()->action('Personal\PersonalController@index', ["created" => true, "users" => Personal::all()]);
	}   

     public function editView($id){
      $p = Personal::find($id);
      return view('archivos.personal.edit', ["name" => $p->name, "lastname" => $p->lastname, "dni" => $p->dni,"phone" => $p->phone,"address" => $p->address,"email" => $p->email, "id" => $p->id,]);
      
    } 

     public function edit(Request $request){
      $p = Personal::find($request->id);
      $p->name = $request->name;
      $p->lastname = $request->lastname;
      $p->dni = $request->dni;
      $p->phone = $request->phone;
      $p->address = $request->address;
      $p->email = $request->email;
      $res = $p->save();
      return redirect()->action('Personal\PersonalController@index', ["edited" => $res]);
    }

  public function delete($id){
    $personal = Personal::find($id);
    $personal->delete();
    return redirect()->action('Personal\PersonalController@index', ["deleted" => true, "users" => Personal::all()]);
  }

  public function createView() {
    return view('archivos.personal.create');
  }

}
