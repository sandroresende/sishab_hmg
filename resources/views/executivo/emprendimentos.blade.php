@extends('layouts.app')
@section('scripts')
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- Section-->
<div id="portal-breadcrumbs">
        <span id="breadcrumbs-you-are-here">Você está aqui:</span>
        <span id="breadcrumbs-home">
            <a href="{{ url('/home') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-1">        
            <span> PMCMV</span>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
        <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/executivo/empreendimentos/filtro')}}">Consulta Empreendimentos</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current"> Empreendimentos</span>
        </span>
    </div> 
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
    <h1  class="documentFirstHeading">
            @if($modalidade) 
                {{$modalidade->txt_modalidade}}
            @elseif($municipio) 
                {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}}
           
            @else
                @if($estado)
                    {{$estado->txt_uf}}
                @else
                    {{$regiao->txt_regiao}}  
                @endif
            @endif 
    </h1>

    <span class="documentFirstHeadingSpan">
            @if($modalidade)             
                @if($municipio) 
                    {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}}
                @elseif($estado)
                    {{$estado->txt_uf}}
                @elseif($estado)
                    {{$regiao->txt_regiao}}  
                @else
                    Brasil
                @endif
            @endif    
    </span>   
       <div class="documentByLine" id="plone-document-byline">
            <span class="documentAuthor">por <span>Secretaria Nacional da Habitação</span> —</span><!-- autor-->
            <span class="documentModified"><span>última atualização</span> {{date('d/m/Y',strtotime($dataPosicao->dte_posicao))}}</span><!-- data atualização-->
            
        </div>  
    <div class="documentByLine" id="plone-document-byline">
    <div id="motivoNaoEnquadramento" class="titulo">
                <h5>Quadro Resumo</h5> 
        </div>
        <table class="table  table-striped table-hover table-sm tab_executivo">
          <thead>
            <tr class="text-center">
              <th scope="col">Modalidade</th>
              <th scope="col">Qtd Empreendimentos</th>
              <th scope="col">Uh Contratadas (Contr.)</th>
              <th scope="col">Uh Concluídas (Conc.)</th>
              <th scope="col">Uh Entregues (Entr.)</th>
              <th scope="col">Valor</th>
            </tr>
          </thead>
          <tbody>
          
            @foreach($resumoOperacoes as $resumo)
            <tr>
              <td scope="row">{{$resumo->txt_modalidade}}</td>
              <td class="text-center">{{number_format($resumo->qtd_empreendimentos, 0, ',' , '.')}}</td>
              <td class="text-center">{{number_format($resumo->qtd_num_uh, 0, ',' , '.')}}</td>
              <td class="text-center">{{number_format($resumo->qtd_num_concluidas, 0, ',' , '.')}}</td>
              <td class="text-center">{{number_format($resumo->qtd_num_entregues, 0, ',' , '.')}}</td>
              <td class="text-center">{{number_format($resumo->qtd_num_vlr_total, 2, ',' , '.')}}</td>
            </tr>
            @endforeach
            
           
            <tr>
            <th scope="col">Total</th>
              <th scope="col">{{number_format($totalResumo['total_qtd_empreendimentos'], 0, ',' , '.')}}</th>
              <th scope="col">{{number_format($totalResumo['total_qtd_num_uh'], 0, ',' , '.')}}</th>
              <th scope="col">{{number_format($totalResumo['total_qtd_num_concluidas'], 0, ',' , '.')}}</th>
              <th scope="col">{{number_format($totalResumo['total_qtd_num_entregues'], 0, ',' , '.')}}</th>
              <th scope="col">{{number_format($totalResumo['total_qtd_num_vlr_total'], 2, ',' , '.')}}</th>
            </tr>
            
          </tbody>
        </table>
        </div>
    <div id="viewlet-above-content-body">


    </div>
    <div id="content-core">
        <div id="motivoNaoEnquadramento" class="titulo">
                <h5>Lista de Empreendimentos</h5> 
        </div>
        <tabela-relatorios-id
                v-bind:titulos="{{$cabecalhoTab}}"
                v-bind:itens="{{json_encode($operacoes)}}"  

                :show="'{{ url('/executivo/empreendimento/') }}'"
            >
            <th scope="col">Total</th>
                    <th scope="col">{{number_format($totalResumo['total_qtd_empreendimentos'], 0, ',' , '.')}}</th>
                    <th scope="col">{{number_format($totalResumo['total_qtd_num_uh'], 0, ',' , '.')}}</th>
                    <th scope="col">{{number_format($totalResumo['total_qtd_num_concluidas'], 0, ',' , '.')}}</th>
                    <th scope="col">{{number_format($totalResumo['total_qtd_num_entregues'], 0, ',' , '.')}}</th>
                    <th scope="col">{{number_format($totalResumo['total_qtd_num_vlr_total'], 2, ',' , '.')}}</th>
                    </tr>
        </tabela-relatorios-id> 
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
    <a class="btn btn-lg btn-light btn-block" href='{{ url("executivo/empreendimentos-download"."/".$dadosEmpreendimento["regiao"]."/".$dadosEmpreendimento["estado"]."/".$dadosEmpreendimento["municipio"]."/".$dadosEmpreendimento["modalidade"]."/".$dadosEmpreendimento["empreendimento"]."/".$dadosEmpreendimento["faixa"])}}' class="btn btn-lg btn-block btn-default">Download para Excel</a>     
    </div><!-- content-core-->
</div><!-- content-->

@endsection
