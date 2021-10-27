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
                :titulo1='"Seleção de Propostas"'
                :titulo2='"Filtro Seleção de Propostas"'
                :link2="'{{ url('/selecao') }}'"
                :titulo3="'Propostas Apresentadas'"
                :clickbotao3="'javascript:window.history.go(-1)'"
                :titulo4="'Proposta'"
            >
            </historico-navegacao>

            <cabecalho-form
                :titulo="'{{$proposta->txt_nome_empreendimento}}'"
                :subtitulo1="'{{strtoupper($proposta->txt_modalidade)}}'"
                :dataatualizacao="'{{date('d/m/Y',strtotime($dataPosicao))}}'"
                :linkcompartilhar="'{{ url("/proposta/$proposta->proposta_id/$proposta->num_apf") }}'"  
                :barracompartilhar="true"              
            >
            </cabecalho-form>   
            <div class="form-group-border">
                <div class="row text-center">                    
                    @if($proposta->bln_enquadrada)
                        <div class="column col-sm-6">  
                            @if(($proposta->bln_selecionada) && ($proposta->bln_contratada) && (!$proposta->bln_demanda_fechada))    
                                <div class="alert alert-success" role="alert">
                                    <i class="fas fa-home 7x"></i> {{$proposta->num_uh}} Selecionadas
                                </div>                   
                            @elseif((!$proposta->bln_selecionada) && ($proposta->bln_contratada) && ($proposta->bln_demanda_fechada))    
                                <div class="alert alert-vermelho text-center" role="alert">
                                    <a class="text-danger" href="#motivoNaoSelecao">
                                        <i class="fas fa-times-circle 7x"></i> Não Selecionada @if($naoSelecionado->count()>0)({{$naoSelecionado->count()}})@endif
                                    </a>    
                                </div>         
                            @else  
                                <div class="alert alert-laranja text-center" role="alert">
                                    <i class="fas fa-check-circle 7x text-warning"></i> {{$proposta->num_uh}} Enquadradas
                                </div>                          
                            @endif    
                        </div>      
                    @else      
                        <div class="column col-sm-12">  
                            <div class="alert alert-vermelho" role="alert">
                                    <i class="fas fa-times-circle 7x"></i> Não Enquadrada @if($naoEnquadramento->count()>0) <a  href="#motivoNaoEnquadramento" class="text-reset"><i class="fas fa-search text-reset"></i></a>@endif
                            </div>                                          
                        </div>        
                    @endif
                    
                    <div class="column col-sm-6">  
                        @if(($proposta->bln_enquadrada))    
                            @if((!$proposta->bln_demanda_fechada) && ($proposta->bln_contratada))
                                <div class="alert alert-info" role="alert">
                                
                                <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                                        <i class="fas fa-home 7x"></i> 
                                    </a>  {{$proposta->num_uh_contratadas}} Contratadas
                                
                                
                                </div>                                 
                                @elseif(($proposta->bln_demanda_fechada) && ($proposta->bln_contratada))
                                    <div class="alert alert-info" role="alert">
                                    <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                                            <i class="fas fa-home 7x"></i> 
                                        </a>  {{$proposta->num_uh_contratadas}} Contratadas por Demanda Fechada
                                        
                                    </div> 
                            @else   
                                @if($proposta->bln_selecionada)
                                    <div class="alert alert-success" role="alert">
                                        <i class="fas fa-home 7x"></i> {{$proposta->num_uh}} Selecionadas
                                    </div>  
                                @else    
                                    <div class="alert alert-vermelho text-center" role="alert">
                                        <a class="text-danger" href="#motivoNaoSelecao">
                                            <i class="fas fa-times-circle 7x text-danger"></i> Não Selecionada @if($naoSelecionado->count()>0)({{$naoSelecionado->count()}})@endif
                                        </a>    
                                    </div>
                                @endif                
                            @endif  
                        
                        @else
                            @if(($proposta->bln_demanda_fechada) && ($proposta->bln_contratada))
                                    <div class="alert alert-info" role="alert">
                                    <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                                            <i class="fas fa-home 7x"></i> 
                                        </a>  {{$proposta->num_uh_contratadas}} Contratadas por Demanda Fechada
                                        
                                    </div> 
                            @endif        
                        @endif        
                    </div>    
                </div>

            </div>
            <!--form-group --> 

            <div class="titulo-linha-cinza text-left">
                <h2>
                   Dados do Empreendimento
                </h2>
            </div>

            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Nº APF</label>
                        <input id="num_apf" type="text" class="form-control input-relatorio" name="num_apf" value="{{$proposta->num_apf}}" disabled >
                    </div> 
                    
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Seleção</label>
                        <input id="selecao" type="text" class="form-control input-relatorio" name="selecao" value="{{$proposta->num_selecao}}ª seleção {{$proposta->num_ano_selecao}}" disabled >
                    </div>
                    @if(!$proposta->bln_demanda_fechada)
                    <div class="column col-xs-12 col-md-5">
                        <label class="control-label label-relatorio">Portaria</label>
                        <input id="txt_portaria_resultado" type="text" class="form-control input-relatorio" name="txt_portaria_resultado" value="{{$proposta->txt_portaria_resultado}}" disabled >
                    </div>
                    @endif
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Pontuação 
                        @if(($proposta->selecao_id) == 9) <!--Condicao para download dos arquivos sobre Pontuacao -->
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Download do Arquivo: Regulamentação para o processo de seleção de propostas - PMCMV-PNHR">
                            <a download href="{{ url('/documents/pnhr.pdf')}}" class="badge badge-warning"><i class="fas fa-download"></i></a>
                        </span>  
                        
                        @elseif(($proposta->selecao_id) == 8)
                            
                            <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Download do Arquivo: Regulamentação para o processo de seleção de propostas - PMCMV-FDS">
                            <a download href="{{ url('/documents/fds.pdf')}}" class="badge badge-warning"><i class="fas fa-download"></i></a>
                        </span>  
                        @elseif(($proposta->selecao_id) == 7)
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Download do Arquivo: Regulamentação para o processo de seleção de propostas - PMCMV FAR">
                            <a download href="{{ url('/documents/far.pdf')}}" class="badge badge-warning"><i class="fas fa-download"></i></a>
                        </span>    
                        @endif
                        </label>
                        <input id="num_pontuacao_total" type="text" class="form-control input-relatorio" name="num_pontuacao_total" value="{{number_format($proposta->num_pontuacao_total, 2, ',' , '.')}}" disabled >
                    </div>
                </div>
            </div><!-- fechar form-group-->
            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-8">
                        <label class="control-label label-relatorio">Endereço do Empreendimento</label>
                        <input id="txt_endereco_intervencao" type="text" class="form-control input-relatorio" name="txt_endereco_intervencao" value="{{$proposta->txt_endereco_intervencao}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Bairro</label>
                        <input id="txt_bairro" type="text" class="form-control input-relatorio" name="txt_bairro" value="{{$proposta->txt_bairro}}" disabled >
                    </div>
                </div>
            </div><!-- fechar form-group-->
            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Região</label>
                        <input id="ds_regiao" type="text" class="form-control input-relatorio" name="ds_regiao" value="{{$proposta->txt_regiao}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">UF</label>
                        <input id="sg_uf" type="text" class="form-control input-relatorio" name="sg_uf" value="{{$proposta->txt_sigla_uf}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-5">
                        <label class="control-label label-relatorio">Município</label>
                        <input id="ds_municipio" type="text" class="form-control input-relatorio" name="ds_municipio" value="{{$proposta->ds_municipio}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">CEP</label>
                        <input id="txt_cep" type="text" class="form-control input-relatorio" name="txt_cep" value="{{$proposta->txt_cep}}" disabled >
                    </div>
                </div>
            </div><!-- fechar form-group-->
            <div class="titulo-linha-cinza text-left">
                <h2>
                   Dados do Proponente
                </h2>
            </div>
            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-9">
                        <label class="control-label label-relatorio">Nome do Proponente</label>
                        <input id="txt_nome_entidade_proponente" type="text" class="form-control input-relatorio" name="txt_nome_entidade_proponente" value="{{$proposta->txt_nome_entidade_proponente}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">CNPJ</label>
                        <input id="txt_cnpj" type="text" class="form-control input-relatorio" name="txt_cnpj" value="{{$proposta->txt_cnpj}}" disabled >
                    </div>
                </div>
            </div><!-- fechar form-group-->
            <div class="titulo-linha-cinza text-left">
                <h2>
                   Dados da Proposta
                </h2>
            </div>
            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Tipologia</label>
                        <input id="txt_tipologia_unidade" type="text" class="form-control input-relatorio" name="txt_tipologia_unidade" value="{{$proposta->txt_tipologia}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">UH</label>
                        <input id="num_uh" type="text" class="form-control input-relatorio" name="num_uh" value="{{number_format($proposta->num_uh, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Valor por UH <em class="nota">(Vlr Financiamento/Num UH)</em></label>
                        <input id="vlr_por_uh" type="text" class="form-control input-relatorio" name="vlr_por_uh" value="{{number_format($proposta->vlr_investimento/$proposta->num_uh, 2, ',' , '.')}}" disabled >
                    </div>
                    @if($proposta->bln_aquecimento_solar)
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Valor Aquecimento</label>
                        <input id="vlr_aquecimento_solar" type="text" class="form-control input-relatorio" name="vlr_aquecimento_solar" value="{{number_format($proposta->vlr_aquecimento_solar, 2, ',' , '.')}}" disabled >
                    </div>
                    @endif
                </div>
            </div><!-- fechar form-group-->
            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Valor Investimento</label>
                        <input id="vlr_investimento" type="text" class="form-control input-relatorio" name="vlr_investimento" value="{{number_format($proposta->vlr_investimento, 2, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Valor Contrapartida</label>
                        <input id="vlr_contrapartida" type="text" class="form-control input-relatorio" name="vlr_contrapartida" value="{{number_format($proposta->vlr_contrapartida, 2, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Valor Financiamento</label>
                        <input id="vlr_financiamento" type="text" class="form-control input-relatorio" name="vlr_financiamento" value="{{number_format($proposta->vlr_financiamento, 2, ',' , '.')}}" disabled >
                    </div>
                    
                </div>
            </div><!-- fechar form-group-->

            @if($proposta->modalidade_id==3)
            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Isenção de ITBI</label>
                        <input id="bln_isencao_itbi" type="text" class="form-control input-relatorio" name="bln_isencao_itbi" value="@if($itensDeclaratorios->bln_isencao_itbi) Sim @else Não @endif" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Isenção de ISSQN</label>
                        <input id="bln_isencao_issqn" type="text" class="form-control input-relatorio" name="bln_isencao_issqn" value="@if($itensDeclaratorios->bln_isencao_issqn) Sim @else Não @endif" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Isenção do IPTU</label>
                        <input id="bln_isencao_iptu" type="text" class="form-control input-relatorio" name="bln_isencao_iptu" value="@if($itensDeclaratorios->bln_isencao_iptu) Sim @else Não @endif" disabled >
                    </div>
                    
                </div>
            </div><!-- fechar form-group-->
            @endif

            @if($proposta->modalidade_id==2)
            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                    <label class="control-label label-relatorio">Regime Construtivo</label>
                        <input id="txt_atendimento_bancario" type="text" class="form-control input-relatorio" name="txt_atendimento_bancario" value="{{$itensDeclaratorios->regimeConstrutivo->txt_regime_construtivo}}" disabled > 
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label label-relatorio">Tomador do Financiamento</label>
                        <input id="txt_transporte_publico" type="text" class="form-control input-relatorio" name="txt_transporte_publico" value="{{$itensDeclaratorios->tomadorFinanciamento->txt_tomador_financiamento}}" disabled >                
                    </div>
                </div>
            </div><!-- fechar form-group-->
            @endif  

            @if($proposta->modalidade_id!=6)
                <div class="form-group-border">
                    <div class="row">
                        <div class="column col-xs-12 col-md-10">
                            <label class="control-label label-relatorio">Declarou que o Município implementou instrumentos da Lei nº 10.257, de 10 de julho de 2001?</label>
                        </div>
                        <div class="column col-xs-12 col-md-2">
                            <input id="bln_municipio_lei_10257" type="text" class="form-control input-relatorio" name="bln_municipio_lei_10257" value="@if($itensDeclaratorios->bln_municipio_lei_10257) Sim @else Não @endif" disabled >                
                        </div>
                    </div>
               
                    <div class="row">
                        <div class="column col-xs-12 col-md-10">
                            <label class="control-label label-relatorio">Terreno em ZEIS ou proveniente de instrumento de controle da ociosidade</label>
                        </div>
                        <div class="column col-xs-12 col-md-2">
                            <input id="bln_terreno_em_zeis" type="text" class="form-control input-relatorio" name="bln_terreno_em_zeis" value="@if($itensDeclaratorios->bln_terreno_em_zeis) Sim @else Não @endif" disabled >                
                        </div>
                    </div>
               
                    <div class="row">
                        <div class="column col-xs-12 col-md-10">
                            <label class="control-label label-relatorio">Terreno doado ou cedido por órgão público</label>
                        </div>
                        <div class="column col-xs-12 col-md-2">
                            <input id="bln_terreno_doado" type="text" class="form-control input-relatorio" name="bln_terreno_doado" value="@if($itensDeclaratorios->bln_terreno_doado) Sim @else Não @endif" disabled >
                        </div>
                    </div>
                    @if($proposta->modalidade_id==2) 
                    <div class="row">
                        <div class="column col-xs-12 col-md-10">
                            <label class="control-label label-relatorio">Terreno Próprio</label>
                        </div>
                        <div class="column col-xs-12 col-md-2">
                            <input id="bln_terreno_proprio" type="text" class="form-control input-relatorio" name="bln_terreno_proprio" value="@if($itensDeclaratorios->bln_terreno_proprio) Sim @else Não @endif" disabled >                
                        </div>                    
                    </div>                    
                    @endif
                </div><!-- fechar form-group-->
            @endif

            

            @if($proposta->modalidade_id!=6)
                    <div class="titulo-linha-cinza text-left">
                        <h2>
                            Distância até equipamentos públicos pré-existentes
                        </h2>
                    </div>                    
                    <div class="form-group-border">
                        <div class="row">
                        <div class="column col-xs-12 col-md-6">
                                <label class="control-label label-relatorio">Creche</label>
                                <input id="txt_equipamento_creche" type="text" class="form-control input-relatorio" name="txt_equipamento_creche" value="{{$itensDeclaratorios->txt_equipamento_creche}}" disabled >                
                            </div>
                            <div class="column col-xs-12 col-md-6">
                                <label class="control-label label-relatorio">Ensino Infantil</label>
                                <input id="txt_equipamento_ensino_infantil" type="text" class="form-control input-relatorio" name="txt_equipamento_ensino_infantil" value="{{$itensDeclaratorios->txt_equipamento_ensino_infantil}}" disabled >                
                            </div>
                        </div>
                        <div class="row">
                            <div class="column col-xs-12 col-md-6">
                            <label class="control-label label-relatorio">Ensino Fundamental</label>
                                <input id="txt_equipamento_ensino_fundamental" type="text" class="form-control input-relatorio" name="txt_equipamento_ensino_fundamental" value="{{$itensDeclaratorios->txt_equipamento_ensino_fundamental}}" disabled > 
                            </div>
                            <div class="column col-xs-12 col-md-6">
                                <label class="control-label label-relatorio">Ensino Médio             </label>
                                <input id="txt_equipamento_ensino_medio" type="text" class="form-control input-relatorio" name="txt_equipamento_ensino_medio" value="{{$itensDeclaratorios->txt_equipamento_ensino_medio}}" disabled >
                            </div>
                        </div>
                    </div><!-- fechar form-group-->
                    @if($proposta->modalidade_id==3)
                    <div class="form-group-border">
                        <div class="row">
                            <div class="column col-xs-12 col-md-6">
                            <label class="control-label label-relatorio">Agência bancária, dos correios ou lotérica</label>
                                <input id="txt_atendimento_bancario" type="text" class="form-control input-relatorio" name="txt_atendimento_bancario" value="{{$itensDeclaratorios->txt_atendimento_bancario}}" disabled > 
                            </div>
                            <div class="column col-xs-12 col-md-6">
                                <label class="control-label label-relatorio">Ponto/Estação de transporte público</label>
                                <input id="txt_transporte_publico" type="text" class="form-control input-relatorio" name="txt_transporte_publico" value="{{$itensDeclaratorios->txt_transporte_publico}}" disabled >                
                            </div>
                        </div>
                    </div><!-- fechar form-group-->
                    @endif  
                @endif  

                @if($proposta->modalidade_id!=6)
                    <div class="titulo-linha-cinza text-left">
                        <h2>
                            Infraestrutura pré-existente
                        </h2>
                    </div>  
                   
                    <div class="form-group-border">
                        <div class="row">
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Abastecimento água</label>
                                <input id="bln_abastecimento_agua_pre_existente" type="text" class="form-control input-relatorio" name="bln_abastecimento_agua_pre_existente" value="@if($itensDeclaratorios->bln_abastecimento_agua_pre_existente) Sim @else Não @endif" disabled >                
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Rede de esgoto pública</label>
                                <input id="bln_rede_esgoto_pre_existente" type="text" class="form-control input-relatorio" name="bln_rede_esgoto_pre_existente" value="@if($itensDeclaratorios->bln_rede_esgoto_pre_existente) Sim @else Não @endif" disabled >                
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Rede de águas pluviais</label>
                                <input id="bln_rede_agua_pluvial_pre_existente" type="text" class="form-control input-relatorio" name="bln_rede_agua_pluvial_pre_existente" value="@if($itensDeclaratorios->bln_rede_agua_pluvial_pre_existente) Sim @else Não @endif" disabled >
                            </div>                           
                        </div>        
                    </div><!-- fechar form-group-->
                    <div class="form-group-border">
                        <div class="row">
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Abastecimento de energia elétrica</label>
                                <input id="bln_rede_energia_pre_existente" type="text" class="form-control input-relatorio" name="bln_rede_energia_pre_existente" value="@if($itensDeclaratorios->bln_rede_energia_pre_existente) Sim @else Não @endif" disabled >                
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Iluminação pública</label>
                                <input id="bln_iluminacao_publica_pre_existente" type="text" class="form-control input-relatorio" name="bln_iluminacao_publica_pre_existente" value="@if($itensDeclaratorios->bln_iluminacao_publica_pre_existente) Sim @else Não @endif" disabled >                
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Abastecimento de gás</label>
                                <input id="bln_abastecimento_gas_pre_existente" type="text" class="form-control input-relatorio" name="bln_abastecimento_gas_pre_existente" value="@if($itensDeclaratorios->bln_abastecimento_gas_pre_existente) Sim @else Não @endif" disabled >
                            </div>                           
                        </div>        
                    </div><!-- fechar form-group-->
                    <div class="form-group-border">
                        <div class="row">
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Coleta de lixo</label>
                                <input id="bln_coleta_lixo_pre_existente" type="text" class="form-control input-relatorio" name="bln_coleta_lixo_pre_existente" value="@if($itensDeclaratorios->bln_coleta_lixo_pre_existente) Sim @else Não @endif" disabled >                
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Transporte coletivo</label>
                                <input id="bln_transporte_publico_pre_existente" type="text" class="form-control input-relatorio" name="bln_transporte_publico_pre_existente" value="@if($itensDeclaratorios->bln_transporte_publico_pre_existente) Sim @else Não @endif" disabled >
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Pavimentação</label>
                                <input id="bln_pavimentacao_pre_existente" type="text" class="form-control input-relatorio" name="bln_pavimentacao_pre_existente" value="@if($itensDeclaratorios->bln_pavimentacao_pre_existente) Sim @else Não @endif" disabled >
                            </div>                           
                        </div>        
                    </div><!-- fechar form-group-->
                    <div class="form-group-border">
                        <div class="row">
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Telefone</label>
                                <input id="bln_rede_telefonia_pre_existente" type="text" class="form-control input-relatorio" name="bln_rede_telefonia_pre_existente" value="@if($itensDeclaratorios->bln_rede_telefonia_pre_existente) Sim @else Não @endif" disabled >
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Guias e sarjetas</label>
                                <input id="bln_guia_e_sargeta_pre_existente" type="text" class="form-control input-relatorio" name="bln_guia_e_sargeta_pre_existente" value="@if($itensDeclaratorios->bln_guia_e_sargeta_pre_existente) Sim @else Não @endif" disabled >
                            </div>
                        </div>        
                    </div><!-- fechar form-group-->
                    @else
                    <div class="form-group-border">
                        <div class="row">
                            <div class="column col-xs-12 col-md-10">
                                <label class="control-label label-relatorio">Possui projeto relacionados ao desenvolvimento rural sustentável?</label>
                            </div>
                            <div class="column col-xs-12 col-md-2">
                                <input id="bln_projeto_sustentavel" type="text" class="form-control input-relatorio" name="bln_projeto_sustentavel" value="@if($itensDeclaratorios->bln_projeto_sustentavel) Sim @else Não @endif" disabled >
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="column col-xs-12 col-md-10">
                                <label class="control-label label-relatorio">Residentes de área de risco, área insalubre ou foram desabrigados</label>
                            </div>
                            <div class="column col-xs-12 col-md-2">
                                <input id="bln_area_risco" type="text" class="form-control input-relatorio" name="bln_area_risco" value="@if($itensDeclaratorios->bln_area_risco) Sim @else Não @endif" disabled >
                            </div>
                        </div>
                   
                        <div class="row">
                            <div class="column col-xs-12 col-md-10">
                                <label class="control-label label-relatorio">Beneficiárias responsáveis pela unidade familiar:</label>
                            </div>
                            <div class="column col-xs-12 col-md-2">
                                <input id="num_chefe_familia" type="text" class="form-control input-relatorio" name="num_chefe_familia" value="{{$itensDeclaratorios->num_chefe_familia}}" disabled >
                            </div>
                        </div>
                   
                        <div class="row">
                            <div class="column col-xs-12 col-md-10">
                                <label class="control-label label-relatorio">Beneficiários ou membros da família com deficiência:</label>
                            </div>
                            <div class="column col-xs-12 col-md-2">
                                <input id="num_membro_familia_deficiente" type="text" class="form-control input-relatorio" name="num_membro_familia_deficiente" value="{{$itensDeclaratorios->num_membro_familia_deficiente}}" disabled >
                            </div>
                        </div>
                    </div><!-- fechar form-group-->

                    <div class="titulo-linha-cinza text-left">
                        <h2>
                            Qualificação do Beneficiário
                        </h2>
                    </div>  
                   
                    <div class="form-group-border">    
                        <div class="row">
                        @foreach($tipoComunidadeRural as $comunidade)
                            <div class="column col-xs-12 col-md-4">
                                <label>
                                <input type="checkbox" checked="true" disabled> {{$comunidade->tipoComunidade->txt_tipo_comunidade}}
                                </label>
                            </div>
                        @endforeach
                        </div>
                    </div> <!-- fechar form-group-->   
                @endif

                @if(count($naoEnquadramento)>0)
                    <div class="titulo-linha-cinza text-left">
                        <h2>
                            Motivo de Não Enquadramento
                        </h2>
                    </div> 
                    
                    <div class="form-group-border"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Motivos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($naoEnquadramento as $motivo)
                                <tr>
                                    <td>{{$motivo->txt_motivo_nao_enquadramento}}</td>
                                </tr>    
                                @endforeach  
                            </tbody>
                        </table> 
                        </div> <!-- fechar form-group-->                  
                @endif 

                @if(count($naoSelecionado)>0)
                    <div class="titulo-linha-cinza text-left">
                        <h2>
                            Motivo de Não Seleção
                        </h2>
                    </div> 
                   
                    <div class="form-group-border"> 
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Motivos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($naoSelecionado as $motivoNaoSelecionado)
                                <tr>
                                    <td>{{$motivoNaoSelecionado->tipoMotivoNaoSelecao->txt_tipo_motivo_nao_selecao}}</td>
                                </tr>    
                                @endforeach  
                            </tbody>
                        </table> 
                    </div> <!-- fechar form-group-->                  
                @endif 

                <div class="form-group">
                    <div class="row">
                        <div class="column col-sm-6 col-xs-12">                                        
                            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">   
                        </div>
                        <div class="column col-sm-6 col-xs-12">
                            <input class="btn btn-lg btn-danger btn-block" type="button-danger" onclick="javascript:window.history.go(-1)" value="Fechar">    
                        </div>
                    </div>        
                </div><!-- fechar primeiro form-group-->

        </div>  
        <!--content-core -->   
    </div>  
    <!--content-->   
@endsection


