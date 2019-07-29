@extends('layouts.light')

@section('css')
	
    {{HTML::style('css/edicao-cliente.css')}}
    
@endsection


@section('content')
	
	<div class="container">
		<form id="edicao-cliente" name="registration" action="registrar/finalizarRegistro" method="POST" enctype="multipart/form-data">
		  <h1>{{ __('messages.registrarCadastre') }}</h1>
		  
		  <div class="tab">{{ __('messages.registrarInfo') }}
			<p><input placeholder="{{ __('messages.registrarNome') }}" oninput="this.className = ''" name="nome"></p>
			<p><input placeholder="{{ __('messages.registrarSobrenome') }}" oninput="this.className = ''" name="sobrenome"></p>
			<p><input placeholder="{{ __('messages.registrarData') }}" oninput="this.className = ''" name="nascimento"></p>
			<p><input placeholder="{{ __('messages.registrarTelefones') }}" oninput="this.className = ''" name="telefones"></p>
			<p><input placeholder="{{ __('messages.registrarEmail') }}" oninput="this.className = ''" name="email"></p>    
			<p><input placeholder="{{ __('messages.registrarSenha') }}" oninput="this.className = ''" name="senha" type="password"></p>
			<p><input placeholder="{{ __('messages.registrarRepetir') }}" oninput="this.className = ''" name="senhaConfirmacao" type="password"></p>
		  </div>
		  <div class="tab">Documentos:
			<p><input placeholder="{{ __('messages.registrarCPF') }}" oninput="this.className = ''" name="cpf"></p>
			<p><input placeholder="{{ __('messages.registrarRG') }}" oninput="this.className = ''" name="rg"></p>
		  </div>
		  <div class="tab">Endereço:
			<p><input placeholder="{{ __('messages.registrarCep') }}" oninput="this.className = ''" name="cep"></p>
			<p><input placeholder="{{ __('messages.registrarLogradouro') }}" oninput="this.className = ''" name="logradouro"></p>
			<p><input placeholder="{{ __('messages.registrarNo') }}" oninput="this.className = ''" name="numero"></p>
			<p><input placeholder="{{ __('messages.registrarBairro') }}" oninput="this.className = ''" name="bairro"></p>
			<p><input placeholder="{{ __('messages.registrarCidade') }}" oninput="this.className = ''" name="cidade"></p>
			<p><input placeholder="{{ __('messages.registrarEstado') }}" oninput="this.className = ''" name="estado"></p>
		  </div>
		  <div style="overflow:auto;">
			<div style="float:right;">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">		
			  <button type="button" id="prevBtn" onclick="nextPrev(-1)">{{ __('messages.registrarVoltar') }}</button>
			  <button type="button" id="nextBtn" onclick="nextPrev(1)">{{ __('messages.registrarAvançar') }}</button>
			</div>
		  </div>
		  <div style="text-align:center;margin-top:40px;">
			<span class="step"></span>
			<span class="step"></span>
			<span class="step"></span>
		  </div>
		</form>
	</div>
			
	        
@endsection	    		
    
@section('scripts')        
	
	<script type="text/javascript">
		var btnAvancar = "{{ __('messages.agendarAvancar') }}";
		var btnConcluir = "{{ __('messages.agendarConcluir') }}";
	</script>

	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/edicao-cliente.js') }}
	{{ HTML::script('js/forms.js') }}

@endsection	    		
    