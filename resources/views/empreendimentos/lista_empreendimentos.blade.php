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
            <a href="{{url('/empreendimentos/filtro')}}">Consulta Empreendimentos</a>
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


    <span class="documentFirstHeadingSpan">
                   
                @if($municipio) 
                    {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}}
                @elseif($estado)
                    {{$estado->txt_uf}}
                @elseif($estado)
                    {{$regiao->txt_regiao}}  
                @else
                    Brasil
                @endif
           
    </span>   
       
    
    <div id="viewlet-above-content-body">


    </div>
    <div id="content-core">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
          
            @if(count($empreendimentosContratados)>0)
                <a class="nav-item nav-link active" id="nav-contratados-tab" data-toggle="tab" href="#nav-contratados" role="tab" aria-controls="nav-contratados" aria-selected="true">Contratados</a>
            @endif

            @if(count($situacoesSelecionadas)==0)
                @if(count($empreendimentosNaoContratados)>0)

                    <a class="nav-item nav-link" id="nav-naocontratados-tab" data-toggle="tab" href="#nav-naocontratados" role="tab" aria-controls="nav-naocontratados" aria-selected="false">Não Contratados</a>
                @endif
            @endif    
            </div>
        </nav>
        @if(count($empreendimentosContratados)>0)
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-contratados" role="tabpanel" aria-labelledby="nav-contratados-tab">
                <div  class="titulo">
                        <h5>Lista de Empreendimentos Contratados</h5> 
                </div>
                <a class="btn btn-lg btn-light btn-block" href='{{ url("empreendimentos/contratados/download"."/".$dadosEmpreendimento["estado"]."/".$dadosEmpreendimento["municipio"])}}' class="btn btn-lg btn-block btn-default">Download para Excel</a>     
                <tabela-relatorios
                        v-bind:titulos="{{$cabecalhoTabContratados}}"
                        v-bind:itens="{{json_encode($empreendimentosContratados)}}"

                        :show="'{{ url('/empreendimentos/') }}'"
                    >           
                </tabela-relatorios> 
            </div><!--nav-contratados -->
    @endif
    
    @if(count($situacoesSelecionadas)==0)
            <div class="tab-pane fade show" id="nav-naocontratados" role="tabpanel" aria-labelledby="nav-naocontratados-tab">
                <div class="titulo">
                        <h5>Lista de Empreendimentos Não Contratados</h5> 
                </div>
                
                <tabela-relatorios-id
                        v-bind:titulos="{{$cabecalhoTabNaoContratados}}"
                        v-bind:itens="{{json_encode($empreendimentosNaoContratados)}}"

                        :show="'{{ url('/proposta/') }}'"
                    >           
                </tabela-relatorios-id>     
                <a class="btn btn-lg btn-light btn-block" href='{{ url("empreendimentos/contratados/download"."/".$dadosEmpreendimento["estado"])}}' class="btn btn-lg btn-block btn-default">Download para Excel</a>     
             </div><!--nav-naocontratados -->
        </div>
    @endif

        
     
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
    
    </div><!-- content-core-->
</div><!-- content-->

@endsection
