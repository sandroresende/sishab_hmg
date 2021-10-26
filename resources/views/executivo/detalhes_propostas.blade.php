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
            <a href="{{url('/executivo/filtro')}}">Consulta Relatório Executivo</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

    <span dir="ltr" id="breadcrumbs-1">        
        <a href="#" onclick="javascript:window.history.go(-1)">Relatório Executivo</a>
        <span class="breadcrumbSeparator">
            &gt;
            executivo/relatorio
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Dados da Seleção</span>
    </span>
</div>
    
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
    <h1  class="documentFirstHeading">
            @if($municipio) 
                {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}} 
            @else
                @if($estado)
                    {{$estado->txt_uf}}
                @endif
            @endif 

            @if($rm_ride)
                {{$rm_ride}}
            @endif

            @if($regiao && !$estado)
                {{$regiao->txt_regiao}}    
            @endif

            @if(!$municipio && !$estado && !$rm_ride && !$regiao)
                BRASIL
            @endif
    </h1>
           
    <div id="viewlet-below-content-title">
        <div class="documentByLine" id="plone-document-byline">
            <span class="documentAuthor">por <span>Secretaria Nacional da Habitação</span> —</span><!-- autor-->
            <span class="documentModified"><span>última atualização</span> {{date('d/m/Y',strtotime($dataPosicao))}}</span><!-- data atualização-->
            
        </div>
    </div> <!-- viewlet-below-content-title-->
    <div id="viewlet-above-content-body">
        

    </div>
    <div id="content-core">
              <!--Tabela MCMV 1-->
        
        <div class="titulo">
            <h5>Valores Contratados por Ano</h5>
        </div> 


        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead  class="text-center">
                    <tr class="text-center">
                        <th rowspan="2" class="align-middle">Ano</th>  
                        <th colspan="4">Entidades</th>                          
                        <th colspan="4">Far Empresas</th>                          
                        <th colspan="4">Rural</th>                          
                    </tr>
                    <tr class="text-center">
                        <th>Propostas</th>                          
                        <th>UH Selecionadas</th>                          
                        <th>UH Contratadas</th>                          
                        <th>Valor</th>  
                        <th>Propostas</th>                          
                        <th>UH Selecionadas</th>                          
                        <th>UH Contratadas</th>                          
                        <th>Valor</th>  
                        <th>Propostas</th>                          
                        <th>UH Selecionadas</th>                          
                        <th>UH Contratadas</th>                          
                        <th>Valor</th>                          
                    </tr>
                </thead>
                <tbody>      
                <?php $count = 0 ?>
                    @foreach($contratadasAno2 as $ano) 
                            <tr class="text-center">          
                                <td>{{$ano->num_ano_selecao}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_entidade), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_selecionada_entidade), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_entidades), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_entidades), 2, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_far), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_selecionada_far), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_far), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_far), 2, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_rural), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_selecionada_rural), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_rural), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_rural), 2, ',' , '.')}}</td>
                            </tr>            
                    @endforeach   
                    <tr  class="text-center">     
                        <th>TOTAL</th>     
                        <th>{{number_format( ($totalAno2['total_prop_selec_entidade']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_selecionada_entidade']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_contratadas_entidades']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_vlr_contratado_entidades']), 2, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_prop_selec_far']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_selecionada_far']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_contratadas_far']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_vlr_contratado_far']), 2, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_prop_selec_rural']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_selecionada_rural']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_contratadas_rural']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalAno2['total_vlr_contratado_rural']), 0, ',' , '.')}}</th>                                
                    </tr>                          
                </tbody>
            </table> 
        </div> 

<!-- FIM VALORES CONTRATADOS ANO -->

<!-- PROPOSTAS -->

        <div class="titulo">
            <h5>Propostas</h5> 
        </div> 

        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
            <thead  class="text-center">
                <tr class="text-center">
                <th>UF</th>  
                <th>Município</th>  
                <th>Modalidade</th>  
                <th>APF</th>  
                <th>Empreendimento</th>  
                <th>UH Selecionadas</th>  
                <th>UH Contratadas</th>     
                <th>Valor Contratado</th>                                    
                <th>Ano Seleção</th>                                    
                </tr>
            </thead>
            <tbody>      
                <?php $count = 0 ?>          
                @foreach($propostasContratadas as $propostas) 
                    <tr class="text-center">          
                        <td>{{$propostas->txt_sigla_uf}}</td>                                    
                        <td>{{$propostas->ds_municipio}}</td>                                    
                        <td>{{$propostas->txt_modalidade}}</td>                                    
                        <td>{{$propostas->num_apf}}</td>   
                        <td>{{$propostas->txt_nome_empreendimento}}</td>    
                        <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                        <td>{{number_format( ($propostas->num_uh_contratadas), 0, ',' , '.')}}</td>
                        <td>{{number_format( ($propostas->vlr_contratado), 2, ',' , '.')}}</td>
                        <td>{{$propostas->num_ano_selecao}}</td>                                   
                    </tr>            
                @endforeach  

                <!-- PROBLEMAS AQUI -->
                    <tr  class="text-center">     
                        <th colspan="4">TOTAL</th>     
                        <th>{{number_format( ($totalContratadas['total_prop_selec']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalContratadas['total_selecionada']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalContratadas['total_contratadas']), 0, ',' , '.')}}</th>
                        <th>{{number_format( ($totalContratadas['total_vlr_contratado']), 2, ',' , '.')}}</th>
                        <th></th>                                                              
                    </tr>


            </tbody>
        </table> 
    </div> 


<!-- FIM PROPOSTAS -->
<button class="btn-lg btn btn-success btn-block"
        onclick="javascript:window.history.go(-1)">
        Voltar
    </button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 
    
    </div><!-- content-core-->
</div><!-- content-->



@endsection