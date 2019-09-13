@if(\Auth::user()->role_id == 4)
<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Archivos</span>
  </a>
  <ul class="dropdown-menu">
    <li>
      <a href="{{route('personal.index')}}"><i class="fa fa-users"></i> Personal</a>
    </li>
    <li>
      <a href="{{route('centros.index')}}"><i class="fa fa-hospital-o"></i> Centros Medicos</a>
    </li>
    <li>
      <a href="{{route('profesionales.index')}}"><i class="fa fa-plus-square"></i> Prof. de apoyo</a>
    </li>
    <li>
      <a href="{{route('laboratorios.index')}}"><i class="fa fa-circle-o"></i> Laboratorios</a>
    </li>
    <li>
      <a href="{{route('analisis.index')}}"><i class="fa fa-renren"></i> Analisis de laboratorios</a>
    </li>
    <li>
      <a href="{{route('servicios.index')}}"><i class="fa fa-dropbox"></i> Servicios</a>
    </li>
    <li>
      <a href="{{route('paquetes.index')}}"><i class="fa fa-dropbox"></i> Paquetes</a>
    </li>
    <li>
      <a href="{{route('pacientes.index')}}"><i class="fa fa-wheelchair"></i> Pacientes</a>
    </li>    
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Existencias</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Productos</a>
        <ul class="dropdown-menu">
@if(Session::get('sedeName') == 'PROCERES')

          <li>
            <a href="{{route('productos.index')}}"><i class="fa fa-list-alt"></i> Almacen Central</a>
          </li>

          <li>
            <a href="{{route('rayos.index')}}"><i class="fa fa-list-alt"></i> Almacen Rayos</a>
          </li>

          <li>
            <a href="{{route('obstetra.index')}}"><i class="fa fa-list-alt"></i> Almacen Obstetra</a>
          </li>

          <li>
            <a href="{{route('lab.index')}}"><i class="fa fa-list-alt"></i> Almacen Laboratorio</a>
          </li>

          <li>
            <a href="{{route('recepcion.index')}}"><i class="fa fa-list-alt"></i> Almacen Recepcion</a>
          </li>
          
@endif

@if(Session::get('sedeName') <> 'PROCERES')



          <li>
            <a href="{{route('productos.index2')}}"><i class="fa fa-list-alt"></i> Almacen Local</a>
          </li>
@endif


        </ul>      
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Requerimientos</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('requerimientos.index')}}"><i class="fa fa-plus-square-o"></i> Enviados</a>
          </li>

@if(Session::get('sedeName') == 'PROCERES')

          <li>
            <a href="{{route('requerimientos.index2')}}"><i class="fa fa-plus-square-o"></i> Recibidos</a>
          </li>

          <li>
            <a href="{{route('requerimientos.index3')}}"><i class="fa fa-plus-square-o"></i> Procesados</a>
          </li>
@endif


        </ul>      
    </li>


@if(Session::get('sedeName') == 'PROCERES')
  
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-share"></i> Ingreso de Productos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('productos.in')}}"><i class="fa fa-plus-square-o"></i> Ingresos</a>
          </li>
        </ul>      
    </li>
@endif


    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Salida de Productos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('ventas.index')}}"><i class="fa fa-plus-square-o"></i> Ventas</a>
          </li>
@if(Session::get('sedeName') == 'PROCERES')

          <li>
            <!--{{route('productos.trans')}}-->
            <a href="{{route('productos.trans')}}"><i class="fa fa-refresh"></i> Movimientos</a>
            <a href="{{route('productos.out')}}"><i class="fa fa-refresh"></i> Salidas</a>

          </li>
@endif


        </ul>      
    </li>

  </ul>
