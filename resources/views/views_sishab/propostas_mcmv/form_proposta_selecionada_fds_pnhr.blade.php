<div class="row text-center">
    <div class="column col-sm-6">       
        @if($proposta->bln_enquadrada)
            @if(($proposta->bln_selecionada) && ($proposta->bln_contratada) && (!$proposta->bln_demanda_fechada))    
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-home 7x"></i> {{$proposta->num_uh}} Selecionadas
                </div>                   
            @elseif((!$proposta->bln_selecionada) && ($proposta->bln_contratada) && ($proposta->bln_demanda_fechada))    
                <div class="alert alert-danger" role="alert">
                <i class="fas fa-times-circle 7x"></i> Não Selecionada @if($naoSelecionado->count()>0)<a class="badge badge-danger" href="#motivoNaoSelecao">({{$naoSelecionado->count()}})</a>@endif
                </div>                   
            @else  
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-check-circle 7x"></i> {{$proposta->num_uh}} Enquadradas
                </div>                          
            @endif      
        @else      
            <div class="alert alert-danger" role="alert">
                    <i class="fas fa-times-circle 7x"></i> Não Enquadrada @if($naoEnquadramento->count()>0) <a  href="#motivoNaoEnquadramento" class="text-reset"><i class="fas fa-search text-reset"></i></a>@endif
            </div>                                          
        @endif
    </div>    
    <div class="column col-sm-6">  
            @if(($proposta->bln_enquadrada) && ($proposta->bln_selecionada))    
                @if(($proposta->bln_contratada) && (!$proposta->bln_demanda_fechada))
                    <div class="alert alert-info" role="alert">
                    <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                            <i class="fas fa-home 7x"></i> 
                        </a>  {{$proposta->num_uh_contratadas}} Contratadas                                    
                    </div>                                                                                            
                @else   
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-home 7x"></i> {{$proposta->num_uh}} Selecionadas
                    </div>  
                    
                @endif    
            @elseif(($proposta->bln_enquadrada) && (!$proposta->bln_selecionada))    
                @if(($proposta->bln_contratada) && ($proposta->bln_demanda_fechada))
                    <div class="alert alert-info" role="alert">
                    <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                            <i class="fas fa-home 7x"></i> 
                        </a>  {{$proposta->num_uh_contratadas}} Contratadas por demanda Fechada
                        
                    </div>     
                @endif    
            @else  
                @if(($proposta->bln_contratada) && ($proposta->bln_demanda_fechada))
                    <div class="alert alert-info" role="alert">
                    <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                            <i class="fas fa-home 7x"></i> 
                        </a>  {{$proposta->num_uh_contratadas}} Contratadas por demanda Fechada
                        
                    </div>     
                @else
                    <div class="alert alert-danger" role="alert">
                            <i class="fas fa-times-circle 7x"></i> Não Selecionada @if($naoSelecionado->count()>0)<a class="badge badge-danger" href="#motivoNaoSelecao">({{$naoSelecionado->count()}})</a>@endif
                    </div>
                @endif    
            @endif        
        </div>    
    </div>
