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
        {{$prototipo->txt_nome_prototipo}}  <span class="documentFirstHeadingSpan">(id: {{$prototipo->id}} )             </span>
    </h2>

    <span class="documentFirstHeadingSpan">
        {{$municipio->ds_municipio}} - {{$municipio->txt_sigla_uf}}
    </span>   
    <span class="documentFirstHeadingSpan">
        @if($prototipo->situacao_prototipo_id == 3)
            <strong style="color:grey">Data Conclusão: </strong>{{date('d/m/Y',strtotime($prototipo->dte_conclusao_preenchimento))}}
        @elseif($prototipo->situacao_prototipo_id == 4)
            <strong style="color:grey">Data de Finalização: </strong>{{date('d/m/Y',strtotime($prototipo->dte_prototipo_finalizado))}}
        @endif
            
    </span> 
    @if($prototipo->situacao_prototipo_id == 3)
    <div class="alert alert-primary text-center" role="alert">
        CONCLUÍDO
    </div>   
    @elseif($prototipo->situacao_prototipo_id == 4)
    <div class="alert alert-success  text-center" role="alert">
        PROPOSTA ENVIADA
    </div>   
@endif

        <div class="linha-separa"></div>
        
        <div id="content-core">
            
            <div class="form-group">
                <div class="titulo">
                    <h5>Dados do Proponente </h5>                     
                </div>
                <div class="row">
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label ">UF</label>
                        <input id="txt_sigla_uf" type="text" class="form-control" name="txt_sigla_uf" value="{{$municipio->txt_sigla_uf}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label ">Município</label>
                        <input id="ds_municipio" type="text" class="form-control" name="ds_municipio" value="{{$municipio->ds_municipio}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label ">Nome do Chefe do Poder Executivo</label>
                        <input id="txt_nome_chefe_executivo" type="text" class="form-control" name="txt_nome_chefe_executivo" value="{{$ente->txt_nome_chefe_executivo}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label ">Cargo</label>
                        <input id="txt_cargo_executivo" type="text" class="form-control" name="txt_cargo_executivo" value="{{$ente->txt_cargo_executivo}}" disabled>
                    </div>
                </div>   <!-- row-->
                <div class="titulo">
                    <h5>Gestor ou técnico indicado como ponto focal do projeto </h5>                     
                </div>
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label ">Nome</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label ">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{$usuario->email}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label ">Cargo/função</label>
                        <input id="txt_cargo" type="text" class="form-control" name="txt_cargo" value="{{$usuario->txt_cargo}}" disabled>
                    </div> 
                </div>   <!-- row-->        
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label ">Órgão/lotação</label>
                        <input id="txt_ente_publico" type="text" class="form-control" name="txt_ente_publico" value="{{$ente->txt_ente_publico}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label ">Telefone fixo</label>
                        <input id="telefone_fixo" type="text" class="form-control" name="telefone_fixo" value="{{$usuario->txt_ddd_fixo}}-{{$usuario->txt_telefone_fixo}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label ">Telefone móvel</label>
                        <input id="telefone_movel" type="text" class="form-control" name="telefone_movel" value="{{$usuario->txt_ddd_movel}}-{{$usuario->txt_telefone_movel}}" disabled>
                    </div> 
                </div>   <!-- row-->    
            </div>   
            <!-- form-group-->     
            
            

            
            <div class="form-group">
                <div class="titulo">
                    <h5>Registro das informações sobre as condições do terreno ofertado para o empreendimento.</h5>                     
                </div>
                <div id="accordion">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                          <button class="btn btn-outline-primary btn-lg btn-block " data-toggle="collapse" data-target="#collapseCaractTerreno" aria-expanded="true" aria-controls="collapseCaractTerreno">
                            1. Caracterização Básica do Terreno
                          </button>
                        </h5>
                      </div>
                  
                      <div id="collapseCaractTerreno" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <span><strong>Nessa seção são solicitadas informações básicas sobre as condições do terreno oferecido para o desenvolvimento do projeto.</strong></span>
                            <div class="linha-separa"></div>
                            <div class="row">
                                <div class="column col-xs-12 col-md-6">
                                    <div class="media">
                                        
                                        <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$caracTerreno->txt_caminho_doc_cartorio")}}'><i class="fas fa-file-pdf fa-3x"></i></a>                         
                                        <div class="media-body">                                          
                                          <p><strong style="color:grey">1.1 Cópia da documentação registrada em cartório com a comprovação da titularidade do terreno</strong></p>
                                        </div>
                                      </div>
                                </div>
                                <div class="column col-xs-12 col-md-6">
                                    @if($caracTerreno->txt_caminho_dec_interesse)
                                    <div class="media">
                                        <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$caracTerreno->txt_caminho_dec_interesse")}}'><i class="fas fa-file-pdf fa-3x"></i></a>                         
                                        <div class="media-body">                                          
                                          <p><strong style="color:grey">1.2 Declaração demonstrando o interesse dessa em participar da iniciativa, além do tempo estimado para efetivar a doação do terreno</strong></p>
                                        </div>
                                      </div>
                                     @endif 
                                </div> 
                            </div>   <!-- row-->      
                            <div class="row">                                
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label "><strong style="color:grey">1.3 Área do terreno</strong></label>
                                    <input id="vlr_area_terreno" type="text" class="form-control" name="vlr_area_terreno" value="{{$caracTerreno->vlr_area_terreno}} m²" disabled>
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label "><strong style="color:grey">1.4 Titularidade do terreno</strong></label>
                                    <input id="txt_titularidade_terreno" type="text" class="form-control" name="txt_titularidade_terreno" value="{{$caracTerreno->txt_titularidade_terreno}}" disabled>
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    @if($caracTerreno->titularidade_terreno_id == 3)
                                        <label class="control-label ">1.4.1 Terreno registrado em nome de</label>
                                        <input id="txt_terreno_terceiro" type="text" class="form-control" name="txt_terreno_terceiro" value="{{$caracTerreno->txt_terreno_terceiro}}" disabled>
                                    @endif
                                </div>    
                            </div>   <!-- row-->  
                            <div class="row">
                                <div class="column col-xs-12 col-md-2">
                                    <label class="control-label "><strong style="color:grey">1.5 Terreno está ocupado</strong></label>
                                    <input id="terreno_ocupado" type="text" class="form-control" name="terreno_ocupado" value="@if($caracTerreno->bln_terreno_ocupado) Sim @else Não @endif" disabled>
                                </div> 
                                <div class="column col-xs-12 col-md-10">
                                    @if($caracTerreno->bln_terreno_ocupado)
                                        <label class="control-label ">1.5.1 Qual é a ocupação</label>
                                        <input id="bln_terreno_ocupado" type="text" class="form-control" name="bln_terreno_ocupado" value=" {{$caracTerreno->txt_ocupacao}}" disabled>
                                    @endif
                                </div> 
                            </div>   <!-- row-->
                            <div class="row">
                                <div class="column col-xs-12 col-md-8">
                                    <label class="control-label "><strong style="color:grey">1.6 O terreno está em área de risco de deslizamento, inundação ou de contaminação?</strong></label>
                                    <input id="txt_terreno_area_risco" type="text" class="form-control" name="txt_terreno_area_risco" value="@if($caracTerreno->txt_terreno_area_risco == 1) Sim @elseif($caracTerreno->txt_terreno_area_risco == 2) Não @else Não Sei @endif" disabled>
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                    @if($caracTerreno->txt_terreno_area_risco == 1)
                                        <label class="control-label ">1.6.1 Qual é o risco</label>
                                        <input id="txt_tipo_risco" type="text" class="form-control" name="txt_tipo_risco" value=" {{$caracTerreno->txt_tipo_risco}}" disabled>
                                    @endif
                                </div> 
                            </div>   <!-- row--> 
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label "><strong style="color:grey">1.7 O terreno encontra-se em Zona Especial de Interesse Social (ZEIS) ou é proveniente de aplicação de medidas de controle de ociosidade?</strong></label>
                                    <input id="bln_terreno_reis_ociosidade" type="text" class="form-control" name="bln_terreno_reis_ociosidade" value="@if($caracTerreno->bln_terreno_reis_ociosidade) Sim @else Não @endif" disabled>
                                </div> 
                            </div>   <!-- row--> 
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label "><strong style="color:grey">1.8 Comentários ou as observações que considere importantes</strong></label>
                                    <input id="txt_observacao" type="text" class="form-control" name="txt_observacao" value="{{$caracTerreno->txt_observacao}}" disabled>
                                </div> 
                            </div>   <!-- row--> 
                            @if($prototipo->situacao_prototipo_id != 4)
                                <a href='{{ url("/prototipo/caracterizacao_terreno/editar/$caracTerreno->id")}}' type="button" class="btn btn-danger btn-lg btn-block">
                                    Editar - Caracterização Básica do Terreno <i class="fas fa-search"></i>
                                </a>
                            @endif
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                          <button class="btn btn-outline-primary btn-lg btn-block collapsed" data-toggle="collapse" data-target="#collapseInfBasica" aria-expanded="false" aria-controls="collapseInfBasica">
                            2. Infraestrutura Básica
                          </button>
                        </h5>
                      </div>
                      <div id="collapseInfBasica" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <span><strong>A seguir solicita-se o registro de informações sobre a disponibilidade de infraestrutura para servir ao terreno ofertado (infraestrutura não incidente).</strong></span>
                            <div class="linha-separa"></div>
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label "><strong style="color:grey">2.1 Sistemas de infraestrutura básica estão disponíveis no acesso ao terreno (não assinalar obras em andamento)</strong></label>
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxAbastecimentoAgua" value="option1" @if($infraBasica->bln_sistema_abastecimento) checked @endif disabled>
                                                <label class="form-check-label" for="inlineCheckbox1">Sistema de abastecimento de água</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-4">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxEsgoto" value="option2" @if($infraBasica->bln_sistema_coleta_esgoto) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de coleta e destinação de esgoto</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-4">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxAguasPluviais" value="option3" @if($infraBasica->bln_sistema_renagem_ag_pluviais) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Sistema de drenagem de águas pluviais</label>
                                            </div>
                                        </div>  
                                    </div><!-- row--> 
                                    <div class="row">    
                                        <div class="column col-xs-12 col-md-4">  
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxEnergiaEletrica" value="option1" @if($infraBasica->bln_dist_energia_eletrica) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox1">Sistema de distribuição de energia elétrica</label>
                                              </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-4">         
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxIluminacao" value="option2" @if($infraBasica->bln_iluminacao_publica) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de iluminação pública</label>
                                              </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-4">   
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxGuiasSarjetas" value="option3" @if($infraBasica->bln_guias_sarjetas) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Guias e sarjetas</label>
                                              </div>
                                        </div>
                                    </div><!-- row--> 
                                    <div class="row">                                    
                                        <div class="column col-xs-12 col-md-4">       
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxPavimentacao" value="option3" @if($infraBasica->bln_pavimentacao) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Pavimentação</label>
                                              </div>
                                        </div>                                 
                                    </div>   <!-- row-->                                     
                                </div>
                            </div>   <!-- row-->                            
                            <div class="row">
                                <div class="column col-xs-12 col-md-5">
                                    <label class="control-label "><strong style="color:grey">2.2 Existem obras em andamento que servirá ao terreno?</strong></label>
                                    <input id="bln_obras_andamento" type="text" class="form-control" name="bln_obras_andamento" value="@if($infraBasica->bln_obras_andamento) Sim @else Não @endif" disabled>
                                </div> 
                                <div class="column col-xs-12 col-md-7">
                                    @if($infraBasica->bln_obras_andamento)
                                        <label class="control-label ">a. Qual(is) sistema(s)</label>
                                        <input id="txt_sistema_em_obras" type="text" class="form-control" name="txt_sistema_em_obras" value=" {{$infraBasica->txt_sistema_em_obras}}" disabled>
                                    @endif
                                </div> 
                            </div>   <!-- row-->
                            @if($infraBasica->bln_obras_andamento)
                            <div class="row">                                
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label ">b. Origem do recurso</label>
                                    <input id="txt_origem_recurso" type="text" class="form-control" name="txt_origem_recurso" value=" {{$infraBasica->txt_origem_recurso}}" disabled>                                    
                                </div> 
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label ">c. Prazo para o término das obras</label>
                                    <input id="dte_termino_obras" type="text" class="form-control" name="dte_termino_obras" value=" @if($infraBasica->dte_termino_obras)  {{date('d/m/Y',strtotime($infraBasica->dte_termino_obras))}} @endif" disabled>                                    
                                </div> 
                            </div>   <!-- row-->  
                            @endif
                            @if($prototipo->situacao_prototipo_id != 4)
                                <a href='{{ url("/prototipo/infraestruturaBasica/editar/$infraBasica->id")}}' type="button" class="btn btn-danger btn-lg btn-block">
                                    Editar - Infraestrutura Básica <i class="fas fa-search"></i>
                                </a>                                       
                            @endif    
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                          <button class="btn btn-outline-primary btn-lg btn-block  collapsed" data-toggle="collapse" data-target="#collapseInsUrbana" aria-expanded="false" aria-controls="collapseInsUrbana">
                           3. Inserção Urbana
                          </button>
                        </h5>
                      </div>
                      <div id="collapseInsUrbana" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">
                            <span><strong>Nessa seção são solicitadas informações sobre a disponibilidade de equipamentos públicos e serviços urbanos no entorno do terreno disponibilizado para o desenvolvimento do projeto.</strong></span>
                            <div class="linha-separa"></div>
                            <div class="row">
                                <div class="column col-xs-12 col-md-5">
                                    <label class="control-label "><strong style="color:grey">3.1 O Município dispõe de transporte público coletivo?</strong></label>
                                    <input id="bln_transporte_publico_coletivo" type="text" class="form-control" name="bln_transporte_publico_coletivo" value="@if($insercaoUrbana->bln_transporte_publico_coletivo) Sim @else Sei @endif" disabled>
                                </div> 
                            </div>   <!-- row-->    
                            @if($insercaoUrbana->bln_transporte_publico_coletivo)
                                <label class="control-label "><strong style="color:grey">3.2 Se houver transporte público coletivo:</strong></label>
                                <div class="row">
                                        <div class="column col-xs-12 col-md-7">
                                                <label class="control-label ">Distância do ponto ou terminal de embarque e desembarque de passageiros mais próximo</label>
                                                <input id="vlr_distancia_ponto" type="text" class="form-control" name="vlr_distancia_ponto" value=" {{$insercaoUrbana->vlr_distancia_ponto}}" disabled>
                                        </div> 
                                        <div class="column col-xs-12 col-md-5">
                                        
                                            <label class="control-label ">Quantos itinerários estão disponíveis para o ponto mencionado</label>
                                            <input id="num_itinerarios" type="text" class="form-control" name="num_itinerarios" value=" {{$insercaoUrbana->num_itinerarios}}" disabled>
                                        </div> 
                                </div>   <!-- row-->                           
                            @endif    
                            <label class="control-label "><strong style="color:grey">3.3 Informar a distância caminhável ou o tempo de deslocamento por transporte público para os seguintes equipamentos e serviços:</strong></label>
                            @if($insercaoUrbana->bln_equip_esporte_cultura)
                                <label class="control-label ">I.	Equipamentos de esporte, cultura e lazer</label>
                                <div class="row">
                                        <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Qual Equipamento</label>
                                                <input id="txt_equip_esporte_cultura" type="text" class="form-control" name="txt_equip_esporte_cultura" value=" {{$insercaoUrbana->txt_equip_esporte_cultura}}" disabled>
                                        </div> 
                                        <div class="column col-xs-12 col-md-6">
                                        
                                            <label class="control-label ">Distância em metros</label>
                                            <input id="vlr_dist_mts_eq_esp_cult" type="text" class="form-control" name="vlr_dist_mts_eq_esp_cult" value=" {{$insercaoUrbana->vlr_dist_mts_eq_esp_cult}}" disabled>
                                        </div> 
                                </div>   <!-- row-->                           
                            @endif 
                            @if($insercaoUrbana->bln_mercadinho_mercado || $insercaoUrbana->bln_padaria || $insercaoUrbana->bln_farmacia)
                                <label class="control-label ">II. Estabelecimentos de uso cotidiano (distância em metros)</label>                                
                                <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_mercadinho_mercado )
                                                <label class="control-label ">- Mercadinho ou mercearia</label>
                                                <input id="vlr_dist_mts_mercadinho" type="text" class="form-control" name="vlr_dist_mts_mercadinho" value=" {{$insercaoUrbana->vlr_dist_mts_mercadinho}}" disabled>
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_padaria)
                                                <label class="control-label ">- Padaria</label>
                                                <input id="vlr_dist_mts_padaria" type="text" class="form-control" name="vlr_dist_mts_padaria" value=" {{$insercaoUrbana->vlr_dist_mts_padaria}}" disabled>
                                            @endif    
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_farmacia)
                                                <label class="control-label ">-	Farmácia ou Drogaria</label>
                                                <input id="vlr_dist_mts_farmacia" type="text" class="form-control" name="vlr_dist_mts_farmacia" value=" {{$insercaoUrbana->vlr_dist_mts_farmacia}}" disabled>
                                            @endif
                                        </div> 
                                </div>   <!-- row-->                           
                            @endif    
                            @if($insercaoUrbana->bln_supermercado || $insercaoUrbana->bln_agencia_bancaria || $insercaoUrbana->bln_agencia_correios || $insercaoUrbana->bln_centro_comercial || $insercaoUrbana->bln_restaurante_popular)
                                <label class="control-label ">III.	Estabelecimentos de uso eventual (por transporte público)</label>                                
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_supermercado )
                                            <label class="control-label ">- Supermercado</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_supermercado" type="text" class="form-control" name="vlr_dist_mts_supermercado" value=" {{$insercaoUrbana->vlr_dist_mts_supermercado}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_supermercado" type="text" class="form-control" name="num_tempo_min_supermercado" value=" {{$insercaoUrbana->num_tempo_min_supermercado}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_agencia_bancaria )
                                            <label class="control-label ">- Agência bancária</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_ag_bancaria" type="text" class="form-control" name="vlr_dist_mts_ag_bancaria" value=" {{$insercaoUrbana->vlr_dist_mts_ag_bancaria}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_ag_bancaria" type="text" class="form-control" name="num_tempo_min_ag_bancaria" value=" {{$insercaoUrbana->num_tempo_min_ag_bancaria}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_agencia_correios )
                                            <label class="control-label ">- Agência dos correios</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_correios" type="text" class="form-control" name="vlr_dist_mts_correios" value=" {{$insercaoUrbana->vlr_dist_mts_correios}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_correios" type="text" class="form-control" name="num_tempo_min_correios" value=" {{$insercaoUrbana->num_tempo_min_correios}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div>                                         
                                    </div>   <!-- row-->    
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_centro_comercial )
                                            <label class="control-label ">- Centro comercial</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_cent_comerc" type="text" class="form-control" name="vlr_dist_mts_cent_comerc" value=" {{$insercaoUrbana->vlr_dist_mts_cent_comerc}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_cent_comerc" type="text" class="form-control" name="num_tempo_min_cent_comerc" value=" {{$insercaoUrbana->num_tempo_min_cent_comerc}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_restaurante_popular )
                                            <label class="control-label ">- Restaurante popular</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_rest_pop" type="text" class="form-control" name="vlr_dist_mts_rest_pop" value=" {{$insercaoUrbana->vlr_dist_mts_rest_pop}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_rest_pop" type="text" class="form-control" name="num_tempo_min_rest_pop" value=" {{$insercaoUrbana->num_tempo_min_rest_pop}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            
                                        </div>                                         
                                    </div>   <!-- row-->                         
                            @endif  
                                @if($insercaoUrbana->bln_escola_ed_infantil || $insercaoUrbana->bln_escola_ed_fund_ciclo_1 || $insercaoUrbana->bln_escola_ed_fund_ciclo_2 || $bln_escola_ed_fund_ciclo_1->bln_cras || $insercaoUrbana->bln_ubs)
                                <label class="control-label ">IV. Equipamentos Públicos Comunitários (por transporte público)</label>                                                               
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_escola_ed_infantil )
                                            <label class="control-label ">-	Escola pública de educação infantil</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_ed_inf" type="text" class="form-control" name="vlr_dist_mts_ed_inf" value=" {{$insercaoUrbana->vlr_dist_mts_ed_inf}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_ed_inf" type="text" class="form-control" name="num_tempo_min_ed_inf" value=" {{$insercaoUrbana->num_tempo_min_ed_inf}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_escola_ed_fund_ciclo_1 )
                                            <label class="control-label ">- Escola pública de ensino fundamental (ciclo I)</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_ed_fund_c1" type="text" class="form-control" name="vlr_dist_mts_ed_fund_c1" value=" {{$insercaoUrbana->vlr_dist_mts_ed_fund_c1}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_ed_fund_c1" type="text" class="form-control" name="num_tempo_min_ed_fund_c1" value=" {{$insercaoUrbana->num_tempo_min_ed_fund_c1}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_escola_ed_fund_ciclo_2 )
                                            <label class="control-label ">- Escola pública de ensino fundamental (ciclo II)</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_ed_fund_c2" type="text" class="form-control" name="vlr_dist_mts_ed_fund_c2" value=" {{$insercaoUrbana->vlr_dist_mts_ed_fund_c2}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_ed_fund_c2" type="text" class="form-control" name="num_tempo_min_ed_fund_c2" value=" {{$insercaoUrbana->num_tempo_min_ed_fund_c2}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div>                                         
                                    </div>   <!-- row-->    
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_cras )
                                            <label class="control-label ">- Centro de Referência de Assistência Social (CRAS)</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_cras" type="text" class="form-control" name="vlr_dist_mts_cras" value=" {{$insercaoUrbana->vlr_dist_mts_cras}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_cras" type="text" class="form-control" name="num_tempo_min_cras" value=" {{$insercaoUrbana->num_tempo_min_cras}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            @if($insercaoUrbana->bln_ubs )
                                            <label class="control-label ">- Unidade Básica de Saúde (UBS)</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_ubs" type="text" class="form-control" name="vlr_dist_mts_ubs" value=" {{$insercaoUrbana->vlr_dist_mts_ubs}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_ubs" type="text" class="form-control" name="num_tempo_min_ubs" value=" {{$insercaoUrbana->num_tempo_min_ubs}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            @endif
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">                                            
                                        </div>                                         
                                    </div>   <!-- row-->                         
                            @endif    
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <div class="media">
                                        
                                        <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$insercaoUrbana->txt_caminho_mapa")}}'><i class="fas fa-file-pdf fa-3x"></i></a>                         
                                        <div class="media-body">                                          
                                          <p><strong style="color:grey">3.4 Mapa da área com a localização de todos os equipamentos e serviços informados no item anterior</strong></p>
                                        </div>
                                      </div>
                                </div>
                            </div>   <!-- row--> 
                            @if($prototipo->situacao_prototipo_id != 4)
                                <a href='{{ url("/prototipo/insercaoUrbana/editar/$insercaoUrbana->id")}}' type="button" class="btn btn-danger btn-lg btn-block">
                                    Editar - Inserção Urbana <i class="fas fa-search"></i>
                                </a>  
                            @endif    
                        </div>
                      </div>
                    </div>
                  </div>

                  
                  <div class="card">
                    <div class="card-header" id="headingFour">
                      <h5 class="mb-0">
                        <button class="btn btn-outline-primary btn-lg btn-block collapsed" data-toggle="collapse" data-target="#collapseConcProje" aria-expanded="false" aria-controls="collapseConcProje">
                          4. Concepção do Projeto
                        </button>
                      </h5>
                    </div>
                    
                    <div id="collapseConcProje" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                      <div class="card-body">
                    
                        <span><strong>Nessa seção, solicita-se o registro de informações sobre eventual projeto já existente ou pretendido para o terreno em questão.</strong></span>
                        <div class="linha-separa"></div>
                        <div class="row">                                
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label "><strong style="color:grey">4.1 Já foi proposto projeto para a área em questão?</strong></label>
                                <input id="bln_possui_projeto_proposto" type="text" class="form-control" name="bln_possui_projeto_proposto" value="@if($concepcaoProjeto->bln_possui_projeto_proposto) Sim @else Não @endif" disabled>
                            </div> 
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label "><strong style="color:grey">4.2 Qual foi o Ente ou parceiro responsável desenvolvimento do projeto?</strong></label>
                                <input id="txt_nome_parceiro_desenv_projeto" type="text" class="form-control" name="txt_nome_parceiro_desenv_projeto" value="{{$concepcaoProjeto->txt_nome_parceiro_desenv_projeto}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label "><strong style="color:grey">4.3 Quantas unidades habitacionais foram propostas no projeto em questão?</strong></label>
                                <input id="num_unidades_hab_propostas" type="text" class="form-control" name="num_unidades_hab_propostas" value="{{$concepcaoProjeto->num_unidades_hab_propostas}}" disabled>
                            </div>    
                        </div>   <!-- row-->  
                        <div class="row">                                
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label "><strong style="color:grey">4.4 Qual a área das unidades habitacionais propostas, em m2?</strong></label>
                            <input id="vlr_area_uh_m2" type="text" class="form-control" name="vlr_area_uh_m2" value="{{$concepcaoProjeto->vlr_area_uh_m2}} m²" disabled>
                            </div> 
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label "><strong style="color:grey">4.5 Como o empreendimento foi ou pretende-se que seja organizado?</strong></label>
                                <input id="txt_tipo_organizacao" type="text" class="form-control" name="txt_tipo_organizacao" value="{{$concepcaoProjeto->txt_tipo_organizacao}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                @if($concepcaoProjeto->tipo_organizacao_id == 3)
                                    <label class="control-label "><strong style="color:grey">4.6 Caso seja condomínio vertical, quantos pavimentos foram previstos?</strong></label>
                                    <input id="num_pavimentos_cond_vertical" type="text" class="form-control" name="num_pavimentos_cond_vertical" value="{{$concepcaoProjeto->num_pavimentos_cond_vertical}}" disabled>
                                @endif
                            </div>    
                        </div>   <!-- row--> 
                        <div class="row">                                
                            <div class="column col-xs-12 col-md-6">
                                @if($concepcaoProjeto->tipo_organizacao_id >= 3)
                                    <label class="control-label "><strong style="color:grey">4.7 Caso adotado o regime de condomínio, foram previstas estratégias para redução de custos com a administração do condomínio?</strong></label>
                                    <input id="txt_estrategia_reducao_custos_cond" type="text" class="form-control" name="txt_estrategia_reducao_custos_cond" value="{{$concepcaoProjeto->txt_estrategia_reducao_custos_cond}}" disabled>
                                @endif
                            </div>   
                            <div class="column col-xs-12 col-md-6">
                                <label class="control-label "><strong style="color:grey">4.8 Há possibilidade de destinação de lote, edificação ou de cessão de área do condomínio para atividades comerciais?</strong></label>
                            <input id="txt_destinacao_atividade_comercial" type="text" class="form-control" name="txt_destinacao_atividade_comercial" value="@if($concepcaoProjeto->txt_destinacao_atividade_comercial)Sim @elseif($caracTerreno->txt_terreno_area_risco == 2) Não @else Não Sei @endif" disabled>
                            </div> 
                        </div>   <!-- row--> 
                        <div class="row">                                
                            <div class="column col-xs-12 col-md-12">
                                <label class="control-label "><strong style="color:grey">4.9	Registre aqui os comentários ou as observações que considere importantes</strong></label>
                                <textarea id="txt_observacao" class="form-control" name="txt_observacao"  rows="10" disabled>{{$concepcaoProjeto->txt_observacao}}</textarea>
                            </div>                             
                        </div>   <!-- row--> 
                        @if($prototipo->situacao_prototipo_id != 4)
                            <a href='{{ url("/prototipo/concepcaoProjeto/editar/$concepcaoProjeto->id")}}' type="button" class="btn btn-danger btn-lg btn-block">
                                Editar - Inserção Urbana <i class="fas fa-search"></i>
                            </a>  
                        @endif    
                      
                    </div>
                  </div>
                </div>
                
                        
                            
                
            </div><!-- form-group-->  
            <div class="form-group">
                <div class="row">
                    @if($prototipo->situacao_prototipo_id == 3)
                        <div class="column col-sm-6 col-xs-12">
                            <botao-acao-icone  
                                :url="'{{ url("/prototipo/enviar/")}}'" 
                                registro="{{$prototipo->id}}"                               
                                mensagem="Deseja enviar a proposta?" 
                                titulo="Atenção!"
                                txtbotaoconfirma="Sim"
                                txtbotaocancela="Cancelar"
                                cssbotao="btn btn-success btn-lg btn-block"                               
                                cssicone="" 
                                textobotao="Enviar Proposta" 
                            ></botao-acao-icone>
                                                   
                        </div>    
                        <div class="column col-sm-6 col-xs-12">                                        
                            <a href='{{ url("/prototipos/usuario/") }}/{{ Auth::user()->id }}' type="submit" class="btn btn-danger btn-lg btn-block">Fechar</a>                    
                        </div>    
                    @else
                    <div class="column col-sm-12 col-xs-12">                                        
                        <a href='{{ url("/prototipos/usuario/") }}/{{ Auth::user()->id }}' type="submit" class="btn btn-danger btn-lg btn-block">Fechar</a>                    
                    </div>    
                    @endif    
                </div>    
            </div><!-- form-group-->  
        </div>



</div><!-- content-->



@endsection
