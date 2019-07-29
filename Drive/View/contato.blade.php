@extends('templates.default')

@section('menu')
	<nav>
		<ul>
			<li><a href="{{ __('messages.menuLinkIndex') }}">{{ __('messages.menuHome') }}</a></li>
			<li><a href="{{ __('messages.menuLinkAgendamento') }}">{{ __('messages.menuAgendar') }}</a></li>
			<li><a href="{{ __('messages.menuLinkEmpresa') }}">{{ __('messages.menuEmpresa') }}</a></li>
			<li><a href="{{ __('messages.menuLinkUnidades') }}">{{ __('messages.menuUnidades') }}</a></li>
			<li><a href="{{ __('messages.menuLinkServicos') }}">{{ __('messages.menuServicos') }}</a></li>
			<li class="active-link"><a href="{{ __('messages.menuLinkContato') }}">{{ __('messages.menuContato') }}</a></li>
		</ul>
	</nav>

@endsection

@section('content')

	<!-- Main -->
	<section id="main" class="wrapper style1">
		<header class="major">
			<h2>{{ __('messages.contatoTitulo') }}</h2>
			<p>{{ __('messages.contatoPreencha') }}</p>
		</header>
		<div class="container">
			<div class="row">
				<div class="4u">
					<section>
						<h3>{{ __('messages.contatoEnvie') }}</h3>
						<p>{{ __('messages.contatoImportante') }}</p>								
					</section>
					<hr />
					<section>
						<h3>{{ __('messages.contatoOutras') }}</h3>
						<ul class="alt">
							<p>{{ __('messages.contatoGentileza') }}</p>
							<li><a href="{{ __('messages.menuLinkUnidades') }}" class="button alt">{{ __('messages.contatoUnidades') }}</a></li>
						</ul>
					</section>
				</div>
				<div class="8u skel-cell-important">
					<section>
						<div class="pgContato">
						   <div class="contato">
							  <div class="formContato">
								 <form id="formContato" tabindex="1" action="contato/enviarMensagem" method="post">
									<input id="nome" name="nome" required="" type="text" placeholder="{{ __('messages.contatoNome') }}" value="{{ Session::get('nome') }}" /> 
									<input id="email" name="email" required="" type="email" placeholder="{{ __('messages.contatoEmail') }}" value="{{ Session::get('email') }}" /> 
									<input id="tel" name="telefone" required="" type="telefones" placeholder="{{ __('messages.contatoTelefone') }}" value="{{ Session::get('telefone') }}" /> 
									<textarea id="conteudo" name="mensagem" required="" placeholder="{{ __('messages.contatoDeixe') }}" value="{{ Session::get('mensagem') }}"></textarea>
									<button class="botaoContato" type="submit">{{ __('messages.contatoEnviar') }}</button>
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								 </form>
							  </div>
						   </div>
						</div>						
					</section>

					<br />
					<strong> {{ Session::get('message') }} </strong>
				</div>
			</div>					
		</div>
	</section>

@endsection