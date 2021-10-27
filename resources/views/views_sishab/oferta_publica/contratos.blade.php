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
                :link3="'{{ url("/oferta_publica/protocolos/instituicao/$instituicao->id/") }}'"
                :titulo4='"Dados do Protocolo"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'{{$protocolo->txt_protocolo}}'"
                    subtitulo1="{{$instituicao->txt_nome_if}} "
                    subtitulo2="{{$protocolo->ds_municipio}} / {{$protocolo->sg_uf}}"
                    subtitulo3="Média Percentual da Obra: <?php echo getMediaPercProtocolo($protocolo->protocolo_id)?>% "
                    :barracompartilhar="true"    
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/oferta_publica/protocolos/$instituicao->id/$protocolo->protocolo_id") }}'">
                    @if($protocolo->media_percentual == 100)  
                        @if($protocolo->total_entregues == $protocolo->total_uh)                           
                            <div class="alert alert-success text-center" role="alert">
                                <h3>Encerrada</h3>
                            </div> <!-- div alert  -->   
                        @else
                            <div class="alert alert-warning text-center" role="alert">
                                <h3> Ativo P3</h3>
                            </div> <!-- div alert  -->   
                        @endif
                    @elseif(($protocolo->total_devolvidas) == $protocolo->total_uh)
                        <div class="alert alert-success text-center" role="alert">
                            <h3>Encerrada</h3>
                        </div> <!-- div alert  -->   
                    @elseif(($protocolo->total_entregues + $protocolo->total_devolvidas) == $protocolo->total_uh)
                        <div class="alert alert-success text-center" role="alert">
                            <h3>Encerrada</h3>
                        </div> <!-- div alert  -->   
                    @else  
                        @if($protocolo->total_devolvidas < $protocolo->total_inviavies_devolvidas)
                            <div class="alert alert-warning text-center" role="alert">
                                <h3> Ativo P2</h3>
                            </div> <!-- div alert  -->    
                        @elseif(($protocolo->total_obra_inviavel>0) && ($protocolo->total_inviavies_devolvidas<$protocolo->total_obra_inviavel))   
                            <div class="alert alert-danger text-center" role="alert">
                                <h3> Ativo P1</h3>
                            </div> <!-- div alert  -->    
                        @elseif(($protocolo->total_entregues + $protocolo->total_concluidas) == $protocolo->total_uh)
                            <div class="alert alert-danger text-center" role="alert">
                                <h3> Ativo P1</h3>
                            </div> <!-- div alert  -->   
                        @elseif(($protocolo->total_entregues + $protocolo->total_concluidas + $protocolo->total_devolvidas) == $protocolo->total_uh)
                            <div class="alert alert-danger text-center" role="alert">
                                <h3> Ativo P1</h3>
                            </div> <!-- div alert  -->   
                        @elseif(($protocolo->total_andamento + $protocolo->total_entregues) == $protocolo->total_uh)
                            <div class="alert alert-warning text-center" role="alert">
                                <h3> Ativo P2</h3>
                            </div> <!-- div alert  -->  
                        @elseif(($protocolo->total_andamento + $protocolo->total_entregues + $protocolo->total_devolvidas) == $protocolo->total_uh)
                            <div class="alert alert-warning text-center" role="alert">
                                <h3> Ativo P2</h3>
                            </div> <!-- div alert  -->                                         
                        @else
                            <div class="alert alert-warning text-center" role="alert">
                                <h3> Ativo P3</h3>
                            </div> <!-- div alert  -->                                        
                        @endif  
                    @endif  

            </cabecalho-form> 
        <div id="content-core"> 
            <div class="form-group">
                <div id="motivoNaoEnquadramento" class="titulo">
                    <h3>Dados do Protocolo</h3> 
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="colunm col-xs-12 col-md-2  text-center">
                            <label class="control-label label-relatorio  text-center">UH Contratadas</label>
                            <input id="num_uh_contratadas" type="text" class="form-control input-relatorio text-center" name="num_uh_contratadas" value=" {{$protocolo->num_uh_contratadas}}" disabled >                                                      
                        </div>
                        <div class="colunm col-xs-12 col-md-2  text-center">
                            <label class="control-label label-relatorio  text-center">UH Andamento</label>
                            <input id="qtd_andamento" type="text" class="form-control input-relatorio text-center" name="qtd_andamento" value=" {{$qtd_andamento}}" disabled >                                                      
                        </div>
                        <div class="colunm col-xs-12 col-md-2  text-center">
                            <label class="control-label label-relatorio  text-center">UH Concluídas</label>
                            <input id="qtd_concluida" type="text" class="form-control input-relatorio text-center" name="qtd_concluida" value=" {{$qtd_concluida}}" disabled >                                                      
                        </div>
                        <div class="colunm col-xs-12 col-md-2  text-center">
                            <label class="control-label label-relatorio  text-center">UH Entregues</label>
                            <input id="qtd_entregue" type="text" class="form-control input-relatorio text-center" name="qtd_entregue" value=" {{$qtd_entregue}}" disabled >                                                      
                        </div>
                        <div class="colunm col-xs-12 col-md-2  text-center">
                            <label class="control-label label-relatorio  text-center">UH Devolvidas</label>
                            <input id="qtd_devolvido" type="text" class="form-control input-relatorio text-center" name="qtd_devolvido" value=" {{$qtd_devolvido}}" disabled >                                                      
                        </div>
                        <div class="colunm col-xs-12 col-md-2  text-center">
                            <label class="control-label label-relatorio  text-center">Valor da UH</label>
                            <input id="vlr_uh" type="text" class="form-control input-relatorio text-center" name="vlr_uh" value="  {{number_format($protocolo->vlr_uh, 2, ',' , '.')}}" disabled >                                                      
                        </div>
                    
                    </div>
                </div><!-- fechar form-group--> 

                    <!-- /////////////////INICIO ABAS /////////////////////-->    
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            
                            <a class="nav-link active" id="resumoPagamento-tab" data-toggle="tab" href="#resumoPagamento" role="tab" aria-controls="resumoPagamento" aria-selected="true">Situação Contratos</a>
                        
                            <a class="nav-link" id="parcelasPagamento-tab" data-toggle="tab" href="#parcelasPagamento" role="tab" aria-controls="parcelasPagamento" aria-selected="false">Situação Parcelas</a>
                
                        </div>
                    </nav>
                    <!-- /////////////////FIM ABAS /////////////////////-->    
                   
                    
                    <!-- /////////////////INICIO CONTEUDO ABAS //////////////////-->  
            
                    <div class="tab-content" id="myTabContent">
                        <!-- NAV resumoPagamento   -->
                        <div class="tab-pane fade show active" id="resumoPagamento" role="tabpanel" aria-labelledby="resumoPagamento-tab">
                            <div id="motivoNaoEnquadramento" class="titulo">
                                <h3>Contratos</h3> 
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm">
                                    <thead  class="text-center">
                                        <tr>
                                        <th>#</th>                                                       
                                        <th>NIS</th> 
                                        <th>Nome</th> 
                                        <th>% Obra</th> 
                                        <th>% Pago</th> 
                                        <th>Pago Subvenção</th>
                                        <th>A Pagar Subvenção</th>
                                        <th>Data Última Nota</th>                                                
                                        <th>Situação</th>
                                        </tr>
                                    </thead>
                                    <tbody>      
                                    <?php $count = 1 ?>
                                @foreach($contratos as $contrato)                                                                   
                                        <tr>                                                                                              
                                            <td class="text-center"> <?php echo $count++?></td>                                   
                                            <td class="text-center"><a href='{{ url("oferta_publica/contrato/$contrato->contrato_id") }}'> {{$contrato->txt_nis_beneficiario}}</a></td>    
                                            <td>
                                                {{$contrato->txt_nome_beneficiario}} 
                                                @if($contrato->bln_substituido) 
                                                    <span class="badge badge-pill badge-secondary">Substituição</span>                                         
                                                @endif       
                                            </td>                    
                                            <td class="text-center"> {{number_format($contrato->vlr_percentual_obra, 0, ',' , '.')}}%</td>  
                                            <td class="text-center"> {{number_format(($contrato->resumoPagamento->total_subvencao*100)/$protocolo->vlr_uh, 0, ',' , '.')}}%</td>  
                                            <td class="text-center"> {{number_format($contrato->resumoPagamento->total_subvencao, 2, ',' , '.')}}</td>  
                                            <td class="text-center"> {{number_format($protocolo->vlr_uh - $contrato->resumoPagamento->total_subvencao, 2, ',' , '.')}}</td>  
                                            <td class="text-center"> {{date('d/m/Y',strtotime($contrato->resumoPagamento->data_ultima_nota))}}</td>  
                                            <td class="text-center">
                                                <h5>
                                                    @if($contrato->bln_restricao) 
                                                        <span class="badge badge-pill badge-danger">Restrição</span> 
                                                    @else
                                                        @if($contrato->bln_recurso_devolvido) 
                                                        <span class="badge badge-pill badge-warning">Devolvido</span>
                                                        @else
                                                            @if($contrato->bln_entregue) 
                                                                @if($contrato->bln_recurso_devolvido)                                    
                                                                    <span class="badge badge-pill badge-warning">Devolvido</span>                                
                                                                @else
                                                                    <span class="badge badge-pill badge-info">Entregue</span>                                
                                                                @endif   
                                                            @elseif((!$contrato->bln_entregue) && (!$contrato->bln_recurso_devolvido) && ($contrato->vlr_percentual_obra==100))
                                                                <span class="badge badge-pill badge-success">Concluído</span>                                
                                                            @else
                                                                @if($contrato->vlr_percentual_obra == 0)
                                                                    <span class="badge badge-pill badge-danger">Não Iniciada</span>                                
                                                                @else    
                                                                    <span class="badge badge-pill badge-light">Em andamento</span>                                
                                                                @endif    
                                                            @endif
                                                        @endif   
                                                    @endif   
                                                </h5>    
                                            </td>  
                                        </tr>    
                                        
                                @endforeach                                                       
                                <tr>
                                        <th colspan="5">TOTAL</th>
                                        <th class="text-center"> {{number_format($totalSubvencao, 2, ',' , '.')}}</th>  
                                        <th class="text-center"> {{number_format(($protocolo->num_uh_contratadas*$protocolo->vlr_uh)-$totalSubvencao, 2, ',' , '.')}}</th>  
                                        <th colspan="2"></th>
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                        <!-- NAV parcelasPagamento   -->
                        <div class="tab-pane fade" id="parcelasPagamento" role="tabpanel" aria-labelledby="parcelasPagamento-tab">
                        
                            <div id="motivoNaoEnquadramento" class="titulo">
                                <h3>Parcela Pagas</h3> 
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-sm tab_relatorios">
                                    <thead  class="text-center">
                                        <tr>
                                            <th rowspan="2" class="align-middle">#</th>                                                       
                                            <th rowspan="2" class="align-middle">NIS</th> 
                                            <th rowspan="2" class="align-middle">Nome</th> 
                                            <th rowspan="2" class="align-middle">% Obra</th> 
                                            <th colspan="7">Subvenção</th> 
                                            <th rowspan="2" class="align-middle">Total Subvenção</th> 
                                            <th rowspan="2" class="align-middle">Total Remuneração</th> 
                                            <tr >
                                                <th>Parc. 1</th>
                                                <th>Parc. 2</th>
                                                <th>Parc. 3</th>
                                                <th>Parc. 4</th>
                                                <th>Parc. 5</th>
                                                <th>Parc. 6</th>
                                                <th>Parc. 7</th>
                                            </tr>                                                            
                                        </tr>
                                    </thead>
                                    <tbody>      
                                    <?php $count = 1 ?>
                                @foreach($contratosParcelas as $contrato)                                                                   
                                        <tr>                                                                                              
                                            <td class="text-center"> <?php echo $count++?></td>                                   
                                            <td class="text-center"><a href='{{ url("oferta_publica/contrato/$contrato->contrato_id") }}'> {{$contrato->txt_nis_beneficiario}}</a></td>    
                                            <td>{{$contrato->txt_nome_beneficiario}} 
                                            
                                            </td>                                                          
                                            
                                            <td class="text-center"> {{number_format($contrato->vlr_percentual_obra, 0, ',' , '.')}}%</td>  
                                            <td class="text-center"> {{number_format($contrato->parcela_1, 2, ',' , '.')}}</td>  
                                            <td class="text-center"> {{number_format($contrato->parcela_2, 2, ',' , '.')}}</td>  
                                            <td class="text-center"> {{number_format($contrato->parcela_3, 2, ',' , '.')}}</td>  
                                            <td class="text-center"> {{number_format($contrato->parcela_4, 2, ',' , '.')}}</td>  
                                            <td class="text-center"> {{number_format($contrato->parcela_5, 2, ',' , '.')}}</td>  
                                            <td class="text-center"> {{number_format($contrato->parcela_6, 2, ',' , '.')}}</td>  
                                            <td class="text-center"> {{number_format($contrato->parcela_7, 2, ',' , '.')}}</td>  
                                            @if(($contrato->parcela_1+$contrato->parcela_2+$contrato->parcela_3+$contrato->parcela_4+$contrato->parcela_5+$contrato->parcela_6+$contrato->parcela_7)<$protocolo->vlr_uh)
                                                <td class="text-center text-success font-weight-bold"> {{number_format($contrato->parcela_1+$contrato->parcela_2+$contrato->parcela_3+$contrato->parcela_4+$contrato->parcela_5+$contrato->parcela_6+$contrato->parcela_7, 2, ',' , '.')}}</td>  
                                                <td class="text-center text-success font-weight-bold"> {{number_format($contrato->parcela_1_remun +$contrato->parcela_2_remun, 2, ',' , '.')}}</td>                                      
                                            @else
                                                <td class="text-center"> {{number_format($contrato->parcela_1+$contrato->parcela_2+$contrato->parcela_3+$contrato->parcela_4+$contrato->parcela_5+$contrato->parcela_6+$contrato->parcela_7, 2, ',' , '.')}}</td>  
                                                <td class="text-center"> {{number_format($contrato->parcela_1_remun +$contrato->parcela_2_remun, 2, ',' , '.')}}</td>                                      
                                            @endif
                                            
                                            
                                        </tr>    
                                @endforeach                                                       
                               
                                        <tr>
                                            <th colspan="4">TOTAL</th>
                                            <th>{{number_format( $totalParcelas['total_parcela_1'], 2, ',' , '.')}}</th>
                                            <th>{{number_format( $totalParcelas['total_parcela_2'], 2, ',' , '.')}}</th>
                                            <th>{{number_format( $totalParcelas['total_parcela_3'], 2, ',' , '.')}}</th>
                                            <th>{{number_format( $totalParcelas['total_parcela_4'], 2, ',' , '.')}}</th>
                                            <th>{{number_format( $totalParcelas['total_parcela_5'], 2, ',' , '.')}}</th>
                                            <th>{{number_format( $totalParcelas['total_parcela_6'], 2, ',' , '.')}}</th>
                                            <th>{{number_format( $totalParcelas['total_parcela_7'], 2, ',' , '.')}}</th>
                                            <th>{{number_format( $totalParcelas['total_subvencao'], 2, ',' , '.')}}</th>                                    
                                            <th>{{number_format( $totalParcelas['total_parcela_1_rem']+$totalParcelas['total_parcela_2_rem'], 2, ',' , '.')}}</th>                                    
                                        </tr>
                                    </tbody>
                                </table> 
                            </div>
                        </div>                
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


