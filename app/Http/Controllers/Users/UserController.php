<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Models\Config\Sede;

class UserController extends Controller
{
	public function index(){
		$users = User::all();
		return view('archivos.users.index', ["users" => $users]);
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
    $user = User::find($id);
    $user->delete();
    return redirect()->action('Users\UserController@index', ["deleted" => true, "users" => User::all()]);
  }

  public function loginView(){
    return view('auth.login', ["sedes" => Sede::all()]);
  }

  public function createView() {
    return view('archivos.users.create', ["roles" => Role::all()]);
  }

}
