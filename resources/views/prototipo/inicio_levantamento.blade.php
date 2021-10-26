@extends('layouts.app')

@section('content')

<div class="card-header text-white text-center">
            <strong><h2></h2></strong> 
            <h5></h5>              
          </div>



          <div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
        <a href="{{ url('/prototipo') }}">Página Inicial</a>
        <span class="breadcrumbSeparator">
            &gt;            
        </span>
    </span>
    
    <span dir="ltr" id="breadcrumbs-1">        
    <span >Proposta</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Introdução</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
            {{$prototipo->txt_nome_prototipo}}
        </h2>
        <div class="linha-separa"></div>
        <span class="documentFirstHeadingSpan">
            <h4  class="documentFirstHeading text-center">
                1.	INTRODUÇÃO
                </h4>
        Este formulário é destinado aos representantes dos Entes Públicos interessados em participar do projeto "Protótipos de Habitação de Interesse Social", para registro das informações
         sobre as condições do terreno ofertado para o empreendimento.
        </span>   
        <div class="linha-separa"></div>

       
            <!-- form-group-->              
            <div class="form-group">
               <form action='{{ url("prototipo/iniciar/levantamento/$prototipo->id") }}' method="get">
                    @csrf
                    <div class="well">
                        <div class="box">  
                        <div class="row">
                            <div class="column col-sm-12">
                                <div class="card">
                                <h4 class="card-header">{{$prototipo->txt_nome_prototipo}}</h4>
                                    <div class="card-body">
                                    
                                        <h4 class="card-title">1.1 Nome do Chefe do Poder Executivo ({{$ente->txt_cargo_executivo}})</h4>
                                       <span>{{$ente->txt_nome_chefe_executivo}}</span></br>
                                       <div class="linha-separa"></div>
                                        <h4 class="card-title">1.2 Município/ UF:</h4>
                                       <span>{{$municipio->ds_municipio}}- {{$municipio->txt_sigla_uf}}</span></br>
                                       <div class="linha-separa"></div>
                                        <h4 class="card-title">1.3 Gestor ou técnico indicado como ponto focal do projeto</h4>
                                        <span><strong>Nome: </strong>{{$usuario->name}}</span></br>
                                        <span><strong>Órgão/lotação: </strong>{{$ente->txt_ente_publico}}</span></br>
                                        <span><strong>Cargo/função: </strong>{{$usuario->txt_cargo}}</span></br>
                                        <span><strong>Email: </strong>{{$usuario->email}}</span></br>
                                        @if($usuario->txt_ddd_fixo && $usuario->txt_telefone_fixo)
                                            <span><strong>Telefone fixo: </strong>{{$usuario->txt_ddd_fixo}}-{{$usuario->txt_telefone_fixo}}</span></br>
                                        @endif    
                                        @if($usuario->txt_ddd_movel && $usuario->txt_telefone_movel)
                                            <span><strong>Telefone móvel: </strong>{{$usuario->txt_ddd_movel}}-{{$usuario->txt_telefone_movel}}</span></br>
                                        @endif
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Iniciar Preenchimento</button>     
                                   
                </form> 
              <!--form-group -->
          
          </div>



</div><!-- content-->



@endsection
