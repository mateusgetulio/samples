@extends('layouts.app')

@section('css')
	    
	{{HTML::style('css/forms.css')}}
    
@endsection

	

@section('content')

    <h3 class="titulo-cadastro">Adicionar usuário</h3>	        
	<div class="container">
		<form id="cadastro-usuario" name="insercaousuario" action="/usuarios" method="POST" enctype="multipart/form-data">
			<label for="name">Nome</label>
			<input type="text" name="name" value="" placeholder="Nome">
			{{ ($errors->has('name')) ? $errors->first('name') : '' }}
			
			<label for="email">Email</label>
			<input id="email-cadastro-usuario" type="text" name="email" value="" placeholder="Email">
			{{ ($errors->has('email')) ? $errors->first('email') : '' }}
			
			<label for="senha">Senha</label>
			<input id="password" type="password" name="password" value="" placeholder="Senha">
			{{ ($errors->has('password')) ? $errors->first('password') : '' }}
			
			<label for="passwordConfirmation">Confirme a senha</label>
			<input type="password" name="passwordConfirmation" value="" placeholder="Confirme a senha">				
		
							
			<input type="hidden" name="_token" value="{{ csrf_token() }}">				
			<button id="voltar" type="button" name="Voltar" value="Voltar">Voltar</button>
			<button id="salvar" type="submit" name="Salvar" value="Salvar">Salvar</button>
		</form>
		
	</div>
	
	<div id="data"></div>
		
@endsection	    		
    
@section('scripts')        	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/forms.js') }}		

@endsection	    		
    