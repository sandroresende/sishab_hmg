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
    
    <div class="linha-separa">
    
    </div>
    
    <!-- inicio content-->
    <div id="content">
        <div id="viewlet-above-content-title">
        </div>

        <h2  class="documentFirstHeading text-center">
            @if($operacao->txt_nome_empreendimento) 
                {{$operacao->txt_nome_empreendimento}} - <span>{{number_format($operacao->prc_obra_realizado, 0, ',' , '.')}}% </span>
            @else
                {{$operacao->cod_operacao}}
            @endif
        </h2>

        <span class="documentFirstHeadingSpan">
            {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}}
        </span>   

        <span class="documentFirstHeadingSpan">
            {{$operacao->txt_modalidade}} - {{$operacao->dsc_faixa}} - Pmcmv {{$operacao->num_pmcmv}}
        </span>   

        <span class="documentFirstHeadingSpan">
            <strong>{{$operacao->qtd_uh_financiadas}} </strong> unidades contratadas em 
            <strong>
                @if($operacao->dte_assinatura) 
                    {{date('d/m/Y',strtotime($operacao->dte_assinatura))}} 
                @else 
                    {{$operacao->num_ano_assinatura}} 
                @endif
            </strong>
        </span>  

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


<!-- inicio content-core-->    
        <div id="content-core">
            <!-- inicio abas-->    
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <!-- inicio aba dados operacoes-->    
                    <a class="nav-item nav-link active" id="nav-dados-tab" data-toggle="tab" href="#nav-dados" role="tab" aria-controls="nav-dados" aria-selected="true">
                        Dados Operação
                    </a>
                    <!-- fim aba dados operacoes-->                                

                    <!-- inicio aba dados propostas selecionadas-->    
                    @if($proposta)
                        <a class="nav-item nav-link" id="nav-proposta-tab" data-toggle="tab" href="#nav-proposta" role="tab" aria-controls="nav-proposta" aria-selected="false">
                            Proposta Selecionada
                        </a>
                    @endif
                    <!-- fim aba dados propostas selecionadas-->

                    <!-- inicio aba dados propostas nao selecionadas-->    
                    @if(count($propostasApresentadas)>0)
                        <a class="nav-item nav-link" id="nav-propostasApresentadas-tab" data-toggle="tab" href="#nav-propostasApresentadas" role="tab" aria-controls="nav-propostasApresentadas" aria-selected="false">
                            Propostas Não Selecionadas
                        </a>
                    @endif
                    <!-- fim aba dados propostas nao selecionadas-->

                    <!-- inicio aba matriz-->    
                    @if($arquivoMatriz)                
                        <a class="nav-item nav-link" id="nav-matriz-tab" data-toggle="tab" href="#nav-matriz" role="tab" aria-controls="nav-matriz" aria-selected="false">
                            Matriz de Responsabilidade
                        </a>
                    @endif
                    <!-- fim aba matriz-->

                    <!-- inicio aba dados beneficiarios-->    
                    @if(count($dadosBeneficiarios)>0)
                        <a class="nav-item nav-link" id="nav-beneficiarios-tab" data-toggle="tab" href="#nav-beneficiarios" role="tab" aria-controls="nav-beneficiarios" aria-selected="false">
                            Beneficiários
                        </a>
                    @endif
                    <!-- fim aba dados beneficiarios-->
                    
                    @can('eGestao')
                        <!-- inicio aba liberacoes-->  
                        @if(count($resumoLiberacoes)>0)
                            <a class="nav-item nav-link" id="nav-liberacoes-tab" data-toggle="tab" href="#nav-liberacoes" role="tab" aria-controls="nav-liberacoes" aria-selected="false">
                                Liberações de Pagamento
                            </a>
                        @endif  
                        <!-- fim aba liberacoes-->

                        
                        @if(count($solicitacoesPag)>0)
                            <a class="nav-item nav-link" id="nav-ultimasSolicitacoes-tab" data-toggle="tab" href="#nav-ultimasSolicitacoes" role="tab" aria-controls="nav-ultimasSolicitacoes" aria-selected="false">
                                Últimas Solicitações
                            </a>
                        @endif
                        

                        <!-- inicio aba retomada-->    
                        @if($operacaoRetomada)
                            <a class="nav-item nav-link" id="nav-retomada-tab" data-toggle="tab" href="#nav-retomada" role="tab" aria-controls="nav-retomada" aria-selected="false">
                                Retomada
                            </a>
                        @endif
                        <!-- fim aba retomada-->                        
                    @endcan

                    <!-- inicio aba pac-->    
                        @if(count($projetosPac)>0)
                            <a class="nav-item nav-link" id="nav-projetosPac-tab" data-toggle="tab" href="#nav-projetosPac" role="tab" aria-controls="nav-projetosPac" aria-selected="false">
                                PAC
                            </a>
                        @endif
                    <!-- fim aba pac-->
                </div>
            </nav>
            <!-- fim abas-->    

        <!-- inicio conteudo abas-->    
            <!-- inicio tab-content-->    
            <div class="tab-content" id="nav-tabContent">

