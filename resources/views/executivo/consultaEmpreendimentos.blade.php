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
            <span id="breadcrumbs-current">Consulta Empreendimentos</span>
        </span>
    </div>

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Empreendimentos
        </h2>
        <span class="documentFirstHeadingSpan">Selecione os dados para realização do filtro.</span>   
        <div class="linha-separa"></div>
          


    <div id="content-core">
         <!-- form-group-->              
         <div class="form-group">
          <form action="{{ url('executivo/empreendimentos') }}" method="POST">
              @csrf
              <div class="well">
                  <div class="box">                                                                                 
                  <select-empreendimento :url="'{{ url('/') }}'"></select-empreendimento>  
                  </div>
              </div>    
              <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
          </form> 
        <!--form-group -->
    </div><!-- content-core-->
</div><!-- content-->


@endsection
