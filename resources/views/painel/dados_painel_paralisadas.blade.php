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
            <span> Painel</span>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/resumo/paralisadas/filtro')}}">Consulta de Obras Paralisadas</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Dados de Obras Paralisadas  <span class="badge badge-primary">Novo</span></span>
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
        @if($ano_de>0 && $ano_ate >0)
            <h3 class="documentFirstHeading text-center">Período de Janeiro/{{$ano_de}} até Dezembro/{{$ano_ate}}</h3>
            @else
            <h3 class="documentFirstHeading text-center">Contratação em {{$ano_de}}</h3>
         @endif
    </h1>
        
        
    <div id="viewlet-below-content-title">
        <div class="documentByLine" id="plone-document-byline">
            <!--
          
            -->
        </div>
    </div> <!-- viewlet-below-content-title-->
    <div id="viewlet-above-content-body">
        

    </div>
    <div id="content-core">
        


        @if(count($resumoParalisadas)>0)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h2>Dados de Obras Paralisadas</h2>   
                </strong>                
            </div>

<!--Tabela MCMV 1-->
          
            
            @if($valoresFaixa1['contratadas'] > 0)
            <div class="titulo">
                <h5>FAIXA 1  <span style="float:right; font-size:13px;">                
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>Modalidade</th>
                            <th>Municípios</th>
                            <th>N° de UH</th>
                            <th>Valor Contratado R$</th>                            
                        </tr>                        
                    </thead>
                    <tbody>
                    @foreach($resumoParalisadas as $item)
                        @if($item->bln_faixa == 1)
                            <tr>                        
                                <td>{{$item->txt_modalidade}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_municipio,0, ',' , '.')}}</td>  
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_contratadas,0, ',' , '.')}}</td>                           
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_contratado,0, ',' , '.')}}</td>
                                                              
                            </tr>
                        @endif    
                    @endforeach    
                        <tr class="totalFaixa">
                            <td class="tabelaNumero">Total Faixa 1:</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['municipios'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['contratadas'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['valor_contratado'],0, ',' , '.')}}</td>
                            
                        </tr>
                        </tbody>                                        
                </table>
            <!-- VALORES CONTRATADOS ANO -->
            @endif
          
           

      @if($valoresFgts['contratadas'] > 0)

        <div class="titulo">
                <h5>FAIXA 1.5, 2 e 3 (FGTS)  <span style="float:right; font-size:13px;">                
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>Modalidade</th>
                            <th>Municípios</th>
                            <th>N° de UH</th>
                            <th>Valor Contratado R$</th>                            
                        </tr>                        
                    </thead>
                    <tbody>
                    @foreach($resumoParalisadas as $item)
                        @if($item->bln_faixa == 0)
                            <tr>                        
                                <td>{{$item->txt_modalidade}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_municipio,0, ',' , '.')}}</td>  
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_contratadas,0, ',' , '.')}}</td>                           
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_contratado,0, ',' , '.')}}</td>
                                                              
                            </tr>
                        @endif    
                    @endforeach    
                        <tr class="totalFaixa">
                            <td class="tabelaNumero">Total FGTS:</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['municipios'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['contratadas'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['valor_contratado'],0, ',' , '.')}}</td>
                            
                        </tr>
                        </tbody>                                        
                </table>
            <!-- VALORES CONTRATADOS ANO -->
         @endif
          
           
        </div>
        @endif
        
            <!-- FIM VALORES CONTRATADOS ANO -->
            <button class="btn-lg btn btn-success btn-block"
                            onclick="javascript:window.history.go(-1)">
                            Voltar
                        </button>
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 
                        

    </div><!-- content-core-->
</div><!-- content-->



@endsection
<!--  Section-->