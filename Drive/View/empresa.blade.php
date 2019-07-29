@extends('templates.default')

@section('menu')

	<nav id="nav">
		<ul>
			<li><a href="{{ __('messages.menuLinkIndex') }}">{{ __('messages.menuHome') }}</a></li>
			<li><a href="{{ __('messages.menuLinkAgendamento') }}">{{ __('messages.menuAgendar') }}</a></li>
			<li class="active-link"><a href="{{ __('messages.menuLinkEmpresa') }}">{{ __('messages.menuEmpresa') }}</a></li>
			<li><a href="{{ __('messages.menuLinkUnidades') }}">{{ __('messages.menuUnidades') }}</a></li>
			<li><a href="{{ __('messages.menuLinkServicos') }}">{{ __('messages.menuServicos') }}</a></li>
			<li><a href="{{ __('messages.menuLinkContato') }}">{{ __('messages.menuContato') }}</a></li>
		</ul>
	</nav>

@endsection

@section('content')

	<!-- Main -->
	<section id="main" class="wrapper style1">
		<header class="major">
			<h2>{{ __('messages.empresaTitulo') }}</h2>
			<p>{{ __('messages.empresaConheca') }}</p>
		</header>
		<div class="container">
			<div class="row">
				<div class="4u">
					<section>
						<h3>{{ __('messages.empresaUnidades') }}</h3>
						<p>{{ __('messages.empresaNossasLojas') }}</p>
						<ul class="actions">
							<li><a href="{{ __('messages.menuLinkUnidades') }}" class="button alt">{{ __('messages.vejaMais') }}</a></li>
						</ul>
					</section>
					<hr />
					<section>
						<h3>{{ __('messages.empresaLinks') }}</h3>
						<ul class="alt">
							<li><a href="attachments/CDCcompleto.pdf">{{ __('messages.empresaCodigo') }}</a></li>
							<li><a href="#">{{ __('messages.empresaGarantia') }}</a></li>
							<li><a href="#">{{ __('messages.empresaTermo') }}</a></li>
						</ul>
					</section>
				</div>
				<div class="8u skel-cell-important">
					<section>
						<h2>{{ __('messages.empresaQuem') }}</h2>
						<p>{{ __('messages.empresaADrive') }}</p>
						<p>{{ __('messages.empresaDesde') }}</p>								
					</section>
				</div>
			</div>
			<hr class="major" />
			
			<div class="row">
				<div class="4u">
					<section class="special">
						<a href="#" class="image fit"><img src="images/pic01.jpg" alt="" /></a>
						<h3>{{ __('messages.empresaMissao') }}</h3>
						<p>{{ __('messages.empresaEncantar') }}</p>								
					</section>
				</div>
				<div class="4u">
					<section class="special">
						<a href="#" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
						<h3>{{ __('messages.empresaVisao') }}</h3>
						<p>{{ __('messages.empresaSerReferencia') }}</p>
					</section>
				</div>
				<div class="4u">
					<section class="special">
						<a href="#" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
						<h3>{{ __('messages.empresaValores') }}</h3>
						<p>{{ __('messages.empresaCarater') }}</p>
					</section>
				</div>
			</div>
		</div>
	</section>

@endsection