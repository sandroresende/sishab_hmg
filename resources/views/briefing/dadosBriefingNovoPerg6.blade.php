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
                    Investimento em 2019 - Obras em Execução no Estado
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
        


        @if($resumoContratadas)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h4>INVESTIMENTOS EM 2019 – OBRAS EM EXECUÇÃO NO ESTADO</h4>   
                </strong>                
            </div>

<!--Tabela MCMV 1-->
          
            
           
          
           

     

        <div class="titulo">
                <h5>6. Quantos empreendimentos foram contratados em 2019?</h5>
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>Faixa</th>
                            <th>Nº UH</th>                            
                            <th>Nº Contratos</th>    
                            <th>Valor Contratadado</th>                            
                            <th>Nº Municípios</th>   
                            <th>Nº Empregos Gerados</th>   
                        </tr>                     
                    </thead>
                    <tbody>
                    @foreach($resumoContratadas as $item)                       
                        <tr>                        
                                <td>{{$item->dsc_faixa}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_contratadas,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_contratos,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_operacao,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_municipios,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format(($item->vlr_operacao/1000000)*22,0, ',' , '.')}}</td>
                            </tr>
                       
                    @endforeach    
                    <tr class="totalFaixa">
                            <td class="tabelaNumero">Total:</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['uh_contratadas'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['contratos'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['valor_contratado'],2, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($valoresMcmv['municipio'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format(($valoresMcmv['valor_contratado']/1000000)*22,0, ',' , '.')}}</td>
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