<!-- ///////////////////////////////////////////////// inicio nav-dados /////////////////////////////////////////////////-->    
                <div class="tab-pane fade show active" id="nav-dados" role="tabpanel" aria-labelledby="nav-dados-tab">
                    <div class="row">
                        <div class="column col-sm-6">
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
                                    <!--fim row-->    

                                    <div class="row"> 
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio ">Início Obras</label>
                                            <input id="dte_inicio_obras" type="text" class="form-control input-relatorio" name="dte_inicio_obras" value="@if($dadosFar->dte_inicio_obras) {{date('d/m/Y',strtotime($dadosFar->dte_inicio_obras))}}@endif" disabled >   
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio ">Término Obras</label>
                                            <input id="dte_termino_obras" type="text" class="form-control input-relatorio" name="dte_termino_obras" value="@if($dadosFar->dte_termino_obras) {{date('d/m/Y',strtotime($dadosFar->dte_termino_obras))}}@endif" disabled >
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">                                    
                                        </div> 
                                    </div>
                                    <!--fim row-->
                                    
                                    <div class="row"> 
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio ">Primeira Entrega</label>
                                            <input id="dte_primeira_entrega" type="text" class="form-control input-relatorio" name="dte_primeira_entrega" value="@if($dadosFar->dte_primeira_entrega) {{date('d/m/Y',strtotime($dadosFar->dte_primeira_entrega))}}@endif" disabled >   
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio ">Última Entrega</label>
                                            <input id="dte_ultima_entrega" type="text" class="form-control input-relatorio" name="dte_ultima_entrega" value="@if($dadosFar->dte_ultima_entrega) {{date('d/m/Y',strtotime($dadosFar->dte_ultima_entrega))}}@endif" disabled >
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio ">Data Legalização</label>
                                            <input id="dte_legalizacao" type="text" class="form-control input-relatorio" name="dte_legalizacao" value="@if($dadosFar->dte_legalizacao) {{date('d/m/Y',strtotime($dadosFar->dte_legalizacao))}}@endif" disabled >
                                        </div>                                 
                                    </div>
                                    <!--fim row-->

                                </div><!--fim card-body-->
                            </div><!--fim card-->
                        </div><!--fim column col-sm-6-->
                        
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
                                    <!--fim row-->

                                    <div class="row">                             
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio "> Contrapartida</label>
                                            <input id="vlr_contrapartida" type="text" class="form-control input-relatorio" name="vlr_contrapartida" value="{{number_format($operacao->vlr_contrapartida, 2, ',' , '.')}}" disabled >
                                        </div>                            
                                                                                        
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio"> Terreno</label>
                                            <input id="vlr_liberado_terreno" type="text" class="form-control input-relatorio" name="vlr_liberado_terreno" value="{{number_format($dadosFar->vlr_liberado_terreno, 2, ',' , '.')}}" disabled >
                                        </div>                                                     
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio"> Trabalho Social</label>
                                            <input id="vlr_liberado_ts" type="text" class="form-control input-relatorio" name="vlr_liberado_ts" value="{{number_format($dadosFar->vlr_liberado_ts + $dadosFar->vlr_liberado_ts_adicional, 2, ',' , '.')}}" disabled >
                                        </div>                             
                                    </div>
                                    <!--fim row-->

                                    <div class="row"> 
                                        <div class="column col-xs-12 col-md-4">
                                            <label class="control-label label-relatorio ">Última Liberação</label>
                                            <input id="dte_ultima_liberacao_recurso" type="text" class="form-control input-relatorio" name="dte_ultima_liberacao_recurso" value="@if($dadosFar->dte_ultima_liberacao_recurso) {{date('d/m/Y',strtotime($dadosFar->dte_ultima_liberacao_recurso))}}@endif" disabled >   
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                            
                                        </div> 
                                        <div class="column col-xs-12 col-md-4">
                                        
                                        </div>                                     
                                    </div>
                                    <!--fim row-->
                                </div><!--fim card-body-->
                            </div><!--fim card-->
                        </div><!--fim column col-sm-6-->
                    </div>
                    <!--fim row-->    

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="titulo">
                                        <h5>Dados do Empreendimento</h5> 
                                    </div>
                                    <div class="row ">                                    
                                        <div class="column col-xs-12 col-md-2">
                                            <label class="control-label label-relatorio"> @if($operacao->modalidade_id==5) Propotocolo @else APF @endif</label>
                                            <input id="operacao_id" type="text" class="form-control input-relatorio" name="operacao_id" value="{{$operacao->operacao_id}}" disabled >
                                        </div>
                                        <div class="column col-xs-12 col-md-2">
                                            <label class="control-label label-relatorio">Situação Obra - GEFUS</label>
                                            <input id="operacao_id" type="text" class="form-control input-relatorio" name="operacao_id" value=" {{$operacao->txt_situacao_obra}}" disabled >
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
                                        <div class="column col-xs-12 col-md-2">
                                            <label class="control-label label-relatorio">Tipologia da Unidade</label>
                                            <input id="txt_tipologia" type="text" class="form-control input-relatorio" name="txt_tipologia" value="{{$dadosFar->txt_tipologia}}" disabled >
                                        </div>
                                    </div>
                                    <!--fim row-->                                                                                                                         
                                    
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
                                    <!--fim row-->  
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
                                </div><!--fim card-body-->
                            </div><!--fim card-->
                        </div><!--fim column col-sm-12-->
                    </div><!--fim row-->    

                    @if($operacao->bln_retomada)
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="titulo">
                                            <h5>Dados da Retomada</h5> 
                                        </div>
                                        <div class="row ">                                    
                                            <div class="column col-xs-12 col-md-4">
                                                <label class="control-label label-relatorio"> APF retomada</label>
                                                <input id="txt_apf_retomada" type="text" class="form-control input-relatorio" name="txt_apf_retomada" value="{{$operacao->txt_apf_retomada}}" disabled >
                                            </div>
                                            <div class="column col-xs-12 col-md-4">
                                                <label class="control-label label-relatorio ">Data de Assinatura</label>
                                                <input id="dt_assinatura_retomada" type="text" class="form-control input-relatorio" name="dt_assinatura_retomada" value="@if($operacao->dt_assinatura_retomada) {{date('d/m/Y',strtotime($operacao->dt_assinatura_retomada))}}@endif" disabled >
                                        
                                            </div>
                                            
                                            <div class="column col-xs-12 col-md-4">
                                                <label class="control-label label-relatorio"> Valor da Retomada</label>
                                                <input id="vlr_retomada" type="text" class="form-control input-relatorio" name="vlr_retomada" value="{{number_format($operacao->vlr_retomada, 2, ',' , '.')}}" disabled >
                                            </div>
                                        </div>                               
                                        <!--fim row-->  
                                    </div><!--fim card-body-->
                                </div><!--fim card-->
                            </div><!--fim column col-sm-12-->
                        </div>
                        <!--fim row--> 
                    @endif
                    <div class="row ">  
                        <div class="col-sm-12">
                            <span class="documentByLine">
                                <span class="summary-view-icon">
                                    Posição: {{date('d/m/Y',strtotime($operacao->dte_movimento_arquivo))}}
                                </span>  
                            </span> 
                        </div><!--fim column col-sm-12-->
                    </div>
                    <!--fim row-->  

                </div>
                <!--fim nav-dados -->                