<div id="form-group">
    <div class="titulo">
        <h3>Empreendimento</h3>   
    </div><!-- fechar nome-->    
    
    <div class="form-group">
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
    <div class="form-group">
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
    <div class="form-group">
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
    <div class="titulo">
        <h3>Proponente</h3> 
        </div>  
        </hr>    
        <div class="form-group">
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

        <div class="titulo">
            <h3>Dados da Proposta</h3> 
        </div>     
        </hr>    
        <div class="form-group">
            <div class="row">
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label label-relatorio">Tipologia</label>
                    <input id="txt_tipologia" type="text" class="form-control input-relatorio" name="txt_tipologia" value="{{$proposta->txt_tipologia}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-2">
                    <label class="control-label label-relatorio">UH</label>
                    <input id="qtd_uh_financiadas" type="text" class="form-control input-relatorio" name="qtd_uh_financiadas" value="{{number_format($proposta->num_uh, 0, ',' , '.')}}" disabled >
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
        <div class="form-group">
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
        <div class="form-group">
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
        <div class="form-group">
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
        <div class="form-group">
            <div class="row">
                <div class="column col-xs-12 col-md-10">
                    <label class="control-label label-relatorio">Declarou que o Município implementou instrumentos da Lei nº 10.257, de 10 de julho de 2001?</label>
                </div>
                <div class="column col-xs-12 col-md-2">
                    <input id="bln_municipio_lei_10257" type="text" class="form-control input-relatorio" name="bln_municipio_lei_10257" value="@if($itensDeclaratorios->bln_municipio_lei_10257) Sim @else Não @endif" disabled >                
                </div>
            </div>
        </div><!-- fechar form-group-->
        <div class="form-group">
            <div class="row">
                <div class="column col-xs-12 col-md-10">
                    <label class="control-label label-relatorio">Terreno em ZEIS ou proveniente de instrumento de controle da ociosidade</label>
                </div>
                <div class="column col-xs-12 col-md-2">
                    <input id="bln_terreno_em_zeis" type="text" class="form-control input-relatorio" name="bln_terreno_em_zeis" value="@if($itensDeclaratorios->bln_terreno_em_zeis) Sim @else Não @endif" disabled >                
                </div>
            </div>
        </div><!-- fechar form-group-->
        <div class="form-group">
            <div class="row">
                <div class="column col-xs-12 col-md-10">
                    <label class="control-label label-relatorio">Terreno doado ou cedido por órgão público</label>
                </div>
                <div class="column col-xs-12 col-md-2">
                    <input id="bln_terreno_doado" type="text" class="form-control input-relatorio" name="bln_terreno_doado" value="@if($itensDeclaratorios->bln_terreno_doado) Sim @else Não @endif" disabled >
                </div>
            </div>
        </div><!-- fechar form-group-->
    @endif
    @if($proposta->modalidade_id==2) 
        <div class="form-group">
            <div class="row">
                <div class="column col-xs-12 col-md-10">
                    <label class="control-label label-relatorio">Terreno Próprio</label>
                </div>
                <div class="column col-xs-12 col-md-2">
                    <input id="bln_terreno_proprio" type="text" class="form-control input-relatorio" name="bln_terreno_proprio" value="@if($itensDeclaratorios->bln_terreno_proprio) Sim @else Não @endif" disabled >                
                </div>
            </div>
        </div><!-- fechar form-group-->
        @endif
        @if($proposta->modalidade_id!=6)
        <div class="titulo">
        <h3>Distância até equipamentos públicos pré-existentes</h3> 
        </div>  
        <hr/>  
        <div class="form-group">
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
        <div class="form-group">
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
        <hr/>  
        @if($proposta->modalidade_id!=6)
        <div class="titulo">
        <h3>Infraestrutura pré-existente</h3> 
        </div>  
        <hr/>  
        <div class="form-group">
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
        <div class="form-group">
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
        <div class="form-group">
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
        <div class="form-group">
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
        <div class="form-group">
            <div class="row">
                <div class="column col-xs-12 col-md-10">
                    <label class="control-label label-relatorio">Possui projeto relacionados ao desenvolvimento rural sustentável?</label>
                </div>
                <div class="column col-xs-12 col-md-2">
                    <input id="bln_projeto_sustentavel" type="text" class="form-control input-relatorio" name="bln_projeto_sustentavel" value="@if($itensDeclaratorios->bln_projeto_sustentavel) Sim @else Não @endif" disabled >
                </div>
            </div>
        </div>
        <div class="form-group">    
            <div class="row">
                <div class="column col-xs-12 col-md-10">
                    <label class="control-label label-relatorio">Residentes de área de risco, área insalubre ou foram desabrigados</label>
                </div>
                <div class="column col-xs-12 col-md-2">
                    <input id="bln_area_risco" type="text" class="form-control input-relatorio" name="bln_area_risco" value="@if($itensDeclaratorios->bln_area_risco) Sim @else Não @endif" disabled >
                </div>
            </div>
        </div><!-- fechar form-group-->
        <div class="form-group">    
            <div class="row">
                <div class="column col-xs-12 col-md-10">
                    <label class="control-label label-relatorio">Beneficiárias responsáveis pela unidade familiar:</label>
                </div>
                <div class="column col-xs-12 col-md-2">
                    <input id="num_chefe_familia" type="text" class="form-control input-relatorio" name="num_chefe_familia" value="{{$itensDeclaratorios->num_chefe_familia}}" disabled >
                </div>
            </div>
        </div><!-- fechar form-group-->
        <div class="form-group">    
            <div class="row">
                <div class="column col-xs-12 col-md-10">
                    <label class="control-label label-relatorio">Beneficiários ou membros da família com deficiência:</label>
                </div>
                <div class="column col-xs-12 col-md-2">
                    <input id="num_membro_familia_deficiente" type="text" class="form-control input-relatorio" name="num_membro_familia_deficiente" value="{{$itensDeclaratorios->num_membro_familia_deficiente}}" disabled >
                </div>
            </div>
        </div><!-- fechar form-group-->
            <div class="titulo">
            <h3>Qualificação do Beneficiário</h3> 
            </div>  
            <hr/>  
            <div class="form-group">    
                <div class="row">
                @foreach($tipoComunidadeRural as $comunidade)
                    <div class="column col-xs-12 col-md-4">
                        <label>
                        <input type="checkbox" checked="true"> {{$comunidade->tipoComunidadeAtendida->txt_tipo_comunidade_atendida}}
                        </label>
                    </div>
                @endforeach
                </div>
            </div> <!-- fechar form-group-->   
            @endif
            @if(count($naoEnquadramento)>0)
            <div id="motivoNaoEnquadramento" class="titulo">
            <h3>Motivo de Não Enquadramento</h3> 
            </div>  
            <hr/>  
            <div class="form-group"> 
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
            <div id="motivoNaoSelecao" class="titulo">
                <h3>Motivo de Não Seleção</h3> 
            </div>  
            <hr/>  
            <div class="form-group"> 
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
    </div><!-- fechar form-group-->  