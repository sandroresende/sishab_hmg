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
   
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Consulta Situação da Seleção no Município</span>
    </span>
</div> 

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Situação da Seleção no município
        </h2>
        <span class="documentFirstHeadingSpan">Selecione os dados para realização do filtro.</span>   
        <div class="linha-separa"></div>


    <div id="content-core">
      <!-- form-group-->              
      <div class="form-group">
          <form action="{{ url('selecao/resumo/') }}" method="POST">
              @csrf
              <div class="well">
                  <div class="box">                                                                                 
                      <select-mult-municipio :url="'{{ url('/') }}'"></select-mult-municipio>
                  </div>
              </div>    
              <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
          </form> 
          </div><!--form-group -->
    </div><!-- content-core-->
</div><!-- content-->


@endsection