</li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Movimientos</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('atenciones.index')}}"><i class="fa fa-plus-circle"></i> Ingreso de Atenciones</a>
      </li>
      <li>
        <a href="{{route('gastos.index')}}"><i class="fa fa-random"></i> Relación de Gastos</a>
      </li>
      <li>
        <a href="{{route('labporpagar.index')}}"><i class="fa fa-dollar"></i> Laboratorios por Pagar</a>
      </li>
       <li>
        <a href="{{route('labpagados.index')}}"><i class="fa fa-dollar"></i> Laboratorios Pagados</a>
      </li>
      <li>
        <a href="{{route('ingresos.index')}}"><i class="fa fa-money"></i> Otros Ingresos</a>
      </li>
      <li>
        <a href="{{route('cuentasporcobrar.index')}}"><i class="fa fa-list-alt"></i> Cuentas por Cobrar</a>
      </li>

      <li>
        <a href="{{route('historialcobros.index')}}"><i class="fa fa-list-alt"></i> Historial de Cobros</a>
      </li>

    </ul>
  </li>

   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Comisiones por Pagar</span>
    </a>
    <ul class="dropdown-menu">
      
      <li>
        <a href="{{route('comporpagar.index')}}"><i class="fa fa-list-alt"></i> Comis. Prof.</a>
      </li>
      <li>
        <a href="{{route('comporpagar.index2')}}"><i class="fa fa-list-alt"></i> Comis. Pers.</a>
      </li>
      <li>
        <a href="{{route('comporpagartec.index')}}"><i class="fa fa-list-alt"></i> Comis. Tecnólogos</a>
      </li>
     
    </ul>
  </li>

   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Comisiones Pagadas</span>
    </a>
    <ul class="dropdown-menu">
      
      <li>
        <a href="{{route('compagadas.index')}}"><i class="fa fa-list-alt"></i> Comisiones Pers.</a>
      </li>

       <li>
        <a href="{{route('compagadas.index1')}}"><i class="fa fa-list-alt"></i> Comisiones Prof.</a>
      </li>
      <li>
        <a href="{{route('compagadas.index2')}}"><i class="fa fa-list-alt"></i> Comisiones Tecn.</a>
      </li>

    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Consultas</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('consultas.inicio')}}"><i class="fa fa-plus-circle"></i> Lista de Consultas</a>
      </li>        
	   <li>
        <a href="{{route('historias.index')}}"><i class="fa fa-plus-circle"></i> Ver Historias</a>
      </li>  
      <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-plus-circle"></i> Ver Controles</a>
      </li> 
       
       <li>
        <a href="{{route('proximacita.index')}}"><i class="fa fa-plus-circle"></i> Pròximas Citas</a>
      </li>              
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Programaciones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('service.create')}}"><i class="fa fa-plus-circle"></i> Programar Servicio</a>
      </li> 
      <li>
        <a href="{{route('service.inicio')}}"><i class="fa fa-plus-circle"></i> Listado de Servicio</a>
      </li>       
      <li>
        <a href="{{route('service.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Programaciòn</a>
      </li>                  
    </ul>
  </li>

    <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs"> Control de Sesiones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('sesiones.index')}}"><i class="fa fa-list-alt"></i> Atender Sesiones</a>
      </li>
      <li>
        <a href="{{route('sesionesa.index')}}"><i class="fa fa-list-alt"></i> Consultar Sesiones</a>
      </li>
      
    </ul>
  </li>

   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-bell"></i>
      <span class="hidden-xs">Métodos Anticonceptivos</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('metodos.index')}}"><i class="fa fa-plus-circle"></i> Listar Métodos</a>
      </li>  

      <li>
        <a href="{{route('metodos.index1')}}"><i class="fa fa-plus-circle"></i> Pacientes por Llamar</a>
      </li>           
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Resultados</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('resultados.index')}}"><i class="fa fa-list-alt"></i> Redactar Resultados Serv.</a>
      </li>
      <li>
        <a href="{{route('resultados.index1')}}"><i class="fa fa-list-alt"></i> Redactar Resultados Lab.</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados.index')}}"><i class="fa fa-search"></i> Consultar Resultados Serv.</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados1.index1')}}"><i class="fa fa-search"></i> Consultar Resultados Lab.</a>
      </li>
    </ul>
  </li>


    <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-truck"></i>
      <span class="hidden-xs">Visitadores</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('visitasp.inicio')}}"><i class="fa fa-truck"></i> Programar Visitas</a>
      </li>

      <li>
        <a href="{{route('visitasp.index')}}"><i class="fa fa-truck"></i> Mostrar Visitas Programadas</a>
      </li>
      <li>
        <a href="{{route('visitas.index')}}"><i class="fa fa-truck"></i> Registro de Visitas</a>
      </li>
      <li>
        <a href="{{route('comporentregar.index')}}"><i class="fa fa-square-o"></i> Comisiones Por Entregar</a>
      </li>
       <li>
        <a href="{{route('comentregadas.index')}}"><i class="fa fa-check-square-o"></i> Comisiones Entregadas</a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Reportes</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('produccion.index')}}"><i class="fa fa-file-o"></i> Producciòn del Dia</a>
      </li>
      <li>
        <a href="{{route('cierre.index')}}"><i class="fa fa-file-o"></i> Cierre de Caja</a>
      </li>
       <li>
        <a href="{{route('historial.pacientes')}}"><i class="fa fa-file-o"></i> Historial Pacientes</a>
      </li>        
      <li>
        <a href="reporte-solicitar_diario"><i class="fa fa-file-o"></i> Atenciòn Diaria Consolidado</a>
      </li>
       <li>
        <a href="reporte-solicitar_consolidado"><i class="fa fa-file-o"></i> Atenciòn Diaria Detallado</a>
      </li>
  
      <li>
        <a href="{{route('generals.index')}}"><i class="fa fa-file-o"></i> General Atenciones Servicios</a>
      </li>
      <li>
        <a href="{{route('generall.index')}}"><i class="fa fa-file-o"></i> General Atenciones Labs</a>
      </li>
      <li>
        <a href="{{route('generalp.index')}}"><i class="fa fa-file-o"></i> General Atenciones Paquetes</a>
      </li>
       <li>
        <a href="{{route('generalegresos.indexe')}}"><i class="fa fa-file-o"></i> General Egresos</a>
      </li>
       <li>
        <a href="{{route('comollego.index')}}"><i class="fa fa-file-o"></i> Còmo llego el Paciente?</a>
      </li>
	      <li>
        <a href="{{route('movimientosp.index')}}"><i class="fa fa-file-o"></i> Movimientos de Productos</a>
      </li>
       <li>
        <a href="{{route('malogrados.ver')}}"><i class="fa fa-file-o"></i> Materiales Malogrados</a>
      </li>
       <li>
        <a href="{{route('materialesusados.ver')}}"><i class="fa fa-file-o"></i> Materiales Usados</a>
      </li>
      <li>
        <a href="{{route('materialesconsultas.ver')}}"><i class="fa fa-file-o"></i> Materiales Consultas</a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-cog"></i>
      <span class="hidden-xs">Administración</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('users.password')}}"><i class="fa fa-users"></i> Modificar Contraseña</a>
      </li> 
      <li>
        <a href="{{route('correlativo.index')}}"><i class="fa fa-hospital-o"></i> Nùmeros de Ticket</a>
      </li> 
      <li>
        <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Usuarios</a>
      </li>
      <li>
        <a href="{{route('role.index')}}"><i class="fa fa-user-md"></i> Roles</a>
      </li>     
      <li>
        <a href="{{route('sedes.index')}}"><i class="fa fa-hospital-o"></i> Sedes</a>
      </li>  
      <li>
        <a href="{{route('proveedores.index')}}"><i class="fa fa-hospital-o"></i> Proveedores</a>
      </li>	  
    </ul>
  </li>
 @elseif(\Auth::user()->role_id == 5)
 <li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Archivos</span>
  </a>
  <ul class="dropdown-menu">
    <li>
      <a href="{{route('personal.index')}}"><i class="fa fa-users"></i> Personal</a>
    </li>
    <li>
      <a href="{{route('centros.index')}}"><i class="fa fa-hospital-o"></i> Centros Medicos</a>
    </li>
    <li>
      <a href="{{route('profesionales.index')}}"><i class="fa fa-plus-square"></i> Prof. de apoyo</a>
    </li>
    <li>
      <a href="{{route('laboratorios.index')}}"><i class="fa fa-circle-o"></i> Laboratorios</a>
    </li>
    <li>
      <a href="{{route('analisis.index')}}"><i class="fa fa-renren"></i> Analisis de laboratorios</a>
    </li>
    <li>
      <a href="{{route('servicios.index')}}"><i class="fa fa-dropbox"></i> Servicios</a>
    </li>
    <li>
      <a href="{{route('paquetes.index')}}"><i class="fa fa-dropbox"></i> Paquetes</a>
    </li>
    <li>
      <a href="{{route('pacientes.index')}}"><i class="fa fa-wheelchair"></i> Pacientes</a>
    </li>    
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Existencias</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Productos</a>
        <ul class="dropdown-menu">
