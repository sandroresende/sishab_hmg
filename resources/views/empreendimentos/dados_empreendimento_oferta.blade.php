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
                    {{$operacao->cod_operacao}}
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
               
                @can('eGestao')
                @if(count($dadosBeneficiarios)>0)
                    <a class="nav-item nav-link" id="nav-beneficiarios-tab" data-toggle="tab" href="#nav-beneficiarios" role="tab" aria-controls="nav-beneficiarios" aria-selected="false">Beneficiários</a>
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
                            <div class="row"> 
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio ">Início Obras</label>
                                    <input id="dte_inicio_obras" type="text" class="form-control input-relatorio" name="dte_inicio_obras" value="@if($dadosOferta->dte_inicio_obras) {{date('d/m/Y',strtotime($dadosOferta->dte_inicio_obras))}}@endif" disabled >   
                                </div> 
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio ">Término Obras</label>
                                    <input id="dte_termino_obras" type="text" class="form-control input-relatorio" name="dte_termino_obras" value="@if($dadosOferta->dte_termino_obras) {{date('d/m/Y',strtotime($dadosOferta->dte_termino_obras))}}@endif" disabled >
                                </div> 
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio ">1ª Entrega</label>
                                    <input id="dte_primeira_entrega" type="text" class="form-control input-relatorio" name="dte_primeira_entrega" value="@if($dadosOferta->dte_primeira_entrega) {{date('d/m/Y',strtotime($dadosOferta->dte_primeira_entrega))}}@endif" disabled >
                                </div> 
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio ">Última Entrega</label>
                                    <input id="dte_ultima_entrega" type="text" class="form-control input-relatorio" name="dte_ultima_entrega" value="@if($dadosOferta->dte_ultima_entrega) {{date('d/m/Y',strtotime($dadosOferta->dte_ultima_entrega))}}@endif" disabled >
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
                                    <label class="control-label label-relatorio"> Subvenção</label>
                                    <input id="vlr_operacao" type="text" class="form-control input-relatorio" name="vlr_operacao" value="{{number_format($operacao->vlr_operacao, 2, ',' , '.')}}" disabled >
                                </div> 
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio"> Liberado Sub.</label>
                                    <input id="vlr_liberado" type="text" class="form-control  input-relatorio" name="vlr_liberado" value="{{number_format($dadosOferta->vlr_liberado_subvencao, 2, ',' , '.')}}" disabled >
                                </div>  
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">A Liberar Sub.</label>
                                    <input id="vlr_a_liberar" type="text" class="form-control input-relatorio" name="vlr_a_liberar" value="{{number_format($operacao->vlr_operacao-$dadosOferta->vlr_liberado_subvencao, 2, ',' , '.')}}" disabled >
                                </div>  
                            </div>
                            <div class="row">                             
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio "> Remuneração</label>
                                    <input id="vlr_remuneracao" type="text" class="form-control input-relatorio" name="vlr_remuneracao" value="{{number_format($dadosOferta->vlr_remuneracao * $operacao->qtd_uh_financiadas, 2, ',' , '.')}}" disabled >
                                </div>                            
                                                                                
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio"> Liberado Rem.</label>
                                    <input id="vlr_liberado_remuneracao" type="text" class="form-control input-relatorio" name="vlr_liberado_remuneracao" value="{{number_format($dadosOferta->vlr_liberado_remuneracao, 2, ',' , '.')}}" disabled >
                                </div>                                                     
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio"> A Liberar Rem.</label>
                                    <input id="vlr_remuneracao" type="text" class="form-control input-relatorio" name="vlr_remuneracao" value="{{number_format(($dadosOferta->vlr_remuneracao * $operacao->qtd_uh_financiadas) - $dadosOferta->vlr_liberado_remuneracao, 2, ',' , '.')}}" disabled >
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
                                        <label class="control-label label-relatorio"> Protocolo  @can('eGestao') <a href='{{url("/protocolo/$protocolo->id")}}'><i class="fas fa-search"></i></a>@endcan</label>
                                        <input id="txt_protocolo" type="text" class="form-control input-relatorio" name="txt_protocolo" value="{{$protocolo->txt_protocolo}}" disabled >
                                    </div>
                                    <div class="column col-xs-12 col-md-2">
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
                                
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">Modalidade Oferta</label>
                                        <input id="txt_modalidade_oferta" type="text" class="form-control input-relatorio" name="txt_modalidade_oferta" value="{{$dadosOferta->txt_modalidade_oferta}}" disabled >
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
                                        <label class="control-label label-relatorio">Nome Construtora</label>
                                        <input id="txt_proponente_operacao" type="text" class="form-control input-relatorio" name="txt_proponente_operacao" value="{{$operacao->txt_proponente_operacao}}" disabled >
                                    </div>
                                   
                                    <div class="column col-xs-12 col-md-3">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="column col-xs-12 col-md-8">
                                            <label class="control-label label-relatorio ">Logradouro</label>
                                            <input id="txt_logradouro" type="text" class="form-control input-relatorio" name="txt_logradouro" value="{{$operacao->txt_logradouro}}" disabled >
                                        </div>
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio">Localidade</label>
                                            <input id="txt_localidade" type="text" class="form-control input-relatorio" name="txt_localidade" value="{{$operacao->txt_localidade}}" disabled >
                                        </div>
                                    </div>
                                    <!--fim row--> 
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-3">
                                            <label class="control-label label-relatorio ">UF</label>
                                            <input id="txt_uf" type="text" class="form-control input-relatorio" name="txt_uf" value="{{$operacao->txt_uf}}" disabled >
                                        </div>
                                        <div class="column col-xs-12 col-md-6">
                                            <label class="control-label label-relatorio">Município</label>
                                            <input id="ds_municipio" type="text" class="form-control input-relatorio" name="ds_municipio" value="{{$operacao->ds_municipio}}" disabled >
                                        </div>
                                        <div class="column col-xs-12 col-md-3">
                                            <label class="control-label label-relatorio">CEP</label>
                                            <input id="txt_cep" type="text" class="form-control input-relatorio" name="txt_cep" value="{{$operacao->txt_cep}}" disabled >
                                        </div>
                                    </div>
                                    <!--fim row--> 
                            </div>                       
                            
                        </div>
                    </div>
                </div>  
                <span class="documentByLine">
                    <span class="summary-view-icon">Posição: {{date('d/m/Y',strtotime($operacao->dte_movimento_arquivo))}}</span>  
                </span>    
                
            
        
                
        </div><!--nav-dados -->
        
    @can('eGestao')   
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
     @endcan  
    </div><!-- -->

        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">     
    </div><!-- content-core-->
</div><!-- content-->

@endsection