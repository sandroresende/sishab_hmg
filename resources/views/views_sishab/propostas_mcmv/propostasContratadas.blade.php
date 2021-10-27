@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
    
    
@endsection


@section('content')

<div id="content">
    <div id="content-core">
        
        <historico-navegacao
            :url="'{{ url('/home') }}'"
            :titulo1='"Seleção de Propostas"'
            :titulo2='"Filtro Seleção das Propostas Contratadas"'
            :link2="'{{ url('/proposta/contratadas/resumo/filtro') }}'"
            :titulo3="'Propostas Contratadas'"
        >
        </historico-navegacao>

        <cabecalho-form
                :titulo="'Propostas Contratadas'"
                @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                @if($subtitulo2) subtitulo2="{{$subtitulo2}} " @endif
                @if($subtitulo3) subtitulo3="{{$subtitulo3}} " @endif
                :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                :barracompartilhar="true"
                >
        </cabecalho-form>    

        <div class="form-group">
            @if(count($contratadasAno)>0)
                <div class="titulo">
                    <H3>Valores Contratados por Ano</H3> 
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
                    <H3>Valores Contratados por Demanda Fechada por Ano</H3> 
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
                    <H3>Propostas</H3> 
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
     <div class="form-group">
        <div class="row">
            <div class="column col-sm-6 col-xs-12">                                        
                <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">   
            </div>
            <div class="column col-sm-6 col-xs-12">
                <input class="btn btn-lg btn-danger btn-block" type="button-danger" onclick="javascript:window.history.go(-1)" value="Fechar">    
            </div>
        </div>        
    </div><!-- fechar primeiro form-group-->
     </div>
    <!--content-core --> 
</div>
<!--content-->     
@endsection