<!-- ///////////////////////////////////////////////// inicio nav-propostas selecionadas /////////////////////////////////////////////////-->    
                <div class="tab-pane fade" id="nav-proposta" role="tabpanel" aria-labelledby="nav-proposta-tab">
                @if($proposta)
                    <div id="form-group">
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
                            </div> <!-- fim column col-sm-6 -->  

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
                            </div> <!-- fim column col-sm-6 -->  
                        </div><!-- fim row -->             
                    </div><!-- fim form-group-->     

                    <div class="titulo">
                        <H5>Empreendimento</H5>   
                    </div><!-- fechar nome-->          
                    <div id="form-group">    
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
                                    <!--Condicao para download dos arquivos sobre Pontuacao -->
                                    @if(($proposta->selecao_id) == 9) 
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
                        </div><!-- fim row -->                                 
                    </div><!-- fim form-group--> 
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
                    <div class="form-group">
                        <div class="row">
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">Tipologia</label>
                                <input id="txt_tipologia_unidade" type="text" class="form-control input-relatorio" name="txt_tipologia_unidade" value="{{$proposta->txt_tipologia_unidade}}" disabled >
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
                </div><!-- nav-proposta selecionadas-->     

<!-- ///////////////////////////////////////////////// inicio nav-propostas apresentadas /////////////////////////////////////////////////-->    
                @if(count($propostasApresentadas)>0)
                <div class="tab-pane fade" id="nav-propostasApresentadas" role="tabpanel" aria-labelledby="nav-propostaApresentadas-tab">
                    <colunas-duas-situacao 
                        v-bind:itens="{{$propostasApresentadas}}" 
                        :url="'{{ url('/') }}'">             
                    </colunas-duas-situacao>
                </div><!-- nav-proposta apresentadas-->   
                @endif




<!-- ///////////////////////////////////////////////// inicio nav-matriz /////////////////////////////////////////////////-->    
                @if($arquivoMatriz)
                <div class="tab-pane fade show" id="nav-matriz" role="tabpanel" aria-labelledby="nav-matriz-tab">
                    <div class="embed-responsive embed-responsive-1by1">
                        <iframe class="embed-responsive-item" src='{{ url("$arquivoMatriz->txt_caminho_arquivo/$arquivoMatriz->txt_nome_arquivo")}}' allowfullscreen></iframe>
                    </div>
                </div><!-- nav-matriz-->
                @endif                  
                
<!-- ///////////////////////////////////////////////// inicio nav-beneficiarios /////////////////////////////////////////////////-->   
                @if(count($dadosBeneficiarios)>0)
                
                <div class="tab-pane fade show" id="nav-beneficiarios" role="tabpanel" aria-labelledby="nav-beneficiarios-tab">
                    <div class="titulo">
                        <h5>Relação de Beneficiário</h5> 
                    </div>  
                    <tabela-relatorios
                        v-bind:titulos="{{json_encode($cabecalhoTab)}}"
                        v-bind:itens="{{json_encode($dadosBeneficiarios)}}"  
                    >
                    </tabela-relatorios>                     
                </div><!-- nav-beneficiarios-->
                @endif

                @can('eGestao')
