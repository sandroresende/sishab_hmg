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
    <span >Financeiro</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/pagamento/situacao/filtro')}}">Consulta Situação Pagamento</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Relação de Solicitações de Pagamentos</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    <div id="viewlet-above-content-title">
        </div>

        <h2  class="documentFirstHeading text-center">
            @if($empreendimentos->txt_nome_empreendimento) 
                {{$empreendimentos->txt_nome_empreendimento}} - <span>{{number_format($empreendimentos->prc_obra_realizado, 0, ',' , '.')}}% </span>
            @else
                {{$empreendimentos->cod_empreendimentos}}
            @endif
        </h2>

        <span class="documentFirstHeadingSpan">
            {{$empreendimentos->ds_municipio}} - {{$empreendimentos->txt_sigla_uf}}
        </span>   

        <span class="documentFirstHeadingSpan">
            {{$empreendimentos->txt_modalidade}} - {{$empreendimentos->dsc_faixa}}
        </span>  
    

         
            <!-- form-group-->              
        <div class="form-group">
       
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">
                   

                   
                    </h3>
                    @if(count($solicitacoesPag)>0)
                        <div class="form-group">
                                    <div class="titulo">
                                        <h5> Relação de Solicitações de Pagamentos</h5>
                                        
                                    </div> 
                                    <div class="table-responsive">		
                                    <table class="table table-bordered table-sm tab_executivo">
                                        <thead>
                                            <tr style="max-widh:1142;">
                                                <th>Situação</th>                                
                                                <th>Tipo</th>  
                                                <th class="text-center">Data Solicitação</th>
                                                <th class="text-center">Valor Solicitado</th>
                                                <th class="text-center">Data Liberação</th>
                                                <th class="text-center">Valor Liberado</th>    
                                                <th class="text-center">Valor a Liberar</th> 
                                            </tr>
                                                                
                                        </thead>
                                        <tbody>
                                            @foreach($solicitacoesPag as $dados)
                                                <tr>                        
                                                    <td >{{$dados->txt_observacao}}</td>
                                                    <td >{{$dados->txt_tipo_liberacao_abreviado}}</td>
                                                    <td class="tabelaFaixa text-center">{{date('d/m/Y',strtotime($dados->dte_solicitacao))}} </td>
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_solicitado), 2, ',' , '.')}}</td>
                                                    <td class="tabelaFaixa text-center">
                                                            @if($dados->dte_liberacao) {{date('d/m/Y',strtotime($dados->dte_liberacao))}} @endif
                                                             </td>
                                                    <td class="tabelaFaixa">{{number_format( ($dados->vlr_liberado), 2, ',' , '.')}}</td>             
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_solicitado - $dados->vlr_liberado), 2, ',' , '.')}}</td>                                                    
                                                </tr>                                
                                            @endforeach                                           
                                            <tr  class="total">                        
                                                <td colspan="2"  class="tabelaNumero">TOTAL</td>
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPag['qtd_solicitacoes']), 0, ',' , '.')}}</td>
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPag['total_solicitado']), 2, ',' , '.')}}</td>   
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPag['qtd_liberacoes']), 0, ',' , '.')}}</td>
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPag['total_liberado']), 2, ',' , '.')}}</td>     
                                                <td class="tabelaFaixa">{{number_format( ($totalSolicitacaoPag['total_solicitado']-$totalSolicitacaoPag['total_liberado']), 2, ',' , '.')}}</td>                                                        
                                            </tr>                         
                                        </tbody>
                                    </table>     
                                </div>
                            <!--form-group -->          
                        </div>
                        @endif

                        
                    
                        
                    
                    </blockquote>
                </div>
            </div>
           
            
              <!--form-group -->          
          </div>
          <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">
            Voltar
        </button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">
    </div><!-- content-core-->


</div><!-- content-->



@endsection
