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
        <a href="{{url('/empreendimentos/filtro')}}">Consulta Empreendimentos</a>
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
                    {{$operacao->txt_nome_empreendimento}} - <span>{{number_format($operacao->prc_obra_realizado, 0, ',' , '.')}}% </span>
        @else
        {{$operacao->operacao_id}} @if($operacao->origem_id == 1) - PF @else - PJ @endif 
        @endif
        </h2>
        <span class="documentFirstHeadingSpan">{{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}}</span>   
        <span class="documentFirstHeadingSpan">{{$operacao->txt_modalidade}} - {{$operacao->dsc_faixa}} - Pmcmv {{$operacao->num_pmcmv}}</span>   
        <span class="documentFirstHeadingSpan"><strong>{{$operacao->qtd_uh_financiadas}}</strong> unidades contratadas em <strong>@if($operacao->dte_assinatura) {{date('d/m/Y',strtotime($operacao->dte_assinatura))}} @else {{$operacao->num_ano_assinatura}} @endif</strong></span>   
        
                   
            @if( ($operacao->status_empreendimento_id==1) || ($operacao->status_empreendimento_id==10)|| ($operacao->status_empreendimento_id==11))
                <div class="alert alert-danger text-center" role="alert">
                    {{$operacao->txt_status_empreendimento}}
                </div>   
            @elseif($operacao->status_empreendimento_id==2)
                <div class="alert alert-default text-center" role="alert">
                    {{$operacao->txt_status_empreendimento}}
                </div>   
            @elseif( ($operacao->status_empreendimento_id==3) || ($operacao->status_empreendimento_id==9))
                <div class="alert alert-info text-center" role="alert">
                    {{$operacao->txt_status_empreendimento}}
                </div>   
                @elseif( ($operacao->status_empreendimento_id==4) || ($operacao->status_empreendimento_id==7))
                <div class="alert alert-success text-center" role="alert">
                    {{$operacao->txt_status_empreendimento}}
                </div>     
                @elseif( ($operacao->status_empreendimento_id==5) || ($operacao->status_empreendimento_id==6))
                <div class="alert alert-danger text-center" role="alert">
                {{$operacao->txt_status_empreendimento}}
                </div>  
            @else
                    <div class="alert alert-secondary text-center" role="alert">
                        Em Execução
                    </div>  
            @endif  
        


    <div id="content-core">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-dados-tab" data-toggle="tab" href="#nav-dados" role="tab" aria-controls="nav-dados" aria-selected="true">Dados Operação</a>
              
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
                                    <input id="qtd_uh_financiadas" type="text" class="form-control input-relatorio" name="qtd_uh_financiadas" value="{{number_format($operacao->qtd_uh_financiadas, 0, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Concluídas</label>
                                    <input id="qtd_uh_concluidas" type="text" class="form-control input-relatorio" name="qtd_uh_concluidas" value="{{number_format($operacao->qtd_uh_concluidas, 0, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Entregues</label>
                                    <input id="qtd_uh_entregues" type="text" class="form-control input-relatorio" name="qtd_uh_entregues" value="{{number_format($operacao->qtd_uh_entregues, 0, ',' , '.')}}" disabled >
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
                                    <input id="vlr_operacao" type="text" class="form-control input-relatorio" name="vlr_operacao" value="{{number_format($operacao->vlr_operacao, 2, ',' , '.')}}" disabled >
                                </div> 
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio"> Liberado</label>
                                    <input id="vlr_liberado" type="text" class="form-control  input-relatorio" name="vlr_liberado" value="{{number_format($operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                                </div>  
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">Saldo a Liberar</label>
                                    @if(($operacao->vlr_operacao-$operacao->vlr_liberado)<0)
                                        <input id="vlr_a_liberar" type="text" class="form-control input-alerta" name="vlr_a_liberar" value="{{number_format($operacao->vlr_operacao-$operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                                    @else
                                        <input id="vlr_a_liberar" type="text" class="form-control input-relatorio" name="vlr_a_liberar" value="{{number_format($operacao->vlr_operacao-$operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                                    @endif
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
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> @if($operacao->modalidade_id==5) Propotocolo @else APF @endif</label>
                                        <input id="operacao_id" type="text" class="form-control input-relatorio" name="operacao_id" value="{{$operacao->operacao_id}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-3">
                                    @if($operacao->dte_assinatura)    
                                        <label class="control-label label-relatorio ">Data de Contratação</label>
                                        <input id="dte_assinatura" type="text" class="form-control input-relatorio" name="dte_assinatura" value="@if($operacao->dte_assinatura) {{date('d/m/Y',strtotime($operacao->dte_assinatura))}}@endif" disabled >
                                    @else
                                        <label class="control-label label-relatorio ">Ano Assinatura</label>
                                        <input id="num_ano_assinatura" type="text" class="form-control input-relatorio" name="num_ano_assinatura" value="{{$operacao->num_ano_assinatura}}" disabled >
                                    @endif
                                    </div>
                                    
                                    <div class="column col-xs-12 col-md-2">
                                        <label class="control-label label-relatorio"> % de Obras</label>
                                        <input id="prc_obra_realizado" type="text" class="form-control input-relatorio" name="prc_obra_realizado" value="{{number_format($operacao->prc_obra_realizado, 0, ',' , '.')}}" disabled >
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio ">Instituição</label>
                                        <input id="txt_agente_financeiro" type="text" class="form-control input-relatorio" name="txt_agente_financeiro" value="{{$operacao->txt_agente_financeiro}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">CNPJ/CPF</label>
                                        <input id="proponente_id" type="text" class="form-control input-relatorio" name="proponente_id" value="{{$operacao->proponente_id}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">Nome Entidade</label>
                                        <input id="txt_proponente_operacao" type="text" class="form-control input-relatorio" name="txt_proponente_operacao" value="{{$operacao->txt_proponente_operacao}}" disabled >
                                    </div>
                                   
                                    <div class="column col-xs-12 col-md-3">
                                        
                                    </div>
                                </div>

                              
                               
                                
                            </div> 


                            
                        </div>
                    </div>
                </div>  
                <span class="documentByLine">
                    <span class="summary-view-icon">Posição: {{date('d/m/Y',strtotime($operacao->dte_movimento_arquivo))}}</span>  
                </span>    
                
        </div><!--nav-dados -->
        
    </div><!-- -->

        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">     
    </div><!-- content-core-->
</div><!-- content-->

@endsection