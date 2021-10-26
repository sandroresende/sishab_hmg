@extends('layouts.app')

 @section('scripts')
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> @endsection @section('content')
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
            <span> PMCMV</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/executivo/historico/filtro')}}">Consulta Evolução das Bases - Histórico</a>
            <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Evolução das Bases</span>
    </span>
</div>

    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">

    <div id="viewlet-above-content-title"></div>
    <h1 class="documentFirstHeading">
                    @if($municipio) 
                        {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}} 
                    @else
                        @if($estado)
                            {{$estado->txt_uf}}
                        @endif
                    @endif 

                    @if($rm_ride)
                        {{$rm_ride}}
                    @endif

                    @if($regiao)
                        {{$regiao->txt_regiao}}    
                    @endif

                    @if(!$municipio && !$estado && !$rm_ride && !$regiao)
                        BRASIL
                    @endif
    </h1>
    <span class="documentFirstHeadingSpan">Período de {{date('d/m/Y',strtotime($dataPosicaoDeSelecionada))}} até {{date('d/m/Y',strtotime($posicaoAte->dte_posicao_arquivo))}}</span>
    <div class="linha-separa"></div>

    <div id="viewlet-above-content-body">

    </div>
    <div id="content-core">
        <div class="titulo">
            <h5>Posição Inicial: {{date('d/m/Y',strtotime($dataPosicaoDeSelecionada))}}</h5>
        </div>
        <table-executivo :dados="{{$executivoPosicaoDe}}"> </table-executivo>
        <!--Tabela MCMV 1-->
        <div class="titulo">
            <h5>Posição Final: {{date('d/m/Y',strtotime($posicaoAte->dte_posicao_arquivo))}}</h5>
        </div>
        <table-executivo :dados="{{$executivoPosicaoAte}}"> </table-executivo>
        <!--Tabela MCMV 1-->
        <div class="titulo">
            <h5>Relatório Executivo</h5>
        </div>
        <table-executivo :dados="{{$executivoDiferenca}}"> </table-executivo>

        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">
            Voltar
        </button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">
    </div>
    <!-- content-core-->
</div>
<!-- content-->

@endsection
<!--  Section-->