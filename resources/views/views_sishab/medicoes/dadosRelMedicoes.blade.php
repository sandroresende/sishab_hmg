@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                :url="'{{ url('/home') }}'"
                :titulo1="'Relatórios'"
                :titulo2='"Filtro das Solicitações de Pagamentos das Medições"'
                :link2="'{{ url('/medicoes/situacao/filtro') }}'"
                :titulo3='"Relação de Solicitações de Pagamentos"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Relação de Solicitações de Pagamentos'"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    @if($subtitulo2) subtitulo2="{{$subtitulo2}} " @endif
                    @if($subtitulo3) subtitulo3="{{$subtitulo3}} " @endif
                    :dataatualizacao="'{{getPosicaoDadosMedicoes()}}'"
                    :linkcompartilhar="'{{ url("/medicoes/situacao/filtro/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
            @if(count($solicitacoesPagObs)>0)
                    <div class="form-group">
                        <div class="titulo-linha-cinza text-center">
                            <h2>
                                Resumo por Modalidade
                            </h2>
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
                       
                    </div>
                     <!--form-group -->          
                    <div class="form-group">
                        <div class="titulo-linha-cinza text-center">
                            <h2>
                                Resumo por Situação
                            </h2>
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
            <div class="form-group">
                <div class="titulo-linha-cinza text-center">
                    <h2>
                        Relação de Solicitações
                    </h2>
                </div>
                <tabela-relatorios
                        v-bind:titulos="{{json_encode($cabecalhoTab)}}"
                        v-bind:itens="{{json_encode($solicitacoesPag)}}"
                        show= ""


                    >           
                </tabela-relatorios> 
            </div>
            <!--form-group --> 

            <div class="form-group">
                <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
                <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">   
            </div>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


