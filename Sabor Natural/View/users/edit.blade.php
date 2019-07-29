@extends('layouts.app')

@section('css')
	    
	{{HTML::style('css/forms.css')}}
    
@endsection

	

@section('content')

    <h3 class="titulo-cadastro">Editar usuário</h3>	
	
	<div class="container">
		<form id="edicao-usuario" name="edicao-usuario" action="/usuarios/{{ $detailpage->id }}" method="POST" enctype="multipart/form-data">
			<label for="nome">Nome</label>
			<input type="text" name="name" value="{{ $detailpage->name }}" placeholder="Nome">				
			{{ ($errors->has('nome')) ? $errors->first('nome') : '' }}
			
			<label for="email">Email</label>
			<input id="email-edicao-usuario" type="text" name="email" value="{{ $detailpage->email }}" placeholder="Email">
			{{ ($errors->has('email')) ? $errors->first('email') : '' }}
			
			<label id="edit-password-label" for="senha">Senha</label>
			<input id="edit-password" type="password" name="editPassword" value="{{ $detailpage->password }}" placeholder="Senha">
			{{ ($errors->has('password')) ? $errors->first('password') : '' }}
			
			<label id="edit-password-confirmation-label" for="edit-password-confirmation">Confirme a senha</label>
			<input id="edit-password-confirmation" type="password" name="editPasswordConfirmation" value="{{ $detailpage->password }}" placeholder="Confirme a senha">				
			
			
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">								
			<button id="voltar" type="button" name="Voltar" value="Voltar">Voltar</button>				
			<button id="alterar-senha" type="button" name="alterar-senha" value="Alterar Senha">Alterar a senha</button>					
			<button id="salvar" type="submit" name="Salvar" value="Salvar">Salvar</button>					
		</form>
	</div>
			

		
@endsection	    		
    
@section('scripts')        

	<script> emailCadastrado = "{{ $detailpage->email }}"; </script>					
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/forms.js') }}		

@endsection	    		
    