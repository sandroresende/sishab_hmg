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
            
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-contratados" role="tabpanel" aria-labelledby="nav-contratados-tab">
                <div  class="titulo">
                        <h5>Lista de Vinculadas</h5> 
                </div>
                <tabela-relatorios-id
                        v-bind:titulos="{{$cabecalhoProjetosPac}}"
                        v-bind:itens="{{$projetosPac}}"

                        :show="'{{ url('/vinculadas/projeto') }}'"
                    >           
                </tabela-relatorios-id> 
            </div><!--nav-contratados -->

           
        </div>


        
     
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
    
    </div><!-- content-core-->
</div><!-- content-->

@endsection
