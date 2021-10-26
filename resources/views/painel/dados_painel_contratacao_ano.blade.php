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
            <a href="{{url('/resumo/contratacao/ano/filtro')}}">Consulta Resumo Contratação</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Resumo Contratação<span class="badge badge-primary">Novo</span></span>
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
            <!--
          
            -->
        </div>
    </div> <!-- viewlet-below-content-title-->
    <div id="viewlet-above-content-body">
        

    </div>
    <div id="content-core">
        @if(count($contratacaoAno)>0)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h2>Resumo Contratação <span>@if($ano_de){{$ano_de}} @endif</span></h2>   
                </strong>                
            </div>

<!--Tabela MCMV 1-->
          
            
            @if($parametrosFiltro == 0 && $parametrosRegionais == 0)
            <div class="titulo">
                <h5>UNIDADES HABITACIONAIS <span style="float:right; font-size:13px;">                
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>Região</th>
                            <th>Faixa 1</th>
                            <th>Faixa 1,5</th>
                            <th>Faixa 2</th>
                            <th>Faixa 3</th>                            
                            <th>Produção/Estoque</th>    
                            <th class="totalFaixa text-secondary">Total</th>    
                        </tr>                                          
                    </thead>
                    <tbody>
                    @foreach($contratacaoAno as $item)                        
                            <tr>                        
                                <td>{{$item->txt_regiao}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_1,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_15,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_2,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_3,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->uh_producao_estoque,0, ',' , '.')}}</td>
                                <td class="tabelaFaixa totalFaixa text-center">{{number_format($item->qtd_uh_contratada,0, ',' , '.')}}</td>
                                
                            </tr>                        
                    @endforeach   
                            <tr class="total">                         
                                <td>Total</td>                            
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['faixa1'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['faixa15'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['faixa2'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['faixa3'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['producao'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['contratadas'],0, ',' , '.')}}</td>
                            </tr>
                        </tbody>                                        
                </table>
            <!-- VALORES CONTRATADOS ANO -->
            @endif

            @if($parametrosRegionais == 1)
            <div class="titulo">
                <h5>UNIDADES HABITACIONAIS <span style="float:right; font-size:13px;">                
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>Região</th>
                            <th>UF</th>
                            <th>Município</th>
                            <th>Faixa 1</th>
                            <th>Faixa 1,5</th>
                            <th>Faixa 2</th>
                            <th>Faixa 3</th>                            
                            <th>Produção/Estoque</th>    
                            <th class="totalFaixa text-secondary">Total</th>    
                        </tr>                                          
                    </thead>
                    <tbody>
                    @foreach($contratacaoAno as $item)                        
                            <tr>                        
                                <td>{{$item->txt_regiao}}</td>                            
                                <td>{{$item->txt_sigla_uf}}</td>  
                                <td>{{$item->ds_municipio}}</td>  
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_1,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_15,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_2,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_3,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->uh_producao_estoque,0, ',' , '.')}}</td>
                                <td class="tabelaFaixa totalFaixa text-center">{{number_format($item->qtd_uh_contratada,0, ',' , '.')}}</td>
                                
                            </tr>                        
                    @endforeach   
                            <tr class="total">                         
                                <td colspan="3">Total</td>                            
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['faixa1'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['faixa15'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['faixa2'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['faixa3'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['producao'],0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($valoresMCMV['contratadas'],0, ',' , '.')}}</td>
                            </tr>
                        </tbody>                                        
                </table>
            <!-- VALORES CONTRATADOS ANO -->
            @endif


            <div class="form-group">       
            <div class="row">
                <div class="col-xs-12 col-sm-1 text-right">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-home fa-stack-1x fa-inverse"></i>
                    </span>         
                </div>
                <div class="col-xs-12 col-sm-5">
                    <p>Total Nacional: <span class="font-weight-bold">{{number_format($valoresMCMV['contratadas'],0, ',' , '.')}}</span>.</p>
                </div>
           
            <div class="col-xs-12 col-sm-1 text-right">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                    </span>         
                </div>
                <div class="col-xs-12 col-sm-5">
                   <p> Total Investido: <span class="font-weight-bold">R$  {{number_format($valoresMCMV['valor_contratado'],2, ',' , '.')}}      </span></p>
                </div>
            </div>            
        </div>
             
              
             
           
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