@if(Session::get('sedeName') == 'PROCERES')

          <li>
            <a href="{{route('productos.index')}}"><i class="fa fa-list-alt"></i> Almacen Central</a>
          </li>

          <li>
            <a href="{{route('rayos.index')}}"><i class="fa fa-list-alt"></i> Almacen Rayos</a>
          </li>

          <li>
            <a href="{{route('obstetra.index')}}"><i class="fa fa-list-alt"></i> Almacen Obstetra</a>
          </li>

          <li>
            <a href="{{route('lab.index')}}"><i class="fa fa-list-alt"></i> Almacen Laboratorio</a>
          </li>

          <li>
            <a href="{{route('recepcion.index')}}"><i class="fa fa-list-alt"></i> Almacen Recepcion</a>
          </li>
          
@endif

@if(Session::get('sedeName') <> 'PROCERES')



          <li>
            <a href="{{route('productos.index2')}}"><i class="fa fa-list-alt"></i> Almacen Local</a>
          </li>
@endif


        </ul>      
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Requerimientos</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('requerimientos.index')}}"><i class="fa fa-plus-square-o"></i> Enviados</a>
          </li>

@if(Session::get('sedeName') == 'PROCERES')

          <li>
            <a href="{{route('requerimientos.index2')}}"><i class="fa fa-plus-square-o"></i> Recibidos</a>
          </li>

          <li>
            <a href="{{route('requerimientos.index3')}}"><i class="fa fa-plus-square-o"></i> Procesados</a>
          </li>
