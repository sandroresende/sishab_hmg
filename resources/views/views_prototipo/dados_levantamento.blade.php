@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            :url="'{{ url('/home') }}'"
            :titulo1="'Protótipo de HIS'"
            :titulo2='"Minhas Propostas"'
            :link2="'{{ url('/propostas') }}'"
            :titulo4='"Formulário de levantamento de informações"'
            

            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'{{$prototipo->txt_nome_prototipo}} (id: {{$prototipo->id}} )'"
                    subtitulo1=" {{$municipio->ds_municipio}} - {{$municipio->txt_sigla_uf}}"
                    @if($prototipo->situacao_prototipo_id == 3)
                        subtitulo2="Data Conclusão: {{date('d/m/Y',strtotime($prototipo->dte_conclusao_preenchimento))}}"                    
                    @elseif($prototipo->situacao_prototipo_id == 4)
                        subtitulo2="Data de Finalização: {{date('d/m/Y',strtotime($prototipo->dte_prototipo_finalizado))}}"                        
                    @endif
                    :dataatualizacao="'{{date('d/m/Y',strtotime($prototipo->updated_at))}}'"
                    :linkcompartilhar="'{{ url("/admin/prototipo/show/levantamento/$prototipo->id") }}'"
                    :barracompartilhar="true">

                    @if($prototipo->situacao_prototipo_id == 3)
                        <div class="alert alert-primary text-center" role="alert">
                            <h3>CONCLUÍDO</h3>
                        </div>   
                    @elseif($prototipo->situacao_prototipo_id == 4)
                        <div class="alert alert-success  text-center" role="alert">
                            <h3>PROPOSTA ENVIADA</h3>
                        </div>   
                    @elseif($prototipo->situacao_prototipo_id >=6)
                        <span class="documentFirstHeadingSpan">
                            <strong style="color:grey">Data Habilitação: </strong>{{date('d/m/Y',strtotime($habilitacao->dte_habilitacao))}}
                        </span> 
                            @if($habilitacao->bln_habilitada)
                                <div class="alert alert-success  text-center" role="alert">
                                    <h3>PROPOSTA HABILITADA</h3>
                                </div>   
                                @if($prototipo->num_pontuacao_total)
                                    <div class="alert alert-info text-center" role="alert">
                                        <strong style="color:grey"> Pontuação Total: </strong>{{$prototipo->num_pontuacao_total}} pontos <a  href="#collapsePontuacao" class="text-reset"><i class="fas fa-search text-reset"></i></a>
                                    </div>
                                @endif    
                             @else
                                <div class="alert alert-primary text-center" role="alert">
                                    <h3>PROPOSTA DESABILITADA</h3>
                                </div>           
                            @endif
                    @endif
            </cabecalho-form> 
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
                <div class="row">                    
                    <div class="column col-xs-12 col-md-12">
                        <label class="control-label ">Órgão responsável pela Proposta</label>
                        <input id="txt_orgao_responsavel" type="text" class="form-control" name="txt_orgao_responsavel" value="{{$ente->txt_orgao_responsavel}}" disabled>
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
                                <div class="column col-xs-12 col-md-12">
                                    <div class="media">
                                        
                                        
                                        <div class="media-body">                                          
                                            <label class="control-label ">1.1 Cópia da documentação registrada em cartório com a comprovação da titularidade do terreno</label>
                                        </div>
                                        <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$caracTerreno->txt_caminho_doc_cartorio")}}'><i class="fas fa-file-image fa-2x"></i></a>                         
                                      </div>
                                </div>
                            </div> 
                            <!-- row-->  
                                <!--
                                <div class="column col-xs-12 col-md-6">
                                    @if($caracTerreno->txt_caminho_dec_interesse)
                                    <div class="media">
                                        <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$caracTerreno->txt_caminho_dec_interesse")}}'><i class="fas fa-file-image fa-2x"></i></a>                         
                                        <div class="media-body">                                          
                                          <p><strong style="color:grey">1.2 Declaração demonstrando o interesse dessa em participar da iniciativa, além do tempo estimado para efetivar a doação do terreno</strong></p>
                                        </div>
                                      </div>
                                     @endif 
                                </div> 
                              
                        -->
                       
                            <div class="row">                                
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label ">1.2 Quais as coordenadas geográficas do terreno (centro do terreno)?</label>
                                    <input id="vlr_coordenadas_terreno" type="text" class="form-control" name="vlr_coordenadas_terreno" value="{{$caracTerreno->vlr_coordenadas_terreno}}" disabled>
                                </div>
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label ">1.3 Qual a área do terreno em m²?</label>
                                    <input id="vlr_area_terreno" type="text" class="form-control" name="vlr_area_terreno" value="{{$caracTerreno->vlr_area_terreno}} m²" disabled>
                                </div> 
                            </div>                           
                            <!-- row-->      
                            <div class="row"> 
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">1.4 Quem é o proprietário do terreno?</label>
                                    <input id="txt_proprietario_terreno" type="text" class="form-control" name="txt_proprietario_terreno" value="{{$caracTerreno->txt_proprietario_terreno}}" disabled>
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">1.5 Situação da titularidade do terreno?</label>
                                    <input id="txt_titularidade_terreno" type="text" class="form-control" name="txt_titularidade_terreno" value="{{$caracTerreno->txt_titularidade_terreno}}" disabled>
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    @if($caracTerreno->titularidade_terreno_id == 3)
                                        <label class="control-label ">1.5.1 Terreno registrado em nome de</label>
                                        <input id="txt_terreno_terceiro" type="text" class="form-control" name="txt_terreno_terceiro" value="{{$caracTerreno->txt_terreno_terceiro}}" disabled>
                                    @endif
                                </div>    
                            </div>   <!-- row-->  
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">1.6 O terreno já foi parcelado ou desmembrado?</label>
                                    <input id="bln_terreno_parcelado" type="text" class="form-control" name="bln_terreno_parcelado" value="@if($caracTerreno->bln_terreno_parcelado) Sim @else Não @endif" disabled>
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">1.7 Terreno está ocupado?</label>
                                    <input id="terreno_ocupado" type="text" class="form-control" name="terreno_ocupado" value="@if($caracTerreno->bln_terreno_ocupado) Sim @else Não @endif" disabled>
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                    @if($caracTerreno->bln_terreno_ocupado)
                                        <label class="control-label ">1.7.1 Qual é a ocupação?</label>
                                        <input id="bln_terreno_ocupado" type="text" class="form-control" name="bln_terreno_ocupado" value=" {{$caracTerreno->txt_ocupacao}}" disabled>
                                    @endif
                                </div> 
                            </div>   <!-- row-->
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    @if($caracTerreno->txt_caminho_dec_reassent)
                                    <div class="media">
                                        
                                        <div class="media-body">                                          
                                        <label class="control-label ">1.7.2 Declaração assinada pelo chefe do poder executivo comprometendo-se a elaborar e executar plano de reassentamento e de medidas 
                                                                compensatórias, cujo cronograma de remoção das famílias seja prévio ao início de obras do empreendimento habitacional</label>
                                        </div>
                                        <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$caracTerreno->txt_caminho_dec_reassent")}}'><i class="fas fa-file-image fa-2x"></i></a>                         
                                    </div>
                                    @endif 
                                </div> 
                            </div>   <!-- row-->    
                            <div class="row">
                                <div class="column col-xs-12 col-md-8">
                                    <label class="control-label ">1.8 O terreno terreno está em área de risco de deslizamento, inundação, contaminação ou processos geológicos ou hidrológicos correlatos?</label>
                                    <input id="txt_terreno_area_risco" type="text" class="form-control" name="txt_terreno_area_risco" value="@if($caracTerreno->txt_terreno_area_risco == 1) Sim @elseif($caracTerreno->txt_terreno_area_risco == 0) Não @else Não Sei @endif" disabled>
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                    @if($caracTerreno->txt_terreno_area_risco == 1)
                                        <label class="control-label ">1.8.1 Qual é o risco</label>
                                        <input id="txt_tipo_risco" type="text" class="form-control" name="txt_tipo_risco" value=" {{$caracTerreno->txt_tipo_risco}}" disabled>
                                    @endif
                                </div> 
                            </div>   <!-- row--> 
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label ">1.9 O terreno encontra-se em Zona Especial de Interesse Social (ZEIS) ou é proveniente de aplicação de medidas de controle de ociosidade?</label>
                                    <input id="bln_terreno_zeis_ociosidade" type="text" class="form-control" name="bln_terreno_zeis_ociosidade" value="@if($caracTerreno->bln_terreno_zeis_ociosidade) Sim @else Não @endif" disabled>
                                </div> 
                                <div class="column col-xs-12 col-md-12">
                                    @if($caracTerreno->bln_terreno_zeis_ociosidade == 1)
                                        <label class="control-label ">1.9.1 Legislação e artigo(s) pertinente(s):</label>
                                        <input id="txt_legislacao_zeis" type="text" class="form-control" name="txt_legislacao_zeis" value=" {{$caracTerreno->txt_legislacao_zeis}}" disabled>
                                    @endif
                                </div>
                            </div>   <!-- row--> 
                           
                            
                            <div class="row" >        
                                <label for="situacao_terreno">1.10 Situação do terreno proposto:</label>   
                               
                                <div class="column col-xs-12 col-md-12">
                                    @foreach($situacaoTerreno as $dados)
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                   type="radio" 
                                                   name="exampleRadios" 
                                                   id="exampleRadios{{$dados->id}}" 
                                                   value="{{$dados->id}}"                                                   
                                                   @if($caracTerreno->situacao_terreno_id == $dados->id) checked @endif
                                                   disabled
                                            >
                                            @if($dados->id != 99)
                                                <label class="form-check-label" for="exampleRadios{{$dados->id}}">{{$dados->txt_situacao_terreno}}</label>
                                            @else
                                            <div class="column col-xs-12 col-md-12">
                                                <label class="form-check-label form-inline" for="exampleRadios1">
                                                    {{$dados->txt_situacao_terreno}} 
                                                    @if($dados->id == 99)
                                                        : {{$caracTerreno->txt_outra_situacao_terreno}}
                                                    @endif
                                                </label>
                                            </div> 
                                            @endif
                                        </div>
                                            @endforeach
                                    
                                </div>             
                              
                                <div class="column col-xs-12 col-md-12">
                                    <label for="origem_recurso">1.10.1 Indicar legislação e artigo(s) pertinente(s): </label>   
                                    <textarea  class="form-control" id="txt_legislacao_artigos" name="txt_legislacao_artigos"  rows="3" disabled>{{$caracTerreno->txt_legislacao_artigos}}</textarea>
                                    
                                </div>       
                            </div>

                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                                                            
                                          <label class="control-label ">1.11 Planta do terreno com indicação das coordenadas geográficas</label>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome do Arquivo</th>
                                                    <th>Arquivo</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($plantaTerreno as $dados)
                                                        <tr>
                                                            <td >{{$dados->id}}</td>
                                                            <td>{{$dados->txt_nome_arquivo}}</td>
                                                            <td><a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->txt_caminho_planta")}}'><i class="fas fa-file-image fa-2x"></i></a></td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>

                                </div>
                            </div>   <!-- row--> 

                            
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label ">1.12 Comentários ou as observações que considere importantes</label>
                                    <textarea  class="form-control" id="txt_observacao" name="txt_observacao"  rows="3" disabled>{{$caracTerreno->txt_observacao}}</textarea>
                                    
                                </div> 
                            </div>   <!-- row--> 
                           
                            @if($prototipo->situacao_prototipo_id != 4)
                            <div class="form-group">
                                <div class="row">
                                    <div class="column col-sm-12 col-xs-12">
                                        <botao-acao  
                                            :url="'{{ url("/prototipo/caracterizacao_terreno/editar")}}'" 
                                            registro="{{$caracTerreno->id}}"                               
                                            cssbotao="btn btn-lg btn-danger btn-block"                               
                                            textobotao="Editar - Caracterização Básica do Terreno" 
                                            tipobotao="button-danger"
                                        ></botao-acao>  
                                    </div>    
                                </div>    
                            </div><!-- form-group-->  
                                
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
                                    <label class="control-label ">2.1 Sistemas de infraestrutura básica estão disponíveis no acesso ao terreno (não assinalar obras em andamento)</label>
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxAbastecimentoAgua" value="option1" @if($infraBasica->bln_sistema_abastecimento) checked @endif disabled>
                                                <label class="form-check-label" for="inlineCheckbox1">Sistema de abastecimento de água</label>
                                            </div>
                                        </div>
                                        <div class="column col-xs-12 col-md-12">          
                                            @if($infraBasica->bln_sistema_abastecimento)

                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_abast" value="{{$infraBasica->vlr_dist_sis_abast}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                @endif
                                        </div>
                                        
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxEsgoto" value="option2" @if($infraBasica->bln_sistema_coleta_esgoto) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de coleta e destinação de esgoto</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                            @if($infraBasica->bln_sistema_coleta_esgoto)

                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_coleta" value="{{$infraBasica->vlr_dist_sis_coleta}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                @endif
                                        </div>
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxLixo" value="option2" @if($infraBasica->bln_sistema_coleta_lixo) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de coleta e destinação de lixo</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                            @if($infraBasica->bln_sistema_coleta_lixo)

                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_coleta_lixo" value="{{$infraBasica->vlr_dist_sis_coleta_lixo}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                @endif
                                        </div>
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxAguasPluviais" value="option3" @if($infraBasica->bln_sistema_renagem_ag_pluviais) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Sistema de drenagem de águas pluviais</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                            @if($infraBasica->bln_sistema_renagem_ag_pluviais)

                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_dren_ag_pluv" value="{{$infraBasica->vlr_dist_sis_dren_ag_pluv}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                @endif
                                        </div>
                                      
                                        <div class="column col-xs-12 col-md-12">  
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxEnergiaEletrica" value="option1" @if($infraBasica->bln_dist_energia_eletrica) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox1">Sistema de distribuição de energia elétrica</label>
                                              </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                            @if($infraBasica->bln_dist_energia_eletrica)

                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_dist_ener_elet" value="{{$infraBasica->vlr_dist_sis_dist_ener_elet}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                @endif
                                        </div>
                                        <div class="column col-xs-12 col-md-12">         
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxIluminacao" value="option2" @if($infraBasica->bln_iluminacao_publica) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de iluminação pública</label>
                                              </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                            @if($infraBasica->bln_iluminacao_publica)

                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_ilum_pub" value="{{$infraBasica->vlr_dist_sis_ilum_pub}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                @endif
                                        </div>
                                        <div class="column col-xs-12 col-md-12">   
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxGuiasSarjetas" value="option3" @if($infraBasica->bln_guias_sarjetas) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Guias e sarjetas</label>
                                              </div>
                                        </div>
                                        <div class="column col-xs-12 col-md-12">          
                                            @if($infraBasica->bln_guias_sarjetas)

                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_guias_sarj" value="{{$infraBasica->vlr_dist_sis_guias_sarj}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                @endif
                                        </div>
                                                                       
                                        <div class="column col-xs-12 col-md-12">       
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxPavimentacao" value="option3" @if($infraBasica->bln_pavimentacao) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Pavimentação</label>
                                              </div>
                                        </div>   
                                        <div class="column col-xs-12 col-md-12">          
                                            @if($infraBasica->bln_pavimentacao)

                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_pavim" value="{{$infraBasica->vlr_dist_sis_pavim}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                @endif
                                        </div>                              
                                    </div>   <!-- row-->                                     
                                </div>
                            </div>   <!-- row-->                            
                            
                           
                            
                            @if($prototipo->situacao_prototipo_id != 4)
                            <div class="form-group">
                                <div class="row">
                                    <div class="column col-sm-12 col-xs-12">
                                        <botao-acao  
                                            :url="'{{ url("/prototipo/infraestruturaBasica/editar")}}'" 
                                            registro="{{$infraBasica->id}}"                               
                                            cssbotao="btn btn-lg btn-danger btn-block"                               
                                            textobotao="Editar - Infraestrutura Básica" 
                                            tipobotao="button-danger"
                                        ></botao-acao>  
                                    </div>    
                                </div>    
                            </div><!-- form-group-->  
                                
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
                                    <input id="bln_transporte_publico_coletivo" type="text" class="form-control" name="bln_transporte_publico_coletivo" value="@if($insercaoUrbana->bln_transporte_publico_coletivo) Sim @else Não @endif" disabled>
                                </div> 
                            </div>   <!-- row-->    
                            @if($insercaoUrbana->bln_transporte_publico_coletivo)
                                <label class="control-label "><strong style="color:grey">3.1.1 Se houver transporte público coletivo:</strong></label>
                                <div class="row">
                                        <div class="column col-xs-12 col-md-7">
                                                <label class="control-label ">a) Distância caminhável, em metros, do ponto ou terminal de embarque e desembarque de passageiros mais próximo ao terreno</label>
                                                <input id="vlr_distancia_ponto" type="text" class="form-control" name="vlr_distancia_ponto" value=" {{$insercaoUrbana->vlr_distancia_ponto}}" disabled>
                                        </div> 
                                        <div class="column col-xs-12 col-md-5">
                                        
                                            <label class="control-label ">b) Quantos itinerários estão disponíveis para o ponto mencionado</label>
                                            <input id="num_itinerarios" type="text" class="form-control" name="num_itinerarios" value=" {{$insercaoUrbana->num_itinerarios}}" disabled>
                                        </div> 
                                </div>   <!-- row-->                           
                            @endif    
                            <label class="control-label "><strong style="color:grey">3.2 Informar a distância caminhável ou o tempo de deslocamento por transporte público para os seguintes equipamentos e serviços:</strong></label>
                            
                                <label class="control-label ">I. Estabelecimentos de uso cotidiano (distância caminhável em metros)
                                    @if(!$insercaoUrbana->bln_mercadinho_mercado && !$insercaoUrbana->bln_padaria && !$insercaoUrbana->bln_farmacia ) <span class="text-danger">(Não possui)</span>@endif                                    </label>                                
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
                            
                            
                                <label class="control-label ">II.	Estabelecimentos de uso eventual (Distância Caminhável)</label>                                
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            
                                            <label class="control-label ">- Supermercado @if(!$insercaoUrbana->bln_supermercado ) <span class="text-danger">(Não possui)</span> @endif</label>
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
                                           
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            
                                            <label class="control-label ">- Agência bancária @if(!$insercaoUrbana->bln_agencia_bancaria ) <span class="text-danger">(Não possui)</span> @endif</label>
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
                                          
                                        </div> 
                                        
                                        <div class="column col-xs-12 col-md-4">
                                            
                                            <label class="control-label ">- Lotérica @if(!$insercaoUrbana->bln_loterica ) <span class="text-danger">(Não possui)</span> @endif</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_loterica" type="text" class="form-control" name="vlr_dist_mts_loterica" value=" {{$insercaoUrbana->vlr_dist_mts_loterica}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_loterica" type="text" class="form-control" name="num_tempo_min_loterica" value=" {{$insercaoUrbana->num_tempo_min_loterica}}" disabled>
                                                    </div>    
                                            </div>   <!-- row-->   
                                        </div>                                         
                                    </div>   <!-- row-->    
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label ">- Agência dos correios @if(!$insercaoUrbana->bln_agencia_correios ) <span class="text-danger">(Não possui)</span> @endif</label>
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
                                           
                                         </div> 
                                        <div class="column col-xs-12 col-md-4">  
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                        </div>                                         
                                    </div>   <!-- row-->                         
                            

                                
                                <label class="control-label ">III. Equipamentos Públicos Comunitários</label>                                                               
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            
                                            <label class="control-label ">-	Escola pública de educação infantil @if(!$insercaoUrbana->bln_escola_ed_infantil ) <span class="text-danger">(Não possui)</span> @endif</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_ed_inf" type="text" class="form-control" name="vlr_dist_mts_ed_inf" value=" {{$insercaoUrbana->vlr_dist_mts_ed_inf}}" disabled>
                                                    </div>    

                                                    <div class="column col-xs-12 col-md-6">
                                                    <!--
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_ed_inf" type="text" class="form-control" name="num_tempo_min_ed_inf" value=" {{$insercaoUrbana->num_tempo_min_ed_inf}}" disabled>
                                                    -->
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            
                                            <label class="control-label ">- Escola pública de ensino fundamental (ciclo I) @if(!$insercaoUrbana->bln_escola_ed_fund_ciclo_1 ) <span class="text-danger">(Não possui)</span> @endif</label>
                                            <div class="row">
                                                
                                                    <div class="column col-xs-12 col-md-6">
                                                        <label class="control-label ">Distância</label>
                                                        <input id="vlr_dist_mts_ed_fund_c1" type="text" class="form-control" name="vlr_dist_mts_ed_fund_c1" value=" {{$insercaoUrbana->vlr_dist_mts_ed_fund_c1}}" disabled>
                                                    </div>    
                                                    <div class="column col-xs-12 col-md-6">
                                                        <!--
                                                        <label class="control-label ">Tempo</label>
                                                        <input id="num_tempo_min_ed_fund_c1" type="text" class="form-control" name="num_tempo_min_ed_fund_c1" value=" {{$insercaoUrbana->num_tempo_min_ed_fund_c1}}" disabled>
                                                        -->    
                                                    </div>    
                                            </div>   <!-- row-->                           
                                            
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            
                                            <label class="control-label ">- Escola pública de ensino fundamental (ciclo II) @if(!$insercaoUrbana->bln_escola_ed_fund_ciclo_2 ) <span class="text-danger">(Não possui)</span> @endif</label>
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
                                            
                                        </div>                                         
                                    </div>   <!-- row-->    
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-4">
                                            
                                            <label class="control-label ">- Centro de Referência de Assistência Social (CRAS) @if(!$insercaoUrbana->bln_cras ) <span class="text-danger">(Não possui)</span> @endif</label>
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
                                            
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            
                                            <label class="control-label ">- Unidade Básica de Saúde (UBS) @if(!$insercaoUrbana->bln_ubs ) <span class="text-danger">(Não possui)</span> @endif</label>
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
                                            
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">                                            
                                        </div>                                         
                                    </div>   <!-- row-->    
                                <label class="control-label ">IV.	Equipamentos de esporte, cultura e lazer @if(!$insercaoUrbana->bln_equip_esporte_cultura )<span class="text-danger">(Não possui)</span>@endif </label>
                                <div class="row">
                                    @if($insercaoUrbana->bln_equip_esporte_cultura )
                                        <div class="column col-xs-12 col-md-6">
                                            <label class="control-label ">Qual Equipamento</label>
                                            <input id="txt_equip_esporte_cultura" type="text" class="form-control" name="txt_equip_esporte_cultura" value=" {{$insercaoUrbana->txt_equip_esporte_cultura}}" disabled>
                                        </div> 
                                        <div class="column col-xs-12 col-md-6">                                        
                                            <label class="control-label ">Distância em metros</label>
                                            <input id="vlr_dist_mts_eq_esp_cult" type="text" class="form-control" name="vlr_dist_mts_eq_esp_cult" value=" {{$insercaoUrbana->vlr_dist_mts_eq_esp_cult}}" disabled>
                                        </div>                                     
                                    @endif    
                                </div>   <!-- row-->     
                                <label class="control-label ">V. Aeroporto Comercial:</label>                                                               
                                <div class="row">
                                    <div class="column col-xs-12 col-md-12">
                                        <div class="row">                                            
                                                <div class="column col-xs-12 col-md-6">
                                                    <label class="control-label ">Distância ao aeroporto comercial mais próximo</label>
                                                    <input id="vlr_dist_km_aerop_comercial" type="text" class="form-control" name="vlr_dist_km_aerop_comercial" value=" {{$insercaoUrbana->vlr_dist_km_aerop_comercial}}" disabled>
                                                </div>    
                                                <div class="column col-xs-12 col-md-6">
                                                   
                                                </div>    
                                        </div>   <!-- row-->                                
                                    </div>   <!-- row-->                                
                             
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                                                            
                                          <label class="control-label ">3.3 Mapa(s) da área com a localização do terreno e de todos os equipamentos e serviços informados no item anterior.</label>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome do Arquivo</th>
                                                    <th>Arquivo</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($mapasInsercao as $dados)
                                                        <tr>
                                                            <td >{{$dados->id}}</td>
                                                            <td>{{$dados->txt_nome_arquivo}}</td>
                                                            <td><a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->txt_caminho_mapa")}}'><i class="fas fa-file-image fa-2x"></i></a></td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>

                                </div>
                            </div>   <!-- row--> 
                            <div class="linha-separa"></div>
                            <div class="row" >
                                <div class="column col-xs-12 col-md-12">
                                        
                                        <label for="caminho_doc_cartorio">3.4 Arquivo com registro das rotas caminháveis e dos tempos de deslocamento por transporte público conforme informado no 
                                                        item 3.2. Verificar modelo de documento na página inicial do Painel de Controle. </label>
                                </div>
                                <div class="column col-xs-12 col-md-12">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nome do Arquivo</th>
                                            <th>Arquivo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rotasInsercaoUrbana as $dados)
                                            <tr>
                                                <td >{{$dados->id}}</td>
                                                <td>{{$dados->txt_nome_arquivo}}</td>
                                                <td><a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->txt_caminho_rotas")}}'><i class="fas fa-file-image fa-2x"></i></a></td>
                                            </tr>
                                            @endforeach                
                                        </tbody>
                                    </table>                                        
                                </div>  
                            </div> 
                        </div>
                        @if($prototipo->situacao_prototipo_id != 4)
                            <div class="form-group">
                                <div class="row">
                                    <div class="column col-sm-12 col-xs-12">
                                        <botao-acao  
                                            :url="'{{ url("/prototipo/insercaoUrbana/editar")}}'" 
                                            registro="{{$insercaoUrbana->id}}"                               
                                            cssbotao="btn btn-lg btn-danger btn-block"                               
                                            textobotao="Editar - Inserção Urbana" 
                                            tipobotao="button-danger"
                                        ></botao-acao>  
                                    </div>    
                                </div>    
                            </div><!-- form-group-->  
                                
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
                                cssbotao="btn btn-info btn-lg btn-block"                               
                                cssicone="" 
                                textobotao="Enviar Proposta" 
                            ></botao-acao-icone>
                                                   
                        </div>    
                        <div class="column col-sm-6 col-xs-12">   
                            <botao-acao  
                                    :url="'{{ url("/propostas")}}'" 
                                    registro=""                               
                                    cssbotao="btn btn-lg btn-danger btn-block"                               
                                    textobotao="Fechar" 
                                    tipobotao="button-danger"
                                ></botao-acao>                                     
                                         
                        </div>    
                    @else
                    <div class="column col-sm-12 col-xs-12">                                        
                        <botao-acao  
                                    :url="'{{ url("/propostas")}}'" 
                                    registro=""                               
                                    cssbotao="btn btn-lg btn-danger btn-block"                               
                                    textobotao="Fechar" 
                                    tipobotao="button-danger"
                                ></botao-acao>                    
                    </div>    
                    @endif    
                </div>    
            </div><!-- form-group-->  
        </div>
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


