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
        <span id="breadcrumbs-current">Concepção do Projeto</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Concepção do Projeto
        </h2>
        <span class="documentFirstHeadingSpan">
        Nessa seção, solicita-se o registro de informações sobre eventual projeto já existente ou pretendido para o terreno em questão.
        </span>   
        <div class="linha-separa"></div>


    <div id="content-core">
            <!-- form-group-->              
            <div class="form-group">
               <form action="{{ url('prototipo/editar/concepcaoProjeto/salvar') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">  
                 
                        <div class="linha-separa"></div>   
                        <input type="hidden" class="form-control" id="concepcaoProjetoId" name="concepcaoProjetoId" value="{{$concepcaoProjeto->id}}">                                                                                                                                
                            <concepcao-projeto :url="'{{ url('/') }}'"  v-bind:dados="@if($concepcaoProjeto) {{json_encode($concepcaoProjeto)}} @endif"></concepcao-projeto>
                        </div>
                    </div>    
                   
                </form> 
              <!--form-group -->
          
          </div>
          
    </div><!-- content-core-->


</div><!-- content-->



@endsection
