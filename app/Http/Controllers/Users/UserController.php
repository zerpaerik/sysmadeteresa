<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;

class UserController extends Controller
{
	public function index(){
		$users = User::where('role_id', "!=", 1)->get();
		return view('archivos.personal.index', ["users" => $users]);
	}

	public function create(Request $request){
        $validator = \Validator::make($request->all(), [
          'name' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'email' => 'required|email|unique:users',
          'phone' => 'required|unique:users',
          'dni' => 'required|unique:users',
          'role_id' => 'required',
          'address' => 'required',
          'password' => 'required|string|min:6',
        ]);
        if($validator->fails()) 
          return redirect()->action('Users\UserController@createView', ['errors' => $validator->errors()]);
		$user = User::create([
      'name' => $request->name,
      'lastname' => $request->lastname,
      'email' => $request->email,
      'phone' => $request->phone,
      'dni' => $request->dni,
      'role_id' => $request->role_id,
      'address' => $request->address,
      'password' => \Hash::make($request->password)
    ]);
		return redirect()->action('Users\UserController@index', ["created" => true, "users" => User::all()]);
	}

  public function delete($id){
    $user = User::find($id);
    $user->delete();
    return redirect()->action('Users\UserController@index', ["deleted" => true, "users" => User::all()]);
  }

  public function loginView(){
    return view('auth.login');
  }

  public function createView() {
    return view('archivos.personal.create', ["roles" => Role::all()]);
  }

}
