@extends('layouts.app')

@section('css')    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.15.2/css/ui.jqgrid.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">                
@endsection

@section('content')

<div class="container">
    <h1 >Bem-vindo à área administrativa do portal Sabor Natural</h1>
    <h3 >Escolha uma das opções abaixo para realizar os ajustes desejados:</h3>
    </br>
    </br>


    <div class="row">
        <div class="col-md-3 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Painel administrativo</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-12">
                          <p>                                                        
                            <a href="/pratos" class="btn btn-sq-lg btn-warning">
                                <span class="fa-5x glyphicon glyphicon-apple"></span> </br></br>
                                Pratos
                            </a>            
                            <a href="/usuarios" class="btn btn-sq-lg btn-success">
                                <span class="fa-5x glyphicon glyphicon-user"></span> </br></br>
                                Usuários
                            </a>            
                          </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
