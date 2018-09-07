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

		if($validator->fails()) return view(/*view*/, ["errors" => $validator->errors()]);

		$role = Role::create([
			"name" => $request->name,
		]);

		return view(/*view*/, ["role" => $role]);
	}

    public function index(){
    	//
    }
}
