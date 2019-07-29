@extends('layouts.app')

@section('css')
	
    {{ HTML::style('vendor/fullcalendar/fullcalendar.min.css') }}
    {{ HTML::style('vendor/fullcalendar/fullcalendar.print.css', array('media' => 'print')) }}

@endsection

@section('content')
	  
	<h2>Agendamentos - Selecione o método de visualização </h2>	

	<div class="col-md-6">
        <!-- Nav tabs -->
        <div class="card">
	        <ul class="nav nav-tabs" role="tablist">
	            <li role="presentation" class="active"><a href="#grid-view" aria-controls="grid-view" role="tab" data-toggle="tab">Grid</a></li>
	            <li role="presentation"><a href="#calendario" aria-controls="calendario" role="tab" data-toggle="tab">Calendário</a></li>
	            
	        </ul>

            <!-- Tab panes -->
            <div class="tab-content">
            	<div role="tabpanel" class="tab-pane active" id="grid-view">
                	<div class="container text-left">

                		</br>		
						<button id="editar" type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
						</br>
						</br>
							
								    
						<table id="grid"></table>

						<div id="display-success">Selecione um registro antes de realizar essa operação!</div>	
						<div id="update-forbidden">Esse registro já está cancelado e não pode mais ser alterado!</div>

						{{ Session::get('message') }}
					    
					        
					</div>	
                </div>
                <div role="tabpanel" class="tab-pane" id="calendario">
                	<div class="container text-left">
						</br>		
                		Selecione a unidade desejada para ver as manutenções agendadas: 
						<select class="locationSelectCalendar form-control" id="locationSelect" name="location"> </select>
						<div id="cidade"> </div>
						</br>	
						</br>
								
						<div id='calendar'></div>

						<div id="eventContent" title="Event Details" style="display:none;">
						    Data: <span id="startTime"></span><br>
						    <p id="eventInfo"></p>
						</div>
						
					</div>
                </div>
            </div>
		</div>
	</div>	
		

@endsection

@section('scripts')        

	<script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.2/jquery.jqgrid.min.js"></script>        
	<script>
		grid = null;
		sel_id = null;
		myCellData = null;
		cancelado = null;
					
		//<![CDATA[
		$(function () {
			"use strict";
			$("#grid").jqGrid({
				colModel: [
					{ name: "id", label : "Código",  width: 70 },
					{ name: "unidade", label : "Unidade",  width: 150 },
					{ name: "cliente", label : "Cliente",  width: 160 },
					{ name: "veiculo", label : "Veículo",  width: 230 },
					{ name:'marcacao', label : "Data", index:'marcacao', width: 120, formatter: 'date', formatoptions: { newformat: 'd/m/Y'}, searchoptions:{sopt:['eq']}},
					{ name: "usuario_cancelamento", label : "Usuário cancelamento",  width: 165 },
					{ name: "motivo_cancelamento", label : "Motivo cancelamento",  width: 180 }
				],
				data: {!! $agendamentosJson !!}
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
				cancelado = grid.jqGrid('getCell', sel_id, 'usuario_cancelamento');		
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
				if (cancelado == ''){
					myRedirect("/agendamentos/" + myCellData + "/edit", null, null);	
				} else {
					$('#update-forbidden').fadeIn().delay(3000).fadeOut();
				}
								
			} else {
				$('#display-success').fadeIn().delay(3000).fadeOut();
			}
		});
		
		$("#inserir").click(function(){ 								
			myRedirect("/agendamentos/create", null, null);				
		});
		
		
		
	</script>
	
	{{ HTML::script('vendor/fullcalendar/lib/moment.min.js') }}
	{{ HTML::script('vendor/fullcalendar/fullcalendar.min.js') }}
	{{ HTML::script('vendor/fullcalendar/locale/pt-br.min.js') }}


	<script>

	  $(document).ready(function() {

	    $('#calendar').fullCalendar({
			monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro',
				'Outubro', 'Novembro', 'Dezembro'],
	        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Aug', 'Set', 'Out', 'Nov', 'Dez'],
	        dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
	        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
	        buttonText: {
	            today:    'Hoje',
	            month:    'Mês',
	            week:     'Semana',
	            day:      'Dia'
	        },
	        header: {
	            left: 'prev,next today',
	            center: 'title',
	            right: 'month,basicWeek,basicDay'
	        },
	        weekNumberTitle: 'S',
	        editable: true,
	        viewRender: function(){
	            $('#preloader').hide();
	        },
			events:  [{!! $calendarioAgendamentosJson !!}],
			eventClick:  function(event, jsEvent, view) {
				$("#startTime").html(moment(event.start).format('DD/MM/YYYY'));
				$("#eventInfo").html(event.title);
				$("#eventContent").dialog({ modal: true, title: 'Informações da manutenção', width:400});
			  }
	    });


	    $('#locationSelect').select2({
				placeholder:"Selecione ou pesquise...",
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
				$.post('http://drive.com:8000/api/obterCalendarioUnidade',{val},function(resultAgendamentosJson){
					
					$('#calendar').fullCalendar( 'removeEvents');

					$('#calendar').fullCalendar( 'addEventSource', resultAgendamentosJson);

					$('#calendar').fullCalendar( 'rerenderEvents' );

					$('#calendar').fullCalendar('refetchEvents');


					
				});
			});

	  });

	</script>

@endsection	    