@endif


        </ul>      
    </li>


@if(Session::get('sedeName') == 'PROCERES')
  
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-share"></i> Ingreso de Productos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('productos.in')}}"><i class="fa fa-plus-square-o"></i> Ingresos</a>
          </li>
        </ul>      
    </li>
@endif


    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Salida de Productos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('ventas.index')}}"><i class="fa fa-plus-square-o"></i> Ventas</a>
          </li>
@if(Session::get('sedeName') == 'PROCERES')

          <li>
            <!--{{route('productos.trans')}}-->
            <a href="{{route('productos.trans')}}"><i class="fa fa-refresh"></i> Movimientos</a>
          </li>
@endif


        </ul>      
    </li>

  </ul>
</li>


  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Movimientos</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('atenciones.index')}}"><i class="fa fa-plus-circle"></i> Ingreso de Atenciones</a>
      </li>
      <li>
        <a href="{{route('gastos.index')}}"><i class="fa fa-random"></i> Relación de Gastos</a>
      </li>
      <li>
        <a href="{{route('labporpagar.index')}}"><i class="fa fa-dollar"></i> Laboratorios por Pagar</a>
      </li>
       <li>
        <a href="{{route('labpagados.index')}}"><i class="fa fa-dollar"></i> Laboratorios Pagados</a>
      </li>
      <li>
        <a href="{{route('ingresos.index')}}"><i class="fa fa-money"></i> Otros Ingresos</a>
      </li>
      <li>
        <a href="{{route('cuentasporcobrar.index')}}"><i class="fa fa-list-alt"></i> Cuentas por Cobrar</a>
      </li>

      <li>
        <a href="{{route('historialcobros.index')}}"><i class="fa fa-list-alt"></i> Historial de Cobros</a>
      </li>
     

    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Comisiones por Pagar</span>
    </a>
    <ul class="dropdown-menu">
      
      <li>
        <a href="{{route('comporpagar.index')}}"><i class="fa fa-list-alt"></i> Comis. Prof.</a>
      </li>
      <li>
        <a href="{{route('comporpagar.index2')}}"><i class="fa fa-list-alt"></i> Comis. Pers.</a>
      </li>
      <li>
        <a href="{{route('comporpagartec.index')}}"><i class="fa fa-list-alt"></i> Comis. Tecnólogos</a>
      </li>
     
    </ul>
  </li>

   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Comisiones Pagadas</span>
    </a>
    <ul class="dropdown-menu">
      
      <li>
        <a href="{{route('compagadas.index')}}"><i class="fa fa-list-alt"></i> Comisiones Pers.</a>
      </li>

       <li>
        <a href="{{route('compagadas.index1')}}"><i class="fa fa-list-alt"></i> Comisiones Prof.</a>
      </li>
      <li>
        <a href="{{route('compagadas.index2')}}"><i class="fa fa-list-alt"></i> Comisiones Tecn.</a>
      </li>

    </ul>
  </li>

