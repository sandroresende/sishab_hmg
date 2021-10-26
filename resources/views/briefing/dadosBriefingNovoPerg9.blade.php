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
            <span id="breadcrumbs-current">
                   Obras Paralisadas
            <span class="badge badge-primary">Novo</span></span>
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
        


        @if($resumoParalisadas)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h4>FRAGILIDADES</h4>   
                </strong>                
            </div>

<!--Tabela MCMV 1-->
          
            
           
          
           

     

        <div class="titulo">
                <h5>9. Quantas obras estão paralisadas?</h5>
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>PMCMV</th>
                            <th>Nº Empreendimentos paralisados</th>   
                            <th>Nº UH Paralisadas</th>                                                         
                            <th>Valor Não Oneroso</th>     
                            <th>Valor Oneroso</th>     
                            <th>Valor Total dos Contratos Paralisados</th>                            
                            <th>Valor Pago em 2019</th>        
                            <th>Nº de Municípios</th>                            
                            
                        </tr>                     
                    </thead>
                    <tbody>
                    @foreach($resumoParalisadas as $item)                       
                        <tr>                        
                                <td>@if($item->bln_faixa == 1) Faixa 1 @else FGTS (1.5, 2 e 3) @endif</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_contratos,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_paralisadas,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_nao_oneroso,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_oneroso,2, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_contratado,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_liberado_2019,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_municipio,0, ',' , '.')}}</td>                                
                               
                            </tr>
                    @endforeach
                    <tr class="totalFaixa">
                            <td class="tabelaNumero">Total:</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['contratos'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['uh_paralisadas'],0, ',' , '.')}}</td>                            
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['valor_nao_oneroso'],2, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['valor_oneroso'],2, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['valor_contratado'],2, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['valor_liberado_2019'],2, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['municipio'],0, ',' , '.')}}</td>
                           
                        </tr>                         
                        </tbody>                                        
                </table>
            <!-- VALORES CONTRATADOS ANO -->
       
          
           
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