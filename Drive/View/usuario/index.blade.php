@extends('layouts.app')


@section('content')

        

	<h2>Cadastro de Usuários do Sistema</h2>			

	</br>
	<button id="inserir" type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Inserir</button>		
	<button id="editar" type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
	</br>
	</br>
		
			    
	<table id="grid"></table>
	
	<div id="display-success">Selecione um registro antes de realizar essa operação!</div>
	<div id="update-forbidden">Este usuário não pode ser alterado!</div>

	{{ Session::get('message') }}

		
@endsection

@section('scripts')    		
	<script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.2/jquery.jqgrid.min.js"></script>        
	{{ HTML::script('js/grid.locale-pt.js') }}
	<script>
		
		grid = null;
		sel_id = null;
		myCellData = null;
		
		//<![CDATA[
		$(function () {
			"use strict";
			$("#grid").jqGrid({
				colModel: [
					{ name: "id", label : "Codigo",  width: 75 },
					{ name: "name", label : "Nome",  width: 250 },
					{ name: "email", label : "Email",  width: 250 },
					{ name: "telefones", label : "Telefone(s)",  width: 250 },
					{ name:'created_at', label : "Data de criação", index:'created_at', width: 130, formatter: 'date', formatoptions: { newformat: 'd/m/Y'}, searchoptions:{sopt:['eq']}},						
					{ name:'updated_at', label : "Última atualização", index:'updated_at', width: 130, formatter: 'date', formatoptions: { newformat: 'd/m/Y'}, searchoptions:{sopt:['eq']}}						
				],
				data: {!! $usuarioJson !!}
			,				
			regional : 'pt',
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
			caption: "Usuários"
			}).jqGrid("filterToolbar");
		});		
	
		//]]>
			
		var myRedirect = function(redirectUrl, arg, value) {
		var form = $('<form action="' + redirectUrl + '" method="get">' +
		'<input type="hidden" name="'+ arg +'" value="' + value + '"></input>' + '</form>');
		$('body').append(form);
		$(form).submit();
		};	
			
		$("#editar").click(function(){ 	
			
			if (myCellData == 1){
				$('#update-forbidden').fadeIn().delay(3000).fadeOut();
				return false;
			}
			
			if (myCellData !== null){
				myRedirect("/usuarios/" + myCellData + "/edit", null, null);					
			} else {
				$('#display-success').fadeIn().delay(3000).fadeOut();
			}
		});
		
		$("#inserir").click(function(){ 								
			myRedirect("/usuarios/create", null, null);				
		});
		
		
		
	</script>
@endsection	    