<li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Consultas</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('consultas.inicio')}}"><i class="fa fa-plus-circle"></i> Lista de Consultas</a>
      </li>        
     <li>
        <a href="{{route('historias.index')}}"><i class="fa fa-plus-circle"></i> Ver Historias</a>
      </li> 
       <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-plus-circle"></i> Ver Controles</a>
      </li>  
       
       <li>
        <a href="{{route('proximacita.index')}}"><i class="fa fa-plus-circle"></i> Pròximas Citas</a>
      </li>              
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Programaciones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('service.create')}}"><i class="fa fa-plus-circle"></i> Programar Servicio</a>
      </li> 
      <li>
        <a href="{{route('service.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Programaciòn</a>
      </li>                  
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs"> Control de Sesiones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('sesiones.index')}}"><i class="fa fa-list-alt"></i> Atender Sesiones</a>
      </li>
      <li>
        <a href="{{route('sesionesa.index')}}"><i class="fa fa-list-alt"></i> Consultar Sesiones</a>
      </li>
      
    </ul>
  </li>
   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-bell"></i>
      <span class="hidden-xs">Métodos Anticonceptivos</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('metodos.index')}}"><i class="fa fa-plus-circle"></i>Listar Métodos</a>
      </li>  

      <li>
        <a href="{{route('metodos.index1')}}"><i class="fa fa-plus-circle"></i> Pacientes por Llamar</a>
      </li>           
    </ul>
  </li>
 <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Resultados</span>
    </a>
    <ul class="dropdown-menu">
     <li>
        <a href="{{route('resultados.index')}}"><i class="fa fa-list-alt"></i> Redactar Resultados Serv.</a>
      </li>
      <li>
        <a href="{{route('resultados.index1')}}"><i class="fa fa-list-alt"></i> Redactar Resultados Lab.</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados.index')}}"><i class="fa fa-search"></i> Consultar Resultados Serv.</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados1.index1')}}"><i class="fa fa-search"></i> Consultar Resultados Lab.</a>
      </li>
    </ul>
  </li>
 

    <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-truck"></i>
      <span class="hidden-xs">Visitadores</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('visitasp.inicio')}}"><i class="fa fa-truck"></i> Programar Visitas</a>
      </li>

      <li>
        <a href="{{route('visitasp.index')}}"><i class="fa fa-truck"></i> Mostrar Visitas Programadas</a>
      </li>
      <li>
        <a href="{{route('visitas.index')}}"><i class="fa fa-truck"></i> Registro de Visitas</a>
      </li>
      <li>
        <a href="{{route('comporentregar.index')}}"><i class="fa fa-square-o"></i> Comisiones Por Entregar</a>
      </li>
       <li>
        <a href="{{route('comentregadas.index')}}"><i class="fa fa-check-square-o"></i> Comisiones Entregadas</a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Reportes</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="reporte-solicitar_diario"><i class="fa fa-file-o"></i> Atenciòn Diaria Consolidado</a>
      </li>
       <li>
        <a href="{{route('historial.pacientes')}}"><i class="fa fa-file-o"></i> Historial Pacientes</a>
      </li> 
       <li>
        <a href="reporte-solicitar_consolidado"><i class="fa fa-file-o"></i> Atenciòn Diaria Detallado</a>
      </li>
       <li>
        <a href="{{route('generals.index')}}"><i class="fa fa-file-o"></i> General Atenciones Servicios</a>
      </li>
      <li>
        <a href="{{route('generall.index')}}"><i class="fa fa-file-o"></i> General Atenciones Labs</a>
      </li>
      <li>
        <a href="{{route('generalp.index')}}"><i class="fa fa-file-o"></i> General Atenciones Paquetes</a>
      </li>
       <li>
        <a href="{{route('generalegresos.indexe')}}"><i class="fa fa-file-o"></i> General Egresos</a>
      </li>
       <li>
        <a href="{{route('comollego.index')}}"><i class="fa fa-file-o"></i> Còmo llego el Paciente?</a>
      </li>
	   <li>
        <a href="{{route('movimientosp.index')}}"><i class="fa fa-file-o"></i> Movimientos de Productos</a>
      </li>
      <li>
        <a href="{{route('malogrados.ver')}}"><i class="fa fa-file-o"></i> Materiales Malogrados</a>
      </li>
       <li>
        <a href="{{route('materialesusados.ver')}}"><i class="fa fa-file-o"></i> Materiales Usados</a>
      </li>
      <li>
        <a href="{{route('materialesconsultas.ver')}}"><i class="fa fa-file-o"></i> Materiales Consultas</a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-cog"></i>
      <span class="hidden-xs">Administración</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('users.password')}}"><i class="fa fa-users"></i> Modificar Contraseña</a>
      </li> 
        <li>
        <a href="{{route('cierre.index')}}"><i class="fa fa-file-o"></i> Cierre de Caja</a>
      </li>     
      <li>
        <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Usuarios</a>
      </li>
      <li>
        <a href="{{route('role.index')}}"><i class="fa fa-user-md"></i> Roles</a>
      </li>     
      <li>
        <a href="{{route('sedes.index')}}"><i class="fa fa-hospital-o"></i> Sedes</a>
      </li>  
      <li>
        <a href="{{route('proveedores.index')}}"><i class="fa fa-hospital-o"></i> Proveedores</a>
      </li>	  
    </ul>
  </li>


  
 @elseif(\Auth::user()->role_id == 6)
 
 <li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Archivos</span>
  </a>
  <ul class="dropdown-menu">
    <li>
      <a href="{{route('analisis.index')}}"><i class="fa fa-renren"></i> Analisis de laboratorios</a>
    </li>
    <li>
      <a href="{{route('servicios.index')}}"><i class="fa fa-dropbox"></i> Servicios</a>
    </li>
    <li>
      <a href="{{route('paquetes.index')}}"><i class="fa fa-dropbox"></i> Paquetes</a>
    </li>
    <li>
      <a href="{{route('pacientes.index')}}"><i class="fa fa-wheelchair"></i> Pacientes</a>
    </li>    
  </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Existencias</span>
  </a>
  <ul class="dropdown-menu">
   <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Productos</a>
        <ul class="dropdown-menu">
        @if(Session::get('sedeName') == 'PROCERES')
           <li>
            <a href="{{route('recepcion.index')}}"><i class="fa fa-list-alt"></i> Almacen Recepcion</a>
          </li>
        @else
          <li>
            <a href="{{route('productos.index2')}}"><i class="fa fa-list-alt"></i> Almacen Local</a>
          </li>
        @endif
        </ul>      
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Requerimientos</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('requerimientos.index')}}"><i class="fa fa-plus-square-o"></i> Enviados</a>
          </li>


        </ul>      
    </li>

    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Salida de Productos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('ventas.index')}}"><i class="fa fa-plus-square-o"></i> Ventas</a>
          </li>


        </ul>      
    </li>

  </ul>
