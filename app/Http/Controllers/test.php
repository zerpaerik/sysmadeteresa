public function create(Request $request)
  {
    if(is_null($request->origen_usuario) && ($request->origen <> 3)){
      Toastr::error('Debe Seleccionar un Origen', 'Ingreso de Atenciòn!', ['progressBar' => true]);

    return back();
  }



  
   if($request->origen == 3){
     
     if (is_null($request->id_servicio['servicios'][0]['servicio']) && is_null($request->id_laboratorio['laboratorios'][0]['laboratorio'])){
      return redirect()->route('atenciones.create');
    }

    if (isset($request->id_paquete)) {
      
      foreach ($request->id_paquete['paquetes'] as $key => $paquete) {
        if (!is_null($paquete['paquete'])) {
              $paquete = Paquetes::findOrFail($paquete['paquete']);
              $paq = new Atenciones();
              $paq->id_paciente = $request->id_paciente;
              $paq->origen = $request->origen;
              $paq->origen_usuario = 99999999;
              $paq->id_laboratorio =  1;
              $paq->id_servicio =  1;
              $paq->id_paquete = $paquete->id;
              $paq->comollego = $request->comollego;
              $paq->es_paquete =  true;
        $paq->serv_prog = FALSE;
              $paq->tipopago = $request->tipopago;
              $paq->porc_pagar = $paquete->porcentaje;
              $paq->pendiente = (float)$request->monto_p['paquetes'][$key]['monto'] - (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->monto = (float)$request->monto_p['paquetes'][$key]['monto'];
              $paq->abono = (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->porcentaje = ((float)$request->monto_p['paquetes'][$key]['monto']* $paquete->porcentaje)/100;
              $paq->id_sede =$request->session()->get('sede');
                 if($paquete->id == 1){
              $paq->estatus = 2;
              } else{
              $paq->estatus = 1;
              }
              $paq->usuario = Auth::user()->id;
              $paq->particular = $request->particular;
              $paq->ticket =AtencionesController::generarId($request);
              $paq->ti = $request->tipopago;
              $paq->save(); 

              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $paq->id;
              $creditos->monto= $request->monto_abop['paquetes'][$key]['abono'];
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();


        } else {

        }
      }
    
           
  ////////// guardar servicios y analisis que conforman el paquete
   if(! is_null($request->id_paquete)){
     foreach ($request->id_paquete as $key => $value) {

        $searchServPaq = DB::table('paquete_servicios')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('paquete_id','=', $value)
        ->get();
    
    

        foreach ($searchServPaq as $serv) {
            $id_servicio = $serv->servicio_id;
      
      $servdetalle =  DB::table('servicios')
      ->select('*')
      ->where('id','=',$id_servicio)
      ->first();
      
      $detalle = $servdetalle->detalle;
      $sesion = $servdetalle->sesion;

            if(! is_null($id_servicio)){
              $s = new Atenciones();
              $s->id_paciente = $request->id_paciente;
              $s->origen = $request->origen;
              $s->origen_usuario = 99999999;
              $s->id_laboratorio =  1;
              $s->id_servicio =  $id_servicio;
              $s->id_paquete = 1;
              $s->comollego = $request->comollego;
              $s->es_paquete =  0;
        $s->es_servicio =  1;
              $s->es_laboratorio =  0;
        $s->serv_prog = FALSE;
              $s->tipopago = $request->tipopago;
              $s->porc_pagar = 0;
              $s->pendiente = 0;
              $s->monto = 99999;
              $s->abono = 0;
              $s->porcentaje =0;
              $s->sesion =$sesion;
              $s->id_sede =$request->session()->get('sede');
              $s->estatus = 2;
              $s->particular = $request->particular;
              $s->usuario = Auth::user()->id;
              $s->ticket =AtencionesController::generarId($request);
              $s->paquete= $paq->id; 
              $s->save(); 
             
         }
        }

        $searchLabPaq = DB::table('paquete_laboratorios')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

         foreach ($searchLabPaq as $lab) {
            $id_laboratorio = $lab->laboratorio_id;


            if(!is_null($id_laboratorio)){
        $l = new Atenciones();
              $l->id_paciente = $request->id_paciente;
              $l->origen = $request->origen;
              $l->origen_usuario = 99999999;
              $l->id_laboratorio = $id_laboratorio;
              $l->id_servicio = 1;
              $l->id_paquete = 1;
              $l->comollego = $request->comollego;
              $l->es_paquete =  0;
        $l->es_servicio =  0;
              $l->es_laboratorio = 1;
        $l->serv_prog = FALSE;
              $l->tipopago = $request->tipopago;
              $l->porc_pagar = 0;
              $l->pendiente = 0;
              $l->monto = 99999;
              $l->abono = 0;
              $l->porcentaje =0;
              $l->id_sede =$request->session()->get('sede');
              $l->estatus = 2;
              $l->particular = $request->particular;
              $l->usuario = Auth::user()->id;
              $l->ticket =AtencionesController::generarId($request);
              $l->paquete= $paq->id; 
              $l->save(); 

         }
        }

         
        $paciente = DB::table('pacientes')
        ->select('*')
        ->where('id','=', $request->id_paciente)
        ->first();
          
         $searchConsPaq = DB::table('paquete_consultas')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

                if(count($searchConsPaq) > 0){


          foreach ($searchConsPaq as $cons) {
            $cantidad=$cons->cantidad;
             }



         $contador=0;
         
        while ($contador < $cantidad) {
        
        $evt = new Event;
        $evt->paciente=$request->id_paciente;
        $evt->profesional=36;
        $evt->date=date('Y-m-d');
        $evt->time=17;
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=0;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo='CONSULTAS';
        $evt->paquete= $paq->id; 
        $evt->save();

           $contador++;
         } 

       }


           $searchContPaq = DB::table('paquete_controles')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();


        $paciente = DB::table('pacientes')
        ->select('*')
        ->where('id','=', $request->id_paciente)
        ->first();

                if(count($searchContPaq) > 0){


          foreach ($searchContPaq as $cons) {
            $cantidad=$cons->cantidad;
             }



         $contador=0;
         
        while ($contador < $cantidad) {
        
        $evt = new Event;
        $evt->paciente=$request->id_paciente;
        $evt->profesional=36;
        $evt->date=date('Y-m-d');
        $evt->time=17;
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=0;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo='CONTROLES';
        $evt->paquete= $paq->id; 
        $evt->save();

           $contador++;
         }   

         } 
   


}
}
  
    

          
    }

    if (isset($request->id_servicio)) {
     
  
      foreach ($request->id_servicio['servicios'] as $key => $servicio) {
        if (!is_null($servicio['servicio'])) {

           $searchServicio = DB::table('servicios')
              ->select('*')
              ->where('id','=', $servicio['servicio'])
              ->first();  
        
     // $porcentaje = $searchServicio->porcentaje;
              $programa = $searchServicio->programa;
              $sesion= $searchServicio->sesion;

              if ($request->origen == 1 ){
                $porcentaje = $searchServicio->por_per;
              } else {
                $porcentaje = $searchServicio->porcentaje;
              }
             
              $serv = new Atenciones();
              $serv->id_paciente = $request->id_paciente;
              $serv->origen = $request->origen;
              $serv->origen_usuario = 99999999;
              $serv->id_laboratorio =  1;
              $serv->id_paquete =  1;
              $serv->id_servicio =  $servicio['servicio'];
              $serv->es_servicio =  true;
              $serv->serv_prog =  $programa;
              $serv->sesion =  $sesion;
              $serv->tipopago = $request->tipopago;
              $serv->porc_pagar = $porcentaje;
              $serv->comollego = $request->comollego;
              $serv->pendiente = (float)$request->monto_s['servicios'][$key]['monto'] - (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->monto = (float)$request->monto_s['servicios'][$key]['monto'];
              $serv->abono = (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->porcentaje = ((float)$request->monto_s['servicios'][$key]['monto']* $porcentaje)/100;
              $serv->id_sede = $request->session()->get('sede');
              if($servicio['servicio'] == 1){
              $serv->estatus = 2;
              } else{
              $serv->estatus = 1;
              }
              $serv->particular = $request->particular;
              $serv->usuario = Auth::user()->id;
              $serv->ticket =AtencionesController::generarId($request);
              $serv->save(); 

              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $serv->id;
              $creditos->monto= $request->monto_abos['servicios'][$key]['abono'];
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();
        } else {

        }
      }
    }

    if (isset($request->id_laboratorio)) {

       $searchAnalisis = DB::table('analises')
                    ->select('*')
                   // ->where('estatus','=','1')
                    ->where('id','=', $request->id_laboratorio)
                    ->first();   
                   
                   $porcentaje =  $searchAnalisis->porcentaje;

    if ($request->origen == 2 ){
        $porcentaje = $searchAnalisis->porcentaje;
    } elseif($request->origen == 1) {
        $porcentaje = 0;
    } else {
      $porcentaje=0;
    }           

      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {
          //dd($request->total_g);
          $lab = new Atenciones();
          $lab->id_paciente = $request->id_paciente;
          $lab->origen = $request->origen;
          $lab->origen_usuario = 99999999;
          $lab->id_servicio = 1;
          $lab->id_paquete =  1;
          $lab->id_laboratorio =  $laboratorio['laboratorio'];
          $lab->es_laboratorio =  true;
          $lab->tipopago = $request->tipopago;
          $lab->porc_pagar = $porcentaje;
          $lab->serv_prog = FALSE;
          $lab->comollego = $request->comollego;
          $lab->pendiente = (float)$request->monto_l['laboratorios'][$key]['monto'] - (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->monto = (float)$request->monto_l['laboratorios'][$key]['monto'];
          $lab->abono = (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->porcentaje = ((float)$request->monto_l['laboratorios'][$key]['monto']* $porcentaje)/100;
         // $lab->pendiente = $request->total_g;
          $lab->id_sede = $request->session()->get('sede');
          if($laboratorio['laboratorio'] == 1){
              $lab->estatus = 2;
              } else{
              $lab->estatus = 1;
              }
          $lab->particular = $request->particular;
       $lab->usuario = Auth::user()->id;
         $lab->ticket =AtencionesController::generarId($request);
          $lab->save();

          if($request->tipopago == 'MX'){


          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->mxef;
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = 'EF';
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();


          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->mxtj;
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = 'TJ';
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();

          }else{

          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->monto_abol['laboratorios'][$key]['abono'];
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = $request->tipopago;
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();

          }
        } else {

        }
      }
    }

     
  } else {    
    
    $searchUsuarioID = DB::table('users')
                    ->select('*')
                    ->where('id','=', $request->origen_usuario)
                    ->first();    
 

    if (is_null($request->id_servicio['servicios'][0]['servicio']) && is_null($request->id_laboratorio['laboratorios'][0]['laboratorio'])){
      return redirect()->route('atenciones.create');
    }

    if (isset($request->id_paquete)) {
      
      foreach ($request->id_paquete['paquetes'] as $key => $paquete) {
        if (!is_null($paquete['paquete'])) {
              $paquete = Paquetes::findOrFail($paquete['paquete']);
              $paq = new Atenciones();
              $paq->id_paciente = $request->id_paciente;
              $paq->origen = $request->origen;
              $paq->origen_usuario = $searchUsuarioID->id;
              $paq->id_laboratorio =  1;
              $paq->id_servicio =  1;
              $paq->id_paquete = $paquete->id;
              $paq->comollego = $request->comollego;
              $paq->es_paquete =  true;
            $paq->serv_prog = FALSE;
              $paq->tipopago = $request->tipopago;
              $paq->porc_pagar = $paquete->porcentaje;
              $paq->pendiente = (float)$request->monto_p['paquetes'][$key]['monto'] - (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->monto = (float)$request->monto_p['paquetes'][$key]['monto'];
              $paq->abono = (float)$request->monto_abop['paquetes'][$key]['abono'];
              $paq->porcentaje = ((float)$request->monto_p['paquetes'][$key]['monto']* $paquete->porcentaje)/100;
              $paq->id_sede =$request->session()->get('sede');
               if($paquete->id == 1){
              $paq->estatus = 2;
              } else{
              $paq->estatus = 1;
              }
              $paq->particular = $request->particular;
              $paq->usuario = Auth::user()->id;
              $paq->ticket =AtencionesController::generarId($request);
              $paq->save(); 

             
              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $paq->id;
              $creditos->monto= $request->monto_abop['paquetes'][$key]['abono'];
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();
           


        } else {

        }
      }
    //////
     if(! is_null($request->id_paquete)){
     foreach ($request->id_paquete as $key => $value) {

        $searchServPaq = DB::table('paquete_servicios')
        ->select('*')
                   // ->where('estatus','=','1')
        ->where('paquete_id','=', $value)
        ->get();
    
    

        foreach ($searchServPaq as $serv) {
            $id_servicio = $serv->servicio_id;
      
      $servdetalle =  DB::table('servicios')
      ->select('*')
      ->where('id','=',$id_servicio)
      ->first();
      
      $detalle = $servdetalle->detalle;
      $sesion= $servdetalle->sesion;

            if(! is_null($id_servicio)){
              $s = new Atenciones();
              $s->id_paciente = $request->id_paciente;
              $s->origen = $request->origen;
              $s->origen_usuario = $searchUsuarioID->id;
              $s->id_laboratorio =  1;
              $s->id_servicio =  $id_servicio;
              $s->id_paquete = 1;
              $s->comollego = $request->comollego;
              $s->es_paquete =  FALSE;
              $s->es_servicio =  1;
              $s->es_laboratorio =  FALSE;
              $s->serv_prog = FALSE;
              $s->tipopago = $request->tipopago;
              $s->porc_pagar = 0;
              $s->pendiente = 0;
              $s->monto = 99999;
              $s->sesion = $sesion;
              $s->abono = 0;
              $s->porcentaje =0;
              $s->id_sede =$request->session()->get('sede');
              $s->estatus = 2;
              $s->particular = $request->particular;
              $s->usuario = Auth::user()->id;
              $s->ticket =AtencionesController::generarId($request);
             $s->paquete= $paq->id; 
              $s->save(); 
             
         }
        }

        $searchLabPaq = DB::table('paquete_laboratorios')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

         foreach ($searchLabPaq as $lab) {
            $id_laboratorio = $lab->laboratorio_id;


            if(! is_null($id_laboratorio)){
        $l = new Atenciones();
              $l->id_paciente = $request->id_paciente;
              $l->origen = $request->origen;
              $l->origen_usuario = $searchUsuarioID->id;
              $l->id_laboratorio = $id_laboratorio;
              $l->id_servicio = 1;
              $l->id_paquete = 1;
              $l->comollego = $request->comollego;
              $l->es_paquete =  FALSE;
        $l->es_servicio =  FALSE;
              $l->es_laboratorio = 1;
        $l->serv_prog = FALSE;
              $l->tipopago = $request->tipopago;
              $l->porc_pagar = 0;
              $l->pendiente = 0;
              $l->monto = 99999;
              $l->abono = 0;
              $l->porcentaje =0;
              $l->id_sede =$request->session()->get('sede');
              $l->particular = $request->particular;
              $l->estatus = 2;
              $l->usuario = Auth::user()->id;
              $l->ticket =AtencionesController::generarId($request);
              $l->paquete= $paq->id; 
              $l->save(); 

         }
        }

        $paciente = DB::table('pacientes')
        ->select('*')
        ->where('id','=', $request->id_paciente)
        ->first();

        $searchConsPaq = DB::table('paquete_consultas')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();

        
        if(count($searchConsPaq) > 0){
    
          foreach ($searchConsPaq as $cons) {
            $cantidad=$cons->cantidad;
             }



         $contador=0;
         
        while ($contador < $cantidad) {
        
        $evt = new Event;
        $evt->paciente=$request->id_paciente;
        $evt->profesional=36;
        $evt->date=date('Y-m-d');
        $evt->time=17;
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=0;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo='CONSULTAS';
                $evt->paquete= $paq->id; 
        $evt->save();

           $contador++;
         } 

          } 

$paciente = DB::table('pacientes')
        ->select('*')
        ->where('id','=', $request->id_paciente)
        ->first();

           $searchContPaq = DB::table('paquete_controles')
        ->select('*')
        ->where('paquete_id','=', $value)
        ->get();


        

        if(count($searchContPaq) > 0){


          foreach ($searchContPaq as $cons) {
            $cantidad=$cons->cantidad;
             }



         $contador=0;
         
        while ($contador < $cantidad) {
        
        $evt = new Event;
        $evt->paciente=$request->id_paciente;
        $evt->profesional=36;
        $evt->date=date('Y-m-d');
        $evt->time=17;
        $evt->title=$paciente->nombres . " " . $paciente->apellidos . " Paciente.";
        $evt->monto=0;
        $evt->sede=$request->session()->get('sede');
        $evt->tipo='CONTROLES';
                $evt->paquete= $paq->id; 
        $evt->save();

           $contador++;
         }   

          }   
   



        

}
}
    //////
    }

    if (isset($request->id_servicio)) {
     
      foreach ($request->id_servicio['servicios'] as $key => $servicio) {
        if (!is_null($servicio['servicio'])) {

           $searchServicio = DB::table('servicios')
              ->select('*')
              ->where('id','=',$servicio['servicio'])
              ->first(); 


              $programa = $searchServicio->programa;
              $sesion = $searchServicio->sesion; 


              if ($request->origen == 1 ){
                $porcentaje = $searchServicio->por_per;
              } else {
                $porcentaje = $searchServicio->porcentaje;
              }

              

              $serv = new Atenciones();
              $serv->id_paciente = $request->id_paciente;
              $serv->origen = $request->origen;
              $serv->origen_usuario = $searchUsuarioID->id;
              $serv->id_laboratorio =  1;
              $serv->id_paquete =  1;
              $serv->id_servicio =  $servicio['servicio'];
              $serv->es_servicio =  true;
              $serv->serv_prog =  $programa;
              $serv->sesion =  $sesion;
              $serv->tipopago = $request->tipopago;
              $serv->porc_pagar = $porcentaje;
              $serv->comollego = $request->comollego;
              $serv->pendiente = (float)$request->monto_s['servicios'][$key]['monto'] - (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->monto = (float)$request->monto_s['servicios'][$key]['monto'];
              $serv->abono = (float)$request->monto_abos['servicios'][$key]['abono'];
              $serv->porcentaje = ((float)$request->monto_s['servicios'][$key]['monto']* $porcentaje)/100;
              $serv->id_sede = $request->session()->get('sede');
               if($servicio['servicio'] == 1){
              $serv->estatus = 2;
              } else{
              $serv->estatus = 1;
              }
              $serv->particular = $request->particular;
              $serv->ticket =AtencionesController::generarId($request);
              $serv->usuario = Auth::user()->id;
              $serv->save(); 

             

              if($request->tipopago=='MX'){
              $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $serv->id;
              $creditos->monto= 999999;
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = 'MX';
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();
            }else{
               $creditos = new Creditos();
              $creditos->origen = 'ATENCIONES';
              $creditos->id_atencion = $serv->id;
              $creditos->monto= $request->monto_abos['servicios'][$key]['abono'];
              $creditos->id_sede = $request->session()->get('sede');
              $creditos->tipo_ingreso = $request->tipopago;
              $creditos->descripcion = 'INGRESO DE ATENCIONES';
              $creditos->save();

            }
         

        } else {

        }
      }
    }

    if (isset($request->id_laboratorio)) {

      foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
        if (!is_null($laboratorio['laboratorio'])) {

          $searchAnalisis = DB::table('analises')
          ->select('*')
                   // ->where('estatus','=','1')
          ->where('id','=', $laboratorio['laboratorio'])
          ->first();   

          if ($request->origen == 2 ){
            $porcentaje = $searchAnalisis->porcentaje;
          } else {
            $porcentaje=0;
          }   

         
          $lab = new Atenciones();
          $lab->id_paciente = $request->id_paciente;
          $lab->origen = $request->origen;
          $lab->origen_usuario = $searchUsuarioID->id;
          $lab->id_servicio = 1;
          $lab->id_paquete =  1;
          $lab->id_laboratorio =  $laboratorio['laboratorio'];
          $lab->es_laboratorio =  true;
          $lab->tipopago = $request->tipopago;
          $lab->porc_pagar = $porcentaje;
          $lab->serv_prog = FALSE;
          $lab->comollego = $request->comollego;
          $lab->pendiente = (float)$request->monto_l['laboratorios'][$key]['monto'] - (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->monto = (float)$request->monto_l['laboratorios'][$key]['monto'];
          $lab->abono = (float)$request->monto_abol['laboratorios'][$key]['abono'];
          $lab->porcentaje = ((float)$request->monto_l['laboratorios'][$key]['monto']* $porcentaje)/100;
          $lab->id_sede = $request->session()->get('sede');
          if($laboratorio['laboratorio'] == 1){
            $lab->estatus = 2;
          } else{
            $lab->estatus = 1;
          }
          $lab->particular = $request->particular;
          $lab->usuario = Auth::user()->id;
          $lab->ticket =AtencionesController::generarId($request);
          $lab->save();

          if($request->tipopago == 'MX'){

          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->mxef;
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = 'EF';
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();


          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->mxtj;
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = 'TJ';
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();

          }else{

          $creditos = new Creditos();
          $creditos->origen = 'ATENCIONES';
          $creditos->id_atencion = $lab->id;
          $creditos->monto= $request->monto_abol['laboratorios'][$key]['abono'];
          $creditos->id_sede = $request->session()->get('sede');
          $creditos->tipo_ingreso = $request->tipopago;
          $creditos->descripcion = 'INGRESO DE ATENCIONES';
          $creditos->save();

          }

        } else {

        }
      }
    }
  }
  
  
       Toastr::success('Registrado Exitosamente.', 'Ingreso de Atenciòn!', ['progressBar' => true]);


    return redirect()->route('atenciones.index');
     
  }