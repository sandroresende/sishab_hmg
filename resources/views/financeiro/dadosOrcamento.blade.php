@extends('layouts.app')

 @section('scripts')
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> @endsection @section('content')
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
            <a href="{{url('/orcamentos/filtro')}}">Consulta Orçamentos</a>
            <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Dados do Orçamento</span>
    </span>
</div>

    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">

    <div id="viewlet-above-content-title"></div>
    <h1 class="documentFirstHeading">
                  
    </h1>
    
    <div class="linha-separa"></div>

    <div id="viewlet-above-content-body">

    </div>
    <div id="content-core">
    <div class="titulo">
        <h5>Orçamento Anual</h5> 
    </div>
    <div class="table-responsive">		
        <table class="table table-bordered table-sm tab_executivo">
            <thead>
                <tr>
                    <th>Ano</th>
                    <th>Ação</th>                                              
                    <th class="text-center">Dotação Inicial</th>
                    <th class="text-center">Dotação Adicional</th>                                
                    <th class="text-center">Orç Disponibilizado</th>                                
                    <th class="text-center">Empenhado S/ Canc</th>                               
                    <th class="text-center">RP Cancelados</th>  
                    <th class="text-center">Empenho Liq Exerc</th>  
                    <th class="text-center">Aporte FGTS</th>  
                    <th class="text-center">Pago Exec LOA</th>  
                    <th class="text-center">RP Proc Pago NE</th>  
                    <th class="text-center">RP Não Proc</th>  
                    <th class="text-center">Pago Exerc</th>  
                    <th class="text-center">A Pagar Orcam</th>  
                    <th class="text-center">A Pagar RAP</th>  
                    <th class="text-center">A Pagar Orcam Extra</th>  

                </tr>                                                
            </thead>
            <tbody>
            @foreach($subTotalizadorOrcamentos as $total)
                @foreach($orcamentos as $orcamento)   
                    @if($total->num_ano_exercicio == $orcamento->num_ano_exercicio)                 
                        <tr>                        
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->num_ano_exercicio), 0, ',' , '.')}}</td>
                            <td >{{$orcamento->txt_cod_acao}}</td>
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_dotacao_inicial), 2, ',' , '.')}}</td>
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_dotacao_adicional), 2, ',' , '.')}}</td>                                                                     
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_orcamento_disponibilizado), 2, ',' , '.')}}</td>                                                                     
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_empenhado_sem_canc), 2, ',' , '.')}}</td>                                                                     
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_rp_cancelados), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_empenhado_liquidado_exerc), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_aporte_fgts), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_pago_exec_loa), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_rp_processado_pago_ne), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_rp_nao_processados_pagos), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_pago_exercicio), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_a_pagar_orcamentario), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->vlr_a_pagar_rap), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($orcamento->a_pagar_orcamentario_extra), 2, ',' , '.')}}</td>   
                        </tr>
                    @endif    
                @endforeach   
                <tr  class="total">                        
                    <td  class="tabelaNumero  text-center" colspan="2">TOTAL - {{$total->num_ano_exercicio}}</td>
                    <td class="tabelaFaixa text-center">{{number_format( ($total->total_dotacao_inicial), 2, ',' , '.')}}</td>
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_dotacao_adicional), 2, ',' , '.')}}</td>                                                                     
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_orcamento_disponibilizado), 2, ',' , '.')}}</td>                                                                     
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_empenhado_sem_canc), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_rp_cancelados), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_empenhado_liquidado_exerc), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_aporte_fgts), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_pago_exec_loa), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_rp_processado_pago_ne), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_rp_nao_processados_pagos), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_pago_exercicio), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_a_pagar_orcamentario), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_a_pagar_rap), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-center">{{number_format( ($total->total_a_pagar_orcamentario_extra), 2, ',' , '.')}}</td>   
                </tr>  
            @endforeach   
                <tr class="table-dark">                          
                            <td class="tabelaFaixa text-center" colspan="2">TOTAL</td>                           
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_dotacao_inicial']), 2, ',' , '.')}}</td>
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_dotacao_adicional']), 2, ',' , '.')}}</td>                                                                     
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_orcamento_disponibilizado']), 2, ',' , '.')}}</td>                                                                     
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_empenhado_sem_canc']), 2, ',' , '.')}}</td>                                                                     
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_rp_cancelados']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_empenhado_liquidado_exerc']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_aporte_fgts']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_pago_exec_loa']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_rp_processado_pago_ne']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_rp_nao_processados_pagos']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_pago_exercicio']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_a_pagar_orcamentario']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_a_pagar_rap']), 2, ',' , '.')}}</td>   
                            <td class="tabelaFaixa text-center">{{number_format( ($totalizadorOrcamentos['total_    a_pagar_orcamentario_extra']), 2, ',' , '.')}}</td>   
                        </tr>
            
            </tbody>
        </table>     
    </div>

    <div class="titulo">
        <h5>Liberação Anual</h5> 
    </div>
    <div class="table-responsive">		
        <table class="table table-bordered table-sm tab_executivo">
            <thead>
                <tr>
                    <th>Ação</th>                                                
                    <th class="text-center">2009</th>
                    <th class="text-center">2010</th>
                    <th class="text-center">2011</th>
                    <th class="text-center">2012</th>
                    <th class="text-center">2013</th>
                    <th class="text-center">2014</th>
                    <th class="text-center">2015</th>
                    <th class="text-center">2016</th>
                    <th class="text-center">2017</th>
                    <th class="text-center">2018</th>
                    <th class="text-center">2019</th>
                    <th class="text-center bg-dark">Total</th>
                </tr>                                                
            </thead>
            <tbody>
           
                @foreach($liberacoes as $liberacao)              
                        <tr>                        
                            <td >{{$liberacao->txt_cod_acao}}</td>
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2009), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2010), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2011), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2012), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2013), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2014), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2015), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2016), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2017), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2018), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($liberacao->total_liberacoes_2019), 2, ',' , '.')}}</td>  
                            <td class="tabelaFaixa text-center text-bold table-dark">{{number_format( ($liberacao->total_liberacao_acao), 2, ',' , '.')}}</td>  
                        </tr>                    
                @endforeach  
                <tr class="table-dark">                        
                            <td >TOTAL</td>
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2009']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2010']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2011']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2012']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2013']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2014']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2015']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2016']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2017']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2018']), 2, ',' , '.')}}</td>                            
                            <td class="tabelaFaixa text-center">{{number_format( ($totalLiberacoes['total_liberacoes_2019']), 2, ',' , '.')}}</td>  
                            <td class="tabelaFaixa text-center text-bold table-dark">{{number_format( ($totalLiberacoes['total_liberacao_acao']), 2, ',' , '.')}}</td>  
                        </tr>
            </tbody>
        </table>     
    </div>
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">
            Voltar
        </button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">
    </div>
    <!-- content-core-->
</div>
<!-- content-->

@endsection
<!--  Section-->