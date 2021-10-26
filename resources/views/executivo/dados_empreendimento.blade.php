@extends('layouts.app')

@section('scripts')
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
        <a href="{{ url('/home') }}">Página Inicial</a>
        <span class="breadcrumbSeparator">
            &gt;            
        </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
        <span> PMCMV</span>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href="{{url('/executivo/empreendimentos/filtro')}}">Consulta Empreendimentos</a>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href="#" onclick="javascript:window.history.go(-1)">Dados Empreendimentos</a>
        <span class="breadcrumbSeparator">
            &gt;
        
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Empreendimento</span>
    </span>
</div> 

    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>

<div id="content">

    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        @if($operacao->txt_nome_empreendimento) 
                    {{$operacao->txt_nome_empreendimento}} - <span>{{number_format($operacao->num_percentual, 0, ',' , '.')}}% </span>
                    @else
                    {{$operacao->cod_operacao}}
                    @endif
        </h2>
        <span class="documentFirstHeadingSpan">{{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}}</span>   
        <span class="documentFirstHeadingSpan">{{$operacao->txt_modalidade}} - {{$operacao->dsc_faixa}} - Pmcmv {{$operacao->num_pmcmv}}</span>   
        <span class="documentFirstHeadingSpan"><strong>{{$operacao->num_uh}}</strong> unidades contratadas em <strong>@if($operacao->dte_contratacao) {{date('d/m/Y',strtotime($operacao->dte_contratacao))}} @else {{$operacao->num_ano_assinatura}} @endif</strong></span>   
        
                    @if($operacao->txt_situacao_obras=='Concluída')
                        @if($operacao->num_uh==$operacao->num_entregues)
                        <div class="alert alert-success text-center" role="alert">
                            Entregue
                        </div>   
                        @else
                            @if(($operacao->txt_situacao_obras == 'Concluída') && ($operacao->num_percentual<95))
                            <div class="alert alert-secondary text-center" role="alert">
                                Em Andamento
                            </div>                                  
                            @else
                                <div class="alert alert-info text-center" role="alert">
                                    Concluída
                                </div> 
                            @endif                        
                        @endif                       
                    @elseif(($operacao->txt_situacao_obras=='Normal') || ($operacao->txt_situacao_obras=='Em Andamento'))
                        <div class="alert alert-secondary text-center" role="alert">
                            {{$operacao->txt_situacao_obras}}
                        </div>  
                    @elseif($operacao->txt_situacao_obras=='Entregue')
                        <div class="alert alert-success text-center" role="alert">
                            {{$operacao->txt_situacao_obras}}
                        </div>  
                    @elseif(($operacao->txt_situacao_obras=='Atrasada') || ($operacao->txt_situacao_obras=='Não Iniciada') || ($operacao->txt_situacao_obras=='Obra Retomada'))
                        <div class="alert alert-warning text-center" role="alert">
                            {{$operacao->txt_situacao_obras}}
                        </div>  
                    @elseif(($operacao->txt_situacao_obras=='Cancelada/Distratada') || ($operacao->txt_situacao_obras=='Paralisada'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{$operacao->txt_situacao_obras}}
                        </div>  
                    @else
                        @if($operacao->num_percentual==0)
                            <div class="alert alert-danger text-center" role="alert">
                                Não Iniciada
                            </div>   
                        @elseif(($operacao->num_percentual>0) && ($operacao->num_percentual<=100))
                            <div class="alert alert-default text-center" role="alert">
                                Em Execução
                            </div>   
                        @elseif($operacao->num_uh==$operacao->num_entregues)
                            <div class="alert alert-success text-center" role="alert">
                                Entregue
                            </div>   
                        @else
                            <div class="alert alert-secondary text-center" role="alert">
                                Em Execução
                            </div>  
                        @endif    
                    @endif
 
        


    <div id="content-core">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-dados-tab" data-toggle="tab" href="#nav-dados" role="tab" aria-controls="nav-dados" aria-selected="true">Dados Operação</a>
                @if($proposta)
                    <a class="nav-item nav-link" id="nav-proposta-tab" data-toggle="tab" href="#nav-proposta" role="tab" aria-controls="nav-proposta" aria-selected="false">Proposta Apresentada</a>
                @endif
                @if($arquivoMatriz)                
                    <a class="nav-item nav-link" id="nav-matriz-tab" data-toggle="tab" href="#nav-matriz" role="tab" aria-controls="nav-matriz" aria-selected="false">Matriz de Responsabilidade</a>
                @endif
                @if(count($dadosBeneficiarios)>0)
                    <a class="nav-item nav-link" id="nav-beneficiarios-tab" data-toggle="tab" href="#nav-beneficiarios" role="tab" aria-controls="nav-beneficiarios" aria-selected="false">Beneficiários</a>
                @endif

                 @can('eGestao')
                   
                    @if(count($resumoLiberacoes)>0)
                        <a class="nav-item nav-link" id="nav-liberacoes-tab" data-toggle="tab" href="#nav-liberacoes" role="tab" aria-controls="nav-liberacoes" aria-selected="false">Liberações de Pagamento</a>
                    @endif
                 @endcan
                

        
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-dados" role="tabpanel" aria-labelledby="nav-dados-tab">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                         <div class="card-body">
                            <div class="titulo">
                                <h5>Unidades Habitacionais</h5> 
                            </div>          
                            <div class="row">                                                    
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Contratadas</label>
                                    <input id="num_uh" type="text" class="form-control input-relatorio" name="num_uh" value="{{number_format($operacao->num_uh, 0, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Concluídas</label>
                                    <input id="num_concluidas" type="text" class="form-control input-relatorio" name="num_concluidas" value="{{number_format($operacao->num_concluidas, 0, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Entregues</label>
                                    <input id="num_entregues" type="text" class="form-control input-relatorio" name="num_entregues" value="{{number_format($operacao->num_entregues, 0, ',' , '.')}}" disabled >
                                </div>            
                            </div>      
                            <div class="row"> 
                                <div class="column col-xs-12 col-md-4">
                                @if($operacao->dte_contratacao)    
                                    <label class="control-label label-relatorio ">Data de Contratação</label>
                                    <input id="dte_contratacao" type="text" class="form-control input-relatorio" name="dte_contratacao" value="@if($operacao->dte_contratacao) {{date('d/m/Y',strtotime($operacao->dte_contratacao))}}@endif" disabled >
                                @else
                                    <label class="control-label label-relatorio ">Ano Assinatura</label>
                                    <input id="num_ano_assinatura" type="text" class="form-control input-relatorio" name="num_ano_assinatura" value="{{$operacao->num_ano_assinatura}}" disabled >
                                @endif
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Mês/Ano de Conclusão</label>
                                    <input id="txt_ano_mes_conclusao" type="text" class="form-control input-relatorio" name="txt_ano_mes_conclusao" value="{{$operacao->txt_ano_mes_conclusao}}" disabled >
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                @if($operacao->dte_termino_obras)    
                                    <label class="control-label label-relatorio ">Término das Obras</label>
                                    <input id="dte_termino_obras" type="text" class="form-control input-relatorio" name="dte_termino_obras" value="@if($operacao->dte_termino_obras) {{date('d/m/Y',strtotime($operacao->dte_termino_obras))}}@endif" disabled >
                                @else
                                    <label class="control-label label-relatorio ">Previsão de Término</label>
                                    <input id="dte_prevista_termino_obras" type="text" class="form-control input-relatorio" name="dte_prevista_termino_obras" value="@if($operacao->dte_prevista_termino_obras) {{date('d/m/Y',strtotime($operacao->dte_prevista_termino_obras))}}@endif" disabled >
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column col-sm-6">
                    <div class="card">
                         <div class="card-body">
                            <div class="titulo">
                                <h5>Financeiro (R$)</h5> 
                            </div>          
                            <div class="row">                                                    
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio"> Contratado</label>
                                    <input id="num_vlr_total" type="text" class="form-control input-relatorio" name="num_vlr_total" value="{{number_format($operacao->num_vlr_total, 2, ',' , '.')}}" disabled >
                                </div> 
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio"> Liberado</label>
                                    <input id="num_total_liberado" type="text" class="form-control  input-relatorio" name="num_total_liberado" value="{{number_format($operacao->num_total_liberado, 2, ',' , '.')}}" disabled >
                                </div>  
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">Saldo a Liberar</label>
                                    <input id="num_total_liberado" type="text" class="form-control input-relatorio" name="num_total_liberado" value="{{number_format($operacao->num_vlr_total-$operacao->num_total_liberado, 2, ',' , '.')}}" disabled >
                                </div>  
                            </div>
                            <div class="row">                             
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio "> Contrapartida</label>
                                    <input id="num_contrapartida" type="text" class="form-control input-relatorio" name="num_contrapartida" value="{{number_format($operacao->num_contrapartida, 2, ',' , '.')}}" disabled >
                                </div>                            
                                                                                
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio"> Gestão Condominial</label>
                                    <input id="num_gestao_condominial" type="text" class="form-control input-relatorio" name="num_gestao_condominial" value="{{number_format($operacao->num_gestao_condominial, 2, ',' , '.')}}" disabled >
                                </div>                                                     
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio"> Trabalho Social</label>
                                    <input id="num_valor_tts" type="text" class="form-control input-relatorio" name="num_valor_tts" value="{{number_format($operacao->num_valor_tts, 2, ',' , '.')}}" disabled >
                                </div>                             
                            </div>
                        </div>   
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="titulo">
                                    <h5>Dados do Empreendimento</h5> 
                                </div>
                                <div class="row ">                                    
                                    <div class="column col-xs-12 col-md-2">
                                        <label class="control-label label-relatorio"> APF</label>
                                        <input id="cod_operacao" type="text" class="form-control input-relatorio" name="cod_operacao" value="{{$operacao->cod_operacao}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-2">
                                        <label class="control-label label-relatorio"> % de Obras</label>
                                        <input id="num_percentual" type="text" class="form-control input-relatorio" name="num_percentual" value="{{number_format($operacao->num_percentual, 0, ',' , '.')}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-2">
                                        <label class="control-label label-relatorio">Data de Vistoria</label>
                                        <input id="dte_vistoria" type="text" class="form-control input-relatorio" name="dte_vistoria" value="@if($operacao->dte_vistoria) {{date('d/m/Y',strtotime($operacao->dte_vistoria))}}@endif" disabled >
                                    </div>                                                 
                                
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">Tipologia da Unidade</label>
                                        <input id="txt_tipologia_unidade" type="text" class="form-control input-relatorio" name="txt_tipologia_unidade" value="{{$operacao->txt_tipologia_unidade}}" disabled >
                                    </div>
                                                    
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">Forma de Parcelamento</label>
                                        <input id="txt_forma_parcelamento" type="text" class="form-control input-relatorio" name="txt_forma_parcelamento" value="{{$operacao->txt_forma_parcelamento}}" disabled >
                                    </div>                
                                </div>
                                <div class="row">
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio ">Instituição</label>
                                        <input id="txt_nome_if_af" type="text" class="form-control input-relatorio" name="txt_nome_if_af" value="{{$operacao->txt_nome_if_af}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">Nome Construtora</label>
                                        <input id="txt_nome_entidade_construtora" type="text" class="form-control input-relatorio" name="txt_nome_entidade_construtora" value="{{$operacao->txt_nome_entidade_construtora}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">CNPJ/CPF</label>
                                        <input id="txt_cnpj_entidade_construtora" type="text" class="form-control input-relatorio" name="txt_cnpj_entidade_construtora" value="{{$operacao->txt_cnpj_entidade_construtora}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-3">
                                        
                                    </div>
                                </div>
                            </div>                       
                            
                        </div>
                    </div>
                </div>  
                <span class="documentByLine">
                    <span class="summary-view-icon">Posição: {{date('d/m/Y',strtotime($dataPosicao->dte_posicao))}}</span>  
                </span>    
                
            
        
                
        </div><!--nav-dados -->
        <div class="tab-pane fade" id="nav-proposta" role="tabpanel" aria-labelledby="nav-proposta-tab">
            @if($proposta)
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
                    <H5>Empreendimento</H5>   
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
                    <h5>Proponente</h5> 
                    </div>  
                    <hr/>    
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
                    <h5>Dados da Proposta</h5> 
                    </div>     
                    <hr/>    
                    <div class="form-group">
                        <div class="row">
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">Tipologia</label>
                                <input id="txt_tipologia_unidade" type="text" class="form-control input-relatorio" name="txt_tipologia_unidade" value="{{$proposta->txt_tipologia_unidade}}" disabled >
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
                    <h5>Distância até equipamentos públicos pré-existentes</h5> 
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
                    <h5>Infraestrutura pré-existente</h5> 
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
                        <h5>Qualificação do Beneficiário</h5> 
                        </div>  
                        <hr/>  
                        <div class="form-group">    
                            <div class="row">
                            @foreach($tipoComunidadeRural as $comunidade)
                                <div class="column col-xs-12 col-md-4">
                                    <label>
                                    <input type="checkbox" checked="true"> {{$comunidade->tipoComunidade->txt_tipo_comunidade}}
                                    </label>
                                </div>
                            @endforeach
                            </div>
                        </div> <!-- fechar form-group-->   
                        @endif
                        @if(count($naoEnquadramento)>0)
                        <div id="motivoNaoEnquadramento" class="titulo">
                        <h5>Motivo de Não Enquadramento</h5> 
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
                            <h5>Motivo de Não Seleção</h5> 
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
            @endif
        
        </div><!-- nav-proposta-->
        @if($arquivoMatriz)
        <div class="tab-pane fade show" id="nav-matriz" role="tabpanel" aria-labelledby="nav-matriz-tab">
            <div class="embed-responsive embed-responsive-1by1">
                <iframe class="embed-responsive-item" src='{{ url("$arquivoMatriz->txt_caminho_arquivo/$arquivoMatriz->txt_nome_arquivo")}}' allowfullscreen></iframe>
            </div>
        </div><!-- nav-matriz-->
        @endif
        @if(count($dadosBeneficiarios)>0)
        <div class="titulo">
            <h5>Relação de Beneficiário</h5> 
        </div>  
        <div class="tab-pane fade show" id="nav-beneficiarios" role="tabpanel" aria-labelledby="nav-beneficiarios-tab">
            
            <tabela-relatorios
                v-bind:titulos="{{json_encode($cabecalhoTab)}}"
                v-bind:itens="{{json_encode($dadosBeneficiarios)}}"  
            >
        </tabela-relatorios> 
            
        </div><!-- nav-beneficiarios-->
        @endif
       
        @can('eGestao')
            @if(count($resumoLiberacoes)>0)
            <div class="tab-pane fade show" id="nav-liberacoes" role="tabpanel" aria-labelledby="nav-liberacoes-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="titulo">
                                    <h5>Financeiro (R$)</h5> 
                                </div>          
                                <div class="row">                                                    
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> Contratado</label>
                                        <input id="num_vlr_total" type="text" class="form-control input-relatorio" name="num_vlr_total" value="{{number_format($operacao->num_vlr_total, 2, ',' , '.')}}" disabled >
                                    </div> 
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> Liberado</label>
                                        <input id="num_total_liberado" type="text" class="form-control  input-relatorio" name="num_total_liberado" value="{{number_format($operacao->num_total_liberado, 2, ',' , '.')}}" disabled >
                                    </div>  
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">Saldo a Liberar</label>
                                        <input id="num_total_liberado" type="text" class="form-control input-relatorio" name="num_total_liberado" value="{{number_format($operacao->num_vlr_total-$operacao->num_total_liberado, 2, ',' , '.')}}" disabled >
                                    </div>  
                                </div>
                                <div class="row">                             
                                    <div class="column col-xs-12 col-md-4">
                                        <label class="control-label label-relatorio "> Contrapartida</label>
                                        <input id="num_contrapartida" type="text" class="form-control input-relatorio" name="num_contrapartida" value="{{number_format($operacao->num_contrapartida, 2, ',' , '.')}}" disabled >
                                    </div>                            
                                                                                    
                                    <div class="column col-xs-12 col-md-4">
                                        <label class="control-label label-relatorio"> Gestão Condominial</label>
                                        <input id="num_gestao_condominial" type="text" class="form-control input-relatorio" name="num_gestao_condominial" value="{{number_format($operacao->num_gestao_condominial, 2, ',' , '.')}}" disabled >
                                    </div>                                                     
                                    <div class="column col-xs-12 col-md-4">
                                        <label class="control-label label-relatorio"> Trabalho Social</label>
                                        <input id="num_valor_tts" type="text" class="form-control input-relatorio" name="num_valor_tts" value="{{number_format($operacao->num_valor_tts, 2, ',' , '.')}}" disabled >
                                    </div>                             
                                </div>
                            </div>   
                        </div>
                <div class="form-group">
                    <div class="titulo">
                        <h5>Resumo</h5>                    
                    </div>                             
                    <div class="table-responsive">	
                        <table class="table table-bordered table-sm tab_executivo">
                            <thead>
                                <tr>
                                    <th class="text-center">Tipo de Liberação</th>                                                                                                       
                                    <th>Qtd de Liberações</th>         
                                    <th class="text-center">Valor Liberado</th>
                                </tr>
                                                    
                            </thead>
                            <tbody>
                                @foreach($resumoLiberacoes as $resumo)
                                <tr>                        
                                    <td class="text-center"> {{$resumo->txt_tipo_liberacao}}</td>
                                    <td class="text-center">{{number_format( ($resumo->qtd_liberacoes), 0, ',' , '.')}}</td>                                            
                                    <td class="text-center">{{number_format( ($resumo->vlr_liberacoes), 2, ',' , '.')}}</td>                                            
                                </tr>   
                                @endforeach                                           
                                <tr  class="total">                         
                                    <td class="text-center">TOTAL</td>
                                    <td class="text-center">{{number_format( ($totalLiberacoes['qtd_liberacoes']), 0, ',' , '.')}}</td>                                            
                                    <td class="text-center">{{number_format( ($totalLiberacoes['total_liberado']), 2, ',' , '.')}}</td>                                            
                                </tr>           
                            </tbody>
                        </table>     
                    </div>
                    <div class="titulo">
                        <h5>Liberações</h5>                    
                    </div>                             
                    <div class="table-responsive">	
                        <table class="table table-bordered table-sm tab_executivo">
                            <thead>
                                <tr>
                                    <th>Data de Liberação</th>         
                                    <th class="text-center">Tipo de Liberação</th>                                                                                                       
                                    <th class="text-center">Valor Liberado</th>
                                </tr>
                                                    
                            </thead>
                            <tbody>
                                @foreach($resumoLiberacoes as $resumo)
                                <tr class="totalFaixa">                        
                                    <td class="text-center">SubTotal {{$resumo->txt_tipo_liberacao}}</td>
                                    <td class="text-center">{{number_format( ($resumo->qtd_liberacoes), 0, ',' , '.')}}</td>                                            
                                    <td class="text-center">{{number_format( ($resumo->vlr_liberacoes), 2, ',' , '.')}}</td>                                            
                                </tr>   
                                    @foreach($resumo->tipo_liberacoes as $tipo)
                                    <tr>                        
                                        <td class="text-center">{{date('d/m/Y',strtotime($tipo->dte_liberacao))}}</td>
                                        <td class="text-center">{{$tipo->txt_tipo_liberacao}}</td>
                                        <td class="text-center">{{number_format( ($tipo->vlr_liberacao), 2, ',' , '.')}}</td>                                            
                                    </tr>   
                                    @endforeach  
                                @endforeach                                           
                                <tr  class="total">                         
                                    <td class="text-center">TOTAL</td>
                                    <td class="text-center">{{number_format( ($totalLiberacoes['qtd_liberacoes']), 0, ',' , '.')}}</td>                                            
                                    <td class="text-center">{{number_format( ($totalLiberacoes['total_liberado']), 2, ',' , '.')}}</td>                                            
                                </tr>                 
                            </tbody>
                        </table>     
                    </div>
                <!--form-group -->                      
                </div>
            </div><!-- nav-liberacoes-->
            @endif
        @endcan    
    </div><!-- -->

        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">     
    </div><!-- content-core-->
</div><!-- content-->

@endsection