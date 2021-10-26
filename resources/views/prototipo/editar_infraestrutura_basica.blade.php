@extends('layouts.app')

@section('content')

<div class="card-header text-white text-center">
            <strong><h2></h2></strong> 
            <h5></h5>              
          </div>



          <div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
        <a href="{{ url('/prototipo') }}">Página Inicial</a>
        <span class="breadcrumbSeparator">
            &gt;            
        </span>
    </span>
    
    <span dir="ltr" id="breadcrumbs-1">        
    <span >Proposta</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href='{{ url("/prototipo/show/levantamento/$prototipo->id") }}'> Formulário de levantamento de informações</a>
        <span class="breadcrumbSeparator">
            &gt;
        
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Infraestrutura Básica</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Infraestrutura Básica
        </h2>
        <span class="documentFirstHeadingSpan">
        A seguir solicita-se o registro de informações sobre a disponibilidade de infraestrutura para servir ao terreno ofertado (infraestrutura não incidente).
        </span>   
        <div class="linha-separa"></div>


    <div id="content-core">
            <!-- form-group-->              
            <div class="form-group">
               <form action="{{ url('prototipo/editar/infraestruturaBasica/salvar') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">  
                 
                        <div class="linha-separa"></div>  
                            <input type="hidden" class="form-control" id="infraestrututaBasicaId" name="infraestrututaBasicaId" value="{{$infraestrututaBasica->id}}">                                                                                                                                  
                            <infraestrutura-basica 
                                            :url="'{{ url('/') }}'"
                                            v-bind:dados="@if($infraestrututaBasica) {{json_encode($infraestrututaBasica)}}" @endif
                            ></infraestrutura-basica>
                        </div>
                    </div>    
                   
                </form> 
              <!--form-group -->
          
          </div>
          
    </div><!-- content-core-->


</div><!-- content-->



@endsection
