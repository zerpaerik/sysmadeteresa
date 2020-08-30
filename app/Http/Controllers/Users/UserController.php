<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Models\Config\Sede;
use DB;
use Auth;
use Toastr;


class UserController extends Controller
{
	public function index(){
		//$users = User::all();
		$users = DB::table('users as a')
        ->select('a.id','a.estatus','a.name','a.lastname','a.dni','a.tipo','a.email','a.role_id','b.name as rol')
		    ->join('roles as b','b.id','a.role_id')
        ->orderby('a.id','desc')
		    ->where('a.tipo','=',NULL)
        ->where('a.estatus','=',1)
        ->get();  
		return view('archivos.users.index', ["users" => $users]);
  }
  
  public function pending(){
		$users = DB::table('users as a')
        ->select('a.id','a.estatus','a.name','a.id_paciente','a.lastname','a.origen_r','a.validate','a.dni','a.tipo','a.email','a.role_id')
        ->where('a.origen_r','=','APP')
        ->where('a.id_paciente','=',NULL)
        ->where('a.estatus','=',1)
        ->get();  
		return view('archivos.users.pending', compact('users'));
  }

  public function pendingp(Request $request){

    if(!is_null($request->paciente)){

		    $users = DB::table('users as a')
        ->select('a.id','a.estatus','a.name','a.dni','a.id_paciente','a.lastname','a.origen_r','a.validate','a.dni','a.tipo','a.email','a.role_id')
        ->where('a.origen_r','=','APP')
        ->where('a.id_paciente','=',$request->paciente)
        ->first();  

      } else {
        $users = DB::table('users as a')
        ->select('a.id','a.estatus','a.name','a.dni','a.id_paciente','a.lastname','a.origen_r','a.validate','a.dni','a.tipo','a.email','a.role_id')
        ->where('a.origen_r','=','APP')
        ->where('a.id_paciente','=',7495749564957945)
        ->where('a.estatus','=',1)
        ->first();  

      }

        $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.apellidos','a.dni')
        ->join('users as b','b.id_paciente','a.id')
        ->orderBy('a.apellidos','desc')
        ->get();


		return view('archivos.users.pendingp', compact('users','pacientes'));
	}

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'email' => 'required|email|unique:users',
          'role_id' => 'required',
          'password' => 'required|string|min:6',
        ]);
        if($validator->fails()) 
          return redirect()->action('Users\UserController@createView', ['errors' => $validator->errors()]);
		$user = User::create([
      'name' => $request->name,
      'lastname' => $request->lastname,
      'email' => $request->email,
      'role_id' => $request->role_id,
      'password' => \Hash::make($request->password),
    ]);

    
		return redirect()->action('Users\UserController@index', ["created" => true, "users" => User::all()]);
	}

  public function delete($id){
    $users = User::find($id);
    $users->password='';
    $users->estatus=0;
    $users->save();
    return redirect()->action('Users\UserController@index', ["deleted" => true, "users" => User::all()]);
  }

  public function validar($id){
    $users = User::find($id);
    $users->validate=1;
    $users->save();
    return redirect()->action('Users\UserController@pending', ["deleted" => true, "users" => User::all()]);
  }

  public function denegar($id){
    $users = User::find($id);
    $users->validate=NULL;
    $users->save();
    return redirect()->action('Users\UserController@pending', ["deleted" => true, "users" => User::all()]);
  }

  public function loginView(){
    return view('auth.login', ["sedes" => Sede::all(),"data" => false]);
  }

  public function createView() {
    return view('archivos.users.create', ["roles" => Role::all()]);
  }

    public static function updatepass(Request $request){
    

        $id= Auth::user()->id;
        $usuario = User::where('id', '=', $id)->get()[0];
        $usuario->password = \Hash::make($request->password);
        $usuario = $usuario->update();

     Toastr::success('Modificado Exitosamente.', 'Contraseña!', ['progressBar' => true]);

         return redirect()->route('users.password');

     


    }


    public function updatepasswd()
    {
        $id= Auth::user()->id;
        $usuario = User::where('id', '=', $id)->first();
        return view('archivos.users.updatepasswd', ["usuario" => $usuario]);
    }

}
