@extends('layouts.light')

@section('css')
	
    {{HTML::style('css/edicao-cliente.css')}}
    
@endsection


@section('content')
	
	<div class="container">
		<form id="edicao-cliente" name="registration" action="finalizarAgendamento" method="POST" enctype="multipart/form-data">
		  <h1>{{ __('messages.agendarAgendeAqui') }}</h1>
		  </br>
		  
		  <div class="tab">{{ __('messages.agendarUnidade') }}
			</br>
			</br>
			
			<select class="form-control" id="locationSelect" name="location"> </select>
			<div id="cidade"> </div>
			</br>
		  </div>
		  <div class="tab">{{ __('messages.agendarData') }}
			
			<div class="input_field_wrap">
				<div><p><input id="marcacao" type="text" name="marcacao" value="" placeholder="{{ __('messages.agendarDataMarcacao') }}"></p></div>
			</div>
			
		  </div>
		  <div class="tab">{{ __('messages.agendarVeiculo') }}
			<input type="hidden" name="id_veiculo" id="id_veiculo" value="-1">
			
			<div id="opcoes-veiculo"> 
				<button type="button" id="btnCadastrarVeiculo" disabled="true"> {{ __('messages.agendarCadastrar') }} </button>
				<button type="button" id="btnSelecionarVeiculo"> {{ __('messages.agendarSelecionar') }} </button>
			</div>
			</br>
			<div id="cadastrar-veiculo">
			
				<p><input type="text" id="placa" name="placa" placeholder="{{ __('messages.agendarPlaca') }}"></p>
				<p><input type="text" id="marca" name="marca" placeholder="{{ __('messages.agendarFabricante') }}"></p>
				<p><input type="text" id="modelo" name="modelo" placeholder="{{ __('messages.agendarModelo') }}"></p>
				<p><input input id="ano" type="number" min="1" step="any" name="ano" placeholder="{{ __('messages.agendarAno') }}"></p>
			
			
			</div>
			
			<div id="selecionar-veiculo">
				
				@if ($veiculos->count())
					<h3>Lista de carros cadastrados:</h3>
					@foreach ($veiculos as $veiculo)
											
						<div class="form-check">
							<label>
								<input type="radio" name="radVeiculo" id="{{ $veiculo->id }}"> <span class="label-text"> {{ $veiculo->marca . ' ' . $veiculo->modelo . ', ' . __('messages.agendarPlacaVeiculoAntigo') . ' ' . $veiculo->placa }}</span>
							</label>
						</div>	   
						
					@endforeach								

				@else
					<h4>{{ __('messages.agendarSemVeiculos') }}</h4>						
				@endif
				
			</div>
			
			
			
			
		  </div>
		  <div style="overflow:auto;">
			<div style="float:right;">
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">	
			  <input type="hidden" name="id_cliente" value="{{ $id_cliente }}">
			  <button type="button" id="prevBtn" onclick="nextPrev(-1)">{{ __('messages.agendarVoltar') }}</button>
			  <button type="button" id="nextBtn" onclick="nextPrev(1)" disabled>{{ __('messages.agendarAvancar') }}</button>
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
	
	<script>		
		$(document).ready(function() {
		
			$("input:radio[name=radVeiculo]").on('change', function() {
			   $('#id_veiculo').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
			   $('#placa').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id')); 
			   $('#placa').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
			   $('#marca').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
			   $('#modelo').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
			   $('#ano').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
			  

			});
		
			$('#btnCadastrarVeiculo').click(function() {
				$('#id_veiculo').prop( "value", -1 );
				$('#selecionar-veiculo').hide();
				$('#cadastrar-veiculo').slideToggle( "slow" );
				$('#btnCadastrarVeiculo').prop( "disabled", true );
				$('#btnSelecionarVeiculo').prop( "disabled", false );
				$('#placa').prop( "value", '');
			    $('#marca').prop( "value", '');
			    $('#modelo').prop( "value", '');
			    $('#ano').prop( "value", '');
			});
			
			$('#btnSelecionarVeiculo').click(function() {
				$("input:radio[name=radVeiculo]:not(:disabled):first").prop( "checked", true );
				$('#placa').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
			    $('#marca').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
			    $('#modelo').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
			    $('#ano').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
				$('#id_veiculo').prop( "value", $('input:radio[name=radVeiculo]:checked').attr('id'));
				$('#cadastrar-veiculo').hide();
				$('#selecionar-veiculo').slideToggle( "slow" );
				$('#btnSelecionarVeiculo').prop( "disabled", true );
				$('#btnCadastrarVeiculo').prop( "disabled", false );
			});
	

			$('#locationSelect').select2({
				placeholder:"{{ __('messages.agendarSelecionePesquisa') }}",
				ajax:{
					url:"/api/localizarCidade",
					type:"POST",
					dataType:"json",
					delay:250,
					data:function(params){
						return{
						locationVal:params.term,
					};
					},

					processResults:function(data){
						return{
							results:$.map(data.items,function(val,i){
								return {id:i, text:val};
							})
						};
					}

				}


			});

			$('#locationSelect').on('select2:select',function(e){

				var val=$('#locationSelect').val();
				$.post('http://drive.com:8000/api/obterDatasLivresUnidade',{val},function(atributos){

					$("#nextBtn").removeAttr( "disabled");
					$("#marcacao").removeAttr( "data-disabled-days");
					$("#marcacao").removeAttr( "data-format");
					$("#marcacao").removeAttr( "data-lang");
					$("#marcacao").removeAttr( "data-large-mode");
					$("#marcacao").removeAttr( "data-large-default");
					$("#marcacao").removeAttr( "data-lock");
					$("#marcacao").removeAttr( "data-min-year");
					$("#marcacao").removeAttr( "data-max-year");
					
					$('#marcacao').remove();
					
					var wrapper = $(".input_field_wrap"); 
					
					$(wrapper).append('<div><p><input id="marcacao" type="text" name="marcacao" value="" placeholder="Data"></p></div>');
						
											
					$("#marcacao").attr( "data-disabled-days", atributos["data-disabled-days"]);
					$("#marcacao").attr( "data-format", atributos["data-format"]);
					$("#marcacao").attr( "data-lang", atributos["data-lang"]);
					$("#marcacao").attr( "data-large-mode", atributos["data-large-mode"]);
					$("#marcacao").attr( "data-large-default", atributos["data-large-default"]);
					$("#marcacao").attr( "data-lock", atributos["data-lock"]);
					$("#marcacao").attr( "data-min-year", atributos["data-min-year"]);
					$("#marcacao").attr( "data-max-year", atributos["data-max-year"]);
					$('#marcacao').dateDropper();
					
					console.log(atributos);
					
					
				});
			});
		});

	</script>
	
	{{ HTML::script('js/jquery-1.2.6.pack.js') }}
	
	{{ HTML::script('js/jquery.maskedinput-1.1.4.pack.js') }}

	<script type="text/javascript">
		var $JQuery126 = jQuery.noConflict();

	</script>

	<script type="text/javascript">
		
		$(document).ready(function() {	
			$JQuery126("#placa").mask("aaa-9999");
		});	
	
	</script>	

@endsection	    		
    