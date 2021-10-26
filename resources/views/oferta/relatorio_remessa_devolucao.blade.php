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
    <span >Oferta Pública</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Consulta aos Remessas de Devolução</span>
    </span>
</div>  

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
    <h2  class="documentFirstHeading text-center">
    ANEXO DE DEVOLUÇÃO DE RECURSOS
    </h2>    
    <span class="documentFirstHeadingSpan">Selecione os dados para realização da pesquisa.</span>   
    <div class="linha-separa"></div>
    

    <div id="content-core">
      <!-- form-group-->              
        <div class="form-group">
            <div class="row">
                <div class="column col-md-4 col-md-offset-8">
                    <label class="control-label">Cadastrada por</label>
                    <input id="txt_nome_user_inc" type="text" class="form-control text-center" name="txt_nome_user_inc" value="{{$remessaDevolucao->txt_nome_user_inc}}" disabled >
                </div>            
                <div class="column col-md-4 col-md-offset-8">
                    <label class="control-label">Cadastrada em</label>
                    <input id="created_at" type="text" class="form-control text-center" name="created_at" value="{{date('d/m/Y', strtotime($remessaDevolucao->created_at))}}" disabled >
                </div>            
            </div>

            <div class="row">
                <div class="column col-xs-12 col-md-4">
                        <label class="control-label ">Remessa</label>
                        <input id="remessaDevolucao" type="text" class="form-control text-center" name="remessaDevolucao" value="{{$remessaDevolucao->id}}" disabled >
                    </div>
                <div class="column  col-xs-12 col-md-8">
                    <label class="control-label ">Situação</label>
                    <input id="txt_nome_if" type="text" class="form-control text-center" name="txt_nome_if" value="{{$remessaDevolucao->txt_situacao_devolucao}}" disabled >
                </div>   
            </div>

            <div class="row">
                <div class="column  col-xs-12 col-md-12">
                    <label class="control-label ">Instituição Financeira</label>
                    <input id="txt_nome_if" type="text" class="form-control" name="txt_nome_if" value="{{$instituicao->txt_nome_completo_if}}" disabled >
                </div>            
            </div>

            <div class="row">
                <div class="column  col-xs-12 col-md-12">
                    <label class="control-label ">Descrição</label>                   
                    <textarea class="form-control" id="dsc_remessa_devolucao" rows="3" disabled>{{$remessaDevolucao->dsc_remessa_devolucao}}</textarea>
                   
                </div>            
            </div>  

             <div class="row">      
             <a class="btn btn-lg btn-light btn-block" href='{{ url("remessa_devolucao/download/$remessaDevolucao->id")}}' class="btn btn-lg btn-block btn-default">Download para Excel</a>     
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

            <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
            <a class="btn btn-lg btn-light btn-block" href='{{ url("remessa_devolucao/download/$contrato->remessa_devolucao_id")}}' class="btn btn-lg btn-block btn-default">Download para Excel</a>     
        </div><!-- fechar form-group-->     

    </div><!-- content-core-->
</div><!-- content-->



@endsection