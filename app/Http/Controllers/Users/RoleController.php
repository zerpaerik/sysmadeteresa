<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleController extends Controller
{

	public function create(Request $request){
		
		$validator = \Validator::make($request->all(), [
			"name" => "required|unique:roles"
		]);

		if($validator->fails()) return view('archivos.role.create', ["errors" => $validator->errors()]);

		$role = Role::create([
			"name" => $request->name,
		]);

		return redirect()->action('Users\RoleController@index', ["created" => true, "roles" => Role::all()]);
	}

    public function index(){
      return view('archivos.role.index', ["roles" => Role::all()]);
    }

	public function createView() {
	  return view('archivos.role.create', ["roles" => Role::all()]);
	}
}
