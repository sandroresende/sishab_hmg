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
            <span id="breadcrumbs-current">Demadas Atrasadas</span>
    </span>
</div>


<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Demadas Atrasadas
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
                    @foreach($demandasAtrasadas as $demanda)                 
                        <tr  class="conteudoTabela">                            
                            <td>{{$demanda->id}}</td>
                            <td>{{$demanda->txt_sigla_uf}}</td>
                            <td>{{$demanda->ds_municipio}}</td>
                            <td>{{date('d/m/Y',strtotime($demanda->dte_solicitacao))}}</td>
                            <td>{{date('d/m/Y',strtotime($demanda->dte_previsao_conclusao))}}</td>
                            <td>{{$demanda->qtd_dias_atraso}}</td>
                            <td>{{$demanda->txt_nome_interessado}}</td>
                            <td>{{$demanda->txt_descricao_demanda}}</td>
                            <td class="acao"><a href='{{ url("demanda/$demanda->id")}}'><i class="fas fa-search"></i></a></td>                               
                        </tr>                              
                    @endforeach        
                    </tbody>
                </table> 
                <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
    </div>
    <!-- content-core-->
</div>
<!-- content-->


@endsection
