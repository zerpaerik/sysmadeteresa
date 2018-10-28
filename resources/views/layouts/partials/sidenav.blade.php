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
      <a href="{{route('centros.index')}}"><i class="fa fa-hospital-o"></i> Centros medicos</a>
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
      <a href=""><i class="fa fa-dropbox"></i> Paquetes de servicios</a>
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
      <a href="{{route('productos.index')}}"><i class="fa fa-plus-square-o"></i> Productos</a>
    </li>
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Requerimientos</a>
        <ul class="dropdown-menu">
@if(Session::get('sedeName') <> 'PROCERES')


          <li>
            <a href="{{route('requerimientos.index')}}"><i class="fa fa-plus-square-o"></i> Enviados</a>
          </li>
@endif

@if(Session::get('sedeName') == 'PROCERES')

          <li>
            <a href="{{route('requerimientos.index2')}}"><i class="fa fa-plus-square-o"></i> Recibidos</a>
          </li>
@endif


        </ul>      
    </li>
@if(Session::get('sedeName') == 'PROCERES')

    <li>
      <a href="{{route('historico')}}"><i class="fa fa-list-alt"></i> Historico de transferencias</a>
    </li>
@endif

@if(Session::get('sedeName') == 'PROCERES')
  
    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-share"></i> Ingreso de productos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('productos.in')}}"><i class="fa fa-plus-square-o"></i> Ingresos</a>
          </li>
        </ul>      
    </li>
@endif


    <li>
      <a href="#" class="dropdown-toggle"><i class="fa fa-reply"></i> Salida de productos</a>
        <ul class="dropdown-menu">
          <li>
            <a href="{{route('productos.out')}}"><i class="fa fa-plus-square-o"></i> Ventas</a>
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
        <a href="{{route('atenciones.index')}}"><i class="fa fa-plus-circle"></i> Ingreso de atenciones</a>
      </li>
      <li>
        <a href="{{route('gastos.index')}}"><i class="fa fa-random"></i> Relación de gastos</a>
      </li>
      <li>
        <a href="{{route('labporpagar.index')}}"><i class="fa fa-dollar"></i> Laboratorios por pagar</a>
      </li>
      <li>
        <a href="{{route('ingresos.index')}}"><i class="fa fa-money"></i> Otros ingresos</a>
      </li>
      <li>
        <a href="{{route('cuentasporcobrar.index')}}"><i class="fa fa-list-alt"></i> Cuentas por cobrar</a>
      </li>
      <li>
        <a href="{{route('comporpagar.index')}}"><i class="fa fa-list-alt"></i> Comisiones por pagar</a>
      </li>
      <li>
        <a href="#"><i class="fa fa-list-alt"></i> Comisiones pagadas</a>
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
        <a href="{{route('consultas.create')}}"><i class="fa fa-plus-circle"></i> Nueva Consulta</a>
      </li>
      <li>
        <a href="{{route('consultas.index')}}"><i class="fa fa-plus-circle"></i> Mostrar Consultas</a>
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
        <a href="{{route('resultados.index')}}"><i class="fa fa-list-alt"></i> Redactar Resultados</a>
      </li>
      <li>
        <a href="{{route('resultadosguardados.index')}}"><i class="fa fa-search"></i> Consultar Resultados</a>
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
        <a href="#"><i class="fa fa-file-o"></i> Reportes de atención diaria</a>
      </li>
      <li>
        <a href="#"><i class="fa fa-file-o"></i> Reporte General</a>
      </li>
    </ul>
  </li>

  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-cog"></i>
      <span class="hidden-xs">Administración</span>
    </a>
    <ul class="dropdown-menu">
      @if(\Auth::user()->role_id == 1)
      <li>
        <a href="{{route('users.index')}}"><i class="fa fa-users"></i> Usuarios</a>
      </li>
      <li>
        <a href="{{route('role.index')}}"><i class="fa fa-user-md"></i> Roles</a>
      </li>     
      <li>
        <a href="{{route('sedes.index')}}"><i class="fa fa-hospital-o"></i> Sedes</a>
      </li>      
      @endif
    </ul>
  </li>
<!--
  <li class="dropdown">
    <a href="#" class="dropdown-toggle">
      <i class="fa fa-sign-out"></i>
      <span class="hidden-xs">Cerrar sesión</span>
    </a>
  </li>
-->