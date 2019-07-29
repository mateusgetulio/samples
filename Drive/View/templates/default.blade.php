<!DOCTYPE HTML>
<html>
	<head>
		<title>{{ __('messages.defaultTitulo') }}</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="{{asset('css/map.css')}}">
		@yield('css')
		<script crossorigin="anonymous" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	    <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxggOYjAi6oCqVHnziRwcLrTtsaTN_OOI&libraries=places"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body id="top">
		
		<!-- Header -->
		<header id="header" class="skel-layers-fixed">
			<a href="/" class="navbar-brand"><img class="img-responsive logoimg" src="images/logo.png" alt="Drive"></a>		
			@yield('menu')			
		</header>

		
		@yield('content')

		<footer id="footer">
			<div class="container">
				<div class="row double">
					<div class="6u">						
						<img id="nav-logo-img" class="img-responsive logoimg" src="images/logo.png" alt="Drive">
						<p>{{ __('messages.defaultADrive') }}</p>
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
							<li><a href="#" class="icon fa-linkedin"><span class="label">LinkedIn</span></a></li>
							<li><a href="#" class="icon fa-pinterest"><span class="label">Pinterest</span></a></li>
						</ul>
					</div>

					<div class="6u">
						<div class="row collapse-at-2">
							<div class="6u">
								<h3>{{ __('messages.defaultLinks') }}</h3>
								<ul class="alt">
									<li><a href="{{ __('messages.menuLinkIndex') }}">{{ __('messages.defaultHome') }}</a></li>
									<li><a href="{{ __('messages.menuLinkAgendamento') }}">{{ __('messages.defaultAgendamento') }}</a></li>
									<li><a href="{{ __('messages.menuLinkEmpresa') }}">{{ __('messages.defaultEmpresa') }}</a></li>
									<li><a href="{{ __('messages.menuLinkUnidades') }}">{{ __('messages.defaultUnidades') }}</a></li>
									<li><a href="{{ __('messages.menuLinkServicos') }}">{{ __('messages.defaultServicos') }}</a></li>
									<li><a href="{{ __('messages.menuLinkContato') }}">{{ __('messages.defaultContato') }}</a></li>		
								</ul>
							</div>
							<div class="6u">
								<h3>{{ __('messages.defaultServicosTitle') }}</h3>
								<ul class="alt">
									<li>{{ __('messages.defaultTrocaPneus') }}</li>
									<li>{{ __('messages.defaultAlinhamento') }}</li>
									<li>{{ __('messages.defaultSuspencao') }}</li>
									<li>{{ __('messages.defaultRegulagem') }}</li>
									<li>{{ __('messages.defaultInspecao') }}</li>									
									<li><a href="{{ __('messages.menuLinkServicos') }}">{{ __('messages.verTodos') }}</a></li>
								</ul>
							</div>
						</div>
					</div>					
				</div>
				<ul class="copyright">
					<li>&copy; <?php echo date("Y"); ?> {{ __('messages.defaultDriveCopyRight') }}</li>
					<li>{{ __('messages.defaultDesenvolvidoPor') }}</li>					
				</ul>
			</div>
		</footer>

	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
		
		@yield('js')	
	</body>
</html>