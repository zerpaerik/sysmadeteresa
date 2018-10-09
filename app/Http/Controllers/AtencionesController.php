<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Atenciones;
use App\Models\Servicios;
use App\Models\Analisis;


class AtencionesController extends Controller

{

	public function index(){


      	$atenciones = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.id_servicio','a.id_laboratorio','a.monto','a.porcentaje','a.abono','b.name as paciente','c.name as profesional','d.detalle as servicio')
        ->join('users as b','a.id_paciente','b.id')
        ->join('users as c','a.origen_usuario','c.id')
        ->join('servicios as d','a.id_servicio','d.id')
        ->join('analises as e','a.id_laboratorio','e.id')
        ->orderby('a.id','desc')
        ->paginate(5000);
        return view('generics.index', [
        "icon" => "fa-list-alt",
        "model" => "atenciones",
        "headers" => ["id", "Paciente", "Origen", "Servicio", "Laboratorio", "Total","porcentaje","Abonado Total", "Editar", "Eliminar"],
        "data" => $atenciones,
        "fields" => ["id", "paciente", "profesional", "servicio", "laboratorio", "monto", "porcentaje", "abono"],
          "actions" => [
            '<button type="button" class="btn btn-info">Transferir</button>',
            '<button type="button" class="btn btn-warning">Editar</button>'
          ]
      ]);  

	}

	public function createView() {

    $servicios = Servicios::all();
    $laboratorios = Analisis::all();

    return view('movimientos.atenciones.create', compact('servicios','laboratorios'));
  }

    //
}
