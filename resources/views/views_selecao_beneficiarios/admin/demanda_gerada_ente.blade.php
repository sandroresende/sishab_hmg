@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        <historico-navegacao
                :url="'{{ url('/home') }}'"
                :titulo1="'Seleção de Demanda'"
                :titulo2='"Filtro Arquivos Gerados "'
                :link2="'{{ url('/admin/selecao_demanda/arquivos/gerados/filtro') }}'"
                :titulo3='"Arquivos Gerados"'
                :link3="'{{ url("admin/selecao_demanda/arquivos/gerados") }}'"
                :titulo4='"Demanda Gerada"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Demanda Gerada'"
                    subtitulo1="{{$ente->txt_ente_publico}}"
                    subtitulo2="   {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}}"                             
                    :dataatualizacao="'{{date('d/m/Y',strtotime($arquivosMunicipioPrincipal->updated_at))}}'"
                    :linkcompartilhar="'{{ url("admin/selecao_demanda/arquivo/$demandaGerada->id/$arquivosMunicipioPrincipal->id") }}'"
                    :barracompartilhar="true">
                    
                    

            </cabecalho-form> 
        <div id="content-core"> 
            <div class="form-group">
                @if(count($demandaConsolidada) >0)
                <div class="titulo">
                      <h3>Demanda Consolidada</h3> 
                  </div>   
                  
                      <table class="table table-hover">
                          <thead>
                              <tr class="text-center" >                    
                                  <th>APF</th>
                                  <th>Empreendimento</th>
                                  <th>Status Empreendimento</th>
                                  <th>Situação Obra</th>
                                  <th>UH</th>
                                  <th>UH Entregues</th>                   
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($demandaConsolidada as $dados)
                              
                              <tr class="text-center" >
                                  <td>{{$dados->operacao_id}}</td>
                                  <td>{{$dados->operacoesContratadas->txt_nome_empreendimento}}</td>
                                  <td>{{$dados->operacoesContratadas->txt_status_empreendimento}}</td>
                                  <td>{{$dados->operacoesContratadas->txt_situacao_obra}}</td>
                                  <td>{{number_format($dados->operacoesContratadas->qtd_uh_contratadas, 0, ',' , '.')}}</td>
                                  <td>{{number_format($dados->operacoesContratadas->qtd_uh_entregues, 0, ',' , '.')}}</td>
                                  </tr>                                         
                          @endforeach
                          <tr class="total">
                                  <td class="text-center">TOTAL</td>
                                  <td  class="text-center">{{number_format($totalDemanda['num_empreendimento'], 0, ',' , '.')}}</td>
                                  <td></td>
                                  <td></td>
                                  <td class="text-center">{{number_format($totalDemanda['num_contratadas'], 0, ',' , '.')}}</td>
                                  <td class="text-center">{{number_format($totalDemanda['num_entregues'], 0, ',' , '.')}}</td>
                                  </tr>  
                          </tbody>
                      </table><!-- fechar table-->
                  @endif
                  
               @if($arquivosMunicipioPrincipal)
                  <div class="titulo">
                      <h3>Arquivo Principal</h3> 
                      
                  </div>     
                      <table class="table table-hover">
                          <thead>
                              <tr class="text-center" >
                                 
                                  <th>Id</th>
                                  <th>Tipo Arquivo</th>
                                  <th>N°</th>
                                  <th>Nº Indicações</th>
                                  <th>Nº Aptos</th>
                                  <th>Nº Complementos</th>
                                  <th>Ente Responsável</th>
                                  <th>Data Download</th>
                                  <th>Download realizado por</th>
                              </tr>
                          </thead>
                          <tbody>
                         
                              
                              <tr class="text-center" >
                                 
                                  <td>{{$arquivosMunicipioPrincipal->id}}</td>
                                  <td>{{$arquivosMunicipioPrincipal->tipoArquivo->txt_tipo_arquivo}}</td>
                                  <td>{{$arquivosMunicipioPrincipal->num_arquivo_enviado}}</td>
                                  <td>{{$arquivosMunicipioPrincipal->num_beneficiarios_total}}</td>
                                  <td>{{$arquivosMunicipioPrincipal->num_apto_requisito_criterio}}</td>
                                  <td>{{$arquivosMunicipioPrincipal->num_registro_complemento}}</td>
                                  <td>@if($arquivosMunicipioPrincipal->ente_publico) {{$arquivosMunicipioPrincipal->entePublico->txt_ente_publico}} @endif</td>
                                  <td>@if($arquivosMunicipioPrincipal->dte_download_ente) {{date('d/m/Y',strtotime($arquivosMunicipioPrincipal->dte_download_ente))}}@endif</td>
                                  
                                  <td>@if($arquivosMunicipioPrincipal->user_id) {{$arquivosMunicipioPrincipal->user->name}} @endif  </td>     
                                  </tr>                                         
                      
                          </tbody>
                      </table><!-- fechar table-->
                @endif
              
                        
               @if(count($arquivosMunicipioComplemento) >0)
                  <div class="titulo">
                      <h3>Arquivos Complemento</h3> 
                      
                  </div>     
                      <table class="table table-hover">
                          <thead>
                              <tr class="text-center" >
                                
                                  <th>Id</th>
                                  <th>Tipo Arquivo</th>
                                  <th>N°</th>
                                  <th>Nº Indicações</th>
                                  <th>Nº Aptos</th>
                                  <th>Nº Complementos</th>
                                  <th>Ente Responsável</th>
                                  <th>Data Download</th>
                                  <th>Download realizado por</th>
                              </tr>
                          </thead>
                          <tbody>
                          @foreach($arquivosMunicipioComplemento as $dados)
                              
                              <tr class="text-center" >
                                  
                                  <td>{{$dados->id}}</td>
                                  <td>{{$dados->tipoArquivo->txt_tipo_arquivo}}</td>
                                  <td>{{$dados->num_arquivo_enviado}}</td>
                                  <td>{{$dados->num_beneficiarios_total}}</td>
                                  <td>{{$dados->num_apto_requisito_criterio}}</td>
                                  <td>{{$dados->num_registro_complemento}}</td>
                                  <td>@if($dados->ente_publico) {{$dados->entePublico->txt_ente_publico}} @endif</td>
                                  <td> @if($dados->dte_download_ente) {{date('d/m/Y',strtotime($dados->dte_download_ente))}}@endif</td>
                                  <td>@if($dados->user_id) {{$dados->user->name}} @endif  </td>     
                                  </tr>                                         
                          @endforeach
                          </tbody>
                      </table><!-- fechar table-->
                  @endif    
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


