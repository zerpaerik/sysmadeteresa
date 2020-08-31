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
        ->select('a.id','a.tittle','a.description','a.link','a.date','a.link','a.category','a.url_img','a.usuario','a.created_at','u.name', 'u.lastname')
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


       /*

        $img = $request->file('informe');
                  $nombre_imagen=$img->getClientOriginalName();
                  $product->id_atencion=$request->id;
                  $product->id_servicio=$id_servicio;
                  $product->informe=$nombre_imagen;
                  $product->user_id=Auth::user()->id;
                  if ($product->save()) {
                   \Storage::disk('public')->put($nombre_imagen,  \File::get($img));

                 }
                 \DB::commit();

       */
     
          $noticias = new Noticias();
          $img = $request->file('imagen');
          $nombre_imagen=$img->getClientOriginalName();
          $noticias->tittle = $request->tittle;
          $noticias->link =$request->link;
          $noticias->description =$request->cuerpo;
          $noticias->origin =$request->origin;
          $noticias->category =$request->category;
          $noticias->date = date('Y-m-d');
          $noticias->usuario = \Auth::user()->id;
          $noticias->link_img=$nombre_imagen;
          if ($noticias->save()) {
            \Storage::disk('public')->put($nombre_imagen,  \File::get($img));

          }
          \DB::commit();

      
          Toastr::success('Registrado Exitosamente.', 'Noticia!', ['progressBar' => true]);

          return redirect()->action('NoticiasController@index', ["created" => true, "noticias" => Noticias::all()]);
    


    }

    public function delete($id){
      $noticias = Noticias::find($id);
      $noticias->estatus = 0;
      $noticias->save();
      return redirect()->action('NoticiasController@index', ["deleted" => true, "noticias" => Noticias::all()]);
    }

  

    }


