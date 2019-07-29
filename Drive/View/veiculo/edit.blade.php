@extends('layouts.app')

@section('css')
	
    {{HTML::style('css/forms.css')}}
    
@endsection


@section('content')

	<h3 class="titulo-cadastro">Editar  veículo</h3>

	<div class="container bs-forms">
		<form class="form-horizontal" id="edicao-veiculo" name="edicaoVeiculo" action="/veiculos/{{ $detailpage->id }}" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="placa" class="control-label col-xs-2">Placa</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="placa" id="placa" placeholder="Placa" required disabled value="{{ $detailpage->placa }}">
					{{ ($errors->has('placa')) ? $errors->first('placa') : '' }}
				</div>
			</div>
			
			<div class="form-group">
				<label for="marca" class="control-label col-xs-2">Fabricante</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="marca" id="marca" placeholder="Fabricante" required value="{{ $detailpage->marca }}">
					{{ ($errors->has('marca')) ? $errors->first('marca') : '' }}
				</div>
			</div>
		
			<div class="form-group">
				<label for="modelo" class="control-label col-xs-2">Modelo</label>
				<div class="col-xs-10">
					<input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo" required value="{{ $detailpage->modelo }}">
					{{ ($errors->has('modelo')) ? $errors->first('modelo') : '' }}
				</div>
			</div>
			
			<div class="form-group">
				<label for="ano" class="control-label col-xs-2">Ano</label>
				<div class="col-xs-10">
					<input type="number" min="1" step="any" class="form-control" name="ano" id="ano" placeholder="Ano" required value="{{ $detailpage->ano }}">
					{{ ($errors->has('ano')) ? $errors->first('ano') : '' }}
				</div>
			</div>

			<input type="hidden" class="form-control" name="id_cliente" id="id_cliente" placeholder="Cliente" required  value="{{ $detailpage->id_cliente }}">
			
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

	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/forms.js') }}		

@endsection	    		
    