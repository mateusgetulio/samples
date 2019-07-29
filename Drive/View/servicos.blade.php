@extends('templates.default')

@section('menu')
	<nav id="nav">
		<ul>
			<li><a href="{{ __('messages.menuLinkIndex') }}">{{ __('messages.menuHome') }}</a></li>
			<li><a href="{{ __('messages.menuLinkAgendamento') }}">{{ __('messages.menuAgendar') }}</a></li>
			<li><a href="{{ __('messages.menuLinkEmpresa') }}">{{ __('messages.menuEmpresa') }}</a></li>
			<li><a href="{{ __('messages.menuLinkUnidades') }}">{{ __('messages.menuUnidades') }}</a></li>
			<li class="active-link"><a href="{{ __('messages.menuLinkServicos') }}">{{ __('messages.menuServicos') }}</a></li>
			<li><a href="{{ __('messages.menuLinkContato') }}">{{ __('messages.menuContato') }}</a></li>	
		</ul>
	</nav>

@endsection

@section('content')

	<section id="main" class="wrapper style1">
		<header class="major">
			<h2>{{ __('messages.servicosTitulo') }}</h2>
			<p>{{ __('messages.servicosVejaRelacao') }}</p>
		</header>					
		<div class="container">
			<div class="row">
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_pneu.jpg" alt="" /></a>
						<h3>{{ __('messages.servicosTrocaPneus') }}</h3>
						<p>{{ __('messages.servicosOsPneusTexto') }}</p>									
					</section>
				</div>
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_alinhamento.jpg" alt="" /></a>
						<h3>{{ __('messages.servicosAlinhamento') }}</h3>
						<p>{{ __('messages.servicosAlinhamentoTexto') }}</p>
					</section>
				</div>
			</div>
			<hr />
			<div class="row">
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_suspensao.jpg" alt="" /></a>
						<h3>{{ __('messages.servicosSuspencao') }}</h3>
						<p>{{ __('messages.servicosSuspencaoTexto') }}</p>
					</section>
				</div>
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_farol.jpg" alt="" /></a>
					<h3>{{ __('messages.servicosRegulagemFarol') }}</h3>
					<p>{{ __('messages.servicosRegulagemFarolTexto') }}</p>								
					</section>
				</div>							
			</div>
			<hr />
			<div class="row">
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_inspecao.jpg" alt="" /></a>
						<h3>{{ __('messages.servicosInspecao') }}</h3>
						<p>{{ __('messages.servicosInspecaoTexto') }}</p>									
					</section>
				</div>
				<div class="6u">
					<section class="special">
						<a class="image fit"><img src="images/servico_desempeno.jpg" alt="" /></a>
						<h3>{{ __('messages.servicosDesempeno') }}</h3>
						<p>{{ __('messages.servicosDesempenoTexto') }}</p>
					</section>
				</div>
			</div>						
			<div class="oculto">
			<hr />											
				<div class="row">
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_descarbonizacao.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosDescarbonizacao') }}</h3>
							<p>{{ __('messages.servicosDescarbonizacaoTexto') }}</p>									
						</section>
					</div>							
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_diagnostico.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosDiagnostico') }}</h3>
							<p>{{ __('messages.servicosDiagnosticoTexto') }}</p>
						</section>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_higienizacao.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosHigiene') }}</h3>
							<p>{{ __('messages.servicosHigieneTexto') }}</p>									
						</section>
					</div>
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_bicos.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosLimpezaFarol') }}</h3>
							<p>{{ __('messages.servicosLimpezaFarolTexto') }}</p>
						</section>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_arrefecimento.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosArrefecimento') }}</h3>
							<p>{{ __('messages.servicosArrefecimentoTexto') }}</p>									
						</section>
					</div>
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_freios.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosFreios') }}</h3>
							<p>{{ __('messages.servicosFreiosTexto') }}</p>
						</section>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_amortecedores.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosAmortecedores') }}</h3>
							<p>{{ __('messages.servicosAmortecedoresTexto') }}</p>						
						</section>
					</div>
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_troca_oleo.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosTrocaOleo') }}</h3>
							<p>{{ __('messages.servicosTrocaOleoTexto') }}</p>
						</section>
					</div>
				</div>
				<hr />
				<div class="row">
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_cambagem.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosCambagem') }}</h3>
							<p>{{ __('messages.servicosCambagemTexto') }}</p>									
						</section>
					</div>
					<div class="6u">
						<section class="special">
							<a class="image fit"><img src="images/servico_caster.jpg" alt="" /></a>
							<h3>{{ __('messages.servicosCaster') }}</h3>
							<p>{{ __('messages.servicosCasterTexto') }}</p>
						</section>
					</div>
				</div>
			</div>
			
			<div id="mostrarServicos"> 
				<i id="mostrarServicosBtn" class="icon fa-arrow-down major-grey"></i>
			</div>
		</div>
	</section>

@endsection

@section('js')
	<script src="js/custom-script.js"></script>
@endsection