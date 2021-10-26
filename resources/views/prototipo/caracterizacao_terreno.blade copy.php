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

    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Caracterizacao Terreno</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Caracterizacao Terreno
        </h2>
        <span class="documentFirstHeadingSpan">
        Nessa seção são solicitadas informações básicas sobre as condições do terreno oferecido para o desenvolvimento do projeto.
        </span>   
        <div class="linha-separa"></div>


    <div id="content-core">
            <!-- form-group-->              
            <div class="form-group">
               <form action="{{ url('prototipo/iniciar/caracterizacaoTerreno/salvar') }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="well">
                        <div class="box">  
                            <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">                                                        
                            <caracterizacao-terreno :url="'{{ url('/') }}'"></caracterizacao-terreno>
                        </div>
                    </div>    
                   
                </form> 
              <!--form-group -->
          
          </div>
          
    </div><!-- content-core-->


</div><!-- content-->



@endsection
