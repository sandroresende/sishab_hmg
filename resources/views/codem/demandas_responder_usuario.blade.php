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
            <span> Codem</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Demadas a Responder</span>
    </span>
</div>


<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Demadas a Responder
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
  <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center ">
                            <th>#</th>  
                            <th>ID</th>  
                            <th>UF</th>  
                            <th>Município</th>  
                            <th>Data Solicitação</th>  
                            <th>Previsão Conclusão</th>  
                            <th>Atraso</th>  
                            <th>Interessado (s)</th>  
                            <th>Descrição</th>  
                            <th class="acao">Ação</th>
                        </tr>
                    </thead>
                    <tbody> 
                    @foreach($demandasUsuario as $demanda)  
                                    @if($demanda->qtd_dias_atraso>0)
                                    <tr  class="conteudoTabela table-danger" >                            
                                    @else
                                    <tr  class="conteudoTabela" >                            
                                    @endif               
                        
                            <td>
                                @if($demanda->bln_visualizada)
                                    <i class="fas fa-envelope-open fa-2x" style="color:green;"></i>                                   
                                @else
                                     <i class="fas fa-envelope fa-2x" style="color:gray;"></i>                                   
                                @endif
                            </td>
                            <td>{{$demanda->id}}</td>
                            <td>{{$demanda->txt_sigla_uf}}</td>
                            <td>{{$demanda->ds_municipio}}</td>
                            <td>{{($demanda->dte_solicitacao) ? date('d/m/Y',strtotime($demanda->dte_solicitacao)) : ''}}</td>
                            <td>{{($demanda->dte_previsao_conclusao) ? date('d/m/Y',strtotime($demanda->dte_previsao_conclusao)) : ''}}</td>
                            <td>{{($demanda->qtd_dias_atraso)>0 ? $demanda->qtd_dias_atraso : 0}}</td>
                            <td>{{$demanda->txt_nome_interessado}}</td>
                            <td>{{$demanda->txt_descricao_demanda}}</td>
                            <td class="acao"><a href='{{ url("demanda/$demanda->id")}}'><i class="fas fa-search"></i></a></td>                              
                        </tr>                              
                    @endforeach        
                    </tbody>
                </table> 
            </div>
            <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">         
    </div>
    <!-- content-core-->
</div>
<!-- content-->

@endsection
