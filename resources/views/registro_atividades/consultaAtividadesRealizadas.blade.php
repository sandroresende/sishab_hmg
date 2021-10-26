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
            <span> Painel</span>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Consulta Atividades Realizadas</span>
        </span>
    </div>


<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Atividades Realizadas
        </h2>
        <span class="documentFirstHeadingSpan">
        Selecione os dados para realização da pesquisa.  Para pesquisar os dados referente ao Brasil clique no botão pesquisar sem aplicar nenhum filtro.
        </span>   
        <div class="linha-separa"></div>


    <div id="content-core">
            <!-- form-group-->              
            <div class="form-group">
               <form action="{{ url('painel/paralisadas') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <consulta-atividades :url="'{{ url('/') }}'"></consulta-atividades>
                        </div>
                    </div>    
                   
                </form> 
              <!--form-group -->
          
    </div><!-- content-core-->


</div><!-- content-->

        
@endsection
