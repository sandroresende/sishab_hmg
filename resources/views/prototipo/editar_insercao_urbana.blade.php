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
        <span id="breadcrumbs-current">Inserção Urbana</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Inserção Urbana
        </h2>
        <span class="documentFirstHeadingSpan">
        Nessa seção são solicitadas informações sobre a disponibilidade de equipamentos públicos e serviços urbanos no entorno do terreno disponibilizado para o desenvolvimento do projeto.
        </span> 
          
        <div class="linha-separa"></div>
       

    <div id="content-core">
            <!-- form-group-->              
            <div class="form-group">
               <form action="{{ url('prototipo/editar/insercaoUrbana/salvar') }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="well">
                        <div class="box">                   
                             <div class="linha-separa"></div>                                                                            
                             <input type="hidden" class="form-control" id="insercaoUrbanaId" name="insercaoUrbanaId" value="{{$insercaoUrbana->id}}">                                                        
                            <insercao-urbana 
                                :url="'{{ url('/') }}'"
                                v-bind:dados="@if($insercaoUrbana) {{json_encode($insercaoUrbana)}}" @endif
                                ></insercao-urbana>
                        </div>    
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Salvar</button>
                    </div>    
                </form> 
          </div><!--form-group -->
          <div class="form-group">
            <button  class="btn-lg btn btn-danger btn-block" onclick="javascript:window.history.go(-1)">Cancelar</button>
        </div><!--form-group -->
          
    </div><!-- content-core-->


</div><!-- content-->



@endsection
