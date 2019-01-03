<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>sysMadreTeresa</title>
    <meta name="description" content="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="DevOOPS">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="description">
		<meta name="author" content="DevOOPS">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="{{url('/tema/plugins/bootstrap/bootstrap.css')}}" rel="stylesheet">
		<link href="{{url('/tema/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="{{url('/tema/plugins/fancybox/jquery.fancybox.css')}}" rel="stylesheet">
		<link href="{{url('/tema/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
		<link href="{{url('/tema/plugins/xcharts/xcharts.min.css')}}" rel="stylesheet">
		<link href="{{url('/tema/plugins/select2/select2.css')}}" rel="stylesheet">
		<link href="{{url('/tema/plugins/justified-gallery/justifiedGallery.css')}}" rel="stylesheet">
		<link href="{{url('/tema/css/style_v2.css')}}" rel="stylesheet">
		<link href="{{url('/tema/plugins/chartist/chartist.min.css')}}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
        <script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
<body>
<!--Start Header-->
<div id="screensaver">
  <canvas id="canvas"></canvas>
  <i class="fa fa-lock" id="screen_unlock"></i>
</div>
<div id="modalbox">
  <div class="devoops-modal">
    <div class="devoops-modal-header">
      <div class="modal-header-name">
        <span>Basic table</span>
      </div>
      <div class="box-icons">
        <a class="close-link">
          <i class="fa fa-times"></i>
        </a>
      </div>
    </div>
    <div class="devoops-modal-inner">
    </div>
    <div class="devoops-modal-bottom">
    </div>
  </div>
</div>
<header class="navbar">
  <div class="container-fluid expanded-panel">
    <div class="row">
      <div id="logo" class="col-xs-12 col-sm-2">
        <a href="index.html">Madre Teresa</a>
      </div>
      <div id="top-panel" class="col-xs-12 col-sm-10">
        <div class="row">
          <div class="col-xs-8 col-sm-4">
            <a href="#" class="show-sidebar">
              <i class="fa fa-bars"></i>
            </a>
            &nbsp;
            Sede: {{Session::get('sedeName')}}
          </div>
          <div class="col-xs-4 col-sm-8 top-panel-right">
            <ul class="nav navbar-nav pull-right panel-menu">
              <li class="hidden-xs">
                <a href="#" class="modal-link">
                  <i class="fa fa-bell"></i>
                  <span class="badge">7</span>
                </a>
              </li>
              <li class="hidden-xs">
                <a class="ajax-link" href="#">
                  <i class="fa fa-calendar"></i>
                  <span class="badge">7</span>
                </a>
              </li>
              <li class="hidden-xs">
                <a href="#" class="ajax-link">
                  <i class="fa fa-envelope"></i>
                  <span class="badge">7</span>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle account" data-toggle="dropdown">
                  <div class="avatar">
                    <img src="{{url('img/avatar.jpg')}}" class="img-rounded" alt="avatar" />
                  </div>
                  @auth
                  <i class="fa fa-angle-down pull-right"></i>
                  <div class="user-mini pull-right">
                    <span class="welcome">Bienvenido,</span>
                    <span>{{Auth::user()->name}}</span>
                  </div>
                  @endauth
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="col col-sm-5">
                      <a href="{{route('logout')}}">
                        <i class="fa fa-power-off"></i>
                        <form method="POST" action="logout">
                            {{csrf_field()}}
                          <input type="submit" class="btn btn-danger" value="Logout">
                        </form>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!--End Header-->
<!--Start Container-->
<div id="main" class="container-fluid">
  <div class="row">
    <div id="sidebar-left" class="col-xs-2 col-sm-2">
      <ul class="nav main-menu">
        @include('layouts.partials.sidenav')
      </ul>
    </div>
    <!--Start Content-->
    <div id="content" class="col-xs-12 col-sm-10">
      <div class="preloader">
        <img src="{{url('img/devoops_getdata.gif')}}" class="devoops-getdata" alt="preloader"/>
      </div>
      <div id="app">
        @yield('content')
      </div>      
    </div>
    <!--End Content-->
  </div>
</div>
<!--End Container-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<script src="{{url('/tema/plugins/jquery/jquery-2.1.0.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/lang/es.js"></script>
<script src="{{url('/tema/plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{url('/tema/plugins/justified-gallery/jquery.justifiedgallery.min.js')}}"></script>
<script src="{{url('/tema/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{url('/tema/plugins/tinymce/jquery.tinymce.min.js')}}"></script>
<script src="{{url('/tema/ckeditor/ckeditor.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{url('/tema/plugins/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{url('/tema/plugins/justified-gallery/jquery.justifiedGallery.min.js')}}"></script>
<script src="{{url('/tema/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{url('/tema/plugins/tinymce/jquery.tinymce.min.js')}}"></script>
<!-- All functions for this theme + document.ready processing -->
<script src="{{url('/tema/js/devoops.js')}}"></script>
{!! Toastr::render() !!}

<!-- All functions for this theme + document.ready processing -->
@yield('scripts')
<script src="{{url('/js/devoops.js')}}"></script>
</body>
</html>
