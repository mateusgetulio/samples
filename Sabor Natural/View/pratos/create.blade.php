@extends('layouts.app')

@section('css')
	    
	{{HTML::style('css/forms.css')}}
    
@endsection

	

@section('content')

    <h3 class="titulo-cadastro">Adicionar novo prato</h3>		
	<div class="container">
		<form id="cadastro-prato" name="registration" action="/pratos" method="POST" enctype="multipart/form-data">
			<label for="nome">Nome</label>
			<input type="text" name="nome" value="" placeholder="Nome">
			{{ ($errors->has('nome')) ? $errors->first('nome') : '' }}
			<label for="descricao">Descrição</label>
			<textarea name="descricao" rows="8" cols="40" placeholder="Descricao"></textarea>
			{{ ($errors->has('descricao')) ? $errors->first('descricao') : '' }}
			<label for="preco">Preço</label>
			<input input type="number" min="1" step="any" name="preco" value="" placeholder="Preço">
			{{ ($errors->has('preco')) ? $errors->first('preco') : '' }}
			<label for="peso">Peso</label>
			<input type="text" name="peso" value="" placeholder="Peso">
			{{ ($errors->has('peso')) ? $errors->first('peso') : '' }}
			<label for="image">Foto</label>
			<div class="box__input">
				 {!! Form::file('image', array('class' => 'image')) !!}
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">								
			<button type="button" name="Voltar" value="Voltar" id="voltar">Voltar</button>								
			<button type="submit" name="Salvar" value="Salvar">Salvar</button>								
		</form>
		
	</div>
		
		
        
				
		
@endsection	    		
    
@section('scripts')        

	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/forms.js') }}		

@endsection	    		
    