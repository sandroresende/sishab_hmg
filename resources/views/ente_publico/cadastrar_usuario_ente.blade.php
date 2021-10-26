@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/entePublico') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> Ente Público</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Cadastrar Usuário</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Cadastrar Usuário
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">


  
    <div class="titulo">
        <h5>Dados do Usuário </h5> 
        
    </div>
    
    <form class="form-horizontal" role="form" method="POST" action='{{ url("/usuario/ente_publico/salvar") }}'>
    
    @csrf
    <div class="well">
        <div class="box">                                                                                 
            <cadastro_usu_ente :url="'{{ url('/') }}'"></cadastro_usu_ente>
        </div>
    </div> 
 
    </form>
    
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection