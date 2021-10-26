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
        @if(count($solicitacoesPagObs)>0)
          <div class="form-group">
                    <div class="titulo">
                        <h5>Resumo por Observação</h5>
                        
                    </div> 
                    <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
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
                </div>
              <!--form-group -->          
          </div>
          @endif

          
          @if(count($solicitacoesPagUhs)>0)
          <div class="form-group">
                    <div class="titulo">
                        <h5>Resumo por UF</h5>
                        
                    </div> 
                    <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>UF</th>                                
                                <th class="text-center">Qtde Solicitado</th>
                                <th class="text-center">Valor Solicitado</th>
                                <th class="text-center">Qtde Liberado</th>
                                <th class="text-center">Valor Liberado</th>                                
                                <th class="text-center">Valor a Liberar</th> 
                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($solicitacoesPagUhs as $dados)
                                <tr>                        
                                    <td >{{$dados->txt_sigla_uf}}</td>
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

          @if(count($solicitacoesPagMes)>0)
          <div class="form-group">
                    <div class="titulo">
                        <h5>Resumo por Mês e Observação</h5>
                        
                    </div> 
                    <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>Mês</th>                                
                                <th class="text-center">Qtde Solicitado</th>
                                <th class="text-center">Valor Solicitado</th>
                                <th class="text-center">Qtde Liberado</th>
                                <th class="text-center">Valor Liberado</th>                                
                                <th class="text-center">Valor a Liberar</th> 
                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($solicitacoesPagMes as $dados)
                            <tr  class="totalFaixa">                        
                                    <td >{{$dados->mes_solicitacao}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado), 2, ',' , '.')}}</td>   
                                    <td class="tabelaFaixa">{{number_format( ($dados->qtd_liberacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa">{{number_format( ($dados->total_liberado), 2, ',' , '.')}}</td>                 
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado - $dados->total_liberado), 2, ',' , '.')}}</td>                                                    
                                </tr>   
                                 @foreach($dados->observacoes as $observacao)
                                    <tr >                        
                                        <td class="tr_recuo">{{$observacao->txt_observacao}}</td>
                                        <td class="tabelaFaixa text-center">{{number_format( ($observacao->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                        <td class="tabelaFaixa text-center">{{number_format( ($observacao->total_solicitado), 2, ',' , '.')}}</td>   
                                        <td class="tabelaFaixa">{{number_format( ($observacao->qtd_liberacoes), 0, ',' , '.')}}</td>
                                        <td class="tabelaFaixa">{{number_format( ($observacao->total_liberado), 2, ',' , '.')}}</td>                 
                                        <td class="tabelaFaixa text-center">{{number_format( ($observacao->total_solicitado - $observacao->total_liberado), 2, ',' , '.')}}</td>                                                    
                                    </tr>   
                                @endforeach                                      
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
                        <h5>Resumo por Mês e Tipo de Liberações</h5>
                        
                    </div> 
                    <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>Mês</th>                                
                                <th class="text-center">Qtde Solicitado</th>
                                <th class="text-center">Valor Solicitado</th>
                                <th class="text-center">Qtde Liberado</th>
                                <th class="text-center">Valor Liberado</th>                                
                                <th class="text-center">Valor a Liberar</th> 
                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($solicitacoesPagMes as $dados)
                            <tr  class="totalFaixa">                        
                                    <td >{{$dados->mes_solicitacao}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado), 2, ',' , '.')}}</td>   
                                    <td class="tabelaFaixa">{{number_format( ($dados->qtd_liberacoes), 0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa">{{number_format( ($dados->total_liberado), 2, ',' , '.')}}</td>                 
                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->total_solicitado - $dados->total_liberado), 2, ',' , '.')}}</td>                                                    
                                </tr>   
                                 @foreach($dados->tipo_liberacoes as $tipo)
                                    <tr >                        
                                        <td class="tr_recuo">{{$tipo->txt_tipo_liberacao}}</td>
                                        <td class="tabelaFaixa text-center">{{number_format( ($tipo->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                        <td class="tabelaFaixa text-center">{{number_format( ($tipo->total_solicitado), 2, ',' , '.')}}</td>   
                                        <td class="tabelaFaixa">{{number_format( ($tipo->qtd_liberacoes), 0, ',' , '.')}}</td>
                                        <td class="tabelaFaixa">{{number_format( ($tipo->total_liberado), 2, ',' , '.')}}</td>                 
                                        <td class="tabelaFaixa text-center">{{number_format( ($tipo->total_solicitado - $tipo->total_liberado), 2, ',' , '.')}}</td>                                                    
                                    </tr>   
                                @endforeach                                      
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
