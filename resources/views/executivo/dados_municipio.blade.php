@extends('layouts.app')



@section('content')

<section>
  <div class="container-fluid">    
    </header>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center">
            <strong class="text-white"><h2>Dados do Município</h2></strong>            
          </div>
          <div class="card-body section-padding">
              <!-- form-group-->              
              <div class="form-group">
                    <div class="row">  
                        <div class="col-xs-12 col-md-2">
                            <label for="txt_uf">IBGE </label>
                            <input id="txt_uf" type="text" class="form-control" name="num_apf" value="{{$municipio->id}}" >
                        </div>                              
                        <div class="col-xs-12 col-md-1">
                            <label for="txt_uf">UF </label>
                            <input id="txt_uf" type="text" class="form-control" name="num_apf" value="{{$estado->txt_sigla_uf}}" >
                        </div> 
                        <div class="col-xs-12 col-md-3">
                            <label for="ds_municipio">Município </label>
                            <input id="ds_municipio" type="text" class="form-control" name="ds_municipio" value="{{$municipio->ds_municipio}}" >
                        </div> 
                        <div class="col-xs-12 col-md-3">
                            <label for="ds_municipio">População ({{$brasilComRm->num_ano_referencia}}) </label>
                            <input id="num_total_populacao_2010" type="text" class="form-control" name="num_total_populacao_2010" value="{{number_format( ($brasilComRm->num_total_populacao_2010), 0, ',' , '.')}}" >
                        </div>  
                        <div class="col-xs-12 col-md-3">
                            <label for="ds_municipio">População ({{$brasilComRm->num_ano_referencia_populacao_estimada}}) </label>
                            <input id="num_populacao_estimada" type="text" class="form-control" name="num_populacao_estimada" value="{{number_format( ($brasilComRm->num_populacao_estimada), 0, ',' , '.')}}" >
                        </div>                               
                    </div>
                </div>   
              <!--form-group -->                          
                <div class="form-group">
                    <div class="row">                                
                        <div class="col-sm-6">                        
                            <div class="card text-white bg-secondary mb-3">                               
                                <div class="card-body bg-light">
                                <h5 class="card-title text-secondary text-center">Déficit
                                <a href="" data-toggle="modal" data-target="#modalIndicadores" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i>
                                </a>
                                </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <caixa-simples qtd="{{number_format( ($deficit->vlr_deficit_habitacional_urbano), 0, ',' , '.')}}" titulo="Urbano" cor="#3498db" icone="fas fa-percent"></caixa-simples>
                                        </div>
                                        <div class="col-md-6">
                                            <caixa-simples qtd="{{number_format( ($deficit->vlr_deficit_habitacional_rural), 0, ',' , '.')}}" titulo="Rural"cor="#3498db" icone="fas fa-percent"></caixa-simples>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>  
                        </div>
                        <div class="col-sm-6">
                        <div class="card text-white bg-secondary mb-3" >                            
                                <div class="card-body bg-light text-light">
                                <h5 class="card-title text-secondary text-center">UH Contratadas
                                <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                                <i class="fa fa-arrow-circle-right"></i>
                                </a>    
                                </h5>
                                    <div class="row">
                                        <div class="col-md-6 text-light" >
                                            <caixa-simples qtd="{{number_format( ($num_uh_contratada_urbano), 0, ',' , '.')}}" titulo="Urbano (FDS, FAR e Oferta)" cor="#3498db" icone="fa fa-fw fa-home"></caixa-simples>
                                        </div>
                                        <div class="col-md-6">
                                            <caixa-simples qtd="{{number_format( ($num_uh_contratada_rural), 0, ',' , '.')}}" titulo="Rural" cor="#3498db" icone="fa fa-fw fa-home"></caixa-simples>
                                        </div>
                                    </div>                            
                                </div>
                            </div>   
                        </div>                                
                    </div>
                </div>   
              <!--form-group -->   
              <!--form-group -->                          
              <div class="form-group">
                    <div class="row">                                
                        <div class="col-sm-6">                        
                            <div class="card text-white bg-secondary mb-3">
                                <div class="card-body bg-light">
                                <h5 class="card-title text-secondary text-center">Limites
                                @if(($num_uh_selecao_ativa_ano>0) || ($num_uh_contratadas_ano>0))
                                    <a href="" data-toggle="modal" data-target="#modalLimite" class="small-box-footer">
                                    <i class="fa fa-arrow-circle-right"></i>
                                    </a>    
                                @endif    
                                </h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <caixa-simples qtd="{{number_format( ($brasilComRm->num_limite_uh), 0, ',' , '.')}}" titulo="Portaria" cor="#f1c40f" icone="fa fa-fw fa-home"></caixa-simples>
                                        </div>
                                        <div class="col-md-6">
                                            @if($saldoLimite>0)
                                            <caixa-simples qtd="{{number_format( ($saldoLimite), 0, ',' , '.')}}" titulo="Saldo" cor="#17a689" icone="fa fa-fw fa-home"></caixa-simples>
                                            @else
                                            <caixa-simples qtd="{{number_format( ($saldoLimite), 0, ',' , '.')}}" titulo="Saldo" cor="#e74c3c" icone="fa fa-fw fa-home"></caixa-simples>
                                            @endif                                            
                                        </div>
                                    </div>                                    
                                </div>
                            </div>  
                        </div>
                        <div class="col-sm-6">
                        <div class="card text-white bg-secondary mb-3" >                            
                                <div class="card-body bg-light text-light">
                                <h5 class="card-title text-secondary text-center">Situação do Município</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if($elegivel)
                                                <caixa-simples qtd="ELEGÍVEL" titulo="Portaria 114: item 8.1.1-b" cor="#17a689" icone="fas fa-thumbs-up"></caixa-simples>
                                            @else
                                                <caixa-simples qtd="INELEGÍVEL" titulo="Portaria 114: item 8.1.1-b" cor="#e74c3c" icone="fas fa-thumbs-down"></caixa-simples>
                                            @endif                             
                                        </div>    
                                    </div>
                                </div>
                            </div>   
                        </div>                                
                    </div>
                </div>   
              <!--form-group -->                      
          </div>
        </div>
      </div>   
    </div>
  </div>       
