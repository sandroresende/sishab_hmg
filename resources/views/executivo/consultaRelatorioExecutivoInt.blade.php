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
    <span >PMCMV</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Consulta Relatório Executivo</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Relatório Executivo 
        </h2>
        <span class="documentFirstHeadingSpan">
            Selecione os dados para realização da pesquisa.  Para pesquisar os dados referente ao Brasil clique no botão pesquisar sem aplicar nenhum filtro.
        </span>   
        <div class="linha-separa"></div>


    <div id="content-core">
            <!-- form-group-->              
            <div class="form-group">
               <form action="{{ url('novo_executivo/relatorio') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                        <select-painel :url="'{{ url('/') }}'"    vidvigente = "true" ateano = "true"></select-painel>
                            <DIV>
                            <a class="btn btn-outline-secondary btn-block text-reset" href='{{ url("executivo/download/base")}}'>Donwload para Excel</a>
                            </DIV>   
                        </div>
                    </div>    
                   
                </form> 
              <!--form-group -->
          
          </div>
    </div><!-- content-core-->


</div><!-- content-->



@endsection
