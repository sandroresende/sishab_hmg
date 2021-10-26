@extends('layouts.app')

@section('content')

<section>
  <div class="container-fluid">    
    
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center">
            <strong class="text-white"><h2>Retomadas de Obras</h2></strong>            
          </div>
          <div class="card-body section-padding">
            <!-- form-group-->              
            <div class="form-group">
               
              <!--form-group -->

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>UF</th>                                                       
                        <th>Município</th> 
                        <th>Num APF</th> 
                        <th>Sup</th> 
                        <th>Empreendimento</th> 
                        <th>UH</th> 
                        <th>Concluídas</th> 
                        <th>Entegues</th> 
                        <th>% Obra</th> 
                        <th>Status SNH</th> 
                        <th>Status Gefus</th> 
                        <th>Situação Obra</th> 
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($operacoesRetomadas as $operacoes)                                           
                        
                            <tr>                                                                  
                            
                                <td class="text-center">{{$operacoes->txt_sigla_uf}}</td>   
                                <td class="text-center">{{$operacoes->ds_municipio}}</td>   
                                <td class="text-center"><a href='{{url("/operacao_retomada/$operacoes->id")}}'>{{$operacoes->operacao_id}}</a>  </td>                        
                                <td class="text-center">{{$operacoes->num_suplementacao}}</td>   
                                <td>{{$operacoes->txt_nome_empreendimento}}</td> 
                                <td class="text-center">{{number_format($operacoes->qtd_uh_financiadas,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($operacoes->qtd_uh_concluidas,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($operacoes->qtd_uh_entregues,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($operacoes->prc_obra_realizado, 2, ',' , '.')}}</td> 
                                <td>{{$operacoes->txt_status_snh}}</td> 
                                <td>{{$operacoes->txt_status_demanda}}</td> 
                                <td class="text-center">


                                @if($operacoes->qtd_uh_financiadas == $operacoes->qtd_uh_concluidas)
                                    <span class="badge badge-success">Concluída</span>
                                @elseif($operacoes->qtd_uh_entregues == $operacoes->qtd_uh_financiadas)
                                    <span class="badge badge-primary">Entegue</span>
                                @else
                                    @if(($operacoes->situacao_obras_ifs_id == 6) || ($operacoes->situacao_obras_ifs_id == 8))
                                    <!--  Concluída-->
                                        <span class="badge badge-success">{{$operacoes->txt_situacao_obra}}</span>
                                        @elseif(($operacoes->situacao_obras_ifs_id == 4) || ($operacoes->situacao_obras_ifs_id == 'D'))
                                    <!--  Paralisada-->
                                        <span class="badge badge-danger">{{$operacoes->txt_situacao_obra}}</span>
                                        @elseif(($operacoes->situacao_obras_ifs_id == 3) || ($operacoes->situacao_obras_ifs_id == 'A') || ($operacoes->situacao_obras_ifs_id == 'A'))
                                    <!--  Atrasada-->
                                        <span class="badge badge-warning">{{$operacoes->txt_situacao_obra}}</span>
                                    @elseif($operacoes->situacao_obras_ifs_id == 1)
                                    <!--  Adiantada-->
                                        <span class="badge badge-info">{{$operacoes->txt_situacao_obra}}</span>
                                    @elseif(($operacoes->situacao_obras_ifs_id == 5) || ($operacoes->situacao_obras_ifs_id == 7))
                                    <!--  Não iniciada-->
                                        <span class="badge badge-secondary">{{$operacoes->txt_situacao_obra}}</span>
                                    @elseif($operacoes->situacao_obras_ifs_id == 'B')
                                    <!--  Em andamento-->
                                        <span class="badge badge-light">{{$operacoes->txt_situacao_obra}}</span>
                                    @elseif(($operacoes->situacao_obras_ifs_id == 2) || ($operacoes->situacao_obras_ifs_id == 'C'))
                                    <!--  Não iniciada-->
                                        <span class="badge badge-light">{{$operacoes->txt_situacao_obra}}</span>                                    
                                    @endif
                                @endif    
                                </td>                                  
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