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
            <a href="{{url('/novo_executivo/briefing/filtro')}}">Consulta Briefing</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Briefing Município  <span class="badge badge-primary">Novo</span></span>
        </span>
    </div>
    <div class="text-center">
        <img class="center-block" width='70' src="{{URL::asset('img/brasao_brasil.png')}}"  >
    </div>
    
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
      
    <h2  class="documentFirstHeading">       
            {{$populacaoMunicipio->ds_municipio}} - {{$populacaoMunicipio->txt_uf}} ({{$populacaoMunicipio->txt_sigla_uf}})        
    </h2>       
    
    <div id="viewlet-below-content-title">
        <div class="documentByLine" id="plone-document-byline">
        </div>
    </div> <!-- viewlet-below-content-title-->
    <div id="viewlet-above-content-body">
    </div>

    <div id="content-core" class="relatorios">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-briefing-tab" data-toggle="tab" href="#nav-briefing" role="tab" aria-controls="nav-briefing" aria-selected="true">Briefing</a>
                <a class="nav-item nav-link" id="nav-empreendimentos-tab" data-toggle="tab" href="#nav-empreendimentos" role="tab" aria-controls="nav-empreendimentos" aria-selected="false">Empreendimentos</a>
                
            </div>    
        </nav>    
        <div class="tab-content" id="nav-tabContent">
            
