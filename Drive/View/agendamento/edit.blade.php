@extends('layouts.app')

@section('css')
	
    {{HTML::style('css/forms.css')}}
    
@endsection


@section('content')
		
	<h3 class="titulo-cadastro">Cancelar agendamento</h3>	
	
	<div class="container bs-forms">
		<form class="form-horizontal" id="cancelamento-agendamento" name="cancelamentoAgendamento" action="/agendamentos/{{ $detailpage->id }}" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="motivo_cancelamento" class="control-label col-xs-2">Motivo</label>
				<div class="col-xs-10">
					<textarea  rows="6" class="form-control" name="motivo_cancelamento" id="motivo_cancelamento" placeholder="Motivo do cancelamento" required></textarea>
					{{ ($errors->has('motivo_cancelamento')) ? $errors->first('motivo_cancelamento') : '' }}
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

	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	{{ HTML::script('js/forms.js') }}		

@endsection	    		
    