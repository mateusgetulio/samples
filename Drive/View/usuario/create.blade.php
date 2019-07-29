@extends('layouts.app')

@section('css')
	    
	{{HTML::style('css/forms.css')}}
    
@endsection

	

@section('content')

	<h3>Adicionar usuário</h3>	

	<div class="container bs-forms">
		<form class="form-horizontal" id="cadastro-usuario" name="cadastroUsuario" action="/usuarios" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="name" class="control-label col-xs-2">Nome</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="name" id="name" placeholder="Nome" value="{{ old('name') }}" required>
					{{ ($errors->has('name')) ? $errors->first('name') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="control-label col-xs-2">Email</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required>
					{{ ($errors->has('email')) ? $errors->first('email') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="telefones" class="control-label col-xs-2">Telefones</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="telefones" id="telefones" placeholder="Telefones" value="{{ old('telefones') }}" required>
					{{ ($errors->has('telefones')) ? $errors->first('telefones') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label id="password-label" for="password" class="control-label col-xs-2">Senha</label>
				<div class="col-xs-10">
					<input type="password" class="form-control" name="password" id="password" placeholder="Senha" value="{{ old('password') }}" required>
					{{ ($errors->has('password')) ? $errors->first('password') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label id="password-confirmation-label" for="PasswordConfirmation" class="control-label col-xs-2">Confirme a senha</label>
				<div class="col-xs-10">
					<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirme a senha" value="{{ old('passwordConfirmation') }}" required>
				</div>
			</div>
			
			
			
			<div class="form-group">
				<div class="col-xs-offset-2 col-xs-10">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">						
					<button type="button" name="Voltar" class="btn btn-primary" value="Voltar" id="voltar">Voltar</button>
					<button type="submit" name="Salvar" class="btn btn-primary" value="Salvar">Salvar</button>
				</div>
			</div>
		</form>
	</div>
		
@endsection	    		
    
@section('scripts')        	
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/forms.js') }}		

@endsection	    		
    