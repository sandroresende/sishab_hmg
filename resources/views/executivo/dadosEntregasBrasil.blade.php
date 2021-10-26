@extends('layouts.app')

@section('content')

<section>
  <div class="container-fluid">    
    
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center">
            <strong class="text-white"><h2>Dados de Entregas</h2></strong>            
          </div>
          <div class="card-body section-padding">
            <!-- form-group-->              
            <div class="form-group">
            <div class="titulo">
                <h5>Por Modalidade</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>Modalidade</th>                                                       
                        <th>2009</th>
                        <th>2010</th>
                        <th>2012</th>
                        <th>2013</th>
                        <th>2014</th>
                        <th>2015</th>
                        <th>2016</th>
                        <th>2016</th>
                        <th>2017</th>
                        <th>2018</th>
                        <th>2019</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($entregasModalidade as $entrega)                           
                            <tr>                   
                                <td class="text-center">{{$entrega->txt_modalidade}}</td>   
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2009,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2010,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2011,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2012,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2013,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2014,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2015,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2016,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2017,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2018,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2019,0, ',' , '.')}}</td> 
                                @foreach($totalEntregasModalidade as $totalModalidade)                                                                      
                                    @if($totalModalidade->txt_modalidade == $entrega->txt_modalidade) 
                                        <td class="text-center">    
                                        {{number_format($totalModalidade->total_modalidade,0, ',' , '.')}}
                                        </td>         
                                    @endif                                    
                                @endforeach              
                            </tr>  
                            
                    @endforeach    
                    @foreach($totalEntregasAno as $total)
                            <tr>                   
                                <td class="text-center">TOTAL</td>   
                                <td class="text-center">{{number_format($total->total_2009,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2010,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2011,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2012,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2013,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2014,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2015,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2016,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2017,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2018,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2019,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalUF,0, ',' , '.')}}</td> 
                            </tr>  
                            @endforeach                                                       
                        </tbody>
                    </table> 
                </div> 
              <!--form-group -->
            <div class="titulo">
                <h5>Por Estado</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>UF</th>                                                       
                        <th>2009</th>
                        <th>2010</th>
                        <th>2012</th>
                        <th>2013</th>
                        <th>2014</th>
                        <th>2015</th>
                        <th>2016</th>
                        <th>2016</th>
                        <th>2017</th>
                        <th>2018</th>
                        <th>2019</th>
                        <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($entregas as $entrega)
                           
                            <tr>                   
                                <td class="text-center">{{$entrega->txt_sigla_uf}}</td>   
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2009,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2010,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2011,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2012,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2013,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2014,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2015,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2016,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2017,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2018,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($entrega->total_uh_entregue_2019,0, ',' , '.')}}</td> 
                                @foreach($totalEntregasUF as $totalUf)                                                                      
                                    @if($totalUf->txt_sigla_uf == $entrega->txt_sigla_uf) 
                                        <td class="text-center">    
                                        {{number_format($totalUf->total_uh,0, ',' , '.')}}
                                        </td>         
                                    @endif                                    
                                @endforeach              
                            </tr>  
                            
                    @endforeach    
                    @foreach($totalEntregasAno as $total)
                            <tr>                   
                                <td class="text-center">TOTAL</td>   
                                <td class="text-center">{{number_format($total->total_2009,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2010,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2011,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2012,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2013,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2014,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2015,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2016,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2017,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2018,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($total->total_2019,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalUF,0, ',' , '.')}}</td> 
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