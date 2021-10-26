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
            <a href="{{url('/beneficiarios/filtro')}}">Consulta Beneficiários</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current"> Beneficiários</span>
        </span>
    </div> 
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
    
            @if($municipio) 
            <h1  class="documentFirstHeading"> {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}}           </h1>
            @elseif($estado)                 
            <h1  class="documentFirstHeading"> {{$estado->txt_uf}}   </h1>
            @elseif($cpfDigitado)  
                @foreach($dadosBeneficiarios as $dados)               
                <h3  class="documentFirstHeading text-center"> {{$dados->txt_nome_beneficiario}}   </h3>
                <h4 class="documentFirstHeading text-center">{{$dados->txt_cpf_beneficiario}}</h4>
                <span class="documentFirstHeadingSpan">{{$dados->ds_municipio}}-{{$dados->txt_sigla_uf}}</span>   
                @endforeach 
            @else
                <h1 class="documentFirstHeading text-center">Lista de Beneficiários</h1>
                
            @endif 
            <span class="documentFirstHeadingSpan">Resultado: {{count($dadosBeneficiarios)}} beneficiários</span>   

   
    <div id="content-core">
        @if(!$cpfDigitado)
           
         <tabela-relatorios
                v-bind:titulos="{{json_encode($cabecalhoTab)}}"
                v-bind:itens="{{json_encode($dadosBeneficiarios)}}"  
            >
        </tabela-relatorios> 
        @endif
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
   
    </div><!-- content-core-->
</div><!-- content-->

@endsection
