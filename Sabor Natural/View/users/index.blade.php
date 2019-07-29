@extends('layouts.app')

@section('css')
	
    {{ HTML::style('css/forms.css') }}	
    {{ HTML::style('css/admin.css') }}	
    
@endsection

	

@section('content')

        
	<div class="container">
		<h2>Cadastro de Usuários do Sistema</h2>			

		</br>
		<button id="inserir" type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-plus"></span> Inserir</button>		
		<button id="editar" type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-pencil"></span> Editar</button>
		<button id="deletar" type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove"></span> Apagar</button>
		</br>
		</br>
			
				    
		<table id="grid"></table>
		
		<div id="display-success">Selecione um registro antes de realizar essa operação!</div>
		<div id="update-forbidden">Este usuário não pode ser alterado!</div>

		{{ Session::get('message') }}
	</div>
		
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
					{ name: "email", label : "Email",  width: 350 },
					{ name:'created_at', label : "Data de criação", index:'created_at', width: 130, formatter: 'date', formatoptions: { newformat: 'd/m/Y'}, searchoptions:{sopt:['eq']}},						
					{ name:'updated_at', label : "Última atualização", index:'updated_at', width: 130, formatter: 'date', formatoptions: { newformat: 'd/m/Y'}, searchoptions:{sopt:['eq']}}						
				],
				data: {!! $userjson !!}
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
		
		
		
		$("#deletar").click(function(){ 	
			
			if (myCellData == 1){
				$('#update-forbidden').fadeIn().delay(3000).fadeOut();
				return false;
			}
			
			if (myCellData !== null){
				if (!confirm("Confirma a exclusão deste item?")) {
					return false;
				} else {
					var form2 = $('<form action="/usuarios/' + myCellData + '" method="POST"> ' +
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