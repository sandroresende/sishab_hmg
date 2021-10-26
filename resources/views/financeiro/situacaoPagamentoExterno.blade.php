@extends('layouts.app')

@section('scripts')
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet">
@endsection

@section('content')
<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
        <a href="{{ url('/') }}">Página Inicial</a>
        <span class="breadcrumbSeparator">
            &gt;            
        </span>
    </span>
    
    <span dir="ltr" id="breadcrumbs-1">        
    <span >Financeiro</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/externo/pagamento/situacao/filtro')}}">Consulta Situação Pagamento</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Relação de Solicitações de Pagamentos</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Relação de Solicitações de Pagamentos
        </h2>     
        @if($totalSolicitacaoPagObs['nome_empreendimento'] != '')
        <h4 class="documentFirstHeading text-center">{{$totalSolicitacaoPagObs['nome_empreendimento']}}</h4>   
        <h5 class="documentFirstHeading text-center"> {{$totalSolicitacaoPagObs['municipio']}}-{{$totalSolicitacaoPagObs['sigla_uf']}}</h5>   
        <h5 class="documentFirstHeading text-center">APF:  {{$numApf}}</h5>
        @endif
        <div class="linha-separa"></div>


    <div id="content-core">
            <!-- form-group-->              
        <div class="form-group">
       
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">
                   

                    @if($posicaoDeLib != '')
                        @if(($posicaoDeLib) && (!$posicaoAteLib))
                            Data da Liberação: {{date('d/m/Y',strtotime($posicaoDeLib))}}
                        @else
                            Período da Liberação: de {{date('d/m/Y',strtotime($posicaoDeLib))}} até {{date('d/m/Y',strtotime($posicaoAteLib))}}        
                        @endif
                    @else    
                        @if($mesLiberacao)
                            Mês Liberação: {{$mesLiberacao->txt_mes}}        
                        @endif    
                    @endif   

                        
                    
                    </h3>
                    @if(count($solicitacoesPagObs)>0)
                    <div class="form-group">
                            <div class="titulo">
                                <h5>Resumo por Modalidade</h5>
                                
                            </div> 
                            <div class="table-responsive">		
                            <table class="table table-bordered table-sm tab_executivo">
                                <thead>
                                    <tr style="max-widh:1142;">
                                        <th>Modalidade</th>                                
                                        <th class="text-center">Qtde Solicitado</th>
                                        <th class="text-center">Valor Solicitado</th>
                                        <th class="text-center">Qtde Liberado</th>
                                        <th class="text-center">Valor Liberado</th>                                
                                        <th class="text-center">Valor a Liberar</th> 
                                    </tr>
                                                        
                                </thead>
                                <tbody>
                                    @foreach($solicitacoesPagMod as $dados)
                                        <tr>                        
                                            <td >{{$dados->txt_modalidade}}</td>
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
                        </div>
                        <!--form-group -->          
                    </div>
                        <div class="form-group">
                            <div class="titulo">
                                <h5>Resumo por Situação</h5>
                                
                            </div> 
                            <div class="table-responsive">		
                            <table class="table table-bordered table-sm tab_executivo">
                                <thead>
                                    <tr style="max-widh:1142;">
                                        <th>Situação</th>                                
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
                        </div>
                        <!--form-group -->          
                    </div>
                @endif

                        <div  class="titulo">
                                <h5>Relação de Solicitações</h5> 
                        </div>
                        <tabela-relatorios
                                v-bind:titulos="{{json_encode($cabecalhoTab)}}"
                                v-bind:itens="{{json_encode($solicitacoesPag)}}"
                                show= ""


                            >           
                        </tabela-relatorios> 
                    <!--
                        @if(count($solicitacoesPag)>0)
                        <div class="form-group">
                                    <div class="titulo">
                                        <h5>Relação de Solicitações</h5>
                                        
                                    </div> 
                                    <div class="table-responsive">		
                                    <table class="table table-bordered table-sm tab_executivo">
                                        <thead>
                                            <tr>
                                                <th>Data da Solicitação</th>                                
                                                <th class="text-center">APF</th>
                                                <th class="text-center">UF</th>
                                                <th class="text-center">Município</th>                                
                                                <th class="text-center">Empreendimento</th> 
                                                <th class="text-center">Valor Solicitado</th>  
                                                <th class="text-center">Valor Liberado</th>
                                                <th class="text-center">Data da Liberação</th>
                                                <th class="text-center">Valor a Liberar</th>                                
                                                <th class="text-center">Tipo de Liberação</th> 
                                                <th class="text-center">Mês/Ano da Assinatura</th>
                                                <th class="text-center">Observação</th> 
                                            </tr>
                                                                
                                        </thead>
                                        <tbody>
                                            
                                            @foreach($solicitacoesPag as $dados)
                                            
                                                <tr>                        
                                                    <td class="tabelaFaixa">@if($dados->dte_solicitacao){{date('d/m/Y',strtotime($dados->dte_solicitacao))}}@endif</td>     
                                                    <td >{{$dados->operacao_id}}</td>
                                                    <td >{{$dados->txt_sigla_uf}}</td>
                                                    <td >{{$dados->ds_municipio}}</td>
                                                    <td >{{$dados->txt_nome_empreendimento}}</td>
                                                                                                     
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_solicitado), 2, ',' , '.')}}</td>
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_liberado), 2, ',' , '.')}}</td>   
                                                    <td class="tabelaFaixa">@if($dados->dte_liberacao){{date('d/m/Y',strtotime($dados->dte_liberacao))}}@endif</td>                                                   
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_solicitado - $dados->vlr_liberado), 2, ',' , '.')}}</td>  
                                                    <td >{{$dados->txt_tipo_liberacao_abreviado}}</td>                                                 
                                                    <td >{{ str_limit($dados->mes_assinatura, $limit = 3, $end = '/') }}{{$dados->ano_assinatura}}</td>
                                                    <td >{{$dados->txt_observacao}}</td>

                                                </tr>                                
                                            @endforeach                                           
                                            <tr  class="total">                        
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['qtd_solicitacoes']), 0, ',' , '.')}}</td>
                                                <td colspan="4"  class="tabelaNumero text-center">TOTAL</td>
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_solicitado']), 2, ',' , '.')}}</td>   
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_liberado']), 2, ',' , '.')}}</td>     
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['qtd_liberacoes']), 0, ',' , '.')}}</td>
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPagObs['total_solicitado']-$totalSolicitacaoPagObs['total_liberado']), 2, ',' , '.')}}</td>                                                        
                                                <td colspan="3"  class="tabelaNumero"></td>
                                            </tr>                         
                                        </tbody>
                                    </table>     
                                </div>
                            
                        </div>
                        @endif
-->
                    
                        
                    
                    </blockquote>
                </div>
            </div>
           
            
              <!--form-group -->          
          </div>
          <div class="form-group">
            <div class="row ">  
                <div class="col-sm-12 text-secondary">
                    
                            Posição: {{date('d/m/Y',strtotime($dtePosicao))}}
               
                </div><!--fim column col-sm-12-->
            </div>
          </div>
    </div><!-- content-core-->


</div><!-- content-->



@endsection
