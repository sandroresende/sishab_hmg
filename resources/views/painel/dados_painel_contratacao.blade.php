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
            <a href="{{url('/resumo/contratacao/filtro')}}">Consulta Contratação Total</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Contratação Total <span class="badge badge-primary">Novo</span></span>
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
            <h3 class="documentFirstHeading text-center">Período de Janeiro/{{$ano_de}} até Dezembro/{{$ano_ate}}</h3>
            
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
        <div class="form-group">       
            <div class="row">
                <div class="col-xs-12 col-sm-1 text-right">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-home fa-stack-1x fa-inverse"></i>
                    </span>         
                </div>
                <div class="col-xs-12 col-sm-11">
                    <p>Desde 2009, foram contratadas <span class="font-weight-bold">{{number_format($unidadesContratadas,0, ',' , '.')}}  unidades habitacionais </span>no país em <span class="font-weight-bold">{{number_format($qtd_municipios,0, ',' , '.')}} municípios</span>.</p>
                </div>
            </div>
            <div class="row">
            <div class="col-xs-12 col-sm-1 text-right">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-money fa-stack-1x fa-inverse"></i>
                    </span>         
                </div>
                <div class="col-xs-12 col-sm-11">
                   <p> O investimento total no PMCMV ultrapassa a marca de <span class="font-weight-bold">R$ {{number_format($valorContratado/1000000000,0, ',' , '.')}} bilhões</span>. Estima-se que foram gerados, no período <span class="font-weight-bold">{{number_format(($valorContratado/1000000) * 22,0, ',' , '.')}} empregos </span>diretos e indiretos.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-1 text-right">
                    <span class="fa-stack fa-lg">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa fa-users fa-stack-1x fa-inverse"></i>
                    </span>  
                </div>
                <div class="col-xs-12 col-sm-11">
                <p>Estima-se que <span class="font-weight-bold">{{number_format($valoresMCMV['entregues'] * 4,0, ',' , '.')}} pessoas </span>já residem em uma unidade habitacional financiada pelo programa</p>

                </div>
            </div>
        </div>


        @if(count($resumoContratadas)>0)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h2>Dados da Contratação</h2>   
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
                            <th rowspan="2" >Modalidade</th>
                            <th colspan="5">Unidades</th>
                            <th rowspan="2">Valor Contratado R$</th>
                        </tr>
                        <tr>
                            <th class="text-center">Vigentes</th>
                            <th class="text-center">Distratadas</th>
                            <th class="text-center">Entregues</th>
                            <th class="text-center">Concluídas Não Entregues</th>
                            <th class="text-center">Total Contratadas</th>                        
                        </tr>                        
                    </thead>
                    <tbody>
                    @foreach($resumoContratadas as $item)
                        @if($item->faixa_renda_id == 1)
                            <tr>                        
                                <td>{{$item->txt_modalidade}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_vigentes,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_distratadas,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_entregues,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_nao_entregues,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_contratadas,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_contratado,0, ',' , '.')}}</td>
                            </tr>
                        @endif    
                    @endforeach    
                        <tr class="totalFaixa">
                            <td class="tabelaNumero">Total Faixa 1:</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['vigentes'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['distratadas'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['entregues'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['nao_entregues'],0, ',' , '.')}}</td>
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
                            <th rowspan="2" >Origem</th>
                            <th rowspan="2" >Faixa</th>
                            <th colspan="2">Unidades Habitacionais</th>
                            <th colspan="2">Desconto</th>
                            <th rowspan="2">Financiamento R$</th>
                            <th rowspan="2">Valor Contratado R$</th>
                        </tr>
                        <tr>
                            <th class="text-center">Contratadas</th>
                            <th class="text-center">Entregues</th>
                            <th class="text-center">Subsídio OGU R$</th>
                            <th class="text-center">Subsídio FGTS R$</th>
                        </tr>                        
                    </thead>
                    <tbody>
                    @foreach($resumoContratadas as $item)
                        @if($item->faixa_renda_id != 1)
                            <tr>                        
                                <td>{{$item->dsc_origem}}</td>                            
                                <td>{{$item->dsc_faixa}}</td>  
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_contratadas,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_entregues,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center">{{number_format($item->vlr_sub_ogu,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->vlr_sub_fgts,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->vlr_financiamento,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_contratado,0, ',' , '.')}}</td>
                            </tr>
                        @endif    
                    @endforeach    
                        <tr class="totalFaixa">
                            <td colspan="2" class="tabelaNumero">Total FGTS:</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['contratadas'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['entregues'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['subsidio_ogu'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['subsidio_fgts'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['financiamento'],0, ',' , '.')}}</td>
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