</li>


 <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Movimientos</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('atenciones.index')}}"><i class="fa fa-plus-circle"></i> Ingreso de Atenciones</a>
      </li>
      <li>
        <a href="{{route('gastos.index')}}"><i class="fa fa-random"></i> Relación de Gastos</a>
      </li>
      <li>
        <a href="{{route('labporpagar.index')}}"><i class="fa fa-dollar"></i> Laboratorios por Pagar</a>
      </li>
       <li>
        <a href="{{route('labpagados.index')}}"><i class="fa fa-dollar"></i> Laboratorios Pagados</a>
      </li>
      <li>
        <a href="{{route('ingresos.index')}}"><i class="fa fa-money"></i> Otros Ingresos</a>
      </li>
      <li>
        <a href="{{route('cuentasporcobrar.index')}}"><i class="fa fa-list-alt"></i> Cuentas por Cobrar</a>
      </li>
      
      <li>
        <a href="{{route('historialcobros.index')}}"><i class="fa fa-list-alt"></i> Historial de Cobros</a>
      </li>
    </ul>
  </li>
  
<li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Consultas</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('consultas.inicio')}}"><i class="fa fa-plus-circle"></i> Lista de Consultas</a>
      </li>        
     <li>
        <a href="{{route('historias.index')}}"><i class="fa fa-plus-circle"></i> Ver Historias</a>
      </li>  
       <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-plus-circle"></i> Ver Controles</a>
      </li> 
     
       <li>
        <a href="{{route('proximacita.index')}}"><i class="fa fa-plus-circle"></i> Pròximas Citas</a>
      </li>              
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-bell"></i>
      <span class="hidden-xs">Métodos Anticonceptivos</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('metodos.index')}}"><i class="fa fa-plus-circle"></i>Listar Métodos</a>
      </li>  
      <li>
        <a href="{{route('metodos.index1')}}"><i class="fa fa-plus-circle"></i> Pacientes por Llamar</a>
      </li>           
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Programaciones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('service.create')}}"><i class="fa fa-plus-circle"></i> Programar Servicio</a>
      </li> 
      <li>
        <a href="{{route('service.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Programaciòn</a>
      </li>                  
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs"> Control de Sesiones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('sesiones.index')}}"><i class="fa fa-list-alt"></i> Atender Sesiones</a>
      </li>
      <li>
        <a href="{{route('sesionesa.index')}}"><i class="fa fa-list-alt"></i> Consultar Sesiones</a>
      </li>
      
    </ul>
  </li>

   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-bell"></i>
      <span class="hidden-xs">Métodos Anticonceptivos</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('metodos.index')}}"><i class="fa fa-plus-circle"></i>Listar Métodos</a>
      </li>    

       <li>
        <a href="{{route('metodos.index1')}}"><i class="fa fa-plus-circle"></i> Pacientes por Llamar</a>
      </li>        
    </ul>
  </li>
 <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Resultados</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('resultados.index')}}"><i class="fa fa-list-alt"></i> Redactar Resultados Serv.</a>
      </li>
      <li>
        <a href="{{route('resultados.index1')}}"><i class="fa fa-list-alt"></i> Redactar Resultados Lab.</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados.index')}}"><i class="fa fa-search"></i> Consultar Resultados Serv.</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados1.index1')}}"><i class="fa fa-search"></i> Consultar Resultados Lab.</a>
      </li>
    </ul>
  </li>
  
    <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Reportes</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('historial.pacientes')}}"><i class="fa fa-file-o"></i> Historial Pacientes</a>
      </li> 
      <li>
        <a href="{{route('cierre.index')}}"><i class="fa fa-file-o"></i> Cierre de Caja</a>
      </li>   
      <li>
        <a href="reporte-solicitar_diario"><i class="fa fa-file-o"></i> Atenciòn Diaria Consolidado</a>
      </li>
       <li>
        <a href="reporte-solicitar_consolidado"><i class="fa fa-file-o"></i> Atenciòn Diaria Detallado</a>
      </li>
    </ul>
  </li>

      <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-cog"></i>
      <span class="hidden-xs">Administración</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('users.password')}}"><i class="fa fa-users"></i> Modificar Contraseña</a>
      </li> 
      
    </ul>
  </li>

 @elseif(\Auth::user()->role_id == 7)

 <li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-refresh"></i>
    <span class="hidden-xs">Existencias</span>
  </a>
  <ul class="dropdown-menu">

    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Requerimientos</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('requerimientos.index')}}"><i class="fa fa-plus-square-o"></i> Enviados</a>
          </li>

        </ul>      
    </li>

  </ul>
  <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-tasks"></i> Productos</a>
        <ul class="dropdown-menu">

          <li>
            <a href="{{route('rayos.index')}}"><i class="fa fa-list-alt"></i> Almacen Rayos</a>
          </li>

          <li>
            <a href="{{route('obstetra.index')}}"><i class="fa fa-list-alt"></i> Almacen Obstetra</a>
          </li>
        </ul>      
    </li>

