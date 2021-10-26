@extends('layouts.app')

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
            <a href="{{url('/retomadas/filtro')}}">Consulta Retomada de Obras</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Retomada de Obras</span>
        </span>
    </div>
    <div class="text-center">
        <img class="center-block" width='70' src="{{URL::asset('img/brasao_brasil.png')}}"  >
    </div>
    
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
<div id="viewlet-above-content-title">
        </div>

        <h2  class="documentFirstHeading text-center">
            @if($operacao->txt_nome_empreendimento) 
                {{$operacao->txt_nome_empreendimento}}</span>
            @else
                {{$operacao->cod_operacao}}
            @endif
        </h2>

        
        <span class="documentFirstHeadingSpan">
           {{$operacao->txt_modalidade}} - {{$operacao->dsc_faixa}} - Pmcmv {{$operacao->num_pmcmv}}
        </span>   

        <span class="documentFirstHeadingSpan">
        <STRONG> RETOMADA DE OBRAS</STRONG> 
        </span>   


        <span class="documentFirstHeadingSpan">
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
        </span>  

    <div id="content-core" class="relatorios">
        <div class="titulo">
            <h5>Dados Gerais </h5> 
        </div>
        <div class="form-group">
            <div class="row justify-content-between">
                <div class="col-3">
                    <label class="control-label ">APF</label>
                    <input id="txt_num_apf" type="text" class="form-control" name="txt_num_apf" value="{{$operacaoRetomada->operacao_id}}" disabled >
                </div>
                <div class="col-2">
                    <label class="control-label ">Sup</label>
                    <input id="num_suplementacao" type="text" class="form-control" name="num_suplementacao" value="{{$operacaoRetomada->num_suplementacao}}" disabled >
                </div>
            </div>    
            <div class="row">    
                <div class="column col-xs-12 col-md-6">
                    <label class="control-label ">Empreendimento</label>
                    <input id="txt_nome_empreendimento" type="text" class="form-control" name="txt_nome_empreendimento" value="{{$operacaoRetomada->txt_nome_empreendimento}}" disabled >
                </div>  
                <div class="column col-xs-12 col-md-2">
                    <label class="control-label ">UF</label>
                    <input id="txt_sigla_uf" type="text" class="form-control" name="txt_sigla_uf" value="{{$operacaoRetomada->txt_sigla_uf}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-4">
                    <label class="control-label ">Município</label>
                    <input id="ds_municipio" type="text" class="form-control" name="ds_municipio" value="{{$operacaoRetomada->ds_municipio}}" disabled >
                </div>                 
            </div>                
        </div><!-- fechar form-group--> 

            <div class="titulo">
            <h5>Informações sobre o contrato original do empreendimento</h5> 
        </div>
        <div class="form-group">
            <div class="row">     
                <div class="column col-xs-12 col-md-4">
                    <label class="control-label ">Assinatura</label>
                    <input id="dte_assinatura" type="text" class="form-control" name="dte_assinatura" value="@if($operacaoRetomada->dte_assinatura){{date('d/m/Y',strtotime($operacaoRetomada->dte_assinatura))}}@endif" disabled >
                </div>
                
                <div class="column col-xs-12 col-md-4">
                    <label class="control-label ">Percentual Obra</label>
                    <input id="prc_obra_realizado" type="text" class="form-control" name="prc_obra_realizado" value="{{number_format($operacao->prc_obra_realizado, 0, ',' , '.')}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-4">
                    <label class="control-label ">Situação Obra</label>
                    <input id="txt_situacao_obra" type="text" class="form-control" name="txt_situacao_obra" value="{{$operacaoRetomada->txt_situacao_obra}}" disabled >
                </div>
            </div>
            <div class="row">     
                
                <div class="column col-xs-12 col-md-4">
                    <label class="control-label ">UH</label>
                    <input id="qtd_uh_financiadas" type="text" class="form-control" name="qtd_uh_financiadas" value="{{number_format($operacaoRetomada->qtd_uh_financiadas, 0, ',' , '.')}}" disabled >
                </div>  
                    <div class="column col-xs-12 col-md-4">
                    <label class="control-label ">UH Concluídas</label>
                    <input id="qtd_uh_concluidas" type="text" class="form-control" name="qtd_uh_concluidas" value="{{number_format($operacao->qtd_uh_concluidas, 0, ',' , '.')}}" disabled >
                </div>     
                <div class="column col-xs-12 col-md-4">
                    <label class="control-label ">UH Entregues</label>
                    <input id="qtd_uh_entregues" type="text" class="form-control" name="qtd_uh_entregues" value="{{number_format($operacao->qtd_uh_entregues, 0, ',' , '.')}}" disabled >
                </div> 
                
            </div>
            <div class="row">                                
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label ">Valor Operação</label>
                    <input id="vlr_operacao" type="text" class="form-control" name="vlr_operacao" value="{{number_format($operacao->vlr_operacao, 2, ',' , '.')}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label ">Valor Desembolsado</label>
                    <input id="vlr_liberado" type="text" class="form-control" name="vlr_liberado" value="{{number_format($operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                </div>     
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label ">Valor a Liberar</label>
                    <input id="vlr_a_liberar" type="text" class="form-control" name="vlr_a_liberar" value="{{number_format($operacao->vlr_operacao-$operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                </div> 
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label ">% Financeiro</label>
                    <input id="prc_financeiro" type="text" class="form-control" name="prc_financeiro" value="{{number_format(($operacao->vlr_liberado/$operacao->vlr_operacao)*100, 2, ',' , '.')}}" disabled >
                </div>                         
            </div>
        </div><!-- fechar form-group--> 
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
                    <input id="dte_status_snh" type="text" class="form-control" name="dte_status_snh" value="@if($operacaoRetomada->dte_status_snh){{date('d/m/Y',strtotime($operacaoRetomada->dte_status_snh))}}@endif" disabled >
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

            


            <div class="titulo">
                <h5>Observações                    
                        <a href=""  data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fas fa-plus-circle"></i></a>
                </h5> 

            </div> 
        @if(count($observacoes)>0)          

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>#</th>                                                       
                        <th>Data</th> 
                        <th>Observação</th> 
                        <th>Realizado por</th>                         
                        <th>Ação</th>                        
                        </tr>
                    </thead>
                    <tbody>      
                
                @foreach($observacoes as $observacao)                                                                   
                        <tr>                                                                                              
                            <td class="text-center">{{$observacao->id}}</td>                                   
                            <td class="text-center">{{date('d/m/Y',strtotime($observacao->dte_observacao))}}</td>                                   
                            <td class="text-center">{{$observacao->txt_observacao}}</td>                                                          
                            <td class="text-center">{{$observacao->user->name}}</td>  
                            <td class="text-center">
                                <botao-excluir
                                    :url="'{{ url('/retomada/observacao/delete') }}'"
                                    :registro="{{$observacao->id}}"
                                >
                                
                                </botao-excluir>
                            </td>      
                        </tr>    
                @endforeach                                                       
                    </tbody>
                </table> 
            </div>
        @endif    

      
    </div><!-- content-core-->
</div><!-- content-->


<!--  Section-->
<section class="statistics">
    <div class="container-fluid" >
    <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">         
    </div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova Observação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ url('observacao/nova') }}" method="POST">
      @csrf
        <div class="modal-body">     
            <div class="form-group">
                <label for="observacao" class="col-form-label">Observação</label>
                <input type="hidden" id="retomada_obras_id" name="retomada_obras_id" value="{{$operacaoRetomada->id}}"/>
                <textarea class="form-control" id="observacao" name="observacao" rows="10" require></textarea>
            </div>        
        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-success">Salvar</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection