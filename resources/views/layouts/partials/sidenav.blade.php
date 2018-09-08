<li class="dropdown">
  <a href="#" class="dropdown-toggle">
    <i class="fa fa-folder-open"></i>
    <span class="hidden-xs">Archivos</span>
  </a>
  <ul class="dropdown-menu">
    @if(\Auth::user()->role_id == 1)
    <li>
      <a href="{{route('personal.index')}}"><i class="fa fa-users"></i> Personal</a>
    </li>
    <li>
      <a href="{{route('role.index')}}"><i class="fa fa-user-md"></i> Roles</a>
    </li>
    @endif
    <li>
      <a href="#"><i class="fa fa-hospital-o"></i> Centros medicos</a>
    </li>
    <li>
      <a href="#"><i class="fa fa-plus-square"></i> Prof. de apoyo</a>
    </li>
    <li>
      <a href="#"><i class="fa fa-circle-o"></i> Laboratorios</a>
    </li>
    <li>
      <a href="#"><i class="fa fa-renren"></i> Analisis de laboratorios</a>
    </li>
    <li>
      <a href="#"><i class="fa fa-dropbox"></i> Servicios</a>
    </li>
    <li>
      <a href="#"><i class="fa fa-dropbox"></i>Paquetes de servicios</a>
    </li>
  </ul>
</li>