</li>
 
<li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Consultas</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('consultas.inicio')}}"><i class="fa fa-plus-circle"></i> Lista de Consultas</a>
      </li>        
     <li>
        <a href="{{route('historias.index')}}"><i class="fa fa-plus-circle"></i> Ver Historias</a>
      </li> 
       <li>
        <a href="{{route('prenatal.index')}}"><i class="fa fa-plus-circle"></i> Ver Controles</a>
      </li>  
      
       <li>
        <a href="{{route('proximacita.index')}}"><i class="fa fa-plus-circle"></i> Pròximas Citas</a>
      </li>              
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Programaciones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('service.create')}}"><i class="fa fa-plus-circle"></i> Programar Servicio</a>
      </li> 
      <li>
        <a href="{{route('service.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Programaciòn</a>
      </li>                  
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs"> Control de Sesiones</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('sesiones.index')}}"><i class="fa fa-list-alt"></i> Atender Sesiones</a>
      </li>
      <li>
        <a href="{{route('sesionesa.index')}}"><i class="fa fa-list-alt"></i> Consultar Sesiones</a>
      </li>
      
    </ul>
  </li>

   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-bell"></i>
      <span class="hidden-xs">Métodos Anticonceptivos</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('metodos.index')}}"><i class="fa fa-plus-circle"></i>Listar Métodos</a>
      </li>  
          <li>
        <a href="{{route('metodos.index1')}}"><i class="fa fa-plus-circle"></i> Pacientes por Llamar</a>
      </li>          
    </ul>
  </li>
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Resultados</span>
    </a>
    <ul class="dropdown-menu">
      <li>
        <a href="{{route('resultados.index')}}"><i class="fa fa-list-alt"></i> Redactar Resultados Serv.</a>
      </li>
      <li>
        <a href="{{route('resultados.index1')}}"><i class="fa fa-list-alt"></i> Redactar Resultados Lab.</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados.index')}}"><i class="fa fa-search"></i> Consultar Resultados Serv.</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados1.index1')}}"><i class="fa fa-search"></i> Consultar Resultados Lab.</a>
      </li>
    </ul>
  </li>


    <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-copy"></i>
      <span class="hidden-xs">Reportes</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('historial.pacientes')}}"><i class="fa fa-file-o"></i> Historial Pacientes</a>
      </li> 
    
    </ul>
  </li>

   <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-cog"></i>
      <span class="hidden-xs">Administración</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('historial.pacientes')}}"><i class="fa fa-file-o"></i> Historial Pacientes</a>
      </li> 
       <li>
        <a href="{{route('users.password')}}"><i class="fa fa-users"></i> Modificar Contraseña</a>
      </li> 
     
    </ul>
  </li>
 
 
 
