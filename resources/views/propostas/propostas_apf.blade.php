

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
         
        <div class="linha-separa"></div>


    <div id="content-core">
    <colunas-duas-situacao v-bind:itens="{{$propostas}}" :url="'{{ url('/') }}'">             </colunas-duas-situacao>
        
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
            
        </div> 
@endsection
