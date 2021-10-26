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
        <a href='{{ url("/prototipo/show/levantamento/$caracterizacaoTerreno->prototipo_id") }}'> Formulário de levantamento de informações</a>
        <span class="breadcrumbSeparator">
            &gt;
        
        </span>
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
               <form action="{{ url('prototipo/editar/caracterizacaoTerreno/salvar/') }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="well">
                        <div class="box">  
                            <input type="hidden" class="form-control" id="caracterizacaoTerrenoId" name="caracterizacaoTerrenoId" value="{{$caracterizacaoTerreno->id}}">                                                        
                            <caracterizacao-terreno :url="'{{ url('/') }}'" v-bind:dados="@if($caracterizacaoTerreno) {{json_encode($caracterizacaoTerreno)}} @endif"></caracterizacao-terreno>
                            <button  class="btn-lg btn btn-danger btn-block" onclick="javascript:window.history.go(-1)">Cancelar</button>
                        </div>
                    </div>    
                   
                </form> 
              <!--form-group -->
          
          </div>
          
    </div><!-- content-core-->


</div><!-- content-->



@endsection