<!-- ///////////////////////////////////////////////// inicio nav-liberacoes /////////////////////////////////////////////////-->   
                    <div class="tab-pane fade show" id="nav-liberacoes" role="tabpanel" aria-labelledby="nav-liberacoes-tab">
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
                                        <label class="control-label label-relatorio "> Contrapartida</label>
                                        <input id="vlr_contrapartida" type="text" class="form-control input-relatorio" name="vlr_contrapartida" value="{{number_format($operacao->vlr_contrapartida, 2, ',' , '.')}}" disabled >
                                    </div>                                     
                                </div>
                                <!--fim row-->

                                <div class="row">                             
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> Obra</label>
                                        <input id="vlr_liberado_obra" type="text" class="form-control  input-relatorio" name="vlr_liberado_obra" value="{{number_format($dadosFar->vlr_liberado_obra, 2, ',' , '.')}}" disabled >
                                    </div>  
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> Terreno</label>
                                        <input id="vlr_liberado_terreno" type="text" class="form-control input-relatorio" name="vlr_liberado_terreno" value="{{number_format($dadosFar->vlr_liberado_terreno, 2, ',' , '.')}}" disabled >
                                    </div>                                                     
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> Trabalho Social</label>
                                        <input id="vlr_liberado_ts" type="text" class="form-control input-relatorio" name="vlr_liberado_ts" value="{{number_format($dadosFar->vlr_liberado_ts + $dadosFar->vlr_liberado_ts_adicional, 2, ',' , '.')}}" disabled >
                                    </div>                             
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">Saldo a Liberar</label>
                                        <input id="vlr_liberado" type="text" class="form-control input-relatorio" name="vlr_liberado" value="{{number_format($operacao->vlr_operacao-$dadosFar->vlr_liberado_terreno-$dadosFar->vlr_liberado_obra-$dadosFar->vlr_liberado_ts-$dadosFar->vlr_liberado_ts_adicional, 2, ',' , '.')}}" disabled >
                                    </div>  
                                </div>
                                <!--fim row-->

                                <span class="documentByLine">
                                    <span class="summary-view-icon">
                                        Posição: {{date('d/m/Y',strtotime($operacao->dte_movimento_arquivo))}}
                                    </span>  
                                </span>
                            </div><!--fim card-body-->
                        </div><!--fim card-->

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
                            </div> <!--fim table-responsive--> 

                            <div class="titulo">
                                <h5>Liberações</h5>                    
                            </div>
                            <div class="table-responsive">	
                                <table class="table table-bordered table-sm tab_executivo">
                                    <thead>
                                        <tr>
                                            <th>Data de Liberação</th>         
                                            <th class="text-center">APF</th>                                                                                                       
                                            <th class="text-center">Tipo de Liberação</th>    
                                            <th class="text-center">Valor Liberado</th>
                                        </tr>
                                                            
                                    </thead>
                                    <tbody>
                                        @foreach($resumoLiberacoes as $resumo)
                                        <tr class="totalFaixa">                        
                                            <td class="text-center" colspan="2">SubTotal {{$resumo->txt_tipo_liberacao}}</td>
                                            <td class="text-center">{{number_format( ($resumo->qtd_liberacoes), 0, ',' , '.')}}</td>                                            
                                            <td class="text-center">{{number_format( ($resumo->vlr_liberacoes), 2, ',' , '.')}}</td>                                            
                                        </tr>   
                                            @foreach($resumo->tipo_liberacoes as $tipo)
                                            <tr>                        
                                                <td class="text-center">{{date('d/m/Y',strtotime($tipo->dte_liberacao))}}</td>
                                                <td class="text-center">{{$tipo->operacao_id}}</td>
                                                <td class="text-center">{{$tipo->txt_tipo_liberacao}}</td>
                                                <td class="text-center">{{number_format( ($tipo->vlr_liberacao), 2, ',' , '.')}}</td>                                            
                                            </tr>   
                                            @endforeach  
                                        @endforeach
                                                                                
                                        <tr  class="total">                         
                                            <td class="text-center" colspan="2">TOTAL</td>
                                            <td class="text-center">{{number_format( ($totalLiberacoes['qtd_liberacoes']), 0, ',' , '.')}}</td>                                            
                                            <td class="text-center">{{number_format( ($totalLiberacoes['total_liberado']), 2, ',' , '.')}}</td>                                            
                                        </tr>                 
                                    </tbody>
                                </table>     
                            </div>  <!--fim table-responsive--> 
                        </div><!--fim form-group-->
                    </div><!-- nav-liberacoes-->

