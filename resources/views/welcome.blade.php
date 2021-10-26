@extends('layouts.app') @section('scripts')
<link href="{{ asset('css/style.blue.css') }}" rel="stylesheet">
<link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> @endsection 


@section('content')
<div id="content">   
    
    <div id="viewlet-below-content-title">
        <div class="documentByLine" id="plone-document-byline">           
            <!-- autor-->
            <div class="tile tile-default" id="a1342891-606b-4053-a67a-2244abec99ee">
                <div class="outstanding-header tile-content">            
                    <h2 class="outstanding-title">Programa Minha Casa Minha Vida</h2>
                </div>        
            </div>      
            <!-- data atualização-->
        </div>
    </div>
    
    <div class="row">
        <div class="column col-md-3 " data-panel="">
            <div class="tile tile-default" id="fe5acef5-60aa-4420-a089-7078924c0dc9">        
                <div class="cover-richtext-tile tile-content">
                    <caixa-simples qtd="{{number_format($populacaoTotal->total_populacao, 0, ',' , '.')}}" 
                            titulo="Habitantes" 
                            ano="{{$populacaoTotal->num_ano_referencia}}" 
                            cor="#2969BD" 
                            icone="fas fa-users" 
                            rodape="População"> 
                    </caixa-simples>
                </div>
            </div>
        </div>
        <div class="column col-md-3 " data-panel="">
            <div class="tile tile-default" id="fe5acef5-60aa-4420-a089-7078924c0dc9">        
                <div class="cover-richtext-tile tile-content">
                    <caixa-simples qtd="{{number_format($uh_contratadas, 0, ',' , '.')}}" 
                            titulo="Unidades Habitacionais" 
                            ano="Área Urbana e Rural" 
                            cor="#0172CC" 
                            icone="fas fa-home" 
                            rodape="Contratação"> 
                    </caixa-simples>
                </div>
            </div>
        </div>
        <div class="column col-md-3 " data-panel="">
            <div class="tile tile-default" id="fe5acef5-60aa-4420-a089-7078924c0dc9">        
                <div class="cover-richtext-tile tile-content">
                    <caixa-simples qtd="{{number_format($deficit->vlr_deficit_habitacional_urbano, 0, ',' , '.')}}" 
                            titulo="Unidades Habitacionais" 
                            ano="Área Urbana e Rural" 
                            cor="#008CFF" 
                            icone="fas fa-home" 
                            rodape="Déficit Hab. Urbano"> 
                    </caixa-simples>
                </div>
            </div>
        </div>
        <div class="column col-md-3 " data-panel="">
            <div class="tile tile-default" id="fe5acef5-60aa-4420-a089-7078924c0dc9">        
                <div class="cover-richtext-tile tile-content">
                    <caixa-simples qtd="{{number_format($deficit->vlr_deficit_habitacional_rural, 0, ',' , '.')}}" 
                            titulo="Unidades Habitacionais" 
                            ano="Área Urbana e Rural" 
                            cor="#4DAFFF" 
                            icone="fas fa-home" 
                            rodape="Déficit Hab. Rural"> 
                    </caixa-simples>
                </div>
            </div>
        </div>

    </div>    




     <div class="row">
            <div class="column col-lg-12">
                <div class="titulo">
                    <h5> Contratações Minha Casa Minha Vida (2009 - 2020)</h5>
                </div>
                <span class="text-nota">Posição dos arquivos:</span><span class="text-nota"> @foreach($dataPosicao as $posicao) {{$posicao->txt_modalidade}} ({{date('d/m/Y',strtotime($posicao->dte_movimento))}})@endforeach </span>
                <table-executivo
                        :dados="{{$relatorioExecutivo1}}" 
                        :url="'{{ url('/') }}'"
                        v-bind:codibge=" 0"
                > </table-executivo>
            
            </div>
            
        </div>
        <div id="viewlet-below-content-title">
        <div class="documentByLine" id="plone-document-byline">           
            <!-- autor-->
            <div class="tile tile-default" id="a1342891-606b-4053-a67a-2244abec99ee">
                <div class="outstanding-header tile-content">            
                    <h2 class="outstanding-title">Casa Verde e Amarela</h2>
                </div>        
            </div>      
            <!-- data atualização-->
        </div>
    </div>
        <div class="row">
            <div class="column col-lg-12">
                <div class="titulo">
                    <h5> Contratações Casa Verde e Amarela (a partir de 2020)</h5>
                </div>
                <span class="text-nota">Posição dos arquivos:</span><span class="text-nota"> @foreach($dataPosicao as $posicao) @if($posicao->txt_modalidade == 'CCFGTS') {{$posicao->txt_modalidade}} ({{date('d/m/Y',strtotime($posicao->dte_movimento))}})@endif @endforeach </span>
                <table-executivo-cvea
                        :dados="{{$relatorioExecutivo2}}" 
                        :url="'{{ url('/') }}'"
                        v-bind:codibge=" 0"
                > </table-executivo-cvea>
            
            </div>
            
        </div>

        
   <!--    
    
 
     

        <div class="row">
            <div class="column col-md-6">    
                    

                        <div class="table-responsive">	
                        <div class="titulo">
                            <h5>CONTRATAÇÕES 2019 </h5>  

                        </div>	
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
                                    @if($item->num_ano_assinatura == 2019)                       
                                        <tr>                        
                                            <td>{{$item->txt_regiao}}</td>                            
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_1,0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_15,0, ',' , '.')}}</td>                                
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_2,0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_3,0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_producao_estoque,0, ',' , '.')}}</td>
                                            <td class="tabelaFaixa totalFaixa text-center">{{number_format($item->qtd_uh_contratada,0, ',' , '.')}}</td>
                                            
                                        </tr>                        
                                    @endif    
                                @endforeach   
                                        <tr class="total">                         
                                            <td>Total</td>                            
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2019['faixa1'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2019['faixa15'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2019['faixa2'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2019['faixa3'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2019['producao'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2019['contratadas'],0, ',' , '.')}}</td>
                                        </tr>
                                    </tbody>                                        
                            </table>
                       
                    </div>   
             </div>        
            <div class="column col-md-6">   
                

                <div class="table-responsive">	
                        <div class="titulo">
                            <h5>ENTREGAS 2019    </h5>            
                        </div>	
                        <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr class="text-center">
                                <th>Região</th>                            
                                <th>Faixa 1</th>
                                <th>Faixa 1,5</th>
                                <th>Faixa 2</th>
                                <th>Faixa 3</th>          
                                <th class="totalFaixa text-secondary">Total</th>    
                            </tr>                                          
                        </thead>
                        <tbody>
                        @foreach($entregaAno as $item)  
                            @if($item->num_ano_entrega == 2019)                         
                                <tr>                        
                                    <td>{{$item->txt_regiao}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_1,0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_15,0, ',' , '.')}}</td>                                
                                    <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_2,0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_3,0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa totalFaixa text-center">{{number_format($item->qtd_uh_entregues,0, ',' , '.')}}</td>
                                    
                                </tr>   
                            @endif                         
                        @endforeach   
                                <tr class="total">                         
                                    <td >Total</td>                            
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2019['faixa1'],0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2019['faixa15'],0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2019['faixa2'],0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2019['faixa3'],0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2019['entregues'],0, ',' , '.')}}</td>
                                </tr>
                            </tbody>                                        
                    </table>
                
                </div>   

            </div>    
        </div>
        <div class="row">
            <div class="column col-md-6">    
                    

                        <div class="table-responsive">	
                        <div class="titulo">
                            <h5>CONTRATAÇÕES 2020 </h5>  

                        </div>	
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
                                    @if($item->num_ano_assinatura == 2020)                       
                                        <tr>                        
                                            <td>{{$item->txt_regiao}}</td>                            
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_1,0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_15,0, ',' , '.')}}</td>                                
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_2,0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_3,0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($item->uh_producao_estoque,0, ',' , '.')}}</td>
                                            <td class="tabelaFaixa totalFaixa text-center">{{number_format($item->qtd_uh_contratada,0, ',' , '.')}}</td>
                                            
                                        </tr>                        
                                    @endif    
                                @endforeach   
                                        <tr class="total">                         
                                            <td>Total</td>                            
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2020['faixa1'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2020['faixa15'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2020['faixa2'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2020['faixa3'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2020['producao'],0, ',' , '.')}}</td>
                                            <td class="tabelaNumero text-center">{{number_format($valoresMCMV2020['contratadas'],0, ',' , '.')}}</td>
                                        </tr>
                                    </tbody>                                        
                            </table>
                        
                    </div>   
             </div>        
            <div class="column col-md-6">   
                

                <div class="table-responsive">	
                        <div class="titulo">
                            <h5>ENTREGAS 2020    </h5>            
                        </div>	
                        <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr class="text-center">
                                <th>Região</th>                            
                                <th>Faixa 1</th>
                                <th>Faixa 1,5</th>
                                <th>Faixa 2</th>
                                <th>Faixa 3</th>          
                                <th class="totalFaixa text-secondary">Total</th>    
                            </tr>                                          
                        </thead>
                        <tbody>
                        @foreach($entregaAno as $item)                        
                             @if($item->num_ano_entrega == 2020)                         
                                <tr>                        
                                    <td>{{$item->txt_regiao}}</td>                            
                                <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_1,0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_15,0, ',' , '.')}}</td>                                
                                    <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_2,0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($item->uh_faixa_3,0, ',' , '.')}}</td>
                                    <td class="tabelaFaixa totalFaixa text-center">{{number_format($item->qtd_uh_entregues,0, ',' , '.')}}</td>
                                    
                                </tr>   
                            @endif                        
                        @endforeach   
                                <tr class="total">                         
                                    <td >Total</td>                            
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2020['faixa1'],0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2020['faixa15'],0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2020['faixa2'],0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2020['faixa3'],0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center">{{number_format($valoresEntregas2020['entregues'],0, ',' , '.')}}</td>
                                </tr>
                            </tbody>                                        
                    </table>
                
                </div>   

            </div>    
        </div>
        -->
            <div class="row">
                <div class="column col-lg-12">
                    <div class="titulo">
                        <h5>Modalidades Vigentes</h5>
                        <p class="text-left">O acesso á faixa 1 do PMCMV, voltada a atender famílias de baixa renda, encontra-se disciplinado por normativos específicos, expedidos pelo Ministério do Desenvolvimento Regional, nas modalidades descritas a seguir:
                        </p>
                        <p class="text-left"><b>PMCMV-FAR:</b> Portaria nº 114, de 9 de fevereiro de 2018, que dispõe sobre as operações custeadas com recursos do Fundo de Arrendamento Residencial (FAR) <a download href="{{ url('/documents/far.pdf')}}" class="badge badge-warning"><i class="fas fa-download"></i></a></p>
                        <p class="text-left"><b>PMCMV-Entidades:</b> Instrução Normativa nº 12, de 7 de junho de 2018, que dispõe sobre operações com recursos do Fundo de Desenvolvimento o Social(FDS), e Portaria nº 367, de 7 de junho de 2018 , que disciplina o processo de seleção de propostas, para participação de entidades privadas sem fins lucrativos , localizadas em área urbana. <a download href="{{ url('/documents/fds.pdf')}}" class="badge badge-warning"><i class="fas fa-download"></i></a></p>
                        <p class="text-left"><b>PMCMV-PNHR:</b> Portaria nº 366, de 7 de junho de 2018, que dispõe sobre as operações para o Programa Nacional de Habitação Rural, e Portaria nº 368, de 7 de junho de 2018, que disciplina o processo de seleção de propostas a serem apresentadas pelas entidades provadas sem fins lucrativos, localizadas em área rural, e as prefeituras. <a download href="{{ url('/documents/pnhr.pdf')}}" class="badge badge-warning"><i class="fas fa-download"></i></a></p>

                    </div>
                </div>
            <!--column col-lg-12-->
            </div>
        <!--row-->
        

  
    

</div>
<!-- content-->



@endsection