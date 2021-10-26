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
    <span >Solicitações e Liberações</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/pagamento/quadro_resumo/filtro')}}">Consulta Quadro Resumo de Solicitações e Liberações</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Relatório Executivo</span>
        </span>

    
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Solicitação e Liberação de Pagamento
        </h2>
        <span class="documentFirstHeadingSpan">
            Quadro Resumo
        </span> 
        <span class="documentFirstHeadingSpan">
            @if($municipio)
                {{trim($municipio->ds_municipio)}}-{{$estado->txt_sigla_uf}}
            @elseif($estado)
                {{$estado->txt_uf}}
            @endif
        </span> 
        <span class="documentFirstHeadingSpan">
            @if($tipoLiberacao)
                {{$tipoLiberacao->txt_tipo_liberacao}}        
            @endif
        </span> 
        <span class="documentFirstHeadingSpan">
            
        </span>
        <span class="documentFirstHeadingSpan">
        @if($posicaoDe != '')
            @if(($posicaoDe) && (!$posicaoAte))
                Data da Solicitação: {{date('d/m/Y',strtotime($posicaoDe))}}
            @else
                Período da Solicitação: de {{date('d/m/Y',strtotime($posicaoDe))}} até {{date('d/m/Y',strtotime($posicaoAte))}}        
            @endif
        @else    
            @if($mes)
                Mês Solicitação: {{$mes->txt_mes}}        
            @endif    
        @endif    
        
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
        </span>
        <div class="linha-separa"></div>


    <div id="content-core">
            <!-- form-group-->   
        @if(count($totalSolicitacoesPagamento1Parcela)>0)
          <div class="form-group">
                    <div class="titulo">
                        <h5>Liberações da 1ª Parcela</h5>
                        
                    </div> 
                    <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>Ano</th>
                                <th>Mês</th>
                                <th>Tipo Solicitação</th>                                                
                                <th class="text-center">Qtde Solicitado</th>
                                <th class="text-center">Valor Solicitado</th>
                                @if($total1Parcela['qtd_liberacoes']>0)
                                    <th class="text-center">Qtde Liberado</th>
                                    <th class="text-center">Valor Liberado</th>
                                @endif
                            </tr>
                                                
                        </thead>
                        <tbody>
                        @foreach($totalSolicitacoesPagamento1Parcela as $total)                    
                            @foreach($total->solicitacoes as $dados)
                                <tr>                        
                                    <td >{{$dados->ano_solicitacao}}</td>
                                    <td>{{$dados->mes_solicitacao}}</td>
                                    <td>{{$dados->txt_tipo_liberacao}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado), 2, ',' , '.')}}</td>   
                                    @if($total1Parcela['qtd_liberacoes']>0)
                                        <td class="tabelaFaixa">{{number_format( ($dados->qtd_liberacoes), 0, ',' , '.')}}</td>
                                        <td class="tabelaFaixa">{{number_format( ($dados->total_liberado), 2, ',' , '.')}}</td>                              
                                    @endif                                    
                                </tr>
                                
                            @endforeach               
                            
                            <tr  class="totalFaixa">                        
                                <td colspan="3" class="tabelaNumero">SubTotal</td>
                                <td class="tabelaFaixa">{{number_format( ($total->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                <td class="tabelaFaixa">{{number_format( ($total->total_solicitado), 2, ',' , '.')}}</td>    
                                @if($total1Parcela['qtd_liberacoes']>0)
                                    <td class="tabelaFaixa">{{number_format( ($total->qtd_liberacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa">{{number_format( ($total->total_liberado), 2, ',' , '.')}}</td>                              
                                @endif                              
                            </tr>                    
                        @endforeach   
                        
                        <tr  class="total">                        
                                <td colspan="3" class="tabelaNumero">TOTAL</td>
                                <td class="tabelaFaixa">{{number_format( ($total1Parcela['qtd_solicitacoes']), 0, ',' , '.')}}</td>
                                <td class="tabelaFaixa">{{number_format( ($total1Parcela['total_solicitado']), 2, ',' , '.')}}</td>   
                                @if($total1Parcela['qtd_liberacoes']!=0)
                                    <td class="tabelaFaixa">{{number_format( ($total1Parcela['qtd_liberacoes']), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa">{{number_format( ($total1Parcela['total_liberado']), 2, ',' , '.')}}</td>                              
                                @endif    
                            </tr> 
                        
                        </tbody>
                    </table>     
                </div>
              <!--form-group -->          
          </div>
          @endif
          
          @if(count($totalSolicitacoesPagamento)>0)
            <!-- form-group-->              
            <div class="form-group">
                    <div class="titulo">
                        <h5>Liberações demais Parcelas</h5>
                        
                    </div> 
                    <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>Ano</th>
                                <th>Mês</th>
                                <th>Tipo Solicitação</th>                                                
                                <th class="text-center">Qtde Solicitado</th>
                                <th class="text-center">Valor Solicitado</th>
                                <th class="text-center">Qtde Liberado</th>
                                <th class="text-center">Valor Liberado</th>
                                <th class="text-center">Qtde a Liberar</th>
                                <th class="text-center">Saldo a Liberar</th>
                            </tr>
                                                
                        </thead>
                        <tbody>
                        @foreach($totalSolicitacoesPagamento as $total)                    
                            @foreach($total->solicitacoes as $dados)
                                <tr>                        
                                    <td >{{$dados->ano_solicitacao}}</td>
                                    <td>{{$dados->mes_solicitacao}}</td>
                                    <td>{{$dados->txt_tipo_liberacao}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado), 2, ',' , '.')}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->qtd_liberacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->total_liberado), 2, ',' , '.')}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->qtd_solicitacoes-$dados->qtd_liberacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado-$dados->total_liberado), 2, ',' , '.')}}</td>
                                </tr>
                                
                            @endforeach               
                            
                            <tr  class="totalFaixa">                        
                                <td colspan="2">SubTotal</td>
                                <td>{{$total->mes_solicitacao}}</td>
                                <td class="tabelaFaixa">{{number_format( ($total->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                <td class="tabelaFaixa">{{number_format( ($total->total_solicitado), 2, ',' , '.')}}</td>
                                <td class="tabelaFaixa">{{number_format( ($total->qtd_liberacoes), 0, ',' , '.')}}</td>
                                <td class="tabelaFaixa">{{number_format( ($total->total_liberado), 2, ',' , '.')}}</td>  
                                <td class="tabelaFaixa">{{number_format( ($total->qtd_solicitacoes-$total->qtd_liberacoes), 0, ',' , '.')}}</td>
                                <td class="tabelaFaixa">{{number_format( ($total->total_solicitado-$total->total_liberado), 2, ',' , '.')}}</td>                      
                            </tr>                    
                        @endforeach  
                            <tr  class="total">                        
                                <td colspan="3" class="tabelaNumero">TOTAL</td>
                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacao['qtd_solicitacoes']), 0, ',' , '.')}}</td>
                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacao['total_solicitado']), 2, ',' , '.')}}</td>                                
                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacao['qtd_liberacoes']), 0, ',' , '.')}}</td>
                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacao['total_liberado']), 2, ',' , '.')}}</td>  
                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacao['qtd_solicitacoes']-$totalSolicitacao['qtd_liberacoes']), 0, ',' , '.')}}</td>                              
                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacao['total_solicitado']-$totalSolicitacao['total_liberado']), 2, ',' , '.')}}</td>                                
                            </tr>  
                        </tbody>
                    </table>     
                </div>
              <!--form-group -->          
          </div>
        @endif
          
    </div><!-- content-core-->


</div><!-- content-->



@endsection
