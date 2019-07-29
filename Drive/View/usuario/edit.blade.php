@extends('layouts.app')

@section('css')
	    
	{{HTML::style('css/forms.css')}}
    
@endsection

	

@section('content')

	<h3>Editar usuário</h3>	

	<div class="container bs-forms">
		<form class="form-horizontal" id="edicao-usuario" name="edicaoUsuario" action="/usuarios/{{ $detailpage->id }}" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="name" class="control-label col-xs-2">Nome</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="name" id="name" placeholder="Nome" required value="{{ $detailpage->name }}">
					{{ ($errors->has('name')) ? $errors->first('name') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="email" class="control-label col-xs-2">Email</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="email" id="email" placeholder="Email" required value="{{ $detailpage->email }}">
					{{ ($errors->has('email')) ? $errors->first('email') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="telefones" class="control-label col-xs-2">Telefones</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="telefones" id="telefones" placeholder="Telefones" required value="{{ $detailpage->telefones }}">
					{{ ($errors->has('telefones')) ? $errors->first('telefones') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label id="edit-password-label" for="password" class="control-label col-xs-2">Senha</label>
				<div class="col-xs-10">
					<input type="password" class="form-control" name="password" id="edit-password" placeholder="Senha" required value="{{ $detailpage->password }}">
					{{ ($errors->has('password')) ? $errors->first('password') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label id="edit-password-confirmation-label" for="password_confirmation" class="control-label col-xs-2">Confirme a senha</label>
				<div class="col-xs-10">
					<input type="password" class="form-control" name="password_confirmation" id="edit-password-confirmation" placeholder="Confirme a senha" required value="{{ $detailpage->password }}">
				</div>
			</div>
			
			
			
			<div class="form-group">
				<div class="col-xs-offset-2 col-xs-10">
					<input type="hidden" name="_method" value="put">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">						
					<button type="button" name="Voltar" class="btn btn-primary" value="Voltar" id="voltar">Voltar</button>
					<button type="button" name="Voltar" class="btn btn-primary" value="Alterar Senha" id="alterar-senha">Alterar a senha</button>
					<button type="submit" name="Salvar" class="btn btn-primary" value="Salvar">Salvar</button>
				</div>
			</div>
		</form>
	</div>
			

		
@endsection	    		
    
@section('scripts')        

	<script> 
		$("#alterar-senha").click(function(){ 				
	
			$('#edit-password-label').fadeIn();
			$('#edit-password').fadeIn();
			$('#edit-password-confirmation-label').fadeIn();
			$('#edit-password-confirmation').fadeIn();
			
			$('#edit-password').val("");
			$('#edit-password-confirmation').val("");
			
			$(this).addClass( "btn disabled" );
			
			$('#edicao-usuario').height(260);

		});

		console.log("{{ $errors->first('password') }}");

		if ("{{ $errors->first('password') }}" != "") {
			$('#edit-password-label').fadeIn();
			$('#edit-password').fadeIn();
			$('#edit-password-confirmation-label').fadeIn();
			$('#edit-password-confirmation').fadeIn();
					
			$(this).addClass( "btn disabled" );
			
			$('#edicao-usuario').height(260);

			$('#edit-password').val("");
			$('#edit-password-confirmation').val("");
		}; 

	</script>					
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/forms.js') }}		

@endsection	    		
    