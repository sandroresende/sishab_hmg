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
        <span id="breadcrumbs-current">Dados da Contratação</span>
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
    @if($ano_de>0)
            <h3 class="documentFirstHeading text-center">Período de {{$ano_de}} até {{$ano_ate}}</h3>
            
         @endif
        
    <div id="viewlet-below-content-title">
        <div class="documentByLine" id="plone-document-byline">
            <span class="documentAuthor">por <span>Secretaria Nacional da Habitação</span> —</span><!-- autor-->
            <span class="documentModified"><span>última atualização</span> {{date('d/m/Y',strtotime($dataPosicao->dte_posicao))}}</span><!-- data atualização-->
            
        </div>
    </div> <!-- viewlet-below-content-title-->
    <div id="viewlet-above-content-body">
        

    </div>
    <div id="content-core">
   

        <!--Tabela MCMV 1-->
        <div class="titulo">
            <h5>Relatório Executivo</h5> 
        </div>
       
        <table-executivo 
            :dados="{{$relatorioExecutivo}}"
            :url="'{{ url('/') }}'"
            > </table-executivo>

        <div class="titulo">
            <h5>Unidades Contratadas por Ano</h5> 
        </div>
        <div class="table-responsive">		
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th  rowspan="2"> Ano</th>
                        <th colspan="4">Faixa 1</th>                        
                        <th rowspan="2" class="totalFaixa text-secondary">Total Faixa 1</th>   
                        <th colspan="3">FGTS</th>                      
                        <th rowspan="2" class="totalFaixa text-secondary">Total FGTS</th>                        
                        <th rowspan="2"  class="bg-dark">Total</th> 
                    </tr>
                    <tr class="text-center">                                               
                        <th>Entidades</th>
                        <th>Far</th>
                        <th>Oferta Pública</th>
                        <th>Rural</th>
                        <th>Faixa 1,5</th> 
                        <th>Faixa 2</th> 
                        <th>Faixa 3</th>           
                    </tr>                        
                </thead>
                <tbody>
                    @foreach($relatorioExecutivoAno as $item)
                    <tr >                        
                        <td>{{$item->num_ano_assinatura}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_entidades), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_far + $item->total_uh_far_vinc), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_oferta), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_rural), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa totalFaixa">{{number_format( ($item->valor_total_num_uh_1), 0, ',' , '.')}}</td>   
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_15), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_2), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_3), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa totalFaixa">{{number_format( ($item->valor_total_num_uh_23 + $item->total_uh_fgts_15), 0, ',' , '.')}}</td>                         
                        <td class="tabelaFaixa text-bold table-dark">{{number_format( ($item->valor_total_num_uh_1 + $item->valor_total_num_uh_23 + $item->total_uh_fgts_15), 0, ',' , '.')}}</td>                         
                    </tr>
                    @endforeach
                    @foreach($totalAno as $item)
                    <tr class="total">                        
                        <td>TOTAL</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_entidades), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_far + $item->total_uh_far_vinc), 0, ',' , '.')}} 2</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_oferta), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_rural), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_num_uh_1), 0, ',' , '.')}}</td>  
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_15), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_2), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_3), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_num_uh_23 + $item->total_uh_fgts_15), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa table-dark">{{number_format( ($item->valor_total_num_uh_1+$item->valor_total_num_uh_23 + $item->total_uh_fgts_15), 0, ',' , '.')}}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>     
        </div>




        <div class="titulo">
            <h5>Valores Contratados por Ano <span class="text-danger">(R$ mil)</span></h5> 
        </div> 

        <div class="table-responsive">		

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th  rowspan="2"> Ano</th>
                        <th colspan="4">Faixa 1</th>                        
                        <th rowspan="2" class="totalFaixa text-secondary">Total Faixa 1</th>     
                        <th colspan="3">FGTS</th>   
                        <th rowspan="2" class="totalFaixa text-secondary">Total FGTS</th>         
                        <th rowspan="2" class="bg-dark">Total</th>                                             
                    </tr>
                    <tr class="text-center">                                               
                        <th>Entidades</th>
                        <th>Far</th>
                        <th>Oferta Pública</th>
                        <th>Rural</th>
                        <th>Faixa 1,5</th> 
                        <th>Faixa 2</th> 
                        <th>Faixa 3</th>     
                    </tr>                        
                </thead>
                <tbody>
                    @foreach($relatorioExecutivoAno as $item)
                    <tr >                        
                        <td>{{$item->num_ano_assinatura}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_entidades/1000), 2, ',' , '.')}}</td>  
                        <td class="tabelaFaixa">{{number_format( (($item->valor_total_far + $item->valor_total_far_vinc)/1000), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_oferta/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_rural/1000), 2, ',' , '.')}}</td>    
                        <td class="tabelaFaixa totalFaixa">{{number_format( ($item->valor_total_1/1000), 2, ',' , '.')}}</td>    
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_15/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_2/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_3/1000), 2, ',' , '.')}}</td>  
                        <td class="tabelaFaixa totalFaixa">{{number_format( ($item->valor_total_23/1000+$item->valor_total_fgts_15/1000), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-bold table-dark">{{number_format( (($item->valor_total_fgts_15+$item->valor_total_1+$item->valor_total_23)/1000), 2, ',' , '.')}}</td>                                             
                    </tr>
                    @endforeach
                    @foreach($totalAno as $item)
                    <tr class="total">                        
                        <td>TOTAL</td>
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_entidades/1000), 2, ',' , '.')}}</td>  
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_far + $item->valor_total_far_vinc)/1000, 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_oferta/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_rural/1000), 2, ',' , '.')}}</td>    
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_1/1000), 2, ',' , '.')}}</td>       
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_15/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_2/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_3/1000), 2, ',' , '.')}}</td>  
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_23 + $item->valor_total_fgts_15)/1000, 2, ',' , '.')}}</td>                        
                        <td class="tabelaFaixa table-dark">{{number_format( (($item->valor_total_23 + $item->valor_total_fgts_15+$item->valor_total_1)/1000), 2, ',' , '.')}}</td>       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

 

<div class="form-group">
    <button class="btn-lg btn btn-success btn-block"
        onclick="javascript:window.history.go(-1)">
        Voltar
    </button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 
    
</div> 
    </div><!-- content-core-->
</div><!-- content-->





@endsection