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
        <a href="{{url('/contratos/filtro')}}">Consulta aos Contratos das Instituições</a>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">{{$instituicao->txt_nome_if}}</span>
    </span>
</div> 
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        {{$instituicao->txt_nome_if}}
        </h2>
        

    <div id="content-core">
        <div id="motivoNaoEnquadramento" class="titulo">
            <h5>Dados da Execução</h5> 
        </div>
        <div class="form-group">
                <div class="row">
                    <div class="colunm col-xs-12 col-md-2">
                        <div class="media text-muted pt-3">                            
                            <p class="media-body pb-3 mb-0 small lh-125 text-center">
                                <strong class="d-block text-dark">UH Contratadas</strong>
                                {{$qtd_contratadas}}
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
                                              
                </div>
            </div><!-- fechar form-group--> 
           
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
                                    @if(($contrato->parcela_1+$contrato->parcela_2+$contrato->parcela_3+$contrato->parcela_4+$contrato->parcela_5+$contrato->parcela_6+$contrato->parcela_7)<$contrato->vlr_uh)
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








            
            <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">       
    </div><!-- content-core-->
</div><!-- content-->

@endsection