<!-- ///////////////////////////////////////////////// inicio nav-solicitações /////////////////////////////////////////////////-->   

                    @if(count($solicitacoesPag)>0)
                    <div class="tab-pane fade show" id="nav-ultimasSolicitacoes" role="tabpanel" aria-labelledby="nav-ultimasSolicitacoes-tab">
                        <div class="form-group">
                            <div class="titulo">
                                <h5>Resumo por Observação</h5>                                        
                            </div>
                            <div class="table-responsive">		
                                <table class="table table-bordered table-sm tab_executivo">
                                    <thead>
                                        <tr style="max-widh:1142;">
                                            <th>Observação</th>                                
                                            <th class="text-center">Qtde Solicitado</th>
                                            <th class="text-center">Valor Solicitado</th>
                                            <th class="text-center">Qtde Liberado</th>
                                            <th class="text-center">Valor Liberado</th>                                
                                            <th class="text-center">Valor a Liberar</th> 
                                        </tr>
                                                            
                                    </thead>
                                    <tbody>
                                        @foreach($solicitacoesPagObs as $dados)
                                            <tr>                        
                                                <td >{{$dados->txt_observacao}}</td>
                                                <td class="tabelaFaixa text-center">{{number_format( ($dados->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                                <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado), 2, ',' , '.')}}</td>   
                                                <td class="tabelaFaixa">{{number_format( ($dados->qtd_liberacoes), 0, ',' , '.')}}</td>
                                                <td class="tabelaFaixa">{{number_format( ($dados->total_liberado), 2, ',' , '.')}}</td>                 
                                                <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado - $dados->total_liberado), 2, ',' , '.')}}</td>                                                    
                                            </tr>                                
                                        @endforeach                                           
                                        <tr  class="total">                        
                                            <td  class="tabelaNumero">TOTAL</td>
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['qtd_solicitacoes']), 0, ',' , '.')}}</td>
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_solicitado']), 2, ',' , '.')}}</td>   
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['qtd_liberacoes']), 0, ',' , '.')}}</td>
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_liberado']), 2, ',' , '.')}}</td>     
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_solicitado']-$totalSolicitacaoPagObs['total_liberado']), 2, ',' , '.')}}</td>                                                        
                                        </tr>                         
                                    </tbody>
                                </table>     
                            </div>   <!--fim table-responsive--> 

                            <div class="titulo">
                                <h5>Relação de Solicitações</h5>                                
                            </div>
                            <div class="table-responsive">		
                                <table class="table table-bordered table-sm tab_executivo">
                                    <thead>
                                        <tr>
                                            <th>Data da Solicitação</th>                                
                                            <th class="text-center">APF</th>                               
                                            <th class="text-center">Empreendimento</th> 
                                            <th class="text-center">Valor Solicitado</th>  
                                            <th class="text-center">Valor Liberado</th>
                                            <th class="text-center">Data da Liberação</th>
                                            <th class="text-center">Valor a Liberar</th>                                
                                            <th class="text-center">Tipo de Liberação</th> 
                                         
                                            <th class="text-center">Observação</th> 
                                        </tr>
                                                            
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($solicitacoesPag as $dados)
                                        
                                            <tr>                        
                                                <td class="tabelaFaixa">@if($dados->dte_solicitacao){{date('d/m/Y',strtotime($dados->dte_solicitacao))}}@endif</td>     
                                                <td >{{$dados->operacao_id}}</td>
                                                <td >{{$dados->txt_empreendimento}}</td>
                                                                                                    
                                                <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_solicitado), 2, ',' , '.')}}</td>
                                                <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_liberacao), 2, ',' , '.')}}</td>   
                                                <td class="tabelaFaixa">@if($dados->dte_liberacao){{date('d/m/Y',strtotime($dados->dte_liberacao))}}@endif</td>                                                   
                                                <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_solicitado - $dados->vlr_liberacao), 2, ',' , '.')}}</td>  
                                                <td >{{$dados->txt_tipo_liberacao}}</td>                                                 
                                              
                                                <td >{{$dados->txt_situacao_solicitacao_medicao}}</td>

                                            </tr>                                
                                        @endforeach                                           
                                        <tr  class="total">                        
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['qtd_solicitacoes']), 0, ',' , '.')}}</td>
                                            <td colspan="2"  class="tabelaNumero text-center">TOTAL</td>
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_solicitado']), 2, ',' , '.')}}</td>   
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_liberado']), 2, ',' , '.')}}</td>     
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['qtd_liberacoes']), 0, ',' , '.')}}</td>
                                            <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_solicitado']-$totalSolicitacaoPagObs['total_liberado']), 2, ',' , '.')}}</td>                                                        
                                            <td colspan="3"  class="tabelaNumero"></td>
                                        </tr>                         
                                    </tbody>
                                </table>     
                            </div>
                        </div><!--fim form-group-->
                    </div><!-- nav-solicitações-->
                    @endif

