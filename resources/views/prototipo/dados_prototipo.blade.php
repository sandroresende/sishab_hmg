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
        <span id="breadcrumbs-current">Formulário de levantamento de informações</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
    <h2  class="documentFirstHeading text-center">
        Formulário de levantamento de informações
        </h2>
        <span class="documentFirstHeadingSpan">
        Este formulário é destinado aos representantes dos Entes Públicos interessados em participar do projeto "Protótipos de Habitação de Interesse Social", para registro das informações
         sobre as condições do terreno ofertado para o empreendimento.
        </span>   
        <div class="linha-separa"></div>
        
        <div id="content-core">
            
      
            <!-- form-group-->              
            <div class="form-group">
                <div class="titulo">
                    <h5>DADOS DO PROPONENTE </h5>                 
                </div>
                 
                <div class="row">                    
                        <span class="column col-xs-12 col-md-12"><strong style="color:grey">Nome do Chefe do Poder Executivo</strong><small class="text-muted">({{$ente->txt_cargo_executivo}}):</small> {{$ente->txt_nome_chefe_executivo}}</span></br>
                        <span class="column col-xs-12 col-md-12"><strong style="color:grey">Município/UF:</strong>{{$municipio->ds_municipio}}- {{$municipio->txt_sigla_uf}}</span></br>
                        <span class="column col-xs-12 col-md-12"><strong style="color:grey">Gestor ou técnico indicado como ponto focal do projeto</strong></span>                
                        <span class="column col-xs-12 col-md-6"><strong style="color:grey">a. Nome: </strong> {{$usuario->name}}</span></br>
                        <span class="column col-xs-12 col-md-6"><strong style="color:grey">b. Email: </strong>{{$usuario->email}}</span></br>
                        <span class="column col-xs-12 col-md-6"><strong style="color:grey">c. Órgão/lotação: </strong>{{$ente->txt_ente_publico}}</span></br>
                        <span class="column col-xs-12 col-md-6"><strong style="color:grey">d. Cargo/função: </strong>{{$usuario->txt_cargo}}</span></br>                        
                        <span class="column col-xs-12 col-md-6"><strong style="color:grey">e. Telefone fixo: </strong>{{$usuario->txt_ddd_fixo}}-{{$usuario->txt_telefone_fixo}}</span></br>
                        <span class="column col-xs-12 col-md-6"><strong style="color:grey">f. Telefone móvel: </strong>{{$usuario->txt_ddd_movel}}-{{$usuario->txt_telefone_movel}}</span></br>
                </div>        
                <div class="linha-separa"></div>
            </div><!-- form-group--> 
            
            <div class="form-group">
                <div class="titulo">
                    <h5>DADOS DA PROPOSTA </h5>                 
                </div>
                 
                <div class="row">                    
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">Código De Identificação: </strong>{{$prototipo->id}}</span></br>
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">Nome da Proposta: </strong>{{$prototipo->txt_nome_prototipo}}</span></br>
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">Situtação da Proposta: </strong>{{$prototipo->situacaoPrototipo->txt_situacao_prototipo}}</span></br>
                    @if($prototipo->situacao_prototipo_id == 3)
                        <span class="column col-xs-12 col-md-12"><strong style="color:grey">Data Conclusão: </strong>{{date('d/m/Y',strtotime($prototipo->dte_conclusao_preenchimento))}}</span></br>
                    @elseif($prototipo->situacao_prototipo_id == 4)
                        <span class="column col-xs-12 col-md-12"><strong style="color:grey">Data de Finalização: </strong>{{date('d/m/Y',strtotime($prototipo->dte_prototipo_finalizado))}}</span></br>
                    @endif
                </div>        
                <div class="linha-separa"></div>
            </div><!-- form-group--> 

            <div class="form-group">
                <div class="titulo">
                    <h5>CARACTERIZAÇÃO BÁSICA DO TERRENO </h5>   
                                  
                </div>

                <span class="documentFirstHeadingSpan">Nessa seção são solicitadas informações básicas sobre as condições do terreno oferecido para o desenvolvimento do projeto.</span>
                <div class="linha-separa-fina"></div>
                <div class="row">
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">Área do terreno: </strong> {{$caracTerreno->vlr_area_terreno}} m²</span>
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">Titularidade do terreno:</strong>{{$caracTerreno->txt_titularidade_terreno}}</span>
                    @if($caracTerreno->titularidade_terreno_id == 3)
                        <span class="column col-xs-12 col-md-12"><strong style="color:grey">- Terreno registrado em nome de: </strong> {{$caracTerreno->txt_terreno_terceiro}}</span>
                    @endif   
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">Terreno está ocupado:</strong>@if($caracTerreno->bln_terreno_ocupado) Sim @else Não @endif</span>
                    @if($caracTerreno->bln_terreno_ocupado)
                        <span class="column col-xs-12 col-md-12"><strong style="color:grey">- Qual é a ocupação: </strong> {{$caracTerreno->txt_ocupacao}}</span>
                    @endif   
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">O terreno está em área de risco de deslizamento, inundação ou de contaminação?</strong>@if($caracTerreno->txt_terreno_area_risco == 1) Sim @elseif($caracTerreno->txt_terreno_area_risco == 2) Não @else Não Sei @endif</span>
                    @if($caracTerreno->txt_terreno_area_risco == 1)                        
                        <span class="column col-xs-12 col-md-12"><strong style="color:grey">- Qual é o risco: </strong> {{$caracTerreno->txt_tipo_risco}}</span>                    
                    @endif   
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">O terreno encontra-se em Zona Especial de Interesse Social (ZEIS) ou é proveniente de aplicação de medidas de controle de ociosidade?</strong>
                    @if($caracTerreno->bln_terreno_reis_ociosidade) Sim @else Não @endif</span>                   
                    <span class="column col-xs-12 col-md-12"><strong style="color:grey">Registre aqui os comentários ou as observações que considere importantes: </strong></span>                    
                    <span class="column col-xs-12 col-md-12"> {{$caracTerreno->txt_observacao}}</span>                    
                </div>  
               
                <div class="linha-separa"></div>
            </div><!-- form-group-->  
            <div class="form-group">

                <div class="titulo">
                    <h5>INFRAESTRUTURA BÁSICA </h5>                 
                </div>
                <span class="documentFirstHeadingSpan">A seguir solicita-se o registro de informações sobre a disponibilidade de infraestrutura para servir ao terreno ofertado (infraestrutura não incidente).</span>
                <div class="linha-separa-fina"></div>
                <div class="row">
                <span class="column col-xs-12 col-md-12"><strong style="color:grey">- Distância caminhável ou o tempo de deslocamento por transporte público para os seguintes equipamentos e serviços </strong></span>
                </div>
            </div><!-- form-group-->  <div class="form-group">
                <div class="titulo">
                    <h5>4. INSERÇÃO URBANA</h5>                 
                </div>
                <span class="documentFirstHeadingSpan">Nessa seção são solicitadas informações sobre a disponibilidade de equipamentos públicos e serviços urbanos no entorno do terreno disponibilizado para o desenvolvimento do projeto.</span>
                <div class="row">
                </div>    
            </div><!-- form-group-->  
            <div class="form-group">
                <div class="titulo">
                    <h5>5. CONCEPÇÃO DO PROJETO</h5>                 
                </div>
                <span class="documentFirstHeadingSpan">Nessa seção, solicita-se o registro de informações sobre eventual projeto já existente ou pretendido para o terreno em questão.</span>
                <div class="row">
                </div>
            </div><!-- form-group-->  
            <div class="form-group">
                <div class="row">
                    
                        <div class="column col-sm-6 col-xs-12">

                            <input class="btn btn-info btn-lg btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">                       
                        </div>    
                    
                    <div class="column col-sm-6 col-xs-12">                                        
                        <a href='{{ url("/prototipos/usuario/") }}/{{ Auth::user()->id }}' type="submit" class="btn btn-danger btn-lg btn-block">Fechar</a>                    
                    </div>    
                </div>    
            </div><!-- form-group-->  
        </div>



</div><!-- content-->



@endsection
