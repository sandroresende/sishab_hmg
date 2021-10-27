@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/graficos.css') }}"  media="screen" > 

@endsection

@section('content')
    <div id="content">
        <div id="content-core">  
            <historico-navegacao
                    :url="'{{ url('/home') }}'"
                    :titulo1="'Empreendimentos'"
                    :titulo2='"Filtro de Empreendimentos"'
                    :link2="'{{ url('/empreendimentos/filtro') }}'"
                    :titulo3='"Dados do Empreendimetnos"'
                    >
            </historico-navegacao>  
            <cabecalho-form
                :titulo="'{{$titulo}}'"
                subtitulo1="{{trim($operacao->ds_municipio)}}-{{$operacao->txt_sigla_uf}}"
                subtitulo2="{{$operacao->txt_modalidade}} - {{$operacao->dsc_faixa}} - Pmcmv {{$operacao->num_pmcmv}}"
                subtitulo3="{{$operacao->qtd_uh_vigentes}} unidades vigentes"
                subtitulo4="Contratação: {{date('d/m/Y',strtotime($operacao->dte_assinatura))}} "
                :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                :linkcompartilhar="'{{ url("/empreendimentos/$operacao->txt_apf") }}'"
                :barracompartilhar="true">
                        
                    @if( ($operacao->status_empreendimento_id==1) || ($operacao->status_empreendimento_id==10)|| ($operacao->status_empreendimento_id==11))
                        <div class="alert alert-danger text-center" role="alert">
                            <h3> {{$operacao->txt_status_empreendimento}}</h3>
                        </div> <!-- div alert  -->
                    @elseif($operacao->status_empreendimento_id==2)
                        <div class="alert alert-default text-center" role="alert">
                            <h3> {{$operacao->txt_status_empreendimento}}</h3>
                        </div>   <!-- div alert  --> 
                    @elseif( ($operacao->status_empreendimento_id==3) || ($operacao->status_empreendimento_id==9))
                        <div class="alert alert-info text-center" role="alert">
                        <h3> {{$operacao->txt_status_empreendimento}}</h3>
                        </div>  <!-- div alert  -->  
                    @elseif( ($operacao->status_empreendimento_id==4) || ($operacao->status_empreendimento_id==7))
                        <div class="alert alert-success text-center" role="alert">
                        <h3> {{$operacao->txt_status_empreendimento}}</h3>
                        </div>    <!-- div alert  -->  
                    @elseif( ($operacao->status_empreendimento_id==5) || ($operacao->status_empreendimento_id==6))
                        <div class="alert alert-danger text-center" role="alert">
                        <h3> {{$operacao->txt_status_empreendimento}}</h3>
                        </div>   <!-- div alert  -->
                    @else
                            <div class="alert alert-secondary text-center" role="alert">
                                <h3> Em Execução</h3>
                            </div>  <!-- div alert  --> 
                    @endif  

                    <div class="form-group text-right">
                        <span class="text-right">{{$operacao->qtd_uh_entregues}}/{{$operacao->qtd_uh_contratadas}} unidades </span>            
                        <div class="progress-vue">                              
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info mh-100"role="progressbar" aria-valuenow="{{number_format($percEntrega, 0, ',' , '.')}}" aria-valuemin="0" aria-valuemax="100" style="width: {{number_format($percEntrega, 0, ',' , '.')}}%">{{number_format($percEntrega, 0, ',' , '.')}}
                                % Entregues
                            </div>
                        </div>   <!-- div progress-bar  -->
                    </div> <!-- div form group  -->   

            </cabecalho-form> 
            <div class="alert alert-info text-center" role="alert">
                <h3> APF: {{$operacao->txt_apf}}</h3>
            </div>  <!-- div alert  --> 
            
             <!-- /////////////////INICIO ABAS /////////////////////-->    
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <!-- inicio aba dados operacoes-->    
                      <a class="nav-item nav-link active" id="nav-dados-tab" data-toggle="tab" href="#nav-dados" role="tab" aria-controls="nav-dados" aria-selected="true">
                          Dados Operação
                      </a>
                @can('eGestao')
                  <!-- inicio aba LIBERAÇÕES-->    
                      @if(count($resumoLiberacoes)>0)
                          <a class="nav-item nav-link" id="nav-liberacoes-tab" data-toggle="tab" href="#nav-liberacoes" role="tab" aria-controls="nav-liberacoes" aria-selected="false">Liberações de Pagamento</a>
                      @endif
                  
                @endcan
                  <!-- inicio aba dados propostas selecionadas-->    
                  @if($proposta)
                      <a class="nav-item nav-link" id="nav-proposta-tab" data-toggle="tab" href="#nav-proposta" role="tab" aria-controls="nav-proposta" aria-selected="false">
                          Proposta Selecionada
                      </a>
                  @endif
                  <!-- fim aba dados propostas selecionadas-->
          
                  <!-- inicio aba dados propostas nao selecionadas-->    
                  @if(count($propostasApresentadas)>0)
                      <a class="nav-item nav-link" id="nav-propostasApresentadas-tab" data-toggle="tab" href="#nav-propostasApresentadas" role="tab" aria-controls="nav-propostasApresentadas" aria-selected="false">
                          Propostas Não Selecionadas
                      </a>
                  @endif
                  <!-- fim aba dados propostas nao selecionadas-->    
          
          
                </div>
            </nav>
             <!-- /////////////////FIM ABAS /////////////////////-->    

             <!-- /////////////////INICIO CONTEUDO ABAS //////////////////-->  
            <!-- inicio tab-content--> 
            <div class="tab-content" id="nav-tabContent">
                <!-- ///////////////////////////////////////////////// inicio nav-dados /////////////////////////////////////////////////-->    
                <div class="tab-pane fade show active" id="nav-dados" role="tabpanel" aria-labelledby="nav-dados-tab">
                    @if($operacao->modalidade_id == 2)
                        @include('views_sishab.empreendimentos.form_dados_fds')
                    @elseif(($operacao->modalidade_id == 3) || ($operacao->modalidade_id == 7))
                        @include('views_sishab.empreendimentos.form_dados_far')    
                    @elseif($operacao->modalidade_id == 6)
                        @include('views_sishab.empreendimentos.form_dados_pnhr')    
                    @elseif($operacao->modalidade_id == 5)
                        @include('views_sishab.empreendimentos.form_dados_oferta')    
                    @endif

                    @if(count($resumoLiberacoes)>0)
                        <div class="card">
                            <div class="card-body">
                                <div class="titulo">
                                    <h3>Resumo Financeiro de liberações</h3> 
                                </div> <!-- fim titulo--> 
                                <div class="table-responsive">	
                                    <table class="table table-bordered table-sm tab_executivo">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tipo de Liberação</th>                                                                                                       
                                                <th>Qtd de Liberações</th>         
                                                <th class="text-center">Valor Liberado</th>
                                            </tr>
                                                                
                                        </thead>
                                        <tbody>
                                            @foreach($resumoLiberacoes as $resumo)
                                            <tr>                        
                                                <td class="text-center"> {{$resumo->txt_tipo_liberacao}}</td>
                                                <td class="text-center">{{number_format( ($resumo->qtd_liberacoes), 0, ',' , '.')}}</td>                                            
                                                <td class="text-center">{{number_format( ($resumo->vlr_liberacoes), 2, ',' , '.')}}</td>                                            
                                            </tr>   
                                            @endforeach                                           
                                            <tr  class="total">                         
                                                <td class="text-center">TOTAL</td>
                                                <td class="text-center">{{number_format( ($totalLiberacoes['qtd_liberacoes']), 0, ',' , '.')}}</td>                                            
                                                <td class="text-center">{{number_format( ($totalLiberacoes['total_liberado']), 2, ',' , '.')}}</td>                                            
                                            </tr>           
                                        </tbody>
                                    </table>     
                                </div><!-- fim table-responsive--> 
                            </div> <!-- fim card-body--> 
                        </div> <!-- fim card--> 
                    @endif 
                    
                    @if(count($medicaoObras)>0)
                        <div class="card">
                            <div class="card-body">
                                <div class="titulo">
                                    <h3>Resumo Medições de Obras no Ano Corrente</h3>
                                </div><!--fim titulo --> 
                                <div class="table-responsive">		
                                    <table class="table table-bordered table-sm tab_executivo">
                                        <thead>
                                            <tr style="max-widh:1142;">
                                                <th>Situação</th>                                
                                                <th class="text-center">Qtde Solicitado</th>
                                                <th class="text-center">Valor Solicitado</th>
                                                <th class="text-center">Qtde Liberado</th>
                                                <th class="text-center">Valor Liberado</th>                                
                                                <th class="text-center">Valor a Liberar</th> 
                                            </tr>
                                                                
                                        </thead>
                                        <tbody>
                                            @foreach($medicaoObras as $dados)
                                                <tr>                        
                                                    <td >{{$dados->txt_situacao_solicitacao_medicao}}</td>
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->qtd_solicitacoes), 0, ',' , '.')}}</td>
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_solicitado), 2, ',' , '.')}}</td>   
                                                    <td class="tabelaFaixa">{{number_format( ($dados->qtd_liberacoes), 0, ',' , '.')}}</td>
                                                    <td class="tabelaFaixa">{{number_format( ($dados->vlr_liberado), 2, ',' , '.')}}</td>                 
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_solicitado - $dados->vlr_liberado), 2, ',' , '.')}}</td>                                                    
                                                </tr>                                
                                            @endforeach                                           
                                            <tr  class="total">                        
                                                <td  class="tabelaNumero">TOTAL</td>
                                                <td class="tabelaFaixa">{{number_format( ($totalMedicaoObras['qtd_solicitacoes']), 0, ',' , '.')}}</td>
                                                <td class="tabelaFaixa">{{number_format( ($totalMedicaoObras['total_solicitado']), 2, ',' , '.')}}</td>   
                                                <td class="tabelaFaixa">{{number_format( ($totalMedicaoObras['qtd_liberacoes']), 0, ',' , '.')}}</td>
                                                <td class="tabelaFaixa">{{number_format( ($totalMedicaoObras['total_liberado']), 2, ',' , '.')}}</td>     
                                                <td class="tabelaFaixa">{{number_format( ($totalMedicaoObras['total_solicitado']-$totalMedicaoObras['total_liberado']), 2, ',' , '.')}}</td>                                                        
                                            </tr>                         
                                        </tbody>
                                    </table>    
                                </div><!--fim table-responsive -->  
                            </div><!--fim card-body -->  
                        </div><!--fim card -->  
                     @endif 

                     @if(count($retomadaObras)>0)
                        <div class="card">
                            <div class="card-body">
                                <div class="titulo">
                                    <h3>Retomada Obras</h3>
                                </div><!--fim titulo --> 
                                <div class="table-responsive">		
                                    <table class="table table-bordered table-sm tab_executivo">
                                        <thead>
                                            <tr style="max-widh:1142;">
                                                <th>APF Suplementação</th>                       
                                                <th class="text-center">Tipo</th>
                                                <th class="text-center">Origem da Informação</th>
                                                <th class="text-center">Data Assinatura</th>
                                                <th class="text-center">Valor retomada</th>                                
                                            </tr>
                                                                
                                        </thead>
                                        <tbody>
                                            @foreach($retomadaObras as $dados)
                                                <tr>                        
                                                    <td >{{$dados->txt_cod_operacao_suplementacao}}</td>
                                                    <td >{{$dados->dsc_tipo_retomada}}</td>
                                                    <td >{{$dados->dsc_origem_arquivo_retomada}}</td>
                                                    <td class="tabelaFaixa text-center">{{date('d/m/Y',strtotime($dados->dte_ass_retomada))}}</td>
                                                    <td class="tabelaFaixa text-center">{{number_format( ($dados->vlr_retomada), 2, ',' , '.')}}</td>  
                                                </tr>                                
                                            @endforeach                                           
                                        </tbody>
                                    </table>    
                                </div><!--fim table-responsive -->  
                                @if(count($resumoLiberacoesRetomadas)>0)
                                    <div class="titulo">
                                        <h3>Resumo Financeiro de liberações da Retomada</h3> 
                                    </div> <!-- fim titulo--> 
                                    <div class="table-responsive">	
                                        <table class="table table-bordered table-sm tab_executivo">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">APF Suplementação</th>                                                                                                       
                                                    <th class="text-center">Tipo de Liberação</th>                                                                                                       
                                                    <th>Qtd de Liberações</th>         
                                                    <th class="text-center">Valor Liberado</th>
                                                </tr>
                                                                    
                                            </thead>
                                            <tbody>
                                                @foreach($resumoLiberacoesRetomadas as $resumo)
                                                <tr>                        
                                                    <td class="text-center"> {{$resumo->txt_cod_operacao}}</td>
                                                    <td class="text-center"> {{$resumo->txt_tipo_liberacao}}</td>
                                                    <td class="text-center">{{number_format( ($resumo->qtd_liberacoes), 0, ',' , '.')}}</td>                                            
                                                    <td class="text-center">{{number_format( ($resumo->vlr_liberacoes), 2, ',' , '.')}}</td>                                            
                                                </tr>   
                                                @endforeach                                           
                                                <tr  class="total">                         
                                                    <td class="text-center" colspan="2">TOTAL</td>
                                                    <td class="text-center">{{number_format( ($totalLiberacoes['qtd_liberacoes']), 0, ',' , '.')}}</td>                                            
                                                    <td class="text-center">{{number_format( ($totalLiberacoes['total_liberado']), 2, ',' , '.')}}</td>                                            
                                                </tr>           
                                            </tbody>
                                        </table>     
                                    </div><!-- fim table-responsive--> 
                                @endif    
                            </div><!--fim card-body -->  
                        </div><!--fim card -->  
                     @endif 
                     @if(count($entregas)>0)
                <!--////////////// GRAFICO ENTREGAS///////////-->
                     <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-body">
                                    
                                      <div class="titulo">
                                        <h3>Entregas - Por Ano</h3> 
                                    </div><!-- fim titulo-->   
                                    <canvas id="lineChartAno" class="card-body text-center" width="600" height="400"></canvas>
                                      <div id="lineLegendAno"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div><!--fim nav-dados -->    
                <!-- ///////////////////////////////////////////////// fim nav-dados /////////////////////////////////////////////////-->  
                
                <!-- ///////////////////////////////////////////////// inicio nav-liberacoes /////////////////////////////////////////////////--> 
                @if(count($resumoLiberacoes)>0)
                    <div class="tab-pane fade show" id="nav-liberacoes" role="tabpanel" aria-labelledby="nav-liberacoes-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="titulo">
                                    <h3>Financeiro (R$)</h3> 
                                </div><!-- fim titulo-->          
                                <div class="row">                                                    
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> Contratado</label>
                                        <input id="vlr_operacao" type="text" class="form-control input-relatorio" name="vlr_operacao" value="{{number_format($operacao->vlr_operacao, 2, ',' , '.')}}" disabled >
                                    </div> 
                                                                                       
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> Liberado Obra</label>
                                        <input id="vlr_liberado" type="text" class="form-control input-relatorio" name="vlr_liberado" value="{{number_format($operacao->vlr_liberado + $dadosEmpreendimento->vlr_liberado_ts_adicional, 2, ',' , '.')}}" disabled >
                                    </div>                             
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio"> Liberado Projeto</label>
                                        <input id="vlr_projeto" type="text" class="form-control  input-relatorio" name="vlr_projeto" value="{{number_format($dadosEmpreendimento->vlr_projeto, 2, ',' , '.')}}" disabled >
                                    </div>  
                                    <div class="column col-xs-12 col-md-3">
                                        <label class="control-label label-relatorio">Saldo a Liberar</label>
                                        <input id="vlr_liberado" type="text" class="form-control input-relatorio" name="vlr_liberado" value="{{number_format($operacao->vlr_operacao-$operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                                    </div>  
                                </div><!-- fim row-->
                                <div class="titulo">
                                    <h3>Resumo</h3>                    
                                </div><!-- fim titulo-->
                                <div class="table-responsive">	
                                    <table class="table table-bordered table-sm tab_executivo">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Tipo de Liberação</th>                                                                                                       
                                                <th>Qtd de Liberações</th>         
                                                <th class="text-center">Valor Liberado</th>
                                            </tr>
                                                                
                                        </thead>
                                        <tbody>
                                            @foreach($resumoLiberacoes as $resumo)
                                            <tr>                        
                                                <td class="text-center"> {{$resumo->txt_tipo_liberacao}}</td>
                                                <td class="text-center">{{number_format( ($resumo->qtd_liberacoes), 0, ',' , '.')}}</td>                                            
                                                <td class="text-center">{{number_format( ($resumo->vlr_liberacoes), 2, ',' , '.')}}</td>                                            
                                            </tr>   
                                            @endforeach                                           
                                            <tr  class="total">                         
                                                <td class="text-center">TOTAL</td>
                                                <td class="text-center">{{number_format( ($totalLiberacoes['qtd_liberacoes']), 0, ',' , '.')}}</td>                                            
                                                <td class="text-center">{{number_format( ($totalLiberacoes['total_liberado']), 2, ',' , '.')}}</td>                                            
                                            </tr>           
                                        </tbody>
                                    </table>     
                                </div><!-- fim table-responsive-->
                                <div class="titulo">
                                    <h3>Liberações</h3>                    
                                </div> <!-- fim titulo-->                            
                                <div class="table-responsive">	
                                    <table class="table table-bordered table-sm tab_executivo">
                                        <thead>
                                            <tr>
                                                <th>Data de Liberação</th>         
                                                <th>APF</th>    
                                                <th class="text-center">Tipo de Liberação</th>                                                                                                       
                                                <th class="text-center">Valor Liberado</th>
                                            </tr>
                                                                
                                        </thead>
                                        <tbody>
                                            @foreach($resumoLiberacoes as $resumo)
                                            <tr class="totalFaixa">                        
                                                <td class="text-center"  colspan="2">SubTotal {{$resumo->txt_tipo_liberacao}}</td>
                                                <td class="text-center">{{number_format( ($resumo->qtd_liberacoes), 0, ',' , '.')}}</td>                                            
                                                <td class="text-center">{{number_format( ($resumo->vlr_liberacoes), 2, ',' , '.')}}</td>                                            
                                            </tr>   
                                                @foreach($resumo->tipo_liberacoes as $tipo)
                                                <tr>                        
                                                    <td class="text-center">{{date('d/m/Y',strtotime($tipo->dte_liberacao))}}</td>
                                                    <td class="text-center">{{$tipo->txt_cod_operacao}}</td>
                                                    <td class="text-center">{{$tipo->txt_tipo_liberacao}}</td>
                                                    <td class="text-center">{{number_format( ($tipo->vlr_liberacao), 2, ',' , '.')}}</td>                                            
                                                </tr>   
                                                @endforeach  
                                            @endforeach                                           
                                            <tr  class="total">                         
                                                <td class="text-center" colspan="2">TOTAL</td>
                                                <td class="text-center">{{number_format( ($totalLiberacoes['qtd_liberacoes']), 0, ',' , '.')}}</td>                                            
                                                <td class="text-center">{{number_format( ($totalLiberacoes['total_liberado']), 2, ',' , '.')}}</td>                                            
                                            </tr>                 
                                        </tbody>
                                    </table>     
                                </div><!-- fim table-responsive-->
                            </div>  <!-- fim card-body--> 
                        </div><!-- fim card-->
                           
                    </div><!-- fim nav-liberacoes-->
                @endif

                <!-- ///////////////////////////////////////////////// fim nav-liberacoes /////////////////////////////////////////////////--> 

                <!-- ///////////////////////////////////////////////// inicio nav-propostas slecionadas /////////////////////////////////////////////////--> 
                @if($proposta)
                    <div class="tab-pane fade" id="nav-proposta" role="tabpanel" aria-labelledby="nav-proposta-tab">                    
                        @if(($proposta->modalidade_id == 2) ||($proposta->modalidade_id == 6))
                            @include('views_sishab.propostas_mcmv.form_proposta_selecionada_fds_pnhr')
                        @elseif(($proposta->modalidade_id == 3) || ($proposta->modalidade_id == 7))    
                            @include('views_sishab.propostas_mcmv.form_proposta_selecionada_far')
                        @endif                    
                    </div><!-- nav-proposta selecionadas-->  
                 @endif
                <!-- ///////////////////////////////////////////////// fim nav-propostas slecionadas /////////////////////////////////////////////////--> 

                <!-- ///////////////////////////////////////////////// inicio nav-propostas apresentadas /////////////////////////////////////////////////--> 

                @if(count($propostasApresentadas)>0)
                    <div class="tab-pane fade" id="nav-propostasApresentadas" role="tabpanel" aria-labelledby="nav-propostaApresentadas-tab">
                        <colunas-duas-situacao 
                            v-bind:itens="{{$propostasApresentadas}}" 
                            :url="'{{ url('/') }}'">             
                        </colunas-duas-situacao>
                    </div><!-- nav-proposta apresentadas-->   
                    @endif
                <!-- ///////////////////////////////////////////////// fim nav-propostas apresentadas /////////////////////////////////////////////////--> 

            </div><!-- fim conteudo abas--> 
             <!-- /////////////////FIM CONTEUDO ABAS //////////////////-->  

           
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">  
                    </div>
                    <div class="column col-xs-12 col-md-6">    
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
                    </div>

            </div>  <!--form-group -->

        </div><!-- content-core -->
    </div><!-- content -->
@endsection


@section('scriptsjs')
    <script src="{{URL::asset('js/graficos/Chart.js')}}"></script>
    <script src="{{URL::asset('js/graficos/legend.js')}}"></script>
    <script src="{{URL::asset('js/graficos/graficos.js')}}"></script>
   


        <script type="text/javascript">
          
            window.onload = function() {
               
                var url = "{{ url('/') }}";
             
                lineChartAno({{$operacao->operacao_id}}, url );
            };
  </script>

@endsection