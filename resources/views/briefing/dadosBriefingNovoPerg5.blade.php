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
        


        @if($resumoEntregas)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h4>INVESTIMENTOS EM 2019 – OBRAS EM EXECUÇÃO NO ESTADO</h4>   
                </strong>                
            </div>

<!--Tabela MCMV 1-->
          
            
           
          
           

     

        <div class="titulo">
                <h5>5. Dos contratos em execução, quais tiveram obras entregues em 2019?. 
                Qual a estimativa da população beneficiada e de empregos gerados?</h5>
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th>Faixa</th>
                            <th>Nº UH Entregues</th>                            
                            <th>Nº Contratos com liberação em 2019</th>    
                            <th>Valor contratado UH´s entregues em 2019</th>
                            <th>Valor Liberado em 2019</th>                            
                            <th>Nº Municípios</th>   
                            <th>População beneficiada</th>   
                            <th>Nº Empregos Gerados</th>   
                        </tr>                     
                    </thead>
                    <tbody>
                    @foreach($resumoEntregas as $item)                       
                        <tr>                        
                                <td>{{$item->faixaRenda->dsc_faixa}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_uh_entregue_2019,0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_contratos,0, ',' , '.')}}</td>                                
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_contratado_uh_entregue,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format($item->vlr_liberado_2019,2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format($item->qtd_municipios,0, ',' , '.')}}</td>                                
                                @if($item->faixa_renda_id == 1)
                                    <td class="tabelaNumero text-center">{{number_format($totalMunicipioFaixas['faixa1'],0, ',' , '.')}}</td>                                     
                                @elseif($item->faixa_renda_id == 4)
                                    <td class="tabelaNumero text-center">{{number_format($totalMunicipioFaixas['faixa15'],0, ',' , '.')}}</td>                                     
                                @elseif($item->faixa_renda_id == 2)
                                    <td class="tabelaNumero text-center">{{number_format($totalMunicipioFaixas['faixa2'],0, ',' , '.')}}</td>  
                                @else
                                    <td class="tabelaNumero text-center">{{number_format($totalMunicipioFaixas['faixa3'],0, ',' , '.')}}</td>                                                                          
                                @endif
                                <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format(($item->vlr_liberado_2019/1000000)*22,2, ',' , '.')}}</td>
                            </tr>
                       
                    @endforeach    
                    <tr class="totalFaixa">
                            <td class="tabelaNumero">Total:</td>
                            <td class="tabelaNumero text-center">{{number_format($totalEntregas['entregue_2019'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($totalEntregas['contratos'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($totalEntregas['valor_uh_entregues'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($totalEntregas['liberado_2019'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($totalEntregas['municipios'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center">{{number_format($totalEntregas['populacao'],0, ',' , '.')}}</td>
                            <td class="tabelaNumero text-center" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">{{number_format(($totalEntregas['liberado_2019']/1000000)*22,2, ',' , '.')}}</td>
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