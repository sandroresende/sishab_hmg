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
    <span >Propostas</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Cadastrar Proposta</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Cadastrar Proposta
        </h2>
        <span class="documentFirstHeadingSpan">
        Este formulário é destinado aos representantes dos Entes Públicos interessados em participar do projeto "Protótipos de Habitação de Interesse Social", para registro das informações
         sobre as condições do terreno ofertado para o empreendimento.
        </span>   
        <div class="linha-separa"></div>
            <!-- form-group-->              
            <div class="form-group">
               <form action="{{ url('prototipo/salvar') }}" method="post">
                    @csrf
                    <div class="well">
                        <div class="box">  
                        <div class="row">
                            <div class="column col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">1.1 Nome do Chefe do Poder Executivo ({{$ente->txt_cargo_executivo}})</h4>
                                       <span>{{$ente->txt_nome_chefe_executivo}}</span></br>
                                       <div class="linha-separa"></div>
                                        <h4 class="card-title">1.2 Município/ UF:</h4>
                                       <span>{{$municipio->ds_municipio}}- {{$municipio->txt_sigla_uf}}</span></br>
                                       <div class="linha-separa"></div>
                                        
                                    
                                        <div class="form-group">
                                            <div class="row">        
                                                <div class="column col-xs-12  col-md-12">
                                                    <label for="name" class="control-label"> <h4 class="card-title">1.3 Nome da Proposta</h4></label>
                                                    <input id="txt_nome_prototipo" type="text" class="form-control" name="txt_nome_prototipo" requered >
                                                </div>
                                           </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Criar Proposta</button>                    
                </form> 
              <!--form-group -->
          
          </div>



</div><!-- content-->



@endsection
