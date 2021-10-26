@extends('layouts.app')

@section('content')

<section>
  <div class="container-fluid">    
    
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center">
            <strong class="text-white"><h2>Retomadas de Obras</h2></strong>            
          </div>
          <div class="card-body section-padding">
          
          <div class="titulo">
                <h5>Dados Retomada </h5> 
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">APF Vinculado</label>
                        <input id="num_apf_vinculado" type="text" class="form-control" name="num_apf_vinculado" value="{{$retomada->num_apf_vinculado}}" disabled >
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Modalidade</label>
                        <input id="txt_modalidade_retomada" type="text" class="form-control" name="txt_modalidade_retomada" value="{{$retomada->txt_modalidade_retomada}}" disabled >
                    </div>  
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Data Entrada AO</label>
                        <input id="dte_entrada_ao" type="text" class="form-control" name="dte_entrada_ao" value="@if($retomada->dte_entrada_ao){{date('d/m/Y',strtotime($retomada->dte_entrada_ao))}}@endif" disabled >
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Data da Dotação</label>
                        <input id="dte_dotacao" type="text" class="form-control" name="dte_dotacao" value="@if($retomada->dte_dotacao){{date('d/m/Y',strtotime($retomada->dte_dotacao))}}@endif" disabled >
                    </div>                  
                </div>
                <div class="row">                                                    
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Status Demanda</label>
                        <input id="txt_status_demanda" type="text" class="form-control" name="txt_status_demanda" value="{{$retomada->txt_status_demanda}}" disabled >
                    </div>  
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Data do Status</label>
                        <input id="dte_status_demanda" type="text" class="form-control" name="dte_status_demanda" value="@if($retomada->dte_status_demanda){{date('d/m/Y',strtotime($retomada->dte_status_demanda))}}@endif" disabled >
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Status SNH</label>
                        <input id="txt_status_snh" type="text" class="form-control" name="txt_status_snh" value="{{$retomada->txt_status_snh}}" disabled >
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Data Status SNH</label>
                        <input id="dte_status_snh" type="text" class="form-control" name="dte_status_snh" value="@if($retomada->dte_status_snh){{date('d/m/Y',strtotime($retomada->dte_status_snh))}}@endif" disabled >
                    </div>                        
                </div>
                <div class="row">                                                    
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Demanda Indicada</label>
                        <input id="bln_demanda_indicada" type="text" class="form-control" name="bln_demanda_indicada" value="@if($retomada->bln_demanda_indicada) Sim @else Não @endif" disabled >
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">Possui Condição Impeditiva?</label>
                        <input id="bln_condicao_impeditiva" type="text" class="form-control" name="bln_condicao_impeditiva" value="@if($retomada->bln_condicao_impeditiva) Sim @else Não @endif" disabled >
                    </div>
                    @if($retomada->bln_condicao_impeditiva)
                    <div class="col-xs-12 col-md-6">
                        <label class="control-label ">Condição Impeditiva</label>
                        <input id="txt_condicao_impeditiva" type="text" class="form-control" name="txt_condicao_impeditiva" value="{{$retomada->txt_condicao_impeditiva}}" disabled >
                    </div>                        
                    @endif     
                </div>
                <div class="row">                                                    
                    <div class="col-xs-12 col-md-2">
                        <label class="control-label ">% Involução Obra</label>
                        <input id="prc_involucao_obra" type="text" class="form-control" name="prc_involucao_obra" value="{{number_format($retomada->prc_involucao_obra, 2, ',' , '.')}}" disabled >
                    </div>     
                    <div class="col-xs-12 col-md-2">
                        <label class="control-label ">% Suplementação</label>
                        <input id="prc_suplementacao" type="text" class="form-control" name="prc_suplementacao" value="{{number_format($retomada->prc_suplementacao, 2, ',' , '.')}}" disabled >
                    </div> 
                    <div class="col-xs-12 col-md-2">
                        <label class="control-label ">Suplementação</label>
                        <input id="vlr_suplementar" type="text" class="form-control" name="vlr_suplementar" value="{{number_format($retomada->vlr_suplementar, 2, ',' , '.')}}" disabled >
                    </div>    
                    @if($retomada->motivo_aporte_adicional_id)
                    <div class="col-xs-12 col-md-6">
                        <label class="control-label ">Condição Impeditiva</label>
                        <input id="txt_motivo_aporte_adicional" type="text" class="form-control" name="txt_motivo_aporte_adicional" value="{{$retomada->txt_motivo_aporte_adicional}}" disabled >
                    </div>                        
                    @endif                      
                </div>
            </div><!-- fechar form-group-->

            <div class="titulo">
                <h5>Dados Construtora Atual </h5> 
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-12 col-md-3">
                        <label class="control-label ">CNPJ</label>
                        <input id="txt_cnpj_construtora_atual" type="text" class="form-control" name="txt_cnpj_construtora_atual" value="{{$retomada->txt_cnpj_construtora_atual}}" disabled >
                    </div>
                    <div class="col-xs-12 col-md-9">
                        <label class="control-label ">Nome</label>
                        <input id="txt_nome_construtora_atual" type="text" class="form-control" name="txt_nome_construtora_atual" value="{{$retomada->txt_nome_construtora_atual}}" disabled >
                    </div>                    
                </div>
            </div>
            <div class="titulo">
                <h5>Ofícios</h5> 
            </div>    
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>#</th>                                                       
                        <th>Nº Ofício</th>    
                        <th>Data</th> 
                        <th>Ano</th>
                        <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>      
                
                @foreach($oficiosRetomada as $oficio)                                                                   
                        <tr>                                                                                              
                            <td class="text-center">{{$oficio->oficio_id}}</td>                                   
                            <td class="text-center">{{$oficio->txt_num_oficio}}</td>     
                            <td class="text-center">@if($oficio->dte_oficio){{date('d/m/Y',strtotime($oficio->dte_oficio))}}@endif</td>                                   
                            <td class="text-center">{{$oficio->num_ano_oficio}}</td>                                                         
                            <td class="text-center">{{$oficio->txt_tipo_oficio}}</td>  
                           
                        </tr>    
                @endforeach                                                       
                    </tbody>
                </table> 
            </div>
           
                </div> 
          </div>    
        </div>
      </div>   
    </div>
   
</section>
<!--  Section-->

<!--  Section-->
<section class="statistics">
    <div class="container-fluid" >
    <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">         
    </div>
</section>


@endsection