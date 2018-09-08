<?php

namespace App\Http\Controllers\Personal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Personal;

class PersonalController extends Controller
{

	public function index(){
		$personal = Personal::all();
		return view('archivos.personal.index', ["personal" => $personal]);
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

  public function delete($id){
    $personal = Personal::find($id);
    $personal->delete();
    return redirect()->action('Personal\PersonalController@index', ["deleted" => true, "users" => Personal::all()]);
  }

  public function createView() {
    return view('archivos.personal.create');
  }

}
