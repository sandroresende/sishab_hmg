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
        <span> Oferta Pública</span>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href="{{url('/protocolos/filtro')}}">Consulta ao Protocolo</a>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href="#" onclick="javascript:window.history.go(-1)">Protocolos</a>
        <span class="breadcrumbSeparator">
            &gt;
        
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">{{$protocolo->txt_protocolo}}</span>
    </span>
</div> 
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        {{$protocolo->txt_protocolo}}
        </h2>
        <span class="documentFirstHeadingSpan">{{$protocolo->txt_nome_if}} </span>   
        <span class="documentFirstHeadingSpan">{{$protocolo->ds_municipio}} / {{$protocolo->sg_uf}} </span>   
        <span class="documentFirstHeadingSpan">Média Percentual da Obra: <?php echo getMediaPercProtocolo($protocolo->protocolo_id)?>% </span>   
        


    <div id="content-core">
        <div id="motivoNaoEnquadramento" class="titulo">
            <h5>Dados do Protocolo</h5> 
        </div>
        <div class="form-group">
                <div class="row">
                    <div class="colunm col-xs-12 col-md-2">
                        <div class="media text-muted pt-3">                            
                            <p class="media-body pb-3 mb-0 small lh-125 text-center">
                                <strong class="d-block text-dark">UH Contratadas</strong>
                                {{$protocolo->num_uh_contratadas}}
                            </p>
                        </div>                        
                    </div>
                    <div class="colunm col-xs-12 col-md-2">
                        <div class="media text-muted pt-3">                            
                            <p class="media-body pb-3 mb-0 small lh-125 text-center">
                                <strong class="d-block text-dark">UH Andamento</strong>
                                {{$qtd_andamento}}
                            </p>
                        </div>                        
                    </div>
                    <div class="colunm col-xs-12 col-md-2">
                        <div class="media text-muted pt-3">                            
                            <p class="media-body pb-3 mb-0 small lh-125 text-center">
                                <strong class="d-block text-dark">UH Concluídas</strong>
                                {{$qtd_concluida}}
                            </p>
                        </div>                        
                    </div>
                    <div class="colunm col-xs-12 col-md-2">
                        <div class="media text-muted pt-3">                            
                            <p class="media-body pb-3 mb-0 small lh-125 text-center">
                                <strong class="d-block text-dark">UH Entregues</strong>
                                {{$qtd_entregue}}
                            </p>
                        </div>                        
                    </div>
                    <div class="colunm col-xs-12 col-md-2">
                        <div class="media text-muted pt-3">                            
                            <p class="media-body pb-3 mb-0 small lh-125 text-center">
                                <strong class="d-block text-dark">UH Devolvidas</strong>
                                {{$qtd_devolvido}}
                            </p>
                        </div>                        
                    </div>
                    <div class="colunm col-xs-12 col-md-2">
                        <div class="media text-muted pt-3">                            
                            <p class="media-body pb-3 mb-0 small lh-125 text-center">
                                <strong class="d-block text-dark">Valor da UH</strong>
                                {{number_format($protocolo->vlr_uh, 2, ',' , '.')}}
                            </p>
                        </div>                        
                    </div>                          
                </div>
            </div><!-- fechar form-group--> 
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="resumoPagamento-tab" data-toggle="tab" href="#resumoPagamento" role="tab" aria-controls="resumoPagamento" aria-selected="true">Situação Contratos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="parcelasPagamento-tab" data-toggle="tab" href="#parcelasPagamento" role="tab" aria-controls="parcelasPagamento" aria-selected="false">Situação Parcelas</a>
                </li>                
            </ul>
            
            <div class="tab-content" id="myTabContent">
                <!-- NAV resumoPagamento   -->
                <div class="tab-pane fade show active" id="resumoPagamento" role="tabpanel" aria-labelledby="resumoPagamento-tab">
                    <div id="motivoNaoEnquadramento" class="titulo">
                        <h5>Contratos</h5> 
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
                                    <td class="text-center"><a href='{{ url("contrato/$contrato->contrato_id") }}'> {{$contrato->txt_nis_beneficiario}}</a></td>    
                                    <td>
                                        {{$contrato->txt_nome_beneficiario}} 
                                        @if($contrato->bln_substituido) 
                                            <span class="badge badge-secondary">Substituição</span>                                         
                                        @endif       
                                    </td>                    
                                    <td class="text-center"> {{number_format($contrato->vlr_percentual_obra, 0, ',' , '.')}}%</td>  
                                    <td class="text-center"> {{number_format(($contrato->resumoPagamento->total_subvencao*100)/$protocolo->vlr_uh, 0, ',' , '.')}}%</td>  
                                    <td class="text-center"> {{number_format($contrato->resumoPagamento->total_subvencao, 2, ',' , '.')}}</td>  
                                    <td class="text-center"> {{number_format($protocolo->vlr_uh - $contrato->resumoPagamento->total_subvencao, 2, ',' , '.')}}</td>  
                                    <td class="text-center"> {{date('d/m/Y',strtotime($contrato->resumoPagamento->data_ultima_nota))}}</td>  
                                    <td class="text-center">
                                        @if($contrato->bln_restricao) 
                                            <span class="badge badge-danger">Restrição</span> 
                                        @else
                                            @if($contrato->bln_recurso_devolvido) 
                                            <span class="badge badge-warning">Devolvido</span>
                                            @else
                                                @if($contrato->bln_entregue) 
                                                    @if($contrato->bln_recurso_devolvido)                                    
                                                        <span class="badge badge-warning">Devolvido</span>                                
                                                    @else
                                                        <span class="badge badge-info">Entregue</span>                                
                                                    @endif   
                                                @elseif((!$contrato->bln_entregue) && (!$contrato->bln_recurso_devolvido) && ($contrato->vlr_percentual_obra==100))
                                                    <span class="badge badge-success">Concluído</span>                                
                                                @else
                                                    @if($contrato->vlr_percentual_obra == 0)
                                                        <span class="badge badge-danger">Não Iniciada</span>                                
                                                    @else    
                                                        <span class="badge badge-light">Em andamento</span>                                
                                                    @endif    
                                                @endif
                                            @endif   
                                        @endif   
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
                        <h5>Parcela Pagas</h5> 
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
                                    <td class="text-center"><a href='{{ url("contrato/$contrato->contrato_id") }}'> {{$contrato->txt_nis_beneficiario}}</a></td>    
                                    <td>{{$contrato->txt_nome_beneficiario}} 
                                    @if($contrato->bln_substituido) 
                                            <span class="badge badge-secondary">Substituição</span>                                         
                                        @endif   

                                    @if($contrato->bln_restricao) 
                                            <span class="badge badge-danger">Restrição</span> 
                                        @else
                                            @if($contrato->bln_recurso_devolvido) 
                                            <span class="badge badge-warning">Devolvido</span>
                                            @else
                                                @if($contrato->bln_entregue) 
                                                    @if($contrato->bln_recurso_devolvido)                                    
                                                        <span class="badge badge-warning">Devolvido</span>                                
                                                    @else
                                                        <span class="badge badge-info">Entregue</span>                                
                                                    @endif   
                                                @elseif((!$contrato->bln_entregue) && (!$contrato->bln_recurso_devolvido) && ($contrato->vlr_percentual_obra==100))
                                                    <span class="badge badge-success">Concluído</span>                                
                                                @else
                                                    @if($contrato->vlr_percentual_obra == 0)
                                                        <span class="badge badge-danger">Não Iniciada</span>                                
                                                    @else    
                                                        <span class="badge badge-light">Em andamento</span>                                
                                                    @endif    
                                                @endif
                                            @endif   
                                        @endif  
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







            
            <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">       
    </div><!-- content-core-->
</div><!-- content-->

@endsection