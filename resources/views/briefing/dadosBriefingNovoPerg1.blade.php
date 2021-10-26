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
            <span> Briefing </span>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/briefing/novo/filtro')}}">Consulta Briefing Novo</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Carteira Atual Vigente da Secretaria no Estado  <span class="badge badge-primary">Novo</span></span>
        </span>
     
    </div>
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
      
    <h1  class="documentFirstHeading">
               {{$estado->txt_uf}}    
    </h1>

        
        
    
    <div id="content-core">
        


        @if(count($resumoVigentes)>0)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h4>CARTEIRA ATUAL VIGENTE DA SECRETARIA NO ESTADO</h4>   
                </strong>                
            </div>

<!--Tabela MCMV 1-->
          
            
           
          
           

      @if($valoresFgts['vigentes'] > 0)

        <div class="titulo">
                <h5>1.	Quantos contratos de financiamento (oneroso e não oneroso) estão vigentes no estado? Qual o valor total dos financiamentos e quantos municípios estão contemplados?</h5>
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>Faixa</th>
                            <th>Nº municípios</th>                            
                            <th>Nº de Contratos</th>
                            <th>Nº UH Vigentes</th>
                            <th>Subsídio OGU (não oneroso)</th>
                            <th>Subsídio FGTS (não oneroso)</th>
                            <th>Valor Financiado (oneroso)</th>
                            <th>Valor Total Contratado</th>                            
                        </tr>                     
                    </thead>
                    <tbody>
                    @foreach($resumoVigentes as $item)                       
                        <tr>                        
                                <td>{{$item->dsc_faixa}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_municipios,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_contratos,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_vigentes,0, ',' , '.')}}</td> 
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_sub_ogu,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_sub_fgts,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_financiamento,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_contratado,2, ',' , '.')}}</td>
                                                               
                            </tr>                    
                    @endforeach    
                        <tr class="totalFaixa">
                            <td class="tabelaNumero">Total:</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['municipios'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['contratos'],0, ',' , '.')}}</td>    
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['vigentes'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['vlr_ogu'],2, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['vlr_fgts'],2, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['financiamento'],2, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFgts['valor_contratado'],2, ',' , '.')}}</td>
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