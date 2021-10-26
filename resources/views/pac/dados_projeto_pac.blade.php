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
        <a href="{{url('/vinculadas/filtro')}}">Consulta Vinculadas</a>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href="#" onclick="javascript:window.history.go(-1)">Dados Vinculadas</a>
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
        
                    {{$projetosPac->txt_nome_empreendimento_pac}}</span>
                   
        </h2>
        <span class="documentFirstHeadingSpan">{{$projetosPac->txt_tomador}}</span>   
        @if($projetosPac->num_uh_previstas_mcmv)
        <span class="documentFirstHeadingSpan"><strong>{{$projetosPac->num_uh_previstas_mcmv}}</strong> unidades previstas</strong></span>   
        @endif
                    


    <div id="content-core">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-projetosPac-tab" data-toggle="tab" href="#nav-projetosPac" role="tab" aria-controls="nav-projetosPac" aria-selected="false">Projeto PAC</a>
                
                @if(count($investimentos)>0)
                    <a class="nav-item nav-link" id="nav-investimentos-tab" data-toggle="tab" href="#nav-investimentos" role="tab" aria-controls="nav-investimentos" aria-selected="false">Itens de Investimento</a>
                @endif

                @if(count($caracteristicas)>0)
                    <a class="nav-item nav-link" id="nav-caracteristicas-tab" data-toggle="tab" href="#nav-caracteristicas" role="tab" aria-controls="nav-caracteristicas" aria-selected="false">Características</a>
                @endif                

        
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">     
            <div class="tab-pane fade show active" id="nav-projetosPac" role="tabpanel" aria-labelledby="nav-projetosPac-tab">
                <div class="titulo">
                    <h5>Dados do Projeto PAC </h5> 
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label label-relatorio">Código do Projeto</label>
                            <input id="projeto_pac_id" type="text" class="form-control input-relatorio" name="projeto_pac_id" value="{{$projetosPac->projeto_pac_id}}" disabled >
                        </div>
                        <div class="column col-xs-12 col-md-3">
                            <label class="control-label label-relatorio">Código de Identificação Externo</label>
                            <input id="txt_cod_identificao_externo" type="text" class="form-control input-relatorio" name="txt_cod_identificao_externo" value="{{$projetosPac->txt_cod_identificao_externo}}" disabled >
                        </div>  
                        <div class="column col-xs-12 col-md-5">
                            <label class="control-label label-relatorio">Nome do Empreendimento</label>
                            <input id="txt_nome_empreendimento_pac" type="text" class="form-control input-relatorio" name="txt_nome_empreendimento_pac" value="{{$projetosPac->txt_nome_empreendimento_pac}}" disabled >
                        </div>   
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label label-relatorio">UH Previstas</label>
                            <input id="num_uh_previstas_mcmv" type="text" class="form-control input-relatorio" name="num_uh_previstas_mcmv" value="{{$projetosPac->num_uh_previstas_mcmv}}" disabled >
                        </div>                     
                    </div><!-- row-->
                    <div class="row">
                        <div class="column col-xs-12 col-md-4">
                            <label class="control-label label-relatorio">Programa</label>
                            <input id="txt_programa" type="text" class="form-control input-relatorio" name="txt_programa" value="{{$projetosPac->txt_programa}}" disabled >
                        </div>
                        <div class="column col-xs-12 col-md-4">
                            <label class="control-label label-relatorio">Situação</label>
                            <input id="txt_situacao_contrato_pac" type="text" class="form-control input-relatorio" name="txt_situacao_contrato_pac" value="{{$projetosPac->txt_situacao_contrato_pac}}" disabled >
                        </div>  
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label label-relatorio">Data Assinatura</label>
                            <input id="dte_assinatura" type="text" class="form-control input-relatorio" name="dte_assinatura" value="@if($projetosPac->dte_assinatura){{date('d/m/Y',strtotime($projetosPac->dte_assinatura))}}@endif" disabled >
                        </div>
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label label-relatorio">Data de Vigência</label>
                            <input id="dte_vigencia" type="text" class="form-control input-relatorio" name="dte_vigencia" value="@if($projetosPac->dte_vigencia){{date('d/m/Y',strtotime($projetosPac->dte_vigencia))}}@endif" disabled >
                        </div>                  
                    </div><!-- row-->
                    <div class="row">
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label label-relatorio">UF</label>
                            <input id="txt_sigla_uf" type="text" class="form-control input-relatorio" name="txt_sigla_uf" value="{{$projetosPac->txt_sigla_uf}}" disabled >
                        </div>
                        <div class="column col-xs-12 col-md-4">
                            <label class="control-label label-relatorio">Tomador</label>
                            <input id="txt_tomador" type="text" class="form-control input-relatorio" name="txt_tomador" value="{{$projetosPac->txt_tomador}}" disabled >
                        </div>  
                        <div class="column col-xs-12 col-md-3">
                            <label class="control-label label-relatorio">Logradouro</label>
                            <input id="txt_logradouro" type="text" class="form-control input-relatorio" name="txt_logradouro" value="{{$projetosPac->txt_logradouro}}" disabled >
                        </div>                  
                        <div class="column col-xs-12 col-md-3">
                            <label class="control-label label-relatorio">Localidade</label>
                            <input id="txt_localidade" type="text" class="form-control input-relatorio" name="txt_localidade" value="{{$projetosPac->txt_localidade}}" disabled >
                        </div>                  
                    </div><!-- row-->
                    <div class="row">
                        <div class="column col-xs-12 col-md-6">
                            <label class="control-label label-relatorio">Eixo</label>
                            <input id="txt_eixo" type="text" class="form-control input-relatorio" name="txt_eixo" value="{{$projetosPac->txt_eixo}}" disabled >
                        </div>
                        <div class="column col-xs-12 col-md-6">
                            <label class="control-label label-relatorio">Modalidade</label>
                            <input id="txt_modalidade_pac" type="text" class="form-control input-relatorio" name="txt_modalidade_pac" value="{{$projetosPac->txt_modalidade_pac}}" disabled >
                        </div>
                    </div><!-- row-->
                        <div class="row">
                            <div class="column col-xs-12 col-md-12">
                                <label class="control-label label-relatorio">Objeto PAC</label>
                                <textarea class="form-control input-relatorio" id="txt_objeto" rows="3">{{$projetosPac->txt_objeto}}</textarea>
                            </div>                        
                        </div><!-- row-->
                </div><!-- form-group-->

                 @if($dadosObras)
                    <div class="titulo">
                        <h5>Dados Obra </h5> 
                    </div>
                    <div class="form-group">
                        <div class="row">
                            @if($dadosObras->dte_inicio_obra)
                             <div class="column col-xs-12 col-md-2">
                                <label class="control-label label-relatorio">Data Início</label>
                                <input id="dte_inicio_obra" type="text" class="form-control input-relatorio" name="dte_inicio_obra" value="@if($dadosObras->dte_inicio_obra){{date('d/m/Y',strtotime($dadosObras->dte_inicio_obra))}}@endif" disabled >
                            </div>
                            @else
                            <div class="column col-xs-12 col-md-2">
                                <label class="control-label label-relatorio">Data Previsão Início</label>
                                <input id="dte_previsao_inicio_obra" type="text" class="form-control input-relatorio" name="dte_previsao_inicio_obra" value="@if($dadosObras->dte_previsao_inicio_obra){{date('d/m/Y',strtotime($dadosObras->dte_previsao_inicio_obra))}}@endif" disabled >
                            </div>      
                            @endif

                             @if($dadosObras->dte_termino_obra)
                             <div class="column col-xs-12 col-md-2">
                                <label class="control-label label-relatorio">Data Término</label>
                                <input id="dte_termino_obra" type="text" class="form-control input-relatorio" name="dte_termino_obra" value="@if($dadosObras->dte_termino_obra){{date('d/m/Y',strtotime($dadosObras->dte_termino_obra))}}@endif" disabled >
                            </div>
                            @else
                            <div class="column col-xs-12 col-md-2">
                                <label class="control-label label-relatorio">Data Previsão Término</label>
                                <input id="dte_previsao_termino_obra" type="text" class="form-control input-relatorio" name="dte_previsao_termino_obra" value="@if($dadosObras->dte_previsao_termino_obra){{date('d/m/Y',strtotime($dadosObras->dte_previsao_termino_obra))}}@endif" disabled >
                            </div>      
                            @endif
                            <div class="column col-xs-12 col-md-2">
                                <label class="control-label label-relatorio">Data Início Propon.</label>
                                <input id="dte_inicio_obra_proponente" type="text" class="form-control input-relatorio" name="dte_inicio_obra_proponente" value="@if($dadosObras->dte_inicio_obra_proponente){{date('d/m/Y',strtotime($dadosObras->dte_inicio_obra_proponente))}}@endif" disabled >
                            </div>
                            
                            <div class="column col-xs-12 col-md-2">
                                <label class="control-label label-relatorio">% Obra</label>
                                <input id="prc_execucao_fisica" type="text" class="form-control input-relatorio" name="prc_execucao_fisica" value="{{number_format($dadosObras->prc_execucao_fisica, 2, ',' , '.')}}" disabled >
                            </div>                     
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Situação da Obra</label>
                                <input id="situacao_obra_pac" type="text" class="form-control input-relatorio" name="situacao_obra_pac" value="{{$dadosObras->situacaoObraPac->txt_situacao_obra_pac}}" disabled >
                            </div>   
                        </div><!-- row-->
                        @if($dadosObras->dsc_ultima_providencia_obra)
                        <div class="row">
                            <div class="column col-xs-12 col-md-12">
                                <label class="control-label label-relatorio">Última Providência</label>
                                <textarea class="form-control input-relatorio" id="dsc_ultima_providencia_obra" rows="3">{{$dadosObras->dsc_ultima_providencia_obra}}</textarea>
                            </div>
                        </div>  <!-- row-->
                        @endif

                    </div><!-- form-group-->
                 @endif

                  @if($dadosFinanceiros)    
                    <div class="titulo">
                        <h5>Dados Financeiros </h5> 
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">Orçamento</label>
                                <input id="vlr_orcamento" type="text" class="form-control input-relatorio" name="vlr_orcamento" value="{{number_format($dadosFinanceiros->vlr_orcamento, 2, ',' , '.')}}" disabled >
                            </div>                                 
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">Contratado</label>
                                <input id="vlr_contratado" type="text" class="form-control input-relatorio" name="vlr_contratado" value="{{number_format($dadosFinanceiros->vlr_contratado, 2, ',' , '.')}}" disabled >
                            </div>   
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">Contrapartida</label>
                                <input id="vlr_contrapartida" type="text" class="form-control input-relatorio" name="vlr_contrapartida" value="{{number_format($dadosFinanceiros->vlr_contrapartida, 2, ',' , '.')}}" disabled >
                            </div>   
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">Liberado</label>
                                <input id="vlr_liberado" type="text" class="form-control input-relatorio" name="vlr_liberado" value="{{number_format($dadosFinanceiros->vlr_liberado, 2, ',' , '.')}}" disabled >
                            </div>                               
                        </div><!-- row-->
                    </div><!-- form-group-->
                  @endif

                  @if(count($operacoesPac)>0)
                     <div class="titulo">
                         <h5>Operações Vinculadas</h5> 
                     </div>
                     <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm">
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
                                @foreach($operacoesPac as $operacoes)
                                    <tr class="text-center">
                                        <td>{{$operacoes->operacao_id}}</td>                               
                                        <td>{{$operacoes->txt_situacao_vinculacao}}</td>  
                                        <td>{{$operacoes->txt_nome_empreendimento_mcmv}}</td>  
                                        <td>{{number_format( ($operacoes->num_uh_mcmv), 0, ',' , '.')}}</td>     
                                        <td>{{number_format( ($operacoes->qtd_uh_financiadas), 0, ',' , '.')}}</td>  
                                        <td>{{number_format( ($operacoes->prc_obra_realizado), 0, ',' , '.')}}</td>     
                                        <td>{{number_format( ($operacoes->vlr_operacao), 2, ',' , '.')}}</td>    
                                        <td>{{number_format( ($operacoes->vlr_investimento), 2, ',' , '.')}}</td>    
                                        <td>{{$operacoes->txt_situacao_obra}}</td>                                          
                                    </tr>                                                            
                                @endforeach                                                           
                                </tbody>
                            </table> 
                        </div>
                     </div><!-- form-group-->
                  @endif

                   @if(count($municipiosBeneficiados)>0)
                     <div class="titulo">
                         <h5>Municípios Beneficiados</h5> 
                     </div>
                     <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm">
                                <thead  class="text-center">
                                    <tr class="text-center">
                                        <th>UF</th>
                                        <th>Município</th>
                                    </tr>
                                </thead>
                                <tbody>                                      
                                @foreach($municipiosBeneficiados as $municipio)
                                    <tr class="text-center">
                                        <td>{{$municipio->txt_uf}}</td>                               
                                        <td>{{$municipio->ds_municipio}}</td>                             
                                    </tr>                                                            
                                @endforeach                                                           
                                </tbody>
                            </table> 
                        </div>
                     </div><!-- form-group-->
                  @endif
            </div><!--nav-projetosPac -->
            
            @if(count($investimentos)>0)
            <div class="tab-pane fade" id="nav-investimentos" role="tabpanel" aria-labelledby="nav-investimentos-tab">
                <div class="titulo">
                    <h5>Itens de Investimento</h5> 
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead  class="text-center">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Item de Investimento</th>
                                    <th>Valor do Investimento</th>                               
                                </tr>
                            </thead>
                            <tbody>                                  
                            @foreach($investimentos as $investimento)   
                                <tr class="text-center">                                                      
                                    <td>{{$investimento->item_investimento_id}}</td>                               
                                    <td>{{$investimento->txt_item_investimento}}</td>  
                                    <td>{{number_format( ($investimento->vlr_item_investimento), 2, ',' , '.')}}</td>        
                                </tr>
                            @endforeach                           
                            </tbody>
                        </table> 
                    </div>
                </div><!-- form-group-->
            </div><!--nav-investimentos -->
            @endif
            
            @if(count($caracteristicas)>0)
                <div class="tab-pane fade" id="nav-caracteristicas" role="tabpanel" aria-labelledby="nav-caracteristicas-tab">
                    <div class="form-group">
                        <div class="titulo">
                            <h5>Itens de Investimento</h5> 
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm">
                                <thead  class="text-center">
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Característica</th>
                                        <th>Valor do Característica</th>                               
                                    </tr>
                                </thead>
                                <tbody>                                      
                                @foreach($caracteristicas as $caracteristica)   
                                    <tr class="text-center">                                                      
                                        <td>{{$caracteristica->caracteristica_fisica_id}}</td>                               
                                        <td>{{$caracteristica->txt_caracteristica_fisica}}</td>  
                                        <td>{{number_format( ($caracteristica->vlr_caracteristica), 0, ',' , '.')}} {{$caracteristica->txt_unidade_medida}}</td>        
                                    </tr>    
                                @endforeach  
                                </tbody>
                            </table> 
                        </div>
                    </div><!-- form-group-->
                </div><!--nav-caracteristicas -->
            @endif
        </div>

        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">     
    </div><!-- content-core-->
</div><!-- content-->

@endsection