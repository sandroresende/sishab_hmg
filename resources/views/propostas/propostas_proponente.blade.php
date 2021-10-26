@extends('layouts.app')

@section('content')
<section>
  <div class="container-fluid">    
    
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center">
            <strong class="text-white"><h2>{{$proponente->txt_nome_entidade_proponente}}</h2></strong>            
          </div>
          <div class="card-body section-padding">
               <!-- form-group-->              
               <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                            <th class="align-middle">Ano</th>  
                            <th>N° Portaria</th>                          
                            <th>Modalidade</th>                          
                            <th>Qtd Propostas Apresentadas</th>                          
                            <th>UH Apresentadas</th>  
                            <th>Qtd Propostas Selecionadas</th>                          
                            <th>UH Selecionadas</th>  
                            <th>Qtd Propostas Contratadas</th>                          
                            <th>UH Contratadas</th>  
                            <th>Valor Contratado</th>  
                        </tr>                       
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($resumoPropostas as $resumo) 
                            <tr class="text-center">          
                                <td>{{$resumo->num_ano_selecao}}</td>
                                <td>{{$resumo->num_portaria_resultado}}</td>
                                <td>{{$resumo->txt_modalidade}}</td>
                                <td>{{number_format( ($resumo->qtd_propostas_apresentadas), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($resumo->num_uh_apresentadas), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($resumo->qtd_propostas_selecionada), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($resumo->num_uh_selecionada), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($resumo->qtd_propostas_contratadas), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($resumo->num_uh_contratadas), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($resumo->vlr_total_contratado), 2, ',' , '.')}}</td>

                            </tr>            
                    @endforeach   
                    <tr class="text-center">          
                                <td colspan="3">TOTAL</td>
                                <td>{{number_format( ($totalResumo['total_propostas_apresentadas']), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($totalResumo['total_uh_apresentadas']), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($totalResumo['total_propostas_selecionadas']), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($totalResumo['total_uh_selecionadas']), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($totalResumo['total_propostas_contratadas']), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($totalResumo['total_uh_contratadas']), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($totalResumo['total_vlr_contratado']), 2, ',' , '.')}}</td>

                            </tr>                                                 
                        </tbody>
                    </table> 
                </div> 


              <!--form-group -->

              <span class="badge badge-info">&nbsp;&nbsp;&nbsp;?&nbsp;&nbsp;&nbsp;</span> - <em>Seleção dentro do prazo de contratação</em>
                    <!-- panel body -->                             
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead  class="text-center">
                                <tr class="text-center">
                                <th>Mês/Ano</th>  
                                <th>Modalidade</th>  
                                <th>APF</th>  
                                <th>Empreendimento</th>  
                                <th>UH</th>  
                                <th>Valor</th> 
                                <th>Enquadrada</th>            
                                <th>Selecionada</th>           
                                <th>Contratada</th>         
                                </tr>
                            </thead>
                            <tbody>      
                            <?php $count = 0 ?>
                            @foreach($propostas as $dados) 
                                    <tr class="text-center">          
                                        <td>{{date('m/Y',strtotime($dados->dte_portaria_resultado))}}</td>                                    
                                        <td>{{$dados->txt_modalidade}}</td>                                    
                                        <td>{{$dados->num_apf}}</td>                                    
                                        <td><a style="text-decoration:none" href='{{ url("proposta/$dados->proposta_id/$dados->num_apf") }}'>{{$dados->txt_nome_empreendimento}}</a></td>                                    
                                        <td>{{number_format( ($dados->num_uh), 0, ',' , '.')}}</td>
                                        <td>{{number_format( ($dados->vlr_investimento), 2, ',' , '.')}}</td>
                                        <td>                        
                                            @if($dados->bln_enquadrada)                             
                                            <h5><span class="badge badge-success">Sim</span></h5>
                                            @else 
                                                <h5><span class="badge badge-danger">Não</span></h5>
                                            @endif                       
                                        </td>                                                   
                                        <td>
                                            @if($dados->bln_selecionada)                             
                                                <h5><span class="badge badge-success">Sim</span></h5>
                                            @else 
                                                <h5><span class="badge badge-danger">Não</span></h5> 
                                            @endif
                                    </td>                                                   
                                        <td>
                                            @if($dados->bln_contratada)                             
                                            <h5><span class="badge badge-success">Sim</span></h5>
                                            @else 
                                                @if($dados->bln_ativo)                             
                                                <h5><span class="badge badge-info">&nbsp;&nbsp;&nbsp;?&nbsp;&nbsp;&nbsp;</span></h5>
                                            @else 
                                            <h5><span class="badge badge-danger">Não</span></h5>  
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



<section class="statistics">
    <div class="container-fluid" >
        <div class="row ">
            <a class="btn-lg btn btn-success btn-block" href="{{url('/home')}}">Voltar</a>
        </div>
    </div>
</section>

@endsection
