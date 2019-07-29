<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Sabor Natural</title>
        <meta name="description" content="Restaurante Sabor Natural">
        <!-- Estilos -->   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.2/css/ui.jqgrid.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{HTML::style('css/jquery.fancybox-1.3.4.css')}}
		{{HTML::style('css/jquery.bootgrid.min.css')}}
        {{HTML::style('estilos.css')}}
        <!-- Fim dos estilos -->
    </head>

    <body>
        <h1>Página de detalhe</h1>
		<h2>{{ $detailpage->nome }}</h2>
		<p>
			{{ $detailpage->descricao }}
		</p>
		<a href="/usuarios">Voltar</a>
		
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.2/jquery.jqgrid.min.js"></script>
        {{ HTML::script('js/jquery.bootgrid-1.3.1/jquery.bootgrid.min.js') }}		
    </body>
	

</html>