<!-- ///////////////////////////////////////////////// inicio nav-retomada /////////////////////////////////////////////////-->   
                    @if($operacaoRetomada)
                    <div class="tab-pane fade show" id="nav-retomada" role="tabpanel" aria-labelledby="nav-retomada-tab">
                        <div class="row">                           
                            <div class="column col-sm-6">  
                                @if($operacaoRetomada->status_snh_id >=5)
                                <div class="alert alert-danger" role="alert">
                                    Status SNH: {{$operacaoRetomada->txt_status_snh}}
                                </div>
                                @elseif($operacaoRetomada->status_snh_id ==3)
                                <div class="alert alert-success" role="alert">
                                    Status SNH: {{$operacaoRetomada->txt_status_snh}}
                                </div>
                                @elseif($operacaoRetomada->status_snh_id ==4)
                                <div class="alert alert-warning" role="alert">
                                    Status SNH: {{$operacaoRetomada->txt_status_snh}}
                                </div>
                                @elseif($operacaoRetomada->status_snh_id ==2)
                                <div class="alert alert-primary" role="alert">
                                    Status SNH: {{$operacaoRetomada->txt_status_snh}}
                                </div>
                                @else
                                <div class="alert alert-secondary " role="alert">
                                    Status SNH: {{$operacaoRetomada->txt_status_snh}}
                                </div>
                                @endif
                            </div>                    
                            <div class="column col-sm-6">
                                @if($operacaoRetomada->status_demanda_id >=8)
                                <div class="alert alert-danger" role="alert">
                                    Status SNH: {{$operacaoRetomada->txt_status_demanda}}
                                </div>
                                @elseif($operacaoRetomada->status_demanda_id ==4)
                                <div class="alert alert-success" role="alert">
                                    Status SNH: {{$operacaoRetomada->txt_status_demanda}}
                                </div>  
                                @elseif(($operacaoRetomada->status_demanda_id ==6) || ($operacaoRetomada->status_demanda_id ==7))
                                <div class="alert alert-primary" role="alert">
                                    Status SNH: {{$operacaoRetomada->txt_status_demanda}}
                                </div> 
                                @else
                                <div class="alert alert-secondary" role="alert">
                                    Status Gefus: {{$operacaoRetomada->txt_status_demanda}}
                                </div>
                                @endif
                            </div>                    
                        </div> 
                    <div class="titulo">
                            <h5>Informações para o apote adicional ou sumplementação</h5> 
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">APF Vinculado</label>
                                    <input id="num_apf_vinculado" type="text" class="form-control" name="num_apf_vinculado" value="{{$operacaoRetomada->num_apf_vinculado}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">Modalidade</label>
                                    <input id="txt_modalidade_retomada" type="text" class="form-control" name="txt_modalidade_retomada" value="{{$operacaoRetomada->txt_modalidade_retomada}}" disabled >
                                </div>  
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">Valor Adicional</label>
                                    <input id="vlr_adicional" type="text" class="form-control" name="vlr_adicional" value="{{number_format($operacaoRetomada->vlr_adicional, 2, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">Agente Financeiro</label>
                                    <input id="txt_agente_financeiro" type="text" class="form-control" name="txt_agente_financeiro" value="{{$operacaoRetomada->txt_agente_financeiro}}" disabled >
                                </div>                  
                            </div>
                            <!--fim row-->               
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Valor Original da Unidade</label>
                                    <input id="vlr_original_unidade" type="text" class="form-control" name="vlr_original_unidade" value="{{number_format($operacaoRetomada->vlr_original_unidade, 2, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Valor Teto para Município</label>
                                    <input id="vlr_teto_municipio" type="text" class="form-control" name="vlr_teto_municipio" value="{{number_format($operacaoRetomada->vlr_teto_municipio, 2, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">% acima Teto</label>
                                    <input id="prc_acima_teto" type="text" class="form-control" name="prc_acima_teto" value="{{number_format($operacaoRetomada->prc_acima_teto, 2, ',' , '.')}}" disabled >
                                </div>
                            </div>
                            <!--fim row-->  
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">% Suplementação</label>
                                    <input id="prc_suplementacao" type="text" class="form-control" name="prc_suplementacao" value="{{number_format($operacaoRetomada->prc_suplementacao, 2, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Valor Liberar até Solicitação</label>
                                    <input id="vlr_liberar_ate_solicitacao" type="text" class="form-control" name="vlr_liberar_ate_solicitacao" value="{{number_format($operacaoRetomada->vlr_liberar_ate_solicitacao, 2, ',' , '.')}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">% FInanceiro até Solicitação</label>
                                    <input id="prc_financeiro_ate_solicitacao" type="text" class="form-control" name="prc_financeiro_ate_solicitacao" value="{{number_format($operacaoRetomada->prc_financeiro_ate_solicitacao, 2, ',' , '.')}}" disabled >
                                </div>
                            </div>
                            <!--fim row-->   
                        </div><!-- fechar form-group--> 

                            <div class="titulo">
                            <h5>Análise SNH</h5> 
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-between">
                                <div class="col-3">
                                    <label class="control-label ">Status SNH</label>
                                    <input id="txt_status_snh" type="text" class="form-control" name="txt_status_snh" value="{{$operacaoRetomada->txt_status_snh}}" disabled >
                                </div>
                                <div class="col-2">
                                    <label class="control-label ">Data Status</label>
                                    <input id="dte_status_snh" type="text" class="form-control" name="dte_status_snh" value="@if($operacaoRetomada->dte_status_snh){{date('d/m/Y',strtotime($operacaoRetomadaSNH->dte_status_snh))}}@endif" disabled >
                                </div>
                            </div>    
                            @if(count($oficiosRetomadaSNH)>0)    
                            <div class="row"> 
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-sm">
                                        <thead  class="text-center">
                                            <tr>
                                            <th>#</th>                                                       
                                            <th>Data</th> 
                                            <th>Ofício</th> 
                                            <th>Motivo</th> 
                                            <!--
                                            <th>Ação</th>
                                            -->
                                            </tr>
                                        </thead>
                                        <tbody>      
                                    
                                    @foreach($oficiosRetomadaSNH as $dados)   
                                                                                                    
                                            <tr>                                                                                              
                                                <td class="text-center">{{$dados->oficio_id}}</td>                                   
                                                <td class="text-center">
                                                    @if($dados->dte_oficio) 
                                                        {{date('d/m/Y',strtotime($dados->dte_oficio))}}
                                                    @endif
                                                    </td>                                   
                                                <td class="text-center">{{$dados->txt_num_oficio}}</td>                                                          
                                                <td class="text-center">{{$dados->txt_motivo_oficio}}</td>  
                                               
                                            </tr>   
                                        
                                    @endforeach                                                       
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                            @endif
                        </div><!-- fechar form-group--> 
                        <div class="titulo">
                            <h5>Análise Gefus</h5> 
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Status Gefus</label>
                                    <input id="txt_status_demanda" type="text" class="form-control" name="txt_status_demanda" value="{{$operacaoRetomada->txt_status_demanda}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Data Status</label>
                                    <input id="dte_status_demanda" type="text" class="form-control" name="dte_status_demanda" value="@if($operacaoRetomada->dte_status_demanda){{date('d/m/Y',strtotime($operacaoRetomada->dte_status_demanda))}}@endif" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Data Dotação</label>
                                    <input id="dte_dotacao" type="text" class="form-control" name="dte_dotacao" value="@if($operacaoRetomada->dte_dotacao){{date('d/m/Y',strtotime($operacaoRetomada->dte_dotacao))}}@endif" disabled >
                                </div>
                            </div> 

                            @if(count($oficiosRetomadaGefus)>0)  
                            <div class="row">     
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-sm">
                                        <thead  class="text-center">
                                            <tr>
                                            <th>#</th>                                                       
                                            <th>Data</th> 
                                            <th>Ofício</th> 
                                            <th>Motivo</th> 
                                            <!--
                                            <th>Ação</th>
                                            -->
                                            </tr>
                                        </thead>
                                        <tbody>      
                                    
                                    @foreach($oficiosRetomadaGefus as $dados)   
                                        
                                            <tr>                                                                                              
                                                <td class="text-center">{{$dados->oficio_id}}</td>                                   
                                                <td class="text-center">
                                                    @if($dados->dte_oficio) 
                                                        {{date('d/m/Y',strtotime($dados->dte_oficio))}}
                                                    @endif
                                                    </td>                                   
                                                <td class="text-center">{{$dados->txt_num_oficio}}</td>                                                          
                                                <td class="text-center">{{$dados->txt_motivo_oficio}}</td>                                     
                                            </tr>   
                                        
                                    @endforeach                                                       
                                        </tbody>
                                    </table> 
                                </div>
                            </div>
                            @endif
                        </div><!-- fechar form-group--> 

                            


                           
                        @if(count($observacoes)>0)          
                        <div class="titulo">
                                <h5>Observações                    </h5> 

                            </div> 
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm">
                                    <thead  class="text-center">
                                        <tr>
                                        <th>#</th>                                                       
                                        <th>Data</th> 
                                        <th>Observação</th> 
                                        <th>Realizado por</th>                                                 
                                        </tr>
                                    </thead>
                                    <tbody>      
                                
                                @foreach($observacoes as $observacao)                                                                   
                                        <tr>                                                                                              
                                            <td class="text-center">{{$observacao->id}}</td>                                   
                                            <td class="text-center">{{date('d/m/Y',strtotime($observacao->dte_observacao))}}</td>                                   
                                            <td class="text-center">{{$observacao->txt_observacao}}</td>                                                          
                                            <td class="text-center">{{$observacao->user->name}}</td>  
                                            
                                        </tr>    
                                @endforeach                                                       
                                    </tbody>
                                </table> 
                            </div>
                        @endif    
                            <span class="documentByLine">
                                @if($operacaoRetomada->updated_at)
                                    <span class="summary-view-icon">Posição Retomada: {{date('d/m/Y',strtotime($operacaoRetomada->updated_at))}}</span>  
                                @else    
                                    <span class="summary-view-icon">Posição Retomada: {{date('d/m/Y',strtotime($operacaoRetomada->created_at))}}</span>  
                                @endif    
                            </span>   
                    </div><!-- nav-retomada-->
                        @endif
