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
               <form action="{{ url('operacoes_retomadas') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <select-retomada :url="'{{ url('/') }}'" situacaoId="'{{$situacaoId}}'" :municipioId="{{$municipioId}}" :ufId="{{$estadoId}}" ></select-retomada>
                        </div>
                    </div>    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
                </form> 
              <!--form-group -->
            <div class="titulo">
                <h5>Resumo do Status SNH</h5> 
            </div> 
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>UF</th>    
                        <th>Qtd Opercações</th>                                                   
                        <th>Em análise</th> 
                        <th>Aguardando</th> 
                        <th>Autorizado</th> 
                        <th>Valor Questionado</th>                         
                        <th>Não Preenchido</th> 
                        <th>Total</th> 
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($resumoStatusSnh as $status)                                                                   
                            <tr>
                                <td class="text-center">{{$status->txt_sigla_uf}}</td>   
                                <td class="text-center">{{number_format($status->qtd_operacoes,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->em_analise,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->aguardando,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->autorizado,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->valor_questionado,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->nao_preenchido,0, ',' , '.')}}</td> 
                                <td class="text-center text-bold">{{number_format($status->em_analise+$status->em_analise+$status->aguardando+$status->autorizado+$status->valor_questionado+$status->nao_preenchido,0, ',' , '.')}}</td>
                                                         
                            </tr>    
                    @endforeach     
                            <tr class="text-bold">
                                <td class="text-center">TOTAL</td>   
                                <td class="text-center">{{number_format($totalStatusSnh['total_qtd_operacoes'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatusSnh['total_em_analise'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatusSnh['total_aguardando'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatusSnh['total_autorizado'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatusSnh['total_valor_questionado'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatusSnh['total_nao_preenchido'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatusSnh['total_em_analise']+$totalStatusSnh['total_aguardando']+$totalStatusSnh['total_autorizado']+$totalStatusSnh['total_valor_questionado']+$totalStatusSnh['total_nao_preenchido'],0, ',' , '.')}}</td> 
                            </tr>                                
                        </tbody>
                    </table> 
                </div> 
                <div class="titulo">
                <h5>Resumo do Status da retomadas</h5> 
            </div> 
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr>
                        <th>UF</th>    
                        <th>Qtd Opercações</th>                                                   
                        <th>Iniciar Solicitação</th> 
                        <th>Em análise AO</th> 
                        <th>Dotado</th> 
                        <th>Contratado</th> 
                        <th>MCidades</th> 
                        <th>Análise finalizada</th> 
                        <th>Encaminhado para dotação</th> 
                        <th>Não autorizado pelo MCidades</th> 
                        <th>Pendente AF</th> 
                        <th>Não autorizado pelo AO</th> 
                        <th>Não Preenchido</th> 
                        <th>Total</th> 
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($resumoStatusRetomada as $status)                                                                   
                            <tr>
                                <td class="text-center">{{$status->txt_sigla_uf}}</td>   
                                <td class="text-center">{{number_format($status->qtd_operacoes,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->iniciar_solicitacao,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->analise_ao,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->dotado,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->contratado,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->mcidades,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->analise_finalizada,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->encaminhado_dotacao,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->nao_autorizado_mcidades,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->pendente_af,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->nao_autorizado_ao,0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($status->nao_preenchido,0, ',' , '.')}}</td> 
                                <td class="text-center text-bold">{{number_format($status->iniciar_solicitacao+$status->analise_ao+$status->dotado+$status->contratado+$status->mcidades+$status->analise_finalizada+$status->encaminhado_dotacao+$status->nao_autorizado_mcidades+$status->pendente_af+$status->nao_autorizado_ao+$status->nao_preenchido,0, ',' , '.')}}</td>
                                                         
                            </tr>    
                    @endforeach     
                            <tr class="text-bold">
                                <td class="text-center">TOTAL</td>   
                                <td class="text-center">{{number_format($totalStatus['total_qtd_operacoes'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_iniciar_solicitacao'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_analise_ao'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_dotado'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_contratado'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_mcidades'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_analise_finalizada'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_encaminhado_dotacao'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_nao_autorizado_mcidades'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_pendente_af'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_nao_autorizado_ao'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_nao_preenchido'],0, ',' , '.')}}</td> 
                                <td class="text-center">{{number_format($totalStatus['total_iniciar_solicitacao']+$totalStatus['total_analise_ao']+$totalStatus['total_dotado']+$totalStatus['total_contratado']+$totalStatus['total_mcidades']+$totalStatus['total_analise_finalizada']+$totalStatus['total_encaminhado_dotacao']+$totalStatus['total_nao_autorizado_mcidades']+$totalStatus['total_pendente_af']+$totalStatus['total_nao_autorizado_ao']+$totalStatus['total_nao_preenchido'],0, ',' , '.')}}</td> 
                            </tr>                                
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