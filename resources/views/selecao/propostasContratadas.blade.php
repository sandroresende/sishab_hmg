@extends('layouts.app')

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
        <span> Seleção de Propostas</span>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href="{{url('/contratadas/resumo/filtro')}}">Consulta das Propostas Contratadas</a>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Propostas Contratadas</span>
    </span>
</div> 

    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Propostas Contratadas
        </h2>
        <span class="documentFirstHeadingSpan">
        @if($municipio) 
            {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}} 
        @else
            @if($estado)
                {{$estado->txt_uf}}
            @endif
        @endif 

        @if($modalidade)
            {{$modalidade}}
        @endif

        @if($regiao && !$estado)
            {{$regiao->txt_regiao}}    
        @endif


        </span>   
        <div class="linha-separa"></div>


    <div id="content-core">
      <!-- form-group-->        
       
      <div class="form-group">
        @if(count($contratadasAno)>0)
            <div class="titulo">
                <h5>Valores Contratados por Ano</h5> 
            </div> 
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                            <th rowspan="2" class="align-middle">Ano</th>  
                            <th colspan="4">Entidades</th>                          
                            <th colspan="4">Far Empresas</th>                          
                            <th colspan="4">Rural</th>                          
                        </tr>
                        <tr class="text-center">
                            <th>Propostas</th>                          
                            <th>UH Selecionadas</th>                          
                            <th>UH Contratadas</th>                          
                            <th>Valor</th>  
                            <th>Propostas</th>                          
                            <th>UH Selecionadas</th>                          
                            <th>UH Contratadas</th>                          
                            <th>Valor</th>  
                            <th>Propostas</th>                          
                            <th>UH Selecionadas</th>                          
                            <th>UH Contratadas</th>                          
                            <th>Valor</th>                          
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($contratadasAno as $ano) 
                            <tr class="text-center">          
                                <td>{{$ano->num_ano_selecao}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_entidade), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_selecionada_entidade), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_entidades), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_entidades), 2, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_far), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_selecionada_far), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_far), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_far), 2, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_rural), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_selecionada_rural), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_rural), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_rural), 2, ',' , '.')}}</td>
                            </tr>            
                    @endforeach   
                        <tr  class="text-center">     
                                <th>TOTAL</th>     
                                <th>{{number_format( ($totalAno['total_prop_selec_entidade']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_selecionada_entidade']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_contratadas_entidades']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_vlr_contratado_entidades']), 2, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_prop_selec_far']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_selecionada_far']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_contratadas_far']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_vlr_contratado_far']), 2, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_prop_selec_rural']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_selecionada_rural']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_contratadas_rural']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalAno['total_vlr_contratado_rural']), 0, ',' , '.')}}</th>                                
                            </tr>                          
                        </tbody>
                    </table> 
                </div> 
        @endif

        
        @if(count($contratadasAnoDemFechada)>0)
            <div class="titulo">
                <h5>Valores Contratados por Demanda Fechada por Ano</h5> 
            </div> 
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                            <th rowspan="2" class="align-middle">Ano</th>  
                            <th colspan="3">Entidades</th>                          
                            <th colspan="3">Far Empresas</th>                          
                            <th colspan="3">Rural</th>                          
                        </tr>
                        <tr class="text-center">
                            <th>Propostas</th>                          
                            <th>UH Contratadas</th>                          
                            <th>Valor</th>  
                            <th>Propostas</th>                          
                            <th>UH Contratadas</th>                          
                            <th>Valor</th>  
                            <th>Propostas</th>                          
                            <th>UH Contratadas</th>                          
                            <th>Valor</th>                          
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($contratadasAnoDemFechada as $ano) 
                            <tr class="text-center">          
                                <td>{{$ano->num_ano_selecao}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_entidade), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_entidades), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_entidades), 2, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_far), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_far), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_far), 2, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_prop_selec_rural), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_contratadas_rural), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($ano->total_vlr_contratado_rural), 2, ',' , '.')}}</td>
                            </tr>            
                    @endforeach   
                        <tr  class="text-center">     
                                <th>TOTAL</th>     
                                <th>{{number_format( ($totalDemFechadaAno['total_prop_selec_entidade']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalDemFechadaAno['total_contratadas_entidades']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalDemFechadaAno['total_vlr_contratado_entidades']), 2, ',' , '.')}}</th>
                                <th>{{number_format( ($totalDemFechadaAno['total_prop_selec_far']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalDemFechadaAno['total_contratadas_far']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalDemFechadaAno['total_vlr_contratado_far']), 2, ',' , '.')}}</th>
                                <th>{{number_format( ($totalDemFechadaAno['total_prop_selec_rural']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalDemFechadaAno['total_contratadas_rural']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalDemFechadaAno['total_vlr_contratado_rural']), 0, ',' , '.')}}</th>                                
                            </tr>                          
                        </tbody>
                    </table> 
                </div> 
        @endif
            <div class="titulo">
                <h5>Propostas</h5> 
            </div> 
             <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>UF</th>  
                        <th>Município</th>  
                        <th>Modalidade</th>  
                        <th>APF</th>  
                        <th>Empreendimento</th>  
                        <th>UH Selecionadas</th>  
                        <th>UH Contratadas</th>     
                        <th>Valor Contratado</th>                                    
                        <th>Ano Seleção</th>                                    
                        <th>Demanda Fechada</th>   
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasContratadas as $propostas) 
                            <tr class="text-center">          
                                <td>{{$propostas->txt_sigla_uf}}</td>                                    
                                <td>{{$propostas->ds_municipio}}</td>                                    
                                <td>{{$propostas->txt_modalidade}}</td>                                    
                                <td><a style="text-decoration:none" href='{{ url("proposta/$propostas->proposta_id/$propostas->num_apf") }}'>{{$propostas->num_apf}}</a></td>   
                                <td>{{$propostas->txt_nome_empreendimento}}</td>    
                                <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($propostas->num_uh_contratadas), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($propostas->vlr_contratado), 2, ',' , '.')}}</td>
                                <td>{{$propostas->num_ano_selecao}}</td>                                   
                                <td>
                                    @if($propostas->bln_demanda_fechada)
                                    <span class="badge badge-warning">Demanda Fechada</span> 
                                    @endif
                                </td>    
                            </tr>            
                    @endforeach   
                    <tr  class="text-center">     
                                <th colspan="4">TOTAL</th>     
                                <th>{{number_format( ($totalContratadas['total_prop_selec']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalContratadas['total_selecionada']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalContratadas['total_contratadas']), 0, ',' , '.')}}</th>
                                <th>{{number_format( ($totalContratadas['total_vlr_contratado']), 2, ',' , '.')}}</th>
                                <th></th>                                                              
                                <th></th>       
                            </tr>                         
                        </tbody>
                    </table> 
                </div> 
          
      </div><!--form-group -->
      <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 

    <!-- Link para Excel-->
    <a class="btn btn-lg btn-light btn-block" href='{{ url("contratadas-download") . "/" . $dadosPropostas["regiao"] . "/" . $dadosPropostas["estado"] . "/" . $dadosPropostas["municipio"] . "/" . $dadosPropostas["modalidade"] . "/" . $dadosPropostas["ano"]}}' class="btn btn-lg btn-default btn-block">Download para Excel</a>     

    </div><!-- content-core-->
</div><!-- content-->

@endsection