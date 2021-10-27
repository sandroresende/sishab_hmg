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
                :titulo2='"Filtro aos Protocolos das Instituições"'
                :link2="'{{ url('/oferta_publica/protocolos/instituicao/filtro') }}'"
                :titulo3='"Protocolos"'
                :link3="'{{ url("/oferta_publica/protocolos/instituicao/$protocolo->instituicao_id/") }}'"
                :titulo4='"{{$protocolo->txt_protocolo}}"'
                :link4="'{{ url("/oferta_publica/protocolo/$protocolo->instituicao_id/$protocolo->id") }}'"
                :titulo5='"Dados do Contrato"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'{{$beneficiario->txt_nome_beneficiario}}'"
                    subtitulo1="{{$protocolo->txt_protocolo}} "
                    subtitulo2="{{$protocolo->txt_nome_if}}"
                    subtitulo3="{{$protocolo->ds_municipio}} / {{$protocolo->sg_uf}}"
                    :barracompartilhar="true"      
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/oferta_publica/contrato/$contrato->id") }}'">

                    @if($contrato->bln_restricao) 
                        <div class="alert alert-danger text-center" role="alert">
                            <h3> Restrição</h3>
                        </div> <!-- div alert  -->                            
                    @else
                        @if($contrato->bln_recurso_devolvido)
                            <div class="alert alert-warning text-center" role="alert">
                                <h3> Devolvido</h3>
                            </div> <!-- div alert  -->  
                        @else
                            @if($contrato->bln_entregue)
                                <div class="alert alert-info text-center" role="alert">
                                    <h3> Entregue</h3>
                                </div> <!-- div alert  -->
                            @else
                                @if($contrato->vlr_percentual_obra == 100)
                                    <div class="alert alert-success text-center" role="alert">
                                        <h3> Concluído</h3>
                                    </div> <!-- div alert  -->
                                @else
                                    <div class="alert alert-secondary  text-center" role="alert">
                                        <h3> Em Andamento</h3>
                                    </div> <!-- div alert  -->                                   
                                @endif
                            @endif
                        @endif
                    @endif  

            </cabecalho-form> 
        <div id="content-core"> 
            <div class="form-group">
                <div class="titulo">
                    <h3>Dados do Beneficiário </h3> 
                    
                </div>
                <div class="form-group form-group-relatorio">
                <div class="row">                             
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">ID</label>
                        <input id="contrato_id" type="text" class="form-control input-relatorio" name="contrato_id" value="{{$contrato->id}}" disabled >
                    </div>
                    
                        <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">NIS</label>
                        <input id="txt_nis_beneficiario" type="text" class="form-control input-relatorio" name="txt_nis_beneficiario" value="{{$beneficiario->txt_nis_beneficiario}}" disabled >
                    </div>
                        <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">CPF</label>
                        <input id="txt_cpf_beneficiario" type="text" class="form-control input-relatorio" name="txt_cpf_beneficiario" value="{{$beneficiario->txt_cpf_beneficiario}}" disabled >
                    </div>  
                        <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Genero</label>
                        <input id="txt_genero" type="text" class="form-control input-relatorio" name="txt_genero" value="{{$beneficiario->genero->txt_genero}}" disabled >
                    </div> 
                        <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Estado Civil</label>
                        <input id="txt_genero" type="text" class="form-control input-relatorio" name="txt_genero" value="{{$beneficiario->estadoCivil->txt_estado_civil}}" disabled >
                    </div>   
                        <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Data Nascimento</label>
                        <input id="dte_nascimento_beneficiario" type="text" class="form-control input-relatorio" name="dte_nascimento_beneficiario" value="{{date('d/m/Y',strtotime($beneficiario->dte_nascimento_beneficiario))}}" disabled >
                    </div>                                        
                </div>    <!-- fechar row-->  
                @if($beneficiario->txt_nome_conjuge)
                    <div class="row">
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label label-relatorio">CPF Conjuge</label>
                            <input id="txt_cpf_beneficiario" type="text" class="form-control input-relatorio" name="txt_cpf_beneficiario" value="{{$beneficiario->txt_cpf_beneficiario}}" disabled >
                        </div>
                        <div class="column col-xs-12 col-md-5">
                            <label class="control-label label-relatorio">Nome Conjuge</label>
                            <input id="txt_nome_conjuge" type="text" class="form-control input-relatorio" name="txt_nome_conjuge" value="{{$beneficiario->txt_nome_conjuge}}" disabled >
                        </div>  
                        <div class="column col-xs-12 col-md-3">
                            <label class="control-label label-relatorio">Genero Conjuge</label>
                            <input id="txt_genero" type="text" class="form-control input-relatorio" name="txt_genero" value="{{$beneficiario->generoConjuge->txt_genero}}" disabled >
                        </div>                                      
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label label-relatorio">Data Nasc Conjuge</label>
                            <input id="dte_nascimento_conjuge" type="text" class="form-control input-relatorio" name="dte_nascimento_conjuge" value="{{date('d/m/Y',strtotime($beneficiario->dte_nascimento_conjuge))}}" disabled >
                        </div>
                        
                    </div> <!-- fechar row--> 
                @endif   
            </div><!-- fechar form-group-->  
            
            <div class="form-group">
                <div class="titulo">
                    <h3>Dados do Contrato </h3> 
                </div>
                <div class="row">
                    <div class="column col-xs-12 col-md-1">
                        <label class="control-label label-relatorio">UF</label>
                        <input id="sg_uf" type="text" class="form-control input-relatorio" name="sg_uf" value="{{$protocolo->sg_uf}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Município</label>
                        <input id="ds_municipio" type="text" class="form-control input-relatorio" name="ds_municipio" value="{{$protocolo->ds_municipio}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Protocolo</label>
                        <input id="txt_protocolo" type="text" class="form-control input-relatorio" name="txt_protocolo" value="{{$protocolo->txt_protocolo}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Oferta</label>
                        <input id="num_oferta" type="text" class="form-control input-relatorio" name="num_oferta" value="{{$protocolo->num_oferta}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">IF</label>
                        <input id="txt_nome_if" type="text" class="form-control input-relatorio" name="txt_nome_if" value="{{$protocolo->txt_nome_if}}" disabled >
                    </div>
                </div><!-- fechar row-->  
                <div class="row">
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">% Obra</label>
                        <input id="vlr_percentual_obra" type="text" class="form-control input-relatorio" name="vlr_percentual_obra" value="{{$contrato->vlr_percentual_obra}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Situação</label>
                        @if($contrato->bln_restricao) 
                            <input id="situacao" type="text" class="form-control input-relatorio" name="situacao" value="Restrição" disabled >
                        @else
                            @if($contrato->bln_recurso_devolvido)
                                <input id="situacao" type="text" class="form-control input-relatorio" name="situacao" value="Devolvido" disabled >
                            @else
                                @if($contrato->bln_entregue)
                                    <input id="situacao" type="text" class="form-control input-relatorio" name="situacao" value="Entregue" disabled>
                                @else
                                    @if($contrato->vlr_percentual_obra == 100)
                                        <input id="situacao" type="text" class="form-control input-relatorio" name="situacao" value="Concluída" disabled>
                                    @else
                                        <input id="situacao" type="text" class="form-control input-relatorio" name="situacao" value="Em Andamento" disabled>    
                                    @endif
                                @endif
                            @endif
                        @endif    
                    </div>                    
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Valor Subvenção da UH</label>
                        <input id="vlr_uh" type="text" class="form-control input-relatorio" name="vlr_uh" value="{{number_format( ($contrato->protocolo->vlr_uh), 2, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Valor Remuneracao</label>
                        @if($protocolo->num_oferta == 2009)
                            <input id="prc_pago" type="text" class="form-control input-relatorio" name="prc_pago" value="1.000,00" disabled >
                        @else
                            <input id="prc_pago" type="text" class="form-control input-relatorio" name="prc_pago" value="1.160,00" disabled >
                        @endif
                    </div>
                </div> <!-- fechar row-->  
            </div><!-- fechar form-group-->  

            <div class="form-group">
                <div class="titulo">
                    <h3>Pagamentos realizados</h3>
                </div>
                
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm tab_executivo">
                            <thead>
                                <tr>
                                    <th scope="col">Nota</th>
                                    <th scope="col">Data de Geração</th>
                                    <th scope="col">Valor Subvenção</th>
                                    <th scope="col">Valor Remuneração</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagamentos as $pagamento) @if(!$pagamento->notaPagamento->bln_cancelada)
                                <tr class="text-center">
                                    <td>{{$pagamento->notaPagamento->txt_num_nota_tecnica}}</td>
                                    <td>@if($pagamento->notaPagamento->dte_geracao_nota){{date('d/m/Y',strtotime($pagamento->notaPagamento->dte_geracao_nota))}}@endif</td>
                                    <td>{{number_format( ($pagamento->vlr_subvencao), 2, ',' , '.')}} ({{($pagamento->vlr_subvencao*100)/$contrato->protocolo->vlr_uh}}%)</td>
                                    @if($protocolo->num_oferta == 2009)
                                    <td>{{number_format( ($pagamento->vlr_remuneracao), 2, ',' , '.')}} @if($pagamento->vlr_remuneracao>0)({{($pagamento->vlr_remuneracao*100)/1000}}%)@endif</td>
                                    @else
                                    <td>{{number_format( ($pagamento->vlr_remuneracao), 2, ',' , '.')}} @if($pagamento->vlr_remuneracao>0)({{($pagamento->vlr_remuneracao*100)/1160}}%)@endif</td>
                                    @endif
                                </tr>
                                @endif @endforeach
                                <tr class="total text-center">
                                    <td colspan="2">Total</td>
                                    <td>{{number_format( ($resumoPagamentos->total_subvencao), 2, ',' , '.')}} ({{($resumoPagamentos->total_subvencao*100)/$contrato->protocolo->vlr_uh}}%)</td>
                                    @if($protocolo->num_oferta == 2009)
                                    <td>{{number_format( ($resumoPagamentos->total_remuneracao), 2, ',' , '.')}} ({{($resumoPagamentos->total_remuneracao*100)/1000}}%)</td>
                                    @else
                                    <td>{{number_format( ($resumoPagamentos->total_remuneracao), 2, ',' , '.')}} ({{($resumoPagamentos->total_remuneracao*100)/1160}}%)</td>
                                    @endif
        
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- fechar div table-->  
                
            </div><!-- fechar form-group-->  
            @if(count($substituicoes)>0)
                <div class="form-group">               
                    <div class="titulo">
                        <h3>Substituições </h3>
                    </div>
                    
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">NIS Substituído</th>
                                        <th scope="col">CPF Substituído</th>
                                        <th scope="col">Nome do Substituído</th>
                                        <th scope="col">Data Substituição</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($substituicoes as $substituicao)
                                    <tr class="text-center">
                                        <td>{{$substituicao->txt_nis_substituido}}</td>
                                        <td>{{$substituicao->txt_cpf_substituido}}</td>
                                        <td>{{$substituicao->txt_nome_beneficiario}}</td>
                                        <td>@if($substituicao->dte_processamento){{date('d/m/Y',strtotime($substituicao->dte_processamento))}}@endif</td>
            
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                   
                </div><!-- fechar form-group-->  
            @endif
            @if(count($restricoes)>0)
                <div class="form-group">
                    <div class="titulo">
                        <h3>Restrições </h3>
                    </div>
                   
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Data Inclusão</th>
                                        <th scope="col">Restrição</th>
                                        <th scope="col">Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($restricoes as $restricao)
                                    <tr class="text-center">
                                        <td>@if($restricao->dte_inclusao){{date('d/m/Y',strtotime($restricao->dte_inclusao))}}@endif</td>
                                        <td>{{$restricao->tipoRestricao->txt_tipo_restricao}}</td>
                                        <td>@if($restricao->bln_ativa)
                                            <span class="badge badge-danger">Ativa</span> @else
                                            <span class="badge badge-success">Inativa</span> @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                   
                </div><!-- fechar form-group--> 
            @endif
            @if(count($devolucoes)>0)
                <div class="form-group">
                    <div class="titulo">
                        <h3>Situação da Devolução </h3>
                    </div>
                   
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Remessa</th>
                                        <th scope="col">Data Inclusão</th>
                                        <th scope="col">Situação</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($devolucoes as $devolucao)
                                    <tr class="text-center">
                                        <td><a href="" data-toggle="modal" data-target="#modalRemessa" class="small-box-footer">{{$devolucao->remessa_devolucao_id}}</a></td>
                                        <td>@if($devolucao->dte_inclusao){{date('d/m/Y',strtotime($devolucao->dte_inclusao))}}@endif</td>
                                        <td>{{$devolucao->txt_situacao_devolucao}}</td>
                                        <td>@if($devolucao->bln_devolucao_ativa)
                                            <span class="badge badge-danger">Ativa</span> @else
                                            <span class="badge badge-success">Inativa</span> @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                   
                </div><!-- fechar form-group--> 
            @endif

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

