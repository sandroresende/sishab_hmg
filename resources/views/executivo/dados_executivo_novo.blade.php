@extends('layouts.app') @section('scripts')
<link href="{{ asset('css/style.blue.css') }}" rel="stylesheet">
<link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> @endsection @section('content')
<div id="content">   
    
    <div id="viewlet-below-content-title">
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
        <div class="documentByLine" id="plone-document-byline">           
            <!-- autor-->
            <div class="tile tile-default" id="a1342891-606b-4053-a67a-2244abec99ee">
                <div class="outstanding-header tile-content">            
                    <h2 class="outstanding-title">Programa Minha Casa Minha Vida</h2>
                    @if($status == '')
                        @if($situacaoVigencia != '')
                            {{$situacaoVigencia}}
                        @endif                                
                    @else
                        {{$status}}
                    @endif
                    <h4></h4>
                </div>        
            </div>      
            <!-- data atualização-->
        </div>
    </div>

    <div class="form-group">
        <div class="row">
                <div class="column col-sm-6">
                    <h5 class="card-title text-secondary text-center">Déficit Habitacional
                        <a href="" data-toggle="modal" data-target="#modalIndicadores" class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </h5>
                    
                    
                    <div class="row">
                        <div class="column col-md-6 " data-panel="">
                            <div class="tile tile-default" id="fe5acef5-60aa-4420-a089-7078924c0dc9">        
                                <div class="cover-richtext-tile tile-content">
                                <caixa-simples qtd="{{number_format( ($deficit-> vlr_deficit_habitacional_urbano), 0, ',' , '.')}}" 
                                        titulo="Unidades Habitacionais" rodape="Área Urbana" cor="#2969BD" icone="fas fa-home"></caixa-simples>
                                </div>
                            </div>
                        </div>
                        <div class="column col-md-6 " data-panel="">
                            <div class="tile tile-default" id="fe5acef5-60aa-4420-a089-7078924c0dc9">        
                                <div class="cover-richtext-tile tile-content">
                                <caixa-simples qtd="{{number_format( ($deficit->vlr_deficit_habitacional_rural), 0, ',' , '.')}}" 
                                        titulo="Unidades Habitacionais" rodape="Área Rural" cor="#0172CC" icone="fas fa-home"></caixa-simples>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column col-sm-6 ">
                    <h5 class="card-title text-secondary text-center">Unidades Habitacionais Contratadas
                    @if($municipio) 
                        <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                            <i class="fa fa-arrow-circle-right"></i>
                        </a> 
                    @endif    
                    </h5>    
                    <div class="row">
                        <div class="column col-md-6 " data-panel="">
                            <div class="tile tile-default" id="fe5acef5-60aa-4420-a089-7078924c0dc9">        
                                <div class="cover-richtext-tile tile-content">
                                <caixa-simples qtd="{{number_format( ($uhTotal_urbano), 0, ',' , '.')}}" 
                                            titulo="Unidades Habitacionais" rodape="Oferta, FAR e FDS" cor="#2969BD" icone="fas fa-home"></caixa-simples>
                                </div>
                            </div>
                        </div>
                        <div class="column col-md-6 " data-panel="">
                            <div class="tile tile-default" id="fe5acef5-60aa-4420-a089-7078924c0dc9">        
                                <div class="cover-richtext-tile tile-content">
                                <caixa-simples qtd="{{number_format( ($uhTotal_rural), 0, ',' , '.')}}" 
                                titulo="Unidades Habitacionais"  rodape="Rural" cor="#0172CC" icone="fas fa-home"></caixa-simples>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
     <div class="row">
            <div class="column col-lg-12">
                <div class="titulo">
                    <h5> Contratações Brasil (2009 - 2020)</h5>
                </div>
                <span class="text-nota">Posição dos arquivos:</span><span class="text-nota"> @foreach($dataPosicao as $posicao) {{$posicao->txt_modalidade}} ({{date('d/m/Y',strtotime($posicao->dte_movimento))}})@endforeach </span>
                <table-executivo
                        :dados="{{$relatorioExecutivo}}" 
                        :url="'{{ url('/') }}'"
                        v-bind:codibge=" 0"
                > </table-executivo>
            
            </div>
            <!--column col-lg-12-->
        </div>
        <!--row-->  
      </div>

      <div class="form-group">
        
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
                        <th colspan="4">FGTS</th>                      
                        <th rowspan="2" class="totalFaixa text-secondary">Total FGTS</th>                        
                        <th rowspan="2"  class="bg-dark">Total</th> 
                    </tr>
                    <tr class="text-center">                                               
                        <th>Entidades</th>
                        <th>Far</th>
                        <th>Oferta Pública</th>
                        <th>Rural</th>
                        <th>Prod/Estoque</th> 
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
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_prod), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_15), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_2), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_3), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa totalFaixa">{{number_format( ($item->valor_total_num_uh_23 + $item->total_uh_fgts_15+ $item->total_uh_fgts_prod), 0, ',' , '.')}}</td>                         
                        <td class="tabelaFaixa text-bold table-dark">{{number_format( ($item->valor_total_num_uh_1 + $item->valor_total_num_uh_23 + $item->total_uh_fgts_15+ $item->total_uh_fgts_prod), 0, ',' , '.')}}</td>                         
                    </tr>
                    @endforeach
                    @foreach($totalAno as $item)
                    <tr class="total">                        
                        <td>TOTAL</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_entidades), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_far + $item->total_uh_far_vinc), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_oferta), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_rural), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_num_uh_1), 0, ',' , '.')}}</td>  
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_prod), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_15), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_2), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_3), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_num_uh_23 + $item->total_uh_fgts_15+$item->total_uh_fgts_prod), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa table-dark">{{number_format( ($item->valor_total_num_uh_1+$item->valor_total_num_uh_23 + $item->total_uh_fgts_15+$item->total_uh_fgts_prod), 0, ',' , '.')}}</td>
                        
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
                        <th colspan="4">FGTS</th>   
                        <th rowspan="2" class="totalFaixa text-secondary">Total FGTS</th>         
                        <th rowspan="2" class="bg-dark">Total</th>                                             
                    </tr>
                    <tr class="text-center">                                               
                        <th>Entidades</th>
                        <th>Far</th>
                        <th>Oferta Pública</th>
                        <th>Rural</th>
                        <th>Prod/Estoque</th> 
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
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_prod/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_15/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_2/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_3/1000), 2, ',' , '.')}}</td>  
                        <td class="tabelaFaixa totalFaixa">{{number_format( ($item->valor_total_23/1000+$item->valor_total_fgts_15+$item->valor_total_fgts_prod/1000), 2, ',' , '.')}}</td>   
                        <td class="tabelaFaixa text-bold table-dark">{{number_format( (($item->valor_total_fgts_15+$item->valor_total_1+$item->valor_total_23+$item->valor_total_fgts_prod)/1000), 2, ',' , '.')}}</td>                                             
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
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_prod/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_15/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_2/1000), 2, ',' , '.')}}</td> 
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_fgts_3/1000), 2, ',' , '.')}}</td>  
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_23 + $item->valor_total_fgts_15 + $item->valor_total_fgts_prod)/1000, 2, ',' , '.')}}</td>                        
                        <td class="tabelaFaixa table-dark">{{number_format( (($item->valor_total_23 + $item->valor_total_fgts_15+$item->valor_total_1+$item->valor_total_fgts_prod)/1000), 2, ',' , '.')}}</td>       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
      <div class="form-group">  
        <div class="row">
            <button class="btn-lg btn btn-success btn-block"
                onclick="javascript:window.history.go(-1)">
                Voltar
            </button>
            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 
            
        </div>  
    </div>
</div>
<!-- content-->

    
    
    <div class="modal fade" id="modalIndicadores" tabindex="-1" role="dialog" aria-labelledby="modalIndicadoresTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalIndicadoresTitle">Déficit Habitacional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                <div class="titulo">
                    <h5>Urbano</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Urbano</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano), 0, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo até 3 Salários</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_ate3_sal), 2, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo de 3 a 10 Salários</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_de3a10_sal), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo até 10 Salários</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_ate10), 2, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo acima de 10 Salários</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_acima10_sal), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titulo">
                    <h5>Rural</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rural</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_rural), 0, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_rural_relativo), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titulo">
                    <h5>Total</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Total</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_total), 0, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo Total</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_total_relativo), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titulo">
                    <h5>Diversos</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Domicílio Precário</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_domicilios_precarios), 2, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Coabitação Familiar</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_coabitacao_familiar), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Ônus Excessivo com Aluguel</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_onus_excessivo_com_aluguel), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Adensamento Excessivo com Domicílios Alugados</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_adensamento_excessivo_domicilios_alugados), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <p class="font-italic">Ano de Referência: {{$deficit->num_ano_referencia}}</p>

            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>        
      </div>
    </div>
  </div>
</div>


@endsection