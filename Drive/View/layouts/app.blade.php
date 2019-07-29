<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.2/css/ui.jqgrid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />                
    {{HTML::style('css/app.css')}}
    {{HTML::style('css/admin.css')}}
    {{HTML::style('css/datedropper.css')}}
    {{HTML::style('css/timedropper.css')}}
    {{HTML::style('css/datepicker-custom.css')}}
    {{HTML::style('css/dashboard-style.css')}}
    @yield('css')
    
    
    
</head>
<body>


    @if (Auth::user()->flag_administrador == 'N')           

        <div class="container" style="width:300px;"> 
            <div class="alert alert-danger text-center">
              <strong>Acesso negado!</strong> 
            </div>  
        </div>

    @else     

        <div id="throbber" style="display:none; min-height:120px;"></div>
            <div id="noty-holder"></div>
            <div id="wrapper">
                <!-- Navigation -->
                <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                         <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <a href="/admin" class="navbar-brand"><img class="img-responsive logoimg" src=" {{ asset('images/logo-white.png') }} " alt="Drive"></a>
                        </a>
                    </div>
                    <!-- Top Menu Items -->
                    <ul class="nav navbar-right top-nav">        
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Entrar</a></li>                            
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Bem-vindo <b> {{ Auth::user()->name }} </b> <b class="fa fa-angle-down"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                       <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                             &nbsp; Sair
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                       
                    </ul>
                    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav side-nav">
                            <li>
                                <a href="/agendamentos"><i class="fa fa-fw fa-calendar-check-o"></i> Agendamentos</a>
                            </li>
                            <li>
                                <a href="/clientes"><i class="fa fa-fw fa-users"></i> Clientes</a>
                            </li>
                            <li>
                                <a href="/unidades"><i class="fa fa-fw fa fa-map-marker"></i> Unidades</a>
                            </li>
                            <li>
                                <a href="/usuarios"><i class="fa fa-fw fa fa-user"></i> Usuários</a>
                            </li>
                            <li>
                                <a href="/veiculos"><i class="fa fa-fw fa fa-car"></i> Veículos</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>

                <div id="page-wrapper">
                    <div class="container-fluid">
                        @yield('content')   
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->
            </div><!-- /#wrapper -->
        @endif        
       <!-- Scripts -->

        <script crossorigin="anonymous" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
        {{ HTML::script('vendor/fullcalendar/lib/jquery-ui.min.js') }}
        <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxggOYjAi6oCqVHnziRwcLrTtsaTN_OOI&libraries=places"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

         
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
        {{ HTML::script('js/datedropper.js') }}    
        {{ HTML::script('js/timedropper.js') }}  

        <script>
            $(function(){
                $('[data-toggle="tooltip"]').tooltip();
                $(".side-nav .collapse").on("hide.bs.collapse", function() {                   
                    $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
                });
                $('.side-nav .collapse').on("show.bs.collapse", function() {                        
                    $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");        
                });
            })    
            
        </script>


        @yield('scripts')
    </body>

</html>
