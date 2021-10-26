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
            <span id="breadcrumbs-current">Briefing Brasil  <span class="badge badge-primary">Novo</span></span>
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
            Brasil        
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
                
            </div>    
        </nav>    
        <div class="tab-content" id="nav-tabContent">
            
<!-- ///////////////////////////////////////////////// inicio nav-dados /////////////////////////////////////////////////-->    
            <div class="tab-pane fade show active" id="nav-briefing" role="tabpanel" aria-labelledby="nav-briefing-tab">
            <form>
                <div class="form-group">      
                        <br/>
                        <p class="text-justify">
                            Balanço Brasil – Faixa 1, 2009 até posicao {{date('d/m/Y',strtotime($posicaoFx1))}}:
                        </p> 

                        <p>
                            <strong>• População</strong>: {{number_format( ($populacaoBrasil->total_populacao), 0, ',' , '.')}} habitantes (População Estimativa {{$populacaoBrasil->num_ano_referencia}})<br/>
                            <strong>• Unidades habitacionais contratadas</strong>: {{number_format( ($operacoesBrasilFx1->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                            <strong>• Investimento total</strong>: R$ {{number_format( ($operacoesBrasilFx1->vlr_investimento), 2, ',' , '.')}}<br/>
                        </p>

                        <p class="text-justify">
                        Contratações realizadas para as demais faixas (1,5; 2 e 3), 2009 até posicao {{date('d/m/Y',strtotime($posicaoOutrasFx))}}:
                        </p>  
                        <p>
                                <strong>• Unidades habitacionais contratadas</strong>: {{number_format( ($operacoesBrasilOutrasFx->qtd_uh_financiadas), 0, ',' , '.')}}<br/>
                                <strong>• Investimento total</strong>: R$ {{number_format( ($operacoesBrasilOutrasFx->vlr_investimento), 2, ',' , '.')}}<br/>
                        </p> 
                        
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