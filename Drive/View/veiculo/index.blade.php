@extends('layouts.app')

@section('content')	        
	<h2>Cadastro de Veículos</h2>			
			
		
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
					{ name: "id", label : "Codigo",  width: 70 },
					{ name: "placa", label : "Placa",  width: 150 },
					{ name: "marca", label : "Fabricante",  width: 250 },
					{ name: "modelo", label : "Modelo",  width: 300 },
					{ name: "ano", label : "Ano",  width: 90 }
				],
				data: {!! $veiculosJson !!}
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
				myRedirect("/veiculos/" + myCellData + "/edit", null, null);					
			} else {
				$('#display-success').fadeIn().delay(3000).fadeOut();
			}
		});
		
		
		
		
		$("#deletar").click(function(){ 	
					
			if (myCellData !== null){
				if (!confirm("Confirma a exclusão deste item?")) {
					return false;
				} else {
					var form2 = $('<form action="/veiculos/' + myCellData + '" method="POST"> ' +
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