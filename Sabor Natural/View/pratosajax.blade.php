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