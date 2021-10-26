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
        <span id="breadcrumbs-current">Indeferir Permissão</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Indeferir Permissão {{$permissao->id}}
        </h2>
        
        <div class="linha-separa"></div>
        <div>
       
      
        <form id="form_enviar" action="{{ url('admin/permissao/indeferir/salvar') }}" method="post">
        @csrf
        <detalhamento-indeferimento :url="'{{ url('/') }}'"  registro= "{{$permissao->id}}">
        
        </detalhamento-indeferimento>
        <form>

</div><!-- content-->



@endsection