</div>    
<!-- content -->

<!-- Modal -->
<div class="modal fade" id="modalRemessa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Dados da Remessa de Devolução</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @foreach($remessaDevolucao as $remessa)  
          <div class="form-group">
              <div class="row">
                  <div class="column col-xs-12 col-md-12">
                      <label class="control-label label-relatorio">Inserido Por</label>
                      <input id="txt_nome_user_inc" type="text" class="form-control input-relatorio" name="txt_nome_user_inc" value="{{$remessa->txt_nome_user_inc}}" disabled >
                  </div>
              </div>
              <div class="row">
                  <div class="column col-xs-12 col-md-2">
                      <label class="control-label label-relatorio">Remessa</label>
                      <input id="remessa_devolucao_id" type="text" class="form-control input-relatorio" name="remessa_devolucao_id" value="{{$remessa->remessa_devolucao_id}}" disabled >
                  </div>
                  <div class="column col-xs-12 col-md-3">
                      <label class="control-label label-relatorio">Data de Inclusão</label>
                      <input id="dte_inclusao" type="text" class="form-control input-relatorio" name="dte_inclusao" value="{{date('d/m/Y',strtotime($remessa->dte_inclusao))}}" disabled >
                  </div>
                  <div class="column col-xs-12 col-md-7">
                      <label class="control-label label-relatorio">Origem</label>
                      <input id="txt_origem_devolucao" type="text" class="form-control input-relatorio" name="txt_origem_devolucao" value="{{$remessa->txt_origem_devolucao}}" disabled >
                  </div>
              </div>    
          </div> 
          <div class="form-group">
              <label for="exampleFormControlTextarea1">Descrição</label>
              <textarea class="form-control input-relatorio" id="dsc_remessa_devolucao" rows="4" disabled>{{$remessa->dsc_remessa_devolucao}}</textarea>
          </div>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary bnt-block" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
@endsection


