@extends('layouts.app')



@section('content')

<section>
  <div class="container-fluid">    
    </header>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header text-center">
            <strong class="text-white"><h2>{{$selecao->txt_portaria_resultado}}</h2></strong>            
          </div>
          <div class="card-body section-padding">
              <!-- form-group-->              
              <div class="form-group">
                    <div class="row">                                
                        <div class="col-xs-12 col-md-3">
                            <label for="txt_uf">Modalidade </label>
                            <input id="txt_modalidade" type="text" class="form-control" name="txt_modalidade" value="{{$selecao->modalidade->txt_modalidade}}" >
                        </div> 
                        <div class="col-xs-12 col-md-3">
                            <label for="num_total_enquadradas">Enquadradas </label>
                            <input id="num_total_enquadradas" type="text" class="form-control" name="num_total_enquadradas" value="{{number_format( ($selecao->num_total_enquadradas), 0, ',' , '.')}}" >
                        </div> 
                        <div class="col-xs-12 col-md-3">
                            <label for="num_total_selecionadas">Selecionadas </label>
                            <input id="num_total_selecionadas" type="text" class="form-control" name="num_total_selecionadas" value="{{number_format( ($selecao->num_total_selecionadas), 0, ',' , '.')}}" >
                        </div> 
                        <div class="col-xs-12 col-md-3">
                            <label for="num_total_contratadas">Contratadas </label>
                            <input id="num_total_contratadas" type="text" class="form-control" name="num_total_contratadas" value="{{number_format( ($selecao->num_total_contratadas), 0, ',' , '.')}}" >
                        </div> 
                                                      
                    </div>
                </div>                                   
          </div>
        </div>
      </div>   
    </div>
  </div>       
</section>
<!--  Section-->

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
                @if(count($propostasApresentadas)>0)
                    <i style="color:green;" class="fa fa-thumbs-up fa-1x"> Sim</i> | <i style="color:red;" class="fa fa-thumbs-down fa-1x"> Não</i> | <i style="color:blue;" class="fas fa-question fa-1x"> Seleção dentro do prazo de contratação</i>  
                    <!-- panel body -->                             
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead  class="text-center">
                                <tr class="text-center">
                                <th>UF</th>  
                                <th>Município</th>  
                                <th>APF</th>  
                                <th>Empreendimento</th>  
                                <th>UH</th>  
                                <th>Valor (R$)</th>            
                                <th>Enquadrada</th>            
                                <th>Selecionada</th>           
                                <th>Contratada</th>         
                                </tr>
                            </thead>
                            <tbody>      
                            <?php $count = 0 ?>
                            @foreach($propostasApresentadas as $propostas) 
                                    <tr class="text-center">          
                                        <td>{{$propostas->txt_sigla_uf}}</td>                                    
                                        <td>{{$propostas->ds_municipio}}</td>                                    
                                        <td>{{$propostas->num_apf}}</td>                                    
                                        <td><a style="text-decoration:none" href='{{ url("proposta/$propostas->proposta_id/$propostas->num_apf") }}'>{{$propostas->txt_nome_empreendimento}}</a></td>                                    
                                        <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                        <td>{{number_format( ($propostas->vlr_investimento), 2, ',' , '.')}}</td>
                                        <td>                        
                                            @if($propostas->bln_enquadrada)                             
                                                <i style="color:green;" class="fa fa-thumbs-up fa-1x"> </i>
                                            @else 
                                                <i style="color:red;" class="fa fa-thumbs-down fa-1x"> </i>  
                                            @endif                       
                                        </td>                                                   
                                        <td>
                                            @if($propostas->bln_selecionada)                             
                                                <i style="color:green;" class="fa fa-thumbs-up fa-1x"> </i>
                                            @else 
                                                <i style="color:red;" class="fa fa-thumbs-down fa-1x"> </i>  
                                            @endif
                                    </td>                                                   
                                        <td>
                                            @if($propostas->bln_contratada)                             
                                                <i style="color:green;" class="fa fa-thumbs-up fa-1x"> </i>
                                            @else 
                                                @if($propostas->bln_ativo)                             
                                                    <i style="color:blue;" class="fas fa-question fa-1x"> </i>  
                                                @else
                                                    <i style="color:red;" class="fa fa-thumbs-down fa-1x"> </i>  
                                                @endif    
                                            @endif
                                    </td>                                                   
                                    </tr>
                            @endforeach                           
                        
                                </tbody>
                            </table> 
                        </div>    
                      
                @else
                <div class="alert alert-danger alert-dismissible fade in shadowed" role="alert">                                 
                    <i class="fa fa-fw fa-info-circle"></i> Não existem propostas apresentadas para este município.
                </div>     
                @endif
                <div class="form-group">
                    <button class="btn-lg btn btn-success btn-block"
                        onclick="javascript:window.history.go(-1)">
                        Voltar
                    </button>
                </div>            
          </div>
        </div>
      </div>   
    </div>
  </div>       
</section>
<!--  Section-->

@endsection