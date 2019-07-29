@extends('layouts.app')
	

@section('content')
	<div class="container"> 	        
		
		<h1>
			Unidades 
			<a href="/unidades/create">
				<button id="inserir" type="button" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-plus"></span> 
					Inserir
				</button> 
			</a>	
		</h1>
		
		{{ Session::get('message') }}
		@foreach($todasUnidades as $unidade)
			<h3>{{ $unidade->nome }}</h3>
			<p>{{ $unidade -> logradouro . ' ' . $unidade -> numero . ', ' . $unidade -> bairro }}</p>
			<p>{{ $unidade -> cidade . ' / ' . $unidade -> estado}}</p>
			<a href="/unidades/{{$unidade->id}}/edit">
				<button id="editar" type="button" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-pencil"></span> 
					Editar
				</button>
			</a>
			<hr>
		@endforeach
		
			
	</div>			

@endsection

@section('scripts')        
	<script> 
		var myRedirect = function(redirectUrl, arg, value) {
			var form = $('<form action="' + redirectUrl + '" method="get">' +
			'<input type="hidden" name="'+ arg +'" value="' + value + '"></input>' + '</form>');
			$('body').append(form);
			$(form).submit();
		};	
		
	</script>
		
@endsection	    