@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            :url="'{{ url('/selecao_beneficiarios') }}'"
            :titulo1="'Seleção de Beneficiários'"
            :titulo2='"Arquivos"'
            :link2="'{{ url("/selecao_beneficiarios/arquivo/") }}'"
            :titulo3='"Demanda Gerada"'

            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Demanda Gerada'"
                    :dataatualizacao="''"
                    :linkcompartilhar="'{{ url("/selecao_beneficiarios/arquivo/$demandaGeradaId/$arquivoId") }}'"
                    :barracompartilhar="true">
                    <div class="linha-separa"></div>
                        <p>Senhor gestor municipal,

                        informamos que deve ser considerada a lista principal disponibilizada, na qual consta as seguintes informações de cada família: RF idoso; família da qual faz parte pessoa com deficiência; e especificação dos critérios atendidos, conforme Portaria nº 2.081, de 30 de julho de 2020, para que o Ente Público proceda a averiguação das famílias consideradas compatíveis.
                        Caso as famílias previstas na lista principal sejam insuficientes para suprir as reservas referentes ao atendimento de idoso e de pessoa com deficiência, deve-se utilizar as respectivas listas complementares disponibilizadas, em quantidade suficiente para o atendimento da reserva, considerando-se o dobro para compor a lista de suplentes. 
                        </p>
            </cabecalho-form> 
            
            <div class="form-group">
                @if(count($demandaConsolidada) >0)
                <div class="titulo">
                      <h5>Demanda Consolidada</h5> 
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
                  
                  @if(count($arquivosMunicipioPrincipal) >0)
                  <div class="titulo">
                      <h5>Arquivo Principal</h5> 
                      
                  </div>     
                      <table class="table table-hover">
                          <thead>
                              <tr class="text-center" >
                                  <th><i class="fas fa-download"></i></th>
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
                          @foreach($arquivosMunicipioPrincipal as $dados)
                              
                              <tr class="text-center" >
                                  <td>
                                  <form method="post" action='{{ url("/selecao_beneficiarios/download/arquivo/$dados->id")}}'>
                                          @csrf
                                          <button type="submit" class="btn btn-primary">
                                              <i class="fas fa-file"></i></button>
                                      </form>   
                                  </td>
                                  <td>{{$dados->id}}</td>
                                  <td>{{$dados->tipoArquivo->txt_tipo_arquivo}}</td>
                                  <td>{{$dados->num_arquivo_enviado}}</td>
                                  <td>{{$dados->num_beneficiarios_total}}</td>
                                  <td>{{$dados->num_apto_requisito_criterio}}</td>
                                  <td>{{$dados->num_registro_complemento}}</td>
                                  <td>@if($dados->entePublico) {{$dados->entePublico->txt_ente_publico}} @endif</td>
                                  <td>@if($dados->dte_download_ente) {{date('d/m/Y',strtotime($dados->dte_download_ente))}}@endif</td>
                                  
                                  <td>@if($dados->user_id)<a href='{{ url("/usuario/$dados->user_id")}}' type="button" target="_blank"  class="btn btn-sm">{{$dados->user->name}}</a>@endif  </td>     
                                  </tr>                                         
                          @endforeach
                          </tbody>
                      </table><!-- fechar table-->
                  @endif  
              
                        
               @if(count($arquivosMunicipioComplemento) >0)
              
                  <div class="titulo">
                      <h5>Arquivos Complemento</h5> 
                  
                  </div>     
                      <table class="table table-hover">
                          <thead>
                              <tr class="text-center" >
                                  <th><i class="fas fa-download"></i></th>
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
                                  <td>
                                  <form method="post" action='{{ url("/selecao_beneficiarios/download/arquivo/$dados->id")}}'>
                                          @csrf
                                          <button type="submit" class="btn btn-primary">
                                              <i class="fas fa-file-pdf"></i></button>
                                      </form>   
                                  </td>
                                  <td>{{$dados->id}}</td>
                                  <td>{{$dados->tipoArquivo->txt_tipo_arquivo}}</td>
                                  <td>{{$dados->num_arquivo_enviado}}</td>
                                  <td>{{$dados->num_beneficiarios_total}}</td>
                                  <td>{{$dados->num_apto_requisito_criterio}}</td>
                                  <td>{{$dados->num_registro_complemento}}</td>
                                  <td>@if($dados->ente_publico) {{$dados->entePublico->txt_ente_publico}} @endif</td>
                                  <td> @if($dados->dte_download_ente) {{date('d/m/Y',strtotime($dados->dte_download_ente))}}@endif</td>
                                  <td>@if($dados->user_id)<a href='{{ url("/usuario/$dados->user_id")}}' type="button" target="_blank"  class="btn btn-sm">{{$dados->user->name}}</a>@endif  </td>     
                                  </tr>                                         
                          @endforeach
                          </tbody>
                      </table><!-- fechar table-->
                  @endif  

            </div> <!-- form-group -->

            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">                       
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                    </div>    
                </div>
            </div> <!-- form-group -->
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


