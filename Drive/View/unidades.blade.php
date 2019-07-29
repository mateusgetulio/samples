@extends('templates.default')

@section('css')
	<link rel="stylesheet" href="{{asset('css/style-unidades.css')}}">
@endsection

@section('menu')

	<nav id="nav">
		<ul>
			<li><a href="{{ __('messages.menuLinkIndex') }}">{{ __('messages.menuHome') }}</a></li>
			<li><a href="{{ __('messages.menuLinkAgendamento') }}">{{ __('messages.menuAgendar') }}</a></li>
			<li><a href="{{ __('messages.menuLinkEmpresa') }}">{{ __('messages.menuEmpresa') }}</a></li>
			<li class="active-link"><a href="{{ __('messages.menuLinkUnidades') }}">{{ __('messages.menuUnidades') }}</a></li>
			<li><a href="{{ __('messages.menuLinkServicos') }}">{{ __('messages.menuServicos') }}</a></li>
			<li><a href="{{ __('messages.menuLinkContato') }}">{{ __('messages.menuContato') }}</a></li>
		</ul>
	</nav>

@endsection

@section('content')
	
	
	<!-- Main -->
	<section id="main" class="wrapper style1">
		<header class="major">
			<h2>{{ __('messages.unidadeTitulo') }}</h2>
			<p>{{ __('messages.unidadeAlterne') }}</p>
		</header>				
			
		<div class="container">
			<div class="row">
	            <div class="col-md-6">
			        <!-- Nav tabs -->
			        <div class="card">
				        <ul class="nav nav-tabs" role="tablist">
				            <li role="presentation" class="active"><a href="#mapa" aria-controls="mapa" role="tab" data-toggle="tab">{{ __('messages.unidadeMapa') }}</a></li>
				            <li role="presentation"><a href="#lista" aria-controls="lista" role="tab" data-toggle="tab">{{ __('messages.unidadeLista') }}</a></li>
				            
				        </ul>

	                    <!-- Tab panes -->
	                    <div class="tab-content">
	                    	<div role="tabpanel" class="tab-pane active" id="mapa">
	                        	<div class="container text-center">
								    <div class="google-maps" id="map"> </div>
								    
								    </br>
								       
									{!! Form::open(['url'=>'/getLocationCoords','id'=>'selecaoCidade']) !!}

									{!! Form::label('cidade', __('messages.unidadeCidadeLabel') ) !!}
									{{-- {!!Form::select('cidade', $cidades, null,['id'=>'cidade']) !!} --}}

									<select id="locationSelect" name="location" style="width: 150px"> </select>
									<div id="cidade"> </div>

									{!! Form::close() !!}
								        
								</div>	
	                        </div>
	                        <div role="tabpanel" class="tab-pane" id="lista">
	                        	<div class="container pgUnidades">
									@if ($unidades->count())
								        @foreach ($unidades as $unidade)
								        	
								        	<div class="row">
												<div class="4u">
													<section class="special">
														<a class="image fit"><img src="{{ $unidade->foto }}" alt="" /></a>								
													</section>
												</div>
												<div class="8u">
													<section class="special">								
														<h3 class="align-left">{{ $unidade->nome }}</h3>
														<ul class="align-left">
															<li>{{ __('messages.unidadeEndereco') . $unidade->logradouro . ' ' .$unidade->numero . ', ' . $unidade->bairro}}</li>
															<li>{{ __('messages.unidadeTelefone') . $unidade->telefones }}</li>
															
															<li>{{ __('messages.unidadeEmail') . $unidade->email }}</li>
															
															<li>{{ __('messages.unidadeInauguração') . date('d/m/Y', strtotime($unidade->inauguracao)) }}</li>
															<li>{{ __('messages.unidadeHorario') }}</li>
															<li>{{ __('messages.unidadeGerente') . $unidade->gerente }}</li>
														</ul>
													</section>
												</div>					
											</div>
											<hr />	   
								            
								        @endforeach								

								    @else
								        <p></br></p>
								    @endif
									
								</div>
	                        </div>
	                    </div>
					</div>
				</div>
			</div>
		</div>	

	</section>

@endsection		


@section('js')

    <script> 
		var localizeTexto = "{{ __('messages.agendarSelecionePesquisa') }}";
	</script>

    <script src="{{asset('js/script.js')}}"></script>        

    <script src="{{asset('js/mapa.js')}}"></script>
        
@endsection		