<!-- ///////////////////////////////////////////////// inicio nav-dados /////////////////////////////////////////////////-->    
            <div class="tab-pane fade show active" id="nav-briefing" role="tabpanel" aria-labelledby="nav-briefing-tab">
            <form>
                <div class="form-group">      
                    <p class="text-justify">
                        Balanço UF: {{$populacaoEstado->txt_uf}} – Faixa 1, 2009 até posicao {{date('d/m/Y',strtotime($posicaoFx1))}}:
                    </p>  
                    <p>
                            <strong>• População</strong>: {{number_format( ($populacaoEstado->total_populacao), 0, ',' , '.')}} habitantes (População Estimativa {{$populacaoEstado->num_ano_referencia}})<br/>
                            <strong>• Unidades habitacionais contratadas</strong>: {{number_format( ($operacoesEstadoFx1->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                            <strong>• Unidades habitacionais entregues</strong>: {{number_format( ($operacoesEstadoFx1->qtd_uh_entregues), 0, ',' , '.')}}<br/>
                            <strong>• Unidades habitacionais a entregar</strong>: {{number_format( ($operacoesEstadoFx1->qtd_uh_financiadas-$operacoesEstadoFx1->qtd_uh_entregues), 0, ',' , '.')}}<br/>
                            <strong>• Investimento total</strong>: R$ {{number_format( ($operacoesEstadoFx1->vlr_investimento), 2, ',' , '.')}}<br/>
                    </p>

                    <p class="text-justify">
                        Contratações realizadas no Estado, para as demais faixas (1,5; 2 e 3), 2009 até posicao {{date('d/m/Y',strtotime($posicaoOutrasFx))}}:
                    </p>  
                    <p>
                            <strong>• Unidades habitacionais contratadas</strong>: {{number_format( ($operacoesEstadoOutrasFx->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                            <strong>• Unidades habitacionais entregues</strong>: {{number_format( ($operacoesEstadoOutrasFx->qtd_uh_entregues), 0, ',' , '.')}}<br/>
                            <strong>• Unidades habitacionais a entregar</strong>: {{number_format( ($operacoesEstadoOutrasFx->qtd_uh_financiadas-$operacoesEstadoOutrasFx->qtd_uh_entregues), 0, ',' , '.')}}<br/>
                            <strong>• Investimento total</strong>: R$ {{number_format( ($operacoesEstadoOutrasFx->vlr_investimento), 2, ',' , '.')}}<br/>
                    </p>               

                    <p class="text-justify">
                        Balanço do Município de {{$populacaoMunicipio->ds_municipio}}, 2009 até posicao {{date('d/m/Y',strtotime($posicaoOutrasFx))}}:
                    </p>  
                    <p>
                            <strong>• População do Município</strong>: {{number_format( ($populacaoMunicipio->total_populacao), 0, ',' , '.')}} habitantes (População Estimativa {{$populacaoEstado->num_ano_referencia}})<br/>
                            @if($operacoesMunFx1)
                                <strong>• Unidades habitacionais contratadas - Faixa 1</strong>: {{number_format( ($operacoesMunFx1->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                                <strong>• Unidades habitacionais entregues - Faixa 1</strong>: {{number_format( ($operacoesMunFx1->qtd_uh_entregues), 0, ',' , '.')}}<br/>
                                <strong>• Unidades habitacionais a entregar no evento atual</strong>: {{number_format( ($operacoesMunFx1->qtd_uh_financiadas-$operacoesMunFx1->qtd_uh_entregues), 0, ',' , '.')}}<br/>
                                <strong>• Investimento total - Faixa 1</strong>: R$ {{number_format( ($operacoesMunFx1->vlr_investimento), 2, ',' , '.')}}<br/>
                            @endif
                            @if($operacoesMunOutrasFx)
                                <strong>• Unidades habitacionais contratadas - Demais Faixas</strong>: {{number_format( ($operacoesMunOutrasFx->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                                <strong>• Investimento total - Demais Faixas</strong>: R$  {{number_format( ($operacoesMunOutrasFx->vlr_investimento), 2, ',' , '.')}}<br/>
                            @endif
                    </p> 
                    @if($totalSolicitacaoPagObs['total_solicitado']>0)
                    <p class="text-justify">
                        @if($totalSolicitacaoPagObs['total_liberado']>0)
                            Desde o início do ano até {{date('d/m/Y',strtotime($ultimaSolicitacao))}}, o município solicitou a liberação de 
                            R$ {{number_format( ($totalSolicitacaoPagObs['total_solicitado']), 2, ',' , '.')}} milhões de reais, sendo que 
                            R$ {{number_format( ($totalSolicitacaoPagObs['total_liberado']), 2, ',' , '.')}} milhões já foram liberados.
                        @else
                            Desde o início do ano até {{date('d/m/Y',strtotime($ultimaSolicitacao))}}, o município solicitou a liberação de 
                            R$ {{number_format( ($totalSolicitacaoPagObs['total_solicitado']), 2, ',' , '.')}} milhões de reais.
                        @endif
                    </p>
                    
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
                    @endif    
                    

                    @if($totalContratadoEstado>0)
                    <p class="text-justify">
                        Em 2019, até {{date('d/m', strtotime(date('Y-m-d')))}}, o Estado contratou {{number_format( ($totalContratadoEstado),0, ',' , '.')}} unidades habitacionais, sendo:
                    </p>
                    <div class="table-responsive">		
                        <table class="table table-bordered table-sm tab_executivo">
                            <thead>
                                <tr style="max-widh:1142;">
                                    <th>Faixa</th>                         
                                    <th class="text-center">Unidades Habitacionais</th>  
                                </tr>
                                                    
                            </thead>
                            <tbody>
                                @foreach($operacoesFxEstado as $dados)
                                    <tr>                        
                                        <td >{{$dados->dsc_faixa}}</td>
                                        <td class="tabelaFaixa">{{number_format( ($dados->qtd_uh_financiadas),0, ',' , '.')}}</td>                                             
                                    </tr>                                
                                @endforeach  
                                    <tr  class="total">                        
                                        <td  class="tabelaNumero">TOTAL</td>
                                        <td class="tabelaFaixa">{{number_format( ($totalContratadoEstado), 0, ',' , '.')}}</td>                            
                                    </tr>                                           
                                                    
                            </tbody>
                        </table>     
                    </div>   <!--fim table-responsive--> 

                    @endif
                    <p class="text-justify">
                            Balanço de Contratações e Entregas do PMCMV em {{date('Y', strtotime(date('Y-m-d')))}} para todas as Faixas – Nacional:
                    </p> 
                    <p>
                            <strong>• Unidades habitacionais contratadas</strong>: {{number_format( ($operacoesFx->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                            <strong>• Unidades habitacionais entregues</strong>: {{number_format( ($totalUH2019), 0, ',' , '.')}}<br/>

                                </p>  

                    <p>
                        De 2009 até {{date('d/m/Y', strtotime(date('Y-m-d')))}} , o Programa contratou aproximadamente {{number_format( ($totalOperacoes['qtd_contratadas']), 0, ',' , '.')}} milhões de unidades habitacionais em todo o País. 
                        Destas, mais de {{number_format( ($totalOperacoes['qtd_entregues']), 0, ',' , '.')}} milhões de moradias já foram entregues.
                    </p>
                    @foreach($operacoes as $operacao)
                    <p>
                            <strong>• {{$operacao->dsc_faixa}}</strong><br/> 
                            
                                - Unidades habitacionais contratadas: {{number_format( ($operacao->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                                - Unidades habitacionais entregues: {{number_format( ($operacao->qtd_uh_entregues), 0, ',' , '.')}}<br/>
                                - Unidades habitacionais distratadas: {{number_format( ($operacao->qtd_uh_distratadas), 0, ',' , '.')}}<br/>
                                - Unidades habitacionais a entregar: {{number_format( ($operacao->qtd_uh_financiadas-$operacao->qtd_uh_distratadas-$operacao->qtd_uh_entregues), 0, ',' , '.')}}<br/>                
                            
                                </p>                
                    @endforeach    
                </div>        
            </form>                   

            </div>

<!-- ///////////////////////////////////////////////// inicio nav-dados /////////////////////////////////////////////////-->    
            <div class="tab-pane fade" id="nav-empreendimentos" role="tabpanel" aria-labelledby="nav-empreendimentos-tab">
                <form>
                    <br/>
                    @foreach($empreendimentos as $emprendimento)
                    <div class="alert alert-secondary text-center" role="alert">
                        {{$emprendimento->txt_nome_empreendimento}}
                        </div>
                    
                    <div class="form-group">
                    <p>
                        <strong>APF</strong>: {{$emprendimento->operacao_id}}<br/>
                        <strong>Data do contrato:</strong> {{date('d/m/Y', strtotime($emprendimento->dte_assinatura))}} <br/>
                        @if($emprendimento->dte_inicio_obras)
                            <strong>Data do início das obras:</strong> {{date('d/m/Y', strtotime($emprendimento->dte_inicio_obras))}}<br/>
                        @endif
                        @if($emprendimento->dte_termino_obras)
                            <strong>Data de Previsão de Conclusão:</strong> {{date('d/m/Y', strtotime($emprendimento->dte_termino_obras))}}<br/>
                        @endif
                            <strong>Quantidade de UH:</strong> {{number_format( ($emprendimento->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                            <strong>Valor contratado (União):</strong> R$ {{number_format( ($emprendimento->vlr_operacao), 2, ',' , '.')}}<br/>
                        
                        @if($emprendimento->vlr_contrapartida > 0)
                            <strong>Valor de contrapartida do Estado:</strong> R$ {{number_format( ($emprendimento->vlr_contrapartida), 2, ',' , '.')}}<br/>
                        @endif
                        @if($emprendimento->txt_proponente_operacao)
                            <strong>Construtora:</strong> {{$emprendimento->txt_proponente_operacao}} - CNPJ: {{$emprendimento->proponente_id}}<br/>
                        @endif
                    </div>
                    <br/>
                    @endforeach
                </form>
            </div>
                                <br/>
            <div>
                <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">     
                <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
            </div>
            
        
        </div>
    </div><!-- content-core-->
</div><!-- content-->

@endsection
<!--  Section-->