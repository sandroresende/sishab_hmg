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
            <span> PMCMV</span>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Consulta Evolução das Bases - Histórico</span>
        </span>
    </div>


<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Evolução das Bases - Histórico
        </h2>
        <span class="documentFirstHeadingSpan">
        Selecione a posição inicial da base e a posição final para comparar a evolução.  O sistema realizará a diferença entre as bases 
              do relatório executivo referente às posições escolhidas.
        </span>   
        <div class="linha-separa"></div>


    <div id="content-core">
            <!-- form-group-->              
            <div class="form-group">
               <form action="{{ url('executivo/historico') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <select-executivo-posicoes :url="'{{ url('/') }}'"></select-executivo-posicoes>
                        </div>
                    </div>    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
                </form> 
              <!--form-group -->
          
    </div><!-- content-core-->


</div><!-- content-->

        
@endsection
