@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        <historico-navegacao
                :url="'{{ url('/home') }}'"
                :titulo1="'Oferta Pública'"
                :titulo2='"Filtro Remessas de Devolução"'
                :link2="'{{ url('/oferta_publica/filtro_relatorio_devolucao') }}'"
                :titulo3='"Remessas de Devolução"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'ANEXO DE DEVOLUÇÃO DE RECURSOS '"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    :barracompartilhar="true" 
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/oferta_publica/remessa_devolucao/$remessaDevolucao->id") }}'">
            </cabecalho-form> 
        <div id="content-core"> 
            <div class="form-group">
                <div class="row">
                    <div class="column col-md-4 col-md-offset-8">
                        <label class="control-label label-relatorio">Cadastrada por</label>
                        <input id="txt_nome_user_inc" type="text" class="form-control input-relatorio" name="txt_nome_user_inc" value="{{$remessaDevolucao->txt_nome_user_inc}}" disabled >
                    </div>            
                    <div class="column col-md-4 col-md-offset-8">
                        <label class="control-label label-relatorio">Cadastrada em</label>
                        <input id="created_at" type="text" class="form-control input-relatorio" name="created_at" value="{{date('d/m/Y', strtotime($remessaDevolucao->created_at))}}" disabled >
                    </div>            
                </div>
    
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                            <label class="control-label label-relatorio ">Remessa</label>
                            <input id="remessaDevolucao" type="text" class="form-control input-relatorio" name="remessaDevolucao" value="{{$remessaDevolucao->id}}" disabled >
                        </div>
                    <div class="column  col-xs-12 col-md-8">
                        <label class="control-label label-relatorio ">Situação</label>
                        <input id="txt_nome_if" type="text" class="form-control input-relatorio" name="txt_nome_if" value="{{$remessaDevolucao->tipoSituacaoDevolucao->txt_situacao_devolucao}}" disabled >
                    </div>   
                </div>
    
                <div class="row">
                    <div class="column  col-xs-12 col-md-12">
                        <label class="control-label label-relatorio ">Instituição Financeira</label>
                        <input id="txt_nome_if" type="text" class="form-control input-relatorio" name="txt_nome_if" value="{{$instituicao->txt_nome_completo_if}}" disabled >
                    </div>            
                </div>
    
                <div class="row">
                    <div class="column  col-xs-12 col-md-12">
                        <label class="control-label label-relatorio ">Descrição</label>                   
                        <textarea class="form-control input-textarea" wrap="off" id="dsc_remessa_devolucao" rows="3" disabled>{{$remessaDevolucao->dsc_remessa_devolucao}}</textarea>
                       
                    </div>            
                </div>  
    
                 <div class="row">      
                
                    <table class="table table-bordered table-sm">
                    <thead  class="text-center">
                    <tr class="text-center">
                        <th rowspan="2">Nº</th>            
                        <th rowspan="2">Nome</th>                         
                        <th rowspan="2">Protocolo</th> 
                        <th colspan="8">Subvenção</th> 
                        <th colspan="3">Remuneração</th>   
                        
                    </tr>             
                            <tr>
                                <th>P1</th>            
                                <th>P2</th>            
                                <th>P3</th>            
                                <th>P4</th>            
                                <th>P5</th>            
                                <th>P6</th>            
                                <th>P7</th>                      
                                <th class="tabelaFaixa totalFaixa">Total</th>                      
                                <th>P1</th>            
                                <th>P2</th>                      
                                <th class="tabelaFaixa totalFaixa">Total</th>                      
                            </tr>    
                    
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                @foreach($parcelasRemessas as $contrato) 
                            <tr class="text-center">          
                            <td>{{$count += 1}}</td>     
                            <td>
                                {{$contrato->txt_nome_beneficiario}} <br/>
                                <span>CPF: {{$contrato->txt_cpf_beneficiario}}</span>
                                <span>NIS: {{$contrato->txt_nis_beneficiario}}</span>
                            </td>               
                            <td>
                                {{$contrato->txt_protocolo}} <br/>
                                <span>{{$contrato->ds_municipio}}-{{$contrato->sg_uf}}</span>
                            </td>                                          
                            <td>
                                {{ number_format( ($contrato->parcela_1), 2, ',' , '.')}}<br/>
                                <span>@if($contrato->dte_pag_parc_1) {{date('d/m/Y', strtotime($contrato->dte_pag_parc_1))}} @endif</span>
                                <span>{{$contrato->nt_pag_parc_1}}</span>
                            
                            </td>         
                            <td>
                                {{ number_format( ($contrato->parcela_2), 2, ',' , '.')}}<br/>
                                <span>@if($contrato->dte_pag_parc_2) {{date('d/m/Y', strtotime($contrato->dte_pag_parc_2))}} @endif</span>   
                                <span>{{$contrato->nt_pag_parc_2}}</span>                     
                            </td>         
                            <td>
                                {{ number_format( ($contrato->parcela_3), 2, ',' , '.')}}<br/>
                                <span>@if($contrato->dte_pag_parc_3) {{date('d/m/Y', strtotime($contrato->dte_pag_parc_3))}} @endif</span>  
                                <span>{{$contrato->nt_pag_parc_3}}</span>                      
                            </td>         
                            <td>
                                {{ number_format( ($contrato->parcela_4), 2, ',' , '.')}}<br/>
                                <span>@if($contrato->dte_pag_parc_4) {{date('d/m/Y', strtotime($contrato->dte_pag_parc_4))}} @endif</span>  
                                <span>{{$contrato->nt_pag_parc_4}}</span>                      
                            </td>         
                            <td>
                                {{ number_format( ($contrato->parcela_5), 2, ',' , '.')}}<br/>
                                <span>@if($contrato->dte_pag_parc_5) {{date('d/m/Y', strtotime($contrato->dte_pag_parc_5))}} @endif</span>   
                                <span>{{$contrato->nt_pag_parc_5}}</span>                     
                            </td>         
                            <td>
                                {{ number_format( ($contrato->parcela_6), 2, ',' , '.')}}<br/>
                                <span>@if($contrato->dte_pag_parc_6) {{date('d/m/Y', strtotime($contrato->dte_pag_parc_6))}} @endif</span>   
                                <span>{{$contrato->nt_pag_parc_6}}</span>                     
                            </td>         
                            <td>
                                {{ number_format( ($contrato->parcela_7), 2, ',' , '.')}}<br/>
                                <span>@if($contrato->dte_pag_parc_7) {{date('d/m/Y', strtotime($contrato->dte_pag_parc_7))}} @endif</span>  
                                <span>{{$contrato->nt_pag_parc_7}}</span>                      
                            </td>         
                            
                            <td>{{ number_format( ($contrato->parcela_1+$contrato->parcela_2+$contrato->parcela_3+$contrato->parcela_4+$contrato->parcela_5+$contrato->parcela_6+$contrato->parcela_7), 2, ',' , '.')}}</td>                 
                            <td>
                                {{ number_format( ($contrato->parcela_1_remun), 2, ',' , '.')}}
                                <span>@if($contrato->dte_pag_rem_1) {{date('d/m/Y', strtotime($contrato->dte_pag_rem_1))}} @endif</span> 
                                <span>{{$contrato->nt_pag_rem_parc_1}}</span>                       
                            </td>  
                            <td>
                                {{ number_format( ($contrato->parcela_2_remun), 2, ',' , '.')}}
                                <span>@if($contrato->dte_pag_rem_2) {{date('d/m/Y', strtotime($contrato->dte_pag_rem_2))}} @endif</span>   
                                <span>{{$contrato->nt_pag_rem_parc_2}}</span>                      
                            </td>  
                            <td>{{ number_format( ($contrato->parcela_1_remun+$contrato->parcela_1_remu2), 2, ',' , '.')}}</td>  
                            </tr>
                @endforeach  
                            <tr class="text-center">          
                                <td  colspan="10" class="text-right"><h4>TOTAL PAGO</h4></td>                                  
                                <td><h4>{{number_format( ($totalPago), 2, ',' , '.')}}</h4></td>                                  
                            </tr>
                
                         </tbody>
                    </table>
                </div>
    
            </div><!-- fechar form-group-->  
            
      
    

            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
                    </div>    
                </div>
                
                
            </div>    
    </div>   
    <!-- content-core -->



    </modal-form>    


</div>    
<!-- content -->
@endsection


