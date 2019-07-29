@extends('layouts.app')

@section('css')
	
    {{HTML::style('css/forms.css')}}
    
@endsection


@section('content')

	<h3 class="titulo-cadastro">Editar Unidade</h3>	

	<div class="container bs-forms">
		<form class="form-horizontal" id="edicao-unidade" name="edicaoUnidade" action="/unidades/{{ $detailpage->id }}" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="nome" class="control-label col-xs-2">Nome</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required value="{{ $detailpage->nome }}">
					{{ ($errors->has('nome')) ? $errors->first('nome') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="logradouro" class="control-label col-xs-2">Logradouro</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="logradouro" id="logradouro" placeholder="Logradouro" required value="{{ $detailpage->logradouro }}">
					{{ ($errors->has('logradouro')) ? $errors->first('logradouro') : '' }}
				</div>
			</div>
			
			<div class="form-group">
				<label for="numero" class="control-label col-xs-2">Número</label>
				<div class="col-xs-10">
					<input type="number" min="1" step="any" class="form-control" name="numero" id="numero" placeholder="Número" required value="{{ $detailpage->numero }}">
					{{ ($errors->has('numero')) ? $errors->first('numero') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="bairro" class="control-label col-xs-2">Bairro</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" required value="{{ $detailpage->bairro }}">
					{{ ($errors->has('bairro')) ? $errors->first('bairro') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="cidade" class="control-label col-xs-2">Cidade</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" required value="{{ $detailpage->cidade }}">
					{{ ($errors->has('cidade')) ? $errors->first('cidade') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="estado" class="control-label col-xs-2">Estado</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" required value="{{ $detailpage->estado }}">
					{{ ($errors->has('estado')) ? $errors->first('estado') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="cep" class="control-label col-xs-2">Cep</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="cep" id="cep" placeholder="Cep" required value="{{ $detailpage->cep }}">
					{{ ($errors->has('cep')) ? $errors->first('cep') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="lat" class="control-label col-xs-2">Latitude</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="lat" id="lat" placeholder="Latitude" required value="{{ $detailpage->lat }}">
					{{ ($errors->has('lat')) ? $errors->first('lat') : '' }}
				</div>
			</div>
		
			<div class="form-group">
				<label for="lng" class="control-label col-xs-2">Longitude</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="lng" id="lng" placeholder="Longitude" required value="{{ $detailpage->lng }}">
					{{ ($errors->has('lng')) ? $errors->first('lng') : '' }}
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
				<label for="email" class="control-label col-xs-2">Email</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="email" id="email" placeholder="Email" required value="{{ $detailpage->email }}">
					{{ ($errors->has('email')) ? $errors->first('email') : '' }}
				</div>
			</div>

			<div class="form-group">
				<label for="gerente" class="control-label col-xs-2">Gerente</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="gerente" id="gerente" placeholder="Gerente" required value="{{ $detailpage->gerente }}">
					{{ ($errors->has('gerente')) ? $errors->first('gerente') : '' }}
				</div>
			</div>
			
			<div class="form-group">
				<label for="inauguracao" class="control-label col-xs-2">Inauguracao</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="inauguracao" id="inauguracao" placeholder="Inauguracao" required value="{{ $detailpage->inauguracao }}">
					{{ ($errors->has('inauguracao')) ? $errors->first('inauguracao') : '' }}
				</div>
			</div>


			
			<div class="form-group">
				<label for="image" class="control-label col-xs-2">Foto</label>
				<div class="col-xs-10">
					{!! Form::file('image', array('class' => 'images', 'scr' => '', 'accept' => 'image/*')) !!}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-xs-offset-2 col-xs-10">
					<input type="hidden" name="_method" value="put">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">						
					<button type="button" name="Voltar" class="btn btn-primary" value="Voltar" id="voltar">Voltar</button>								
					<button type="submit" name="Salvar" class="btn btn-primary" value="Salvar">Salvar</button>
				</div>
			</div>
		</form>
	</div>
		
	        
@endsection	    		
    
@section('scripts')        

	{{ HTML::script('js/jquery-1.2.6.pack.js') }}
	
	<script type="text/javascript">
		var $JQuery126 = jQuery.noConflict();

	</script>

	{{ HTML::script('js/jquery.maskedinput-1.1.4.pack.js') }}

	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/forms.js') }}

	<script type="text/javascript">
		
		$(document).ready(function() {	
			$JQuery126("#cep").mask("99.999-999");
			$JQuery126("#inauguracao").mask("99/99/9999");
		});	
	
	</script>

@endsection	    		
    