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
        <span> Seleção de Propostas</span>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href="{{url('/selecao')}}">Consulta à Seleção de Propostas</a>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
  
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Propostas Apresentadas</span>
    </span>
</div> 

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
            Propostas Apresentadas
        </h2>
        <span class="documentFirstHeadingSpan">   
          @if(($municipio) && ($estado   ))
            {{$municipio->ds_municipio}}-{{$estado->txt_sigla_uf}}       
          @elseif($estado)              
              {{$estado->txt_uf}}              
          @endif 
        </span>   
   
        <span class="documentFirstHeadingSpan">          
          @if($modalidade)   
              {{$modalidade->txt_modalidade}}              
          @endif   
        </span>   
        <span class="documentFirstHeadingSpan">          
        @if($selecao)   
              {{$selecao->num_selecao}}ª seleção de  {{$selecao->num_ano_selecao}} - {{$selecao->modalidade->txt_modalidade}}
          @endif  
        </span>   
        <div class="linha-separa"></div>


    <div id="content-core">
    @if(count($propostasApresentadas)>0)
                    
                    <!-- panel body -->                             
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead  class="text-center">
                                <tr class="text-center">
                                <th>UF</th>  
                                <th>Município</th>  
                                <th>APF</th>  
                                <th>Seleção</th>  
                                <th>Empreendimento</th>  
                                <th>Modalidade</th>                                  
                                <th>UH</th>                                  
                                <th>Valor (R$)</th>            
                                <th>Situação</th>        
                                </tr>
                            </thead>
                            <tbody>      
                            <?php $count = 0 ?>
                            @foreach($propostasApresentadas as $propostas) 
                                    <tr class="text-center">          
                                        <td>{{$propostas->txt_sigla_uf}}</td>                                    
                                        <td>{{$propostas->ds_municipio}}</td>                                    
                                        <td>{{$propostas->num_apf}}</td>                                    
                                        <td>{{$propostas->num_selecao}}/{{$propostas->num_ano_selecao}}</td>                               
                                        <td><a style="text-decoration:none" href='{{ url("proposta/$propostas->proposta_id/$propostas->num_apf") }}'>{{$propostas->txt_nome_empreendimento}}</a></td>                                    
                                        <td>{{$propostas->txt_modalidade}}</td>                                                                       
                                        <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                        <td>{{number_format( ($propostas->vlr_investimento), 2, ',' , '.')}}</td>
                                        <td>
                                        
                                        @if($propostas->bln_enquadrada)                             
                                            @if($propostas->bln_selecionada)                             
                                                
                                                @if($propostas->bln_contratada)                             
                                                <i class="fas fa-hand-holding-usd fa-1x text-success"> Contratada </i>
                                                @else 
                                                    @if($propostas->bln_ativo)                             
                                                        <i class="fas fa-question fa-1x text-secondary"> Em prazo de Contratação </i>  
                                                    @else
                                                        <i  class="fas fas fa-check fa-1x text-info"> Selecionada</i>
                                                    @endif    
                                                @endif
                                            @else 
                                                <i class="fas fa-times fa-1x text-warning"> Não Selecionada </i>  
                                            @endif
                                        @else
                                            <i class="fa fa-thumbs-down text-danger"> Não Enquadrada</i>        
                                        @endif
                                        
                                        </td>
                                                                                        
                                    </tr>
                            @endforeach                           
                        
                                </tbody>
                            </table> 
                        </div>    
                       
                @endif
        
    </div><!-- content-core-->
</div><!-- content-->
<!-- Section-->
<!--
<colunas-duas-situacao v-bind:itens="{{$propostas}}" :url="'{{ url('/') }}'">            </colunas-duas-situacao>
-->
        <div class="form-group">
            <button class="btn-lg btn btn-success btn-block"
                onclick="javascript:window.history.go(-1)">
                Voltar
            </button>
            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 
            <a class="btn btn-lg btn-light btn-block text-reset text-decoration-none" href='{{ url("propostas-apresentadas-download") . "/" . $dadosPropostas["estado"] . "/" . $dadosPropostas["municipio"] . "/" . $dadosPropostas["modalidade"] . "/" . $dadosPropostas["selecao"]}}' class="btn btn-lg btn-default btn-block">Download para Excel</a>     
        </div> 
@endsection
