@extends('layouts.light')

@section('css')
	
    {{HTML::style('css/edicao-cliente.css')}}
    
@endsection


@section('content')
			
	<div class="container">
		<h2>{{ __('messages.agendamentoSucessoTitulo') }}</h2>
		{{ __('messages.agendamentoSucessoADrive') }}
		</br>
		{{ __('messages.agendamentoSucessoPorGentileza') }}

		<div class="text-left">
			<h3>{{ __('messages.agendamentoSucessoDetalhes') }}</h3>
			<h4>{{ __('messages.agendamentoSucessoData') . $dataAgendamento }}</h4>
			<strong>{{ __('messages.agendamentoSucessoDadosUnidade') }}</strong>
			</br>
			{{ __('messages.agendamentoSucessoEndereco') . $unidade->logradouro . ' ' .$unidade->numero . ', ' . $unidade->bairro . ' - ' . $unidade->cidade . ' / ' . $unidade->estado}}
			</br>
			{{ __('messages.agendamentoSucessoTelefone') . $unidade->telefones }}
			</br>
			{{ __('messages.agendamentoSucessoEmail') . $unidade->email }}
			</br>
			{{ __('messages.agendamentoSucessoGerente') . $unidade->gerente }}
			</br>
			{{ __('messages.agendamentoSucessHorario') }}
			</br>
			</br>
			<strong>{{ __('messages.agendamentoSucessoDadosCliente') }}</strong>
			</br>
			{{ __('messages.agendamentoSucessoNomeCliente') . $cliente->nome . ' ' . $cliente->sobrenome}}
			</br>
			{{ __('messages.agendamentoSucessoTelefoneCliente') . $cliente->telefones }}
			</br>
			{{ __('messages.agendamentoSucessoEmailCliente') . $cliente->email }}
			</br>
			{{ __('messages.agendamentoSucessoVeiculoCliente') . $veiculo->marca . ' ' . $veiculo->modelo . ', ' . __('messages.agendarPlaca') . ': ' . $veiculo->placa }}
			</br>
			</br>
			</br>
		</div>
		{{ __('messages.agendamentoSucessoPedimos') }}
		</br>
		{{ __('messages.agendamentoSucessoAguardamos') }}
		</br>
		{{ __('messages.agendamentoSucessoAEquipe') }}
		
		</br>
		</br>
		</br>
		<button onclick="window.print();">{{ __('messages.agendamentoSucessoImprimir') }}</button> <a href="http:drive.com:8000"><button>{{ __('messages.agendamentoSucessoVoltar') }}</button></a>
	</div>
	
@endsection	    		
    
@section('scripts')        

	

@endsection	    		
    