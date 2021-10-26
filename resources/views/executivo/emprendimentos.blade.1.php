@extends('layouts.app')

@section('content')
<!-- Section-->


<section>
  <div class="container-fluid">   
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center">
            <strong class="text-white"><h2>
                    
                    @if($municipio) 
                        {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}} 
                    @else
                        @if($estado)
                            {{$estado->txt_uf}}
                        @else
                            {{$regiao->txt_regiao}}  
                        @endif
                    @endif 


                    
            </h2></strong>            
          </div>
          <div class="card-body section-padding">
          
          <!-- tabel-->                    

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>UF</th>  
                        <th>Município</th>  
                        <th>Cód Operacao</th>  
                        <th>Empreendimento</th>  
                        <th>Modalidade</th>  
                        <th>PMCMV</th> 
                        <th>%</th> 
                        <th>Contr.</th>            
                        <th>Conc.</th>           
                        <th>Entr.</th>         
                        <th>Valor</th>         
                        <th>Situação</th>         
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($operacoes as $operacao) 
                            <tr class="text-center">          
                                <td>{{$operacao->txt_sigla_uf}}</td>                                    
                                <td>{{$operacao->ds_municipio}}</td>                                    
                                <td>{{$operacao->cod_operacao}}</td>  
                                @if($operacao->txt_nome_empreendimento)
                                <td>
                                    <a href='{{ url("executivo/empreendimento/$operacao->id") }}'> {{$operacao->txt_nome_empreendimento}}</a>                                                                  
                                </td>       
                                    @else
                                    <td>                                           
                                        @if($operacao->cod_operacao)
                                        <a href='{{ url("executivo/empreendimento/$operacao->id") }}'> Cód.: {{$operacao->cod_operacao}}</a>                                        
                                        @else
                                        <a href='{{ url("executivo/empreendimento/$operacao->id") }}'> Cód.: </a>
                                        @endif                                 
                                    </td>       
                                    @endif                                  
                                <td>{{$operacao->txt_modalidade}} </td>                                    
                                <td>{{$operacao->num_pmcmv}}</td>
                                <td>{{number_format($operacao->num_percentual, 0, ',' , '.')}}</td>
                                <td>{{$operacao->num_uh}}</td>
                                <td>{{$operacao->num_concluidas}}</td>
                                <td>{{$operacao->num_entregues}} </td>
                                <td>{{number_format($operacao->num_vlr_total, 2, ',' , '.')}}</td>
                                <td>
                                @if($operacao->num_uh == $operacao->num_entregues)  
                                    <span class="badge badge-info">Entregue</span>
                                @elseif($operacao->num_uh == $operacao->num_concluidas)
                                    <span class="badge badge-success">Concluída</span>
                                @else
                                    @if($operacao->num_percentual == 0)
                                        <span class="badge badge-danger">Não Iniciada</span>
                                    @elseif(($operacao->num_percentual >0) && ($operacao->num_percentual < 100))
                                     <span class="badge badge-light">Em Execução</span> 
                                    @endif
                                @endif 
                            </td>                                           
                            </tr>
                    @endforeach                           
                
                        </tbody>
                    </table> 
                </div>
                <!-- tabel-->                    
          </div>
          <!-- card-body-->     
          
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