</section>
<!--  Section-->
@if(count($propostasApresentadas)>0)
<section>
  <div class="container-fluid">    
    </header>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center">
            <strong class="text-white"><h2>Dados da Seleção</h2></strong>            
          </div>
          <div class="card-body section-padding">
              
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
                                <th>Motivo Não Seleção</th>         
                                </tr>
                            </thead>
                            <tbody>      
                            <?php $count = 0 ?>
                            @foreach($propostasApresentadas as $propostas) 
                                    <tr class="text-center">          
                                        <td>{{date('m/Y',strtotime($propostas->dte_portaria_resultado))}}</td>                                    
                                        <td>{{$propostas->txt_modalidade}}</td>                                    
                                        <td>{{$propostas->num_apf}}</td>                                    
                                        <td><a style="text-decoration:none" href='{{ url("proposta/$propostas->proposta_id/$propostas->num_apf") }}'>{{$propostas->txt_nome_empreendimento}}</a></td>                                    
                                        <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                        <td>{{number_format( ($propostas->vlr_investimento), 2, ',' , '.')}}</td>
                                        <td>                        
                                            @if($propostas->bln_enquadrada)                             
                                            <h5><span class="badge badge-success">Sim</span></h5>
                                            @else 
                                                <h5><span class="badge badge-danger">Não</span></h5>
                                            @endif                       
                                        </td>                                                   
                                        <td>
                                            @if($propostas->bln_selecionada)                             
                                                <h5><span class="badge badge-success">Sim</span></h5>
                                            @else 
                                                <h5><span class="badge badge-danger">Não</span></h5> 
                                            @endif
                                    </td>                                                   
                                        <td>
                                            @if($propostas->bln_contratada)                             
                                            <h5><span class="badge badge-success">Sim</span></h5>
                                            @else 
                                                @if($propostas->bln_ativo)                             
                                                <h5><span class="badge badge-info">&nbsp;&nbsp;&nbsp;?&nbsp;&nbsp;&nbsp;</span></h5>
                                            @else 
                                            <h5><span class="badge badge-danger">Não</span></h5>  
                                                @endif    
                                            @endif
                                    </td>   
                                    <td>{{$propostas->txt_tipo_motivo_nao_selecao}}</td>                                                
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
@endif
<!--  Section-->
<section class="statistics">
    <div class="container-fluid" >
    <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">         
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modalContratacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dados de Contratação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead  class="text-center">
                    <tr>
                    <th>Modalidade</th>  
                    <th>Nº UH</th>  
                    <th>Valor</th>                      
                    </tr>
                </thead>
                <tbody>      
                <?php $count = 0 ?>
                @foreach($contratacao as $valor) 
                    @if(($valor->modalidade_id != 7) && ($valor->modalidade_id != 1) )
                        <tr class="text-center">                                   
                            <td>{{$valor->txt_modalidade}}</td>                                    
                            <td>{{number_format( ($valor->num_uh_contratadas), 0, ',' , '.')}}</td>
                            <td>{{number_format( ($valor->vlr_contratacao), 2, ',' , '.')}}</td>                                                                            
                        </tr>
                    @endif    
                @endforeach                           
            
                    </tbody>
                </table> 
            </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary bnt-block" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalIndicadores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Déficit Habitacional</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <div class="titulo">
            <h5>Urbano</h5> 
        </div>         
            <div class="form-group">
                <div class="row">       
                    <div class="col-sm-6">       
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Urbano</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano), 0, ',' , '.')}}">
                        </div>
                    </div>        
                    <div class="col-sm-6">       
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Relativo</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo), 2, ',' , '.')}}">
                        </div>
                    </div>                        
                </div>
            </div>
            <div class="form-group">
                <div class="row">                               
                    <div class="col-sm-6">       
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Relativo até 3 Salários</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_ate3_sal), 2, ',' , '.')}}">
                        </div>
                    </div>
                    <div class="col-sm-6">       
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Relativo de 3 a 10 Salários</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_de3a10_sal), 2, ',' , '.')}}">
                        </div>
                    </div>        
                </div> 
            </div>
            <div class="form-group">
                <div class="row">                               
                    <div class="col-sm-6">       
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Relativo até 10 Salários</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_ate10), 2, ',' , '.')}}">
                        </div>
                    </div>
                    <div class="col-sm-6">       
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <div class="input-group-text">Relativo acima de 10 Salários</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_acima10_sal), 2, ',' , '.')}}">
                        </div>
                    </div>        
                </div>   
            </div>    
            <div class="titulo">
                <h5>Rural</h5> 
            </div>         
                <div class="form-group">
                    <div class="row">       
                        <div class="col-sm-6">       
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Rural</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_rural), 0, ',' , '.')}}">
                            </div>
                        </div>        
                        <div class="col-sm-6">       
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Relativo</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_rural_relativo), 2, ',' , '.')}}">
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="titulo">
                    <h5>Total</h5> 
                </div> 
                <div class="form-group">
                    <div class="row">                               
                        <div class="col-sm-6">       
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Total</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_total), 0, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">       
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Relativo Total</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_total_relativo), 2, ',' , '.')}}">
                            </div>
                        </div>        
                    </div> 
                </div>
                <div class="titulo">
                    <h5>Diversos</h5> 
                </div> 
                <div class="form-group">
                    <div class="row">                               
                        <div class="col-sm-6">       
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Domicílio Precário</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_domicilios_precarios), 2, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">       
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Coabitação Familiar</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_coabitacao_familiar), 2, ',' , '.')}}">
                            </div>
                        </div>        
                    </div> 
                </div>

                <div class="form-group">
                    <div class="row">                               
                        <div class="col-sm-12">       
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Ônus Excessivo com Aluguel</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_onus_excessivo_com_aluguel), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">       
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">Adensamento Excessivo com Domicílios Alugados</div>
                                </div>
                                <input type="text" class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_adensamento_excessivo_domicilios_alugados), 2, ',' , '.')}}">
                            </div>
                        </div>        
                    </div>   
                </div>   
                
                <p class="font-italic">Ano de Referência: {{$deficit->num_ano_referencia}}</p>
                
      </div>
      <div class="modal-footer">         