<!-- ///////////////////////////////////////////////// inicio nav-pac /////////////////////////////////////////////////--> 
                    @if($projetosPac)        
                    <div class="tab-pane fade show" id="nav-projetosPac" role="tabpanel" aria-labelledby="nav-projetosPac-tab">
                        @foreach($projetosPac as $projetos)
                        <div class="alert alert-dark" role="alert">
                            <div id="viewlet-above-content-title"></div>
                            <h4  class="documentFirstHeading text-center">
                                Projeto nº {{$projetos->projeto_pac_id}}
                            </h4>                                
                        </div><!-- fim alert-->

                        <div class="titulo">
                            <h5>Dados do Projeto PAC </h5> 
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="column col-xs-12 col-md-2">
                                    <label class="control-label label-relatorio">Código do Projeto</label>
                                    <input id="projeto_pac_id" type="text" class="form-control input-relatorio" name="projeto_pac_id" value="{{$projetos->projeto_pac_id}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">Código de Identificação Externo</label>
                                    <input id="txt_cod_identificao_externo" type="text" class="form-control input-relatorio" name="txt_cod_identificao_externo" value="{{$projetos->txt_cod_identificao_externo}}" disabled >
                                </div>  
                                <div class="column col-xs-12 col-md-5">
                                    <label class="control-label label-relatorio">Nome do Empreendimento</label>
                                    <input id="txt_nome_empreendimento_pac" type="text" class="form-control input-relatorio" name="txt_nome_empreendimento_pac" value="{{$projetos->txt_nome_empreendimento_pac}}" disabled >
                                </div>   
                                <div class="column col-xs-12 col-md-2">
                                    <label class="control-label label-relatorio">UH Previstas</label>
                                    <input id="num_uh_previstas_mcmv" type="text" class="form-control input-relatorio" name="num_uh_previstas_mcmv" value="{{$projetos->num_uh_previstas_mcmv}}" disabled >
                                </div>                     
                            </div>
                            <!-- fim row-->  

                            <div class="row">
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Programa</label>
                                    <input id="txt_programa" type="text" class="form-control input-relatorio" name="txt_programa" value="{{$projetos->txt_programa}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Situação</label>
                                    <input id="txt_situacao_contrato_pac" type="text" class="form-control input-relatorio" name="txt_situacao_contrato_pac" value="{{$projetos->txt_situacao_contrato_pac}}" disabled >
                                </div>  
                                <div class="column col-xs-12 col-md-2">
                                    <label class="control-label label-relatorio">Data Assinatura</label>
                                    <input id="dte_assinatura" type="text" class="form-control input-relatorio" name="dte_assinatura" value="@if($projetos->dte_assinatura){{date('d/m/Y',strtotime($projetos->dte_assinatura))}}@endif" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-2">
                                    <label class="control-label label-relatorio">Data de Vigência</label>
                                    <input id="dte_vigencia" type="text" class="form-control input-relatorio" name="dte_vigencia" value="@if($projetos->dte_vigencia){{date('d/m/Y',strtotime($projetos->dte_vigencia))}}@endif" disabled >
                                </div>                  
                            </div>
                            <!-- fim row-->  

                            <div class="row">
                                <div class="column col-xs-12 col-md-2">
                                    <label class="control-label label-relatorio">UF</label>
                                    <input id="txt_sigla_uf" type="text" class="form-control input-relatorio" name="txt_sigla_uf" value="{{$projetos->txt_sigla_uf}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label label-relatorio">Tomador</label>
                                    <input id="txt_tomador" type="text" class="form-control input-relatorio" name="txt_tomador" value="{{$projetos->txt_tomador}}" disabled >
                                </div>  
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">Logradouro</label>
                                    <input id="txt_logradouro" type="text" class="form-control input-relatorio" name="txt_logradouro" value="{{$projetos->txt_logradouro}}" disabled >
                                </div>                  
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label label-relatorio">Localidade</label>
                                    <input id="txt_localidade" type="text" class="form-control input-relatorio" name="txt_localidade" value="{{$projetos->txt_localidade}}" disabled >
                                </div>                  
                            </div>
                            <!-- fim row-->  

                            <div class="row">
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label label-relatorio">Eixo</label>
                                    <input id="txt_eixo" type="text" class="form-control input-relatorio" name="txt_eixo" value="{{$projetos->txt_eixo}}" disabled >
                                </div>
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label label-relatorio">Modalidade</label>
                                    <input id="txt_modalidade_pac" type="text" class="form-control input-relatorio" name="txt_modalidade_pac" value="{{$projetos->txt_modalidade_pac}}" disabled >
                                </div>
                            </div> 
                            <!-- fim row-->  

                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label label-relatorio">Objeto PAC</label>
                                    <textarea class="form-control input-relatorio" id="txt_objeto" rows="3">{{$projetos->txt_objeto}}</textarea>
                                </div>
                            </div> 
                            <!-- fim row-->  

                            @if($projetos->operacoes)                    
                                
                                    <div class="titulo">
                                        <h5>Operações Vinculadas</h5> 
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table  table-hover table-sm">
                                            <thead  class="text-center">
                                                <tr class="text-center">
                                                    <th>APF</th>
                                                    <th>Situação Vinculação</th>
                                                    <th>Empreendimento</th>  
                                                    <th>UH Prevista</th>
                                                    <th>UH Contratada</th>
                                                    <th>% Obra</th>
                                                    
                                                    <th>Valor Oper.</th>
                                                    <th>Valor Inv.</th>
                                                    <th>Situação Obra</th>                                       
                                                </tr>
                                            </thead>
                                            <tbody>                                                  
                                                @foreach($projetos->operacoes as $dados)        
                                                    @if($operacao->operacao_id == $dados->operacao_id)
                                                        <tr class="table-info text-center ">          
                                                    @else
                                                        <tr class="text-center">         
                                                    @endif    
                                                        
                                                            <td>{{$dados->operacao_id}}</td>                               
                                                            <td>{{$dados->txt_situacao_vinculacao}}</td>  
                                                            <td>{{$dados->txt_nome_empreendimento_mcmv}}</td>  
                                                            <td>{{number_format( ($dados->num_uh_mcmv), 0, ',' , '.')}}</td>     
                                                            <td>{{number_format( ($dados->qtd_uh_financiadas), 0, ',' , '.')}}</td>  
                                                            <td>{{number_format( ($dados->prc_obra_realizado), 0, ',' , '.')}}</td>     
                                                            <td>{{number_format( ($dados->vlr_operacao), 2, ',' , '.')}}</td>    
                                                            <td>{{number_format( ($dados->vlr_investimento), 2, ',' , '.')}}</td>    
                                                            <td>{{$dados->txt_situacao_obra}}</td>                                          
                                                        </tr>     
                                                @endforeach       
                                            </tbody>
                                        </table> 
                                    </div> <!-- fim table-responsive-->                                
                        @endif 




                        </div><!-- fim form-group-->    


                        @endforeach

                    
                    </div><!-- nav-pac-->
                    @endif
                @endcan
            </div>
            <!-- fim tab-content-->    
        <!-- fim conteudo abas-->    
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
        </div>
<!-- fim content-core-->    


    </div>
    <!-- fim content-->





@endsection