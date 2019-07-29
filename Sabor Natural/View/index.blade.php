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
        {{HTML::style('css/jquery.fancybox-1.3.4.css')}}                       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{HTML::style('estilos.css')}}     
        <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
        <!-- Fim dos estilos -->
    </head>

    <body data-spy="scroll" data-target="#my-navbar">
        <!-- Navbar -->
        <div id="inicio"></div>
        <nav class="navbar navbar-inverse navbar-fixed-top navbar-expand-lg" id="my-navbar">
            <div class="container container-nav">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a href="" class="navbar-brand"><img class="img-responsive logoimg" src="imagens/logobg.png" alt="Sabor Natural"></a>
                </div>            
                <div class="collapse navbar-collapse" id="navbar-collapse">                
                    <ul class="nav navbar-nav ml-auto navbar-right">
                        <li class="active"><a href="#inicio">Home</a></li>
                        <li><a href="#secao-pratos">Pratos</a></li>
                        <li><a href="#avaliacoes">Avaliações</a></li>
                        <li><a href="#estrutura">Estrutura</a></li>
                        <li><a href="#pedidos">Pedidos</a></li>
                        <li><a href="#contato">Contato</a></li>
                    </ul>
                </div>       
            </div>     
        </nav>
        <!-- Fim do navbar -->

        <!-- Header -->        
        <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="6000" id="bs-carousel">           

            <!-- Indicadores -->
            <ol class="carousel-indicators">
                <li data-target="#bs-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#bs-carousel" data-slide-to="1"></li>
                <li data-target="#bs-carousel" data-slide-to="2"></li>
            </ol>

            <!-- Slides -->
            <div class="carousel-inner">
                <div class="item slides active">
                    <div class="slide-1"></div>
                    <div class="hero">
                        <hgroup>
                            <h2>BEM VINDO AO </h3>
                            <h1>SABOR NATURAL</h1>                                    
                        </hgroup>          
                    </div>
                </div>              
                <div class="item slides">
                    <div class="slide-2"></div>
                    <div class="hero"></div>
                </div>
                <div class="item slides">
                    <div class="slide-3"></div>
                    <div class="hero"></div>
                </div>
            </div> 

            <a href="#bs-carousel" class="left carousel-control" data-slide="prev">            
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a href="#bs-carousel" class="right carousel-control" data-slide="next">            
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>

        </div>
        <!-- Fim do header -->

        <div class="loader overlay"> <i id="loadspinner" class="fa fa-spinner fa-spin"> </i></div>
        
        <!-- Pratos-->
        <div id="secao-pratos" class="divider"> </br> </div>
            <!-- Div de controle da paginação -->
            <div id="pratos">    
                <div class="container">
                    <div class="page-header" >
                        <h2>Pratos<small> Confira nosso cardápio</small></h2>
                    </div>
                    <div id="productscontainer" class="products">
                        <div id="products" class="row list-group">
                        

        					@if ($pratos->count())
        			        	@foreach ($pratos as $prato)
    			        		
    							<div class="item  col-xs-4 col-lg-4">
    		                        <div class="thumbnail">
    		                            <a class="fancybox" href="{{ $prato->foto }}">
    		                            <img class="group list-group-image imagem_pratos_icone" src="{{ $prato->foto }}" alt="">
    		                            </a>
    		                            <div class="caption">
    		                                <h4 class="group inner list-group-item-heading">{{ $prato->nome }}</h4>
    		                                <div class="row">
    		                                    <div class="col-xs-12 col-md-6">
    		                                        <p class="lead">
    		                                            {{ 'R$ '.number_format($prato->preco, 2, ',', '.') }}  	
    		                                        </p>
    		                                    </div>
    		                                </div>
    		                            </div>
    		                        </div>
    		                    </div> 
    			        		
    			        	@endforeach

    			        	
    			                                       
                    </div>
                    <div class="center"> {{ $pratos->links() }} </div>

                        @else
                            <p></br></p>
                        @endif
                </div>
            </div>        
        </div>
        <!-- Fim dos Pratos-->

        <!-- Avaliações-->
        <div class="divider" id="avaliacoes"></br>
            <div class="container">
                <section>
                    <div class="page-header">
                        <h2>Avaliações<small> Espaço reservado para as opiniões dos clientes</small></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <blockquote>
                                <p>Almoçar no Sabor Natural foi uma excelente e agradável experiência, eu e minha família fomos bem atendidos desde a chegada até a saída. A comida, que foi servida com uma rapidez exemplar, estava deliciosa e quentinha e com certeza iremos retornar.</p>
                                <footer>Augusto Moraes</footer>
                            </blockquote>
                        </div>
                        <div class="col-md-4">
                            <blockquote>
                                <p>O Sabor Natural é parada certa para mim durante os almoços de segunda à sexta. Saio da faculdade em direção ao estágio e é importante que me alimente de forma saudável e satisfatória. Recomendo à todos que experimentem os pratos deste restaurante.</p>
                                <footer>Renata Assunção</footer>
                            </blockquote>
                        </div>
                        <div class="col-md-4">
                            <blockquote>
                                <p>Somos clientes do Restaurante há algum tempo, é possível dizer, inclusive, que após termos formado a parceria para que o Sabor Natural fornecesse a alimentação da empresa houve aumento na satisfação e qualidade no ambiente de trabalho.</p>
                                <footer>Carlos Alfredo Jr.</footer>
                            </blockquote>
                        </div>
                    </div>                
                </section>
            </div>
        </div>
        <!--Fim das Avaliações-->

        <!-- Estrutura -->
        <div class="divider" id="estrutura"></br>
            <div class="container">
                <section>
                    <div class="page-header">
                        <h2>Estrutura<small> Conheça o nosso espaço</small></h2>
                    </div>
                    <!-- Carousel -->
                    <div class="carousel slide" id="screenshot-carousel" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#screenshot-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#screenshot-carousel" data-slide-to="1"></li>
                            <li data-target="#screenshot-carousel" data-slide-to="2"></li>
                            <li data-target="#screenshot-carousel" data-slide-to="3"></li>
                            <li data-target="#screenshot-carousel" data-slide-to="4"></li>
                        </ol>                    
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="imagens/espaco1.jpg" alt="Text of the image">              
                            </div>
                            <div class="item">
                                <img src="imagens/espaco2.jpg" alt="Text of the image">      
                            </div>
                            <div class="item">
                                <img src="imagens/espaco3.jpg" alt="Text of the image">
                            </div>
                            <div class="item">
                                <img src="imagens/espaco4.jpg" alt="Text of the image">
                            </div>
                            <div class="item">
                                <img src="imagens/espaco5.jpg" alt="Text of the image">
                            </div>
                        </div>                    
                        <a href="#screenshot-carousel" class="left carousel-control" data-slide="prev">            
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a href="#screenshot-carousel" class="right carousel-control" data-slide="next">            
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                    <!-- Fim do Carousel -->
                </section>
            </div>
        </div>
        <!--Fim da Estrutura-->

        <!-- Pedidos -->
        <div class="divider" id="pedidos"></br>
            <div class="container">
                <section>
                    <div class="page-header">
                        <h2>Pedidos<small> Peça seu prato online</small></h2>
                    </div>                
                    <h3>O serviço de delivery funciona de segunda a sábado de 11:00 às 22:00 em toda grande BH.</h3>
                    </br>
                    <div class="row">
                        <div class="col-sm-2">
                            <h4>Peça pelo:</h4>
                            </br>                                                    
                            <a href="https://www.ifood.com.br/delivery/belo-horizonte-mg/sabornatural">
                                <img src="imagens/logo_ifood.png" class="img-responsive" alt="image">
                            </a>
                        </div>
                                              
                    </div>                
                </section>
            </div>
        </div>
        <!-- Fim dos Pedidos -->

        <!-- Contato -->
        <div class="divider" id="contato"></br>
            <div class="container">
                <section>
                    <div class="page-header">
                        <h2>Contato</h2>
                    </div>                
                    <div class="row">
                        <div class="col-lg-4">
                            <p>Envie sua mensagem, logo responderemos</p>
                            <address>
                                <strong>Sabor Natural Ltda.</strong></br>
                                Rua Sergipe, 1045 - Savassi</br>              
                                Belo Horizonte - MG</br>
                                (31) 3211-1245
                            </address>
                        </div>
                        <div class="col-lg-8">
                            <form action="/contato/enviar" class="form-horizontal">
                                <div class="form-group">
                                    <label for="nome" class="col-lg-2 control-label">Nome</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome" value="{{ Session::get('nome') }}">
                                        {{ ($errors->has('nome')) ? $errors->first('nome') : '' }}
                                    </div>
                                    
                                </div>                            
                                <div class="form-group">
                                    <label for="email" class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ Session::get('email') }}">
                                        {{ ($errors->has('email')) ? $errors->first('email') : '' }}
                                    </div>
                                    
                                </div>                            
                                <div class="form-group">
                                    <label for="mensagem" class="col-lg-2 control-label">Mensagem</label>
                                    <div class="col-lg-10">
                                        <textarea name="mensagem" id="mensagem" class="form-control" 
                                            cols="20" rows="10" placeholder="Mensagem">{{ Session::get('mensagem') }}</textarea>
                                        {{ ($errors->has('mensagem')) ? $errors->first('mensagem') : '' }}
                                    </div>
                                    
                                </div>                            
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>                
                    {{ Session::get('message') }}
                </section>
            </div>
        </div>
        <!-- Fim do Contato -->

        <!-- Rodapé -->
        <footer>
            <hr>
            <div class="container text-center">
                <h3>Inscreva-se para receber nossas novidades e ofertas</h3>
                <form action="" class="form-inline">
                    <div class="form-group">
                        <label for="subscription">Nome</label>
                        <input type="text" class="form-control" id="subscription" placeholder="Seu nome">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Seu email">
                    </div>
                    <button type="submit" class="btn btn-default">Inscrever</button>
                </form>
                <hr>
                <ul class="list-inline">
                    <li><a href="http://www.twitter.com/">Twitter</a></li>
                    <li><a href="http://www.facebook.com/">Facebook</a></li>
                    <li><a href="http://www.youtube.com/">YouTube</a></li>
                    <li><a href="/admin">Admin</a></li>
                </ul>
                <p>&copy; Copyright @ 2018 <br> Desenvolvido por Mateus Getulio Vieira</p>
            </div>            
        </footer>
        <!--Fim do Rodapé -->

        <!--Scripts -->
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>               
        {{ HTML::script('js/fancybox/jquery.mousewheel-3.0.4.pack.js') }}
        {{ HTML::script('js/fancybox/jquery.easing-1.3.pack.js') }}
        {{ HTML::script('js/fancybox/jquery.fancybox-1.3.4.pack.js') }}
        {{ HTML::script('js/fancybox/jquery.fancybox-1.3.4.js') }}
        {{ HTML::script('js/scripts.js') }}
        <!--Fim dos Scripts -->
    </body>
</html>