@elseif(\Auth::user()->role_id == 8)

<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-inbox"></i>
    <span class="hidden-xs">Archivos</span>
  </a>
  <ul class="dropdown-menu">
     <li>
      <a href="{{route('centros.index')}}"><i class="fa fa-hospital-o"></i> Centros Medicos</a>
    </li>
    <li>
      <a href="{{route('profesionales.index')}}"><i class="fa fa-plus-square"></i> Prof. de apoyo</a>
    </li>

   
    
  </ul>
</li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-truck"></i>
      <span class="hidden-xs">Visitadores</span>
    </a>
    <ul class="dropdown-menu">
       <li>
        <a href="{{route('visitasp.inicio')}}"><i class="fa fa-truck"></i> Programar Visitas</a>
      </li>

      <li>
        <a href="{{route('visitasp.index')}}"><i class="fa fa-truck"></i> Mostrar Visitas Programadas</a>
      </li>
      <li>
        <a href="{{route('visitas.index')}}"><i class="fa fa-truck"></i> Registro de Visitas</a>
      </li>
      <li>
        <a href="{{route('comporentregar.index')}}"><i class="fa fa-square-o"></i> Comisiones Por Entregar</a>
      </li>
       <li>
        <a href="{{route('comentregadas.index')}}"><i class="fa fa-check-square-o"></i> Comisiones Entregadas</a>
      </li>
    </ul>
  </li>

    <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-unsorted"></i>
      <span class="hidden-xs">Comisiones Pagadas</span>
    </a>
    <ul class="dropdown-menu">
      
    
       <li>
        <a href="{{route('compagadas.index1')}}"><i class="fa fa-list-alt"></i> Comisiones Prof.</a>
      </li>
   

    </ul>
  </li>

@else

@endif
  
  

