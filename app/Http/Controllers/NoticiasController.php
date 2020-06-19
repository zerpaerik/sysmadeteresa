<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Noticias;
use App\Models\Existencias\Producto;
use App\Informe;
use App\User;
use Auth;
use Toastr;
use Carbon\Carbon;



class NoticiasController extends Controller

{

	public function index(Request $request){



        $noticias = DB::table('noticias as a')
        ->select('a.id','a.titulo','a.subtitulo','a.cuerpo','a.usuario','a.created_at','u.name', 'u.lastname')
        ->join('users as u','u.id','a.usuario')
        ->where('a.estatus','=', 1)
        ->orderby('a.id','desc')
        ->get();


        return view('noticias.index', compact('noticias'));

    }
    
    public function crearGet(){
        return view('noticias.crear');
    }

    public function crearPost(Request $request){

       // dd($request->all());
     
          $noticias = new Noticias();
          $noticias->titulo = $request->titulo;
          $noticias->subtitulo =$request->subtitulo;
		  $noticias->cuerpo =$request->cuerpo;
          $noticias->usuario = \Auth::user()->id;
        /*  $path = $request->file('imagen')->getRealPath();
          $logo = file_get_contents($path);
          $base64 = base64_encode($logo);
          $noticias->imagen = $base64;*/
          $noticias->save();

          Toastr::success('Registrado Exitosamente.', 'Noticia!', ['progressBar' => true]);

          return redirect()->action('NoticiasController@index', ["created" => true, "noticias" => Noticias::all()]);
    


    }

  

    }