</br>
        <button type="button" class="btn btn-primary bnt-block" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLimite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dados de Contratação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>Limite (A)</th>  
                        <th>UH Contratadas (B)</th>  
                        <th>UH Dentro do Prazo Contratação (C)</th>         
                        <th>Saldo (A - B - C)</th>         
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr class="text-center">          
                            <td>{{number_format( ($brasilComRm->num_limite_uh), 0, ',' , '.')}}</td>                                    
                            <td>{{number_format( ($num_uh_contratadas_ano), 0, ',' , '.')}}</td>                                     
                            <td>{{number_format( ($num_uh_selecao_ativa_ano), 0, ',' , '.')}}</td> 
                            <td>{{number_format( ($brasilComRm->num_limite_uh - $num_uh_contratadas_ano - $num_uh_selecao_ativa_ano), 0, ',' , '.')}}</td>                                                                                  
                        </tr>                                        
                    </tbody>
                </table> 
            </div> 
        @if(count($propostasApresentadas)>0)            
            <!-- panel body -->   
            @if($num_uh_contratadas_ano>0)   
            <div class="titulo">
                <h5>Propostas Contratadas em 2018 - FAR Empresas</h5> 
            </div>                            
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>APF</th>  
                        <th>Empreendimento</th>  
                        <th>UH Contratada</th>         
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasApresentadas as $propostas) 
                        @if(($propostas->bln_contratada) && ($propostas->modalidade_id == 3) && ($propostas->num_ano_selecao == 2018) && (!$propostas->bln_ativo)) 
                            <tr class="text-center">          
                                <td>{{$propostas->num_apf}}</td>                                    
                                <td>{{$propostas->txt_nome_empreendimento}}</td>                                    
                                <td>{{number_format( ($propostas->num_uh_contratadas), 0, ',' , '.')}}</td>                                                                                   
                            </tr>
                        @endif    
                    @endforeach                           
                    <tr class="text-center table-secondary table-active">          
                                <td></td>                                    
                                <td class="text-right"><strong>TOTAL</strong></td>                                    
                                <td><strong>{{number_format( ($num_uh_contratadas_ano), 0, ',' , '.')}}</strong></td>                                                                                   
                            </tr>
                        </tbody>
                    </table> 
                </div>  
            @endif

            @if($num_uh_selecao_ativa_ano>0)    
                <!-- panel body -->   
            <div class="titulo">
                <h5>Propostas com a seleção dentro do prazo de contratação em 2018 - FAR Empresas</h5> 
            </div>                            
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>APF</th>  
                        <th>Empreendimento</th>  
                        <th>UH Contratada</th>         
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasApresentadas as $propostas) 
                        @if(($propostas->bln_selecionada) && ($propostas->modalidade_id == 3) && ($propostas->num_ano_selecao == 2018) && ($propostas->bln_ativo))
                            <tr class="text-center">          
                                <td>{{$propostas->num_apf}}</td>                                    
                                <td>{{$propostas->txt_nome_empreendimento}}</td>                                    
                                <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>                                                                                   
                            </tr>
                        @endif    
                    @endforeach                           
                    <tr class="text-center table-secondary table-active">          
                                <td></td>                                    
                                <td class="text-right"><strong>TOTAL</strong></td>                                    
                                <td><strong>{{number_format( ($num_uh_selecao_ativa_ano), 0, ',' , '.')}}</strong></td>                                                                                   
                            </tr>
                        </tbody>
                    </table> 
                </div> 
            @endif    
        @else
        <div class="alert alert-danger alert-dismissible fade in shadowed" role="alert">                                 
            <i class="fa fa-fw fa-info-circle"></i> Não existem propostas apresentadas para este município.
        </div>     
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary bnt-block" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
@endsection