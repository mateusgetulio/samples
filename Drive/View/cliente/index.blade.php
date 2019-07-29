@extends('layouts.app')

@section('content')
        
	<h2>Cadastro de Clientes</h2>			
			
		
	</br>		
	<button id="editar" type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
	</br>
	</br>
		
			    
	<table id="grid"></table>
	
	<div id="display-success">Selecione um registro antes de realizar essa operação!</div>	

	{{ Session::get('message') }}
				

@endsection

@section('scripts')        
	<script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.2/jquery.jqgrid.min.js"></script>        
	<script>
		
		grid = null;
		sel_id = null;
		myCellData = null;
		
		//<![CDATA[
		$(function () {
			"use strict";
			$("#grid").jqGrid({
				colModel: [
					{ name: "id", label : "ID",  width: 40},
					{ name: "nome", label : "Nome",  width: 160, formatter:myformatter },
					{ name: "cpf", label : "CPF",  width: 95 },
					{ name: "rg", label : "Documento",  width: 90 },
					{ name: "telefones", label : "Telefone(s)",  width: 140 },
					{ name: "email", label : "Email",  width: 140 },
					{ name:'nascimento', label : "Nascimento", index:'nascimento', width: 90, formatter: 'date', formatoptions: { newformat: 'd/m/Y'}, searchoptions:{sopt:['eq']}},
					{ name: "logradouro", label : "Logradouro",  width: 180 },
					{ name: "numero", label : "Número",  width: 65 },
					{ name: "cidade", label : "Cidade",  width: 100 },
					{ name: "estado", label : "Estado",  width: 100 },
					{ name: "cep", label : "CEP",  width: 80 }
				],
				data: {!! $clientesJson !!}
			,
			guiStyle: "bootstrap",
			iconSet: "fontAwesome",
			idPrefix: "g5_",				
			sortname: "invdate",
			sortorder: "desc",
			threeStateSort: true,
			sortIconsBeforeText: true,
			headertitles: true,
			toppager: true,
			pager: true,
			rowNum: 15,
			shrinkToFit:'false',
			onSelectRow: function(id){
				grid = jQuery('#grid');
				sel_id = grid.jqGrid('getGridParam', 'selrow');
				myCellData = grid.jqGrid('getCell', sel_id, 'id');					
			},
			viewrecords: true,
			searching: {
				defaultSearch: "cn"
			},
			caption: "Pratos"
			}).jqGrid("filterToolbar");
		});		
		function myformatter ( cellvalue, options, rowObject )
		{
			 return cellvalue + ' ' + rowObject.sobrenome;
		}
		//]]>
			
		var myRedirect = function(redirectUrl, arg, value) {
		var form = $('<form action="' + redirectUrl + '" method="get">' +
		'<input type="hidden" name="'+ arg +'" value="' + value + '"></input>' + '</form>');
		$('body').append(form);
		$(form).submit();
		};	
			
		$("#editar").click(function(){ 								
			if (myCellData !== null){
				myRedirect("/clientes/" + myCellData + "/edit", null, null);					
			} else {
				$('#display-success').fadeIn().delay(3000).fadeOut();
			}
		});
		
		
		
		
		$("#deletar").click(function(){ 	
					
			if (myCellData !== null){
				if (!confirm("Confirma a exclusão deste item?")) {
					return false;
				} else {
					var form2 = $('<form action="/clientes/' + myCellData + '" method="POST"> ' +
						' <input type="hidden" name="_token" value="{{ csrf_token() }}"> ' +
						' <input type="hidden" name="_method" value="delete"> ' +
						' <input type="hidden" name="name" value="Apagar"> ' +				
						' </form>');
					$(document.body).append(form2);
					$(form2).submit();
				}
			} else {
				$('#display-success').fadeIn().delay(3000).fadeOut();
			}
			
		});
		
	</script>
@endsection	    