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
        


        @if(count($valoresFaixa1)>0)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h4>CARTEIRA ATUAL VIGENTE DA SECRETARIA NO ESTADO</h4>   
                </strong>                
            </div>

<!--Tabela MCMV 1-->
          
            
           
          
           

      @if($valoresFaixa1['vigentes'] > 0)

        <div class="titulo">
                <h5>2.	Quantos instrumentos de repasse (oneroso e não oneroso) estão vigentes no estado? Qual o valor total dos repasses e quantos municípios estão contemplados?</h5>
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>Tipo de Operação</th>
                            <th>Nº UH Vigentes</th>                            
                            <th>Nº de Contratos</th>
                            <th>Valor Total Contratado</th>                            
                            <th>Nº municípios</th>   
                        </tr>                     
                    </thead>
                    <tbody>
                    @foreach($resumoVigentes as $item)                       
                        <tr>                        
                                <td>{{$item->txt_status_empreendimento}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_vigentes,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_contratos,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_contratado,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_municipios,0, ',' , '.')}}</td>                                
                            </tr>
                       
                    @endforeach    
                        <tr class="totalFaixa">
                            <td class="tabelaNumero">Total Faixa 1:</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['vigentes'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['contratos'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['valor_contratado'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresFaixa1['municipios'],0, ',' , '.')}}</td>
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