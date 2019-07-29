@extends('templates.default')

@section('css')
	<link rel="stylesheet" href="{{asset('css/style-unidades.css')}}">
@endsection

@section('menu')
	
	<nav id="nav">
		<ul>
			<li class="active-link"><a href="{{ __('messages.menuLinkIndex') }}">{{ __('messages.menuHome') }}</a></li>
			<li><a href="{{ __('messages.menuLinkAgendamento') }}">{{ __('messages.menuAgendar') }}</a></li>
			<li><a href="{{ __('messages.menuLinkEmpresa') }}">{{ __('messages.menuEmpresa') }}</a></li>
			<li><a href="{{ __('messages.menuLinkUnidades') }}">{{ __('messages.menuUnidades') }}</a></li>
			<li><a href="{{ __('messages.menuLinkServicos') }}">{{ __('messages.menuServicos') }}</a></li>
			<li><a href="{{ __('messages.menuLinkContato') }}">{{ __('messages.menuContato') }}</a></li>
		</ul>
	</nav>

@endsection

@section('content')		
	<!-- Banner -->
	<section id="banner">
		<div class="inner">
			<h2>{{ __('messages.indexTituloBanner') }}</h2>
			<p>{{ __('messages.indexTraga') }} <a href="empresa.html">{{ __('messages.indexDriveLabel') }}</a></p>
			<ul class="actions">
				<li><a href="{{ __('messages.menuLinkAgendamento') }}" class="button big special">{{ __('messages.indexAgendar') }}</a></li>
				<li><a href="{{ __('messages.menuLinkEmpresa') }}" class="button big alt">{{ __('messages.indexInfo') }}</a></li>
			</ul>
		</div>
	</section>

	<!-- One -->
	<section id="one" class="wrapper style1">
		<header class="major">
			<h2>{{ __('messages.indexConte') }}</h2>
			<p>{{ __('messages.indexSaiba') }}</p>
		</header>
		<div class="container">
			<div class="row">
				<div class="4u">
					<section class="special box">
						<i class="icon fa-usd major"></i>
						<h3>{{ __('messages.indexPreco') }}</h3>
						<p>{{ __('messages.indexNosDrive') }}</p>
					</section>
				</div>
				<div class="4u">
					<section class="special box">
						<i class="icon fa-handshake-o major"></i>
						<h3>{{ __('messages.indexTransparencia') }}</h3>
						<p>{{ __('messages.indexConosco') }}</p>
					</section>
				</div>
				<div class="4u">
					<section class="special box">
						<i class="icon fa-car major"></i>
						<h3>{{ __('messages.indexGarantia') }}</h3>
						<p>{{ __('messages.indexAPartir') }}</p>
					</section>
				</div>
			</div>
		</div>
	</section>
										
	<section id="two" class="wrapper style2">
		<header class="major">
			<h2>{{ __('messages.indexPrincipais') }}</h2>
			<p>{{ __('messages.indexVeja') }}</p>
		</header>
		<div class="container">
			<div class="row">
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_pneu.jpg" alt="" /></a>
						<h3>{{ __('messages.indexTrocaPneus') }}</h3>
						<p>{{ __('messages.indexOsPneus') }}</p>
						<ul class="actions">
							<li><a href="{{ __('messages.menuLinkServicos') }}" class="button alt">{{ __('messages.vejaMais') }}</a></li>
						</ul>
					</section>
				</div>
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_alinhamento.jpg" alt="" /></a>
						<h3>{{ __('messages.indexAlinhamento') }}</h3>
						<p>{{ __('messages.indexQuandoFalamos') }}</p>
						<ul class="actions">
							<li><a href="{{ __('messages.menuLinkServicos') }}" class="button alt">{{ __('messages.vejaMais') }}</a></li>
						</ul>
					</section>
				</div>
			</div>
			<div class="row">
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_suspensao.jpg" alt="" /></a>
						<h3>{{ __('messages.indexSuspensao') }}</h3>
						<p>{{ __('messages.indexPerfomance') }}</p>
						<ul class="actions">
							<li><a href="{{ __('messages.menuLinkServicos') }}" class="button alt">{{ __('messages.vejaMais') }}</a></li>
						</ul>
					</section>
				</div>
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_farol.jpg" alt="" /></a>
						<h3>{{ __('messages.indexRegulagem') }}</h3>
						<p>{{ __('messages.indexFarois') }}</p>
						<ul class="actions">
							<li><a href="{{ __('messages.menuLinkServicos') }}" class="button alt">{{ __('messages.vejaMais') }}</a></li>
						</ul>
					</section>
				</div>
			</div>
		</div>
	</section>
	
	<section id="three" class="wrapper style1">
		<div class="container">
			<div class="row">
				<div class="8u">
					<section>
						<h2>{{ __('messages.indexOndeDrive') }}</h2>
						<p>{{ __('messages.indexEncontre') }}</p>
							
							    <div class="google-maps" id="map"> </div>
							    
							    </br>
							    <div class="text-center">   
								{!! Form::open(['url'=>'/getLocationCoords','id'=>'selecaoCidade']) !!}

								{!! Form::label('cidade', __('messages.unidadeCidadeLabel')) !!}
								{{-- {!!Form::select('cidade', $cidades, null,['id'=>'cidade']) !!} --}}

								<select id="locationSelect" name="location" style="width: 150px"> </select>
								<div id="cidade"> </div>

								{!! Form::close() !!}
							        
							</div>							
					</section>
				</div>
				<div class="4u">
					<section>
						<h3>{{ __('messages.indexEstrutura') }}</h3>
						<p>{{ __('messages.indexContamos') }}</p>
						<ul class="actions">
							<li><a href="{{ __('messages.menuLinkUnidades') }}" class="button alt">{{ __('messages.indexVejaUnidades') }}</a></li>
						</ul>
					</section>
					<hr />
					<section>
						<h3>{{ __('messages.indexMarcas') }}</h3>
						<p>{{ __('messages.indexTrabralhamos') }}</p>								
					</section>
				</div>
			</div>
		</div>
		<div class="container">
			<img class="banner_marcas" src="images/banner_marcas.png" alt="Drive">
		</div>
	</section>							

@endsection

@section('js')
	
        
	<script> 
		var localizeTexto = "{{ __('messages.agendarSelecionePesquisa') }}";
	</script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/ajaxsearch.js')}}"></script>
    

    <script src="{{asset('js/mapa.js')}}"></script>
        
@endsection		
