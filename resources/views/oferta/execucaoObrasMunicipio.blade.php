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

     <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/execucao/obras/filtro')}}">Consulta Execução de Obras</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Execução de Obras</span>
    </span>

</div>   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        
        @if($instituicao)
            <h2  class="documentFirstHeading text-center">{{$instituicao->txt_nome_if}}</h2>
                @if($estado)
                    <span class="documentFirstHeadingSpan">{{$estado->txt_uf}}</span>   
                @endif     
            @else
                @if($estado)
                <h2  class="documentFirstHeading text-center">{{$estado->txt_uf}}</h2>
                
                @endif      
            @endif  
        
            <div class="linha-separa"></div>
        


    <div id="content-core">
        @if($totalizadores2009['total_uh']>0)
            <div class="titulo">
                <h5>Oferta Pública 2009</h5> 
                </div> 
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>Município</th>                                                       
                        <th>0%</th> 
                        <th>De 0 a 15%</th> 
                        <th>De 15 a 30%</th> 
                        <th>De 30 a 45%</th> 
                        <th>De 45 a 60%</th> 
                        <th>De 60 a 75%</th> 
                        <th>De 75 a 99%</th> 
                        <th>Concluídas</th> 
                        <th>Entegues</th> 
                        <th>Devolvidas</th> 
                        <th>Total UH</th> 
                        </tr>
                    </thead>
                    <tbody>                          
                    <?php $count = 0 ?>
                    @foreach($execucaoObra as $dados) 
                        @if(($dados->num_oferta==1) && ($dados->instituicao_id!=3))
                            <tr>                                                                  
                            
                                <td class="text-center">{{$dados->ds_municipio}}</td>   
                                <td class="text-center">{{number_format($dados->total_0_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_0_a_15_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_15_a_30_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_30_a_45_perc, 0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_45_a_60_perc,0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format($dados->total_de_60_a_75_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_75_a_99_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_concluidas,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_entregues, 0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_devolvidas,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_uh,0, ',' , '.')}}</td>                                 
                            </tr>    
                        @endif      
                    @endforeach 

                    
                            <tr>    
                                <td class="text-center">TOTAL</td>   
                                <td class="text-center">{{number_format($totalizadores2009['total_0_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_de_0_a_15_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_de_15_a_30_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_de_30_a_45_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_de_45_a_60_perc'],0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format($totalizadores2009['total_de_60_a_75_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_de_75_a_99_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_concluidas'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_entregues'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_devolvidas'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2009['total_uh'],0, ',' , '.')}}</td>                                 
                            </tr>    
                    
                        </tbody>
                    </table> 
                </div> 
                @endif

                @if($totalizadores2012['total_uh']>0)
                <div class="linha-separa"></div>
                <div class="titulo">
                <h5>Oferta Pública 2012</h5> 
                </div> 
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>Município</th>                                                       
                        <th>0%</th> 
                        <th>De 0 a 15%</th> 
                        <th>De 15 a 30%</th> 
                        <th>De 30 a 45%</th> 
                        <th>De 45 a 60%</th> 
                        <th>De 60 a 75%</th> 
                        <th>De 75 a 99%</th> 
                        <th>Concluídas</th> 
                        <th>Entegues</th> 
                        <th>Devolvidas</th> 
                        <th>Total UH</th> 
                        </tr>
                    </thead>
                    <tbody>                          
                    <?php $count = 0 ?>
                    @foreach($execucaoObra as $dados)
                    @if(($dados->num_oferta==2) && ($dados->instituicao_id!=3))
                            <tr>                     
                                <td class="text-center">{{$dados->ds_municipio}}</td>   
                                <td class="text-center">{{number_format($dados->total_0_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_0_a_15_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_15_a_30_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_30_a_45_perc, 0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_45_a_60_perc,0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format($dados->total_de_60_a_75_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_de_75_a_99_perc,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_concluidas,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_entregues, 0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_devolvidas,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($dados->total_uh,0, ',' , '.')}}</td>                                 
                            </tr>    
                      @endif      
                    @endforeach 

                    
                            <tr>    
                                <td class="text-center">TOTAL</td>   
                                <td class="text-center">{{number_format($totalizadores2012['total_0_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_de_0_a_15_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_de_15_a_30_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_de_30_a_45_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_de_45_a_60_perc'],0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format($totalizadores2012['total_de_60_a_75_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_de_75_a_99_perc'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_concluidas'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_entregues'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_devolvidas'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalizadores2012['total_uh'],0, ',' , '.')}}</td>                                 
                            </tr>    
                    
                        </tbody>
                    </table> 
                </div> 
                @endif        
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">         
        
    </div><!-- content-core-->
</div><!-- content-->


@endsection