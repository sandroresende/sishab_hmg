@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            :url="'{{ url('/home') }}'"
            :titulo1="'Oferta Pública'"
            :titulo2='"Filtro Execução de Obras"'
            :link2="'{{ url('/oferta_publica/filtro_execucao_obras') }}'"
            :titulo3='"Execução de Obras"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Execução de Obras '"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    @if($subtitulo2) subtitulo2="{{$subtitulo2}} " @endif
                    @if($subtitulo3) subtitulo3="{{$subtitulo3}} " @endif
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :barracompartilhar="true"
                    >
            </cabecalho-form> 
            <div class="form-group">
                @if($totalizadores2009['total_uh']>0)
            <div class="titulo">
                <h3>Oferta Pública 2009</h3> 
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

                    
                            <tr class="total">    
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
                <h3>Oferta Pública 2012</h3> 
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

                    
                            <tr class="total">    
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
            </div>   
        </div>   
        
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
@endsection


