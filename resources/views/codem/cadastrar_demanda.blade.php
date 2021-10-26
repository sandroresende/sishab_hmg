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
            <span> Codem</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Cadastrar Demanda</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Cadastrar Demanda
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Dados da Demanda </h5> 
        
    </div>
    <form role="form" method="POST" action='{{ url("demanda/nova") }}'>
    @csrf
        <cadastro-demanda :url="'{{ url('/') }}'"></cadastro-demanda>     
        <div class="container-fluid" >
      <button class="btn-lg btn btn-success btn-block" type="submit">Salvar</button>
      <input class="btn btn-lg btn-danger btn-block" type="button" name="cancelar" value="Cancelar">         
    </div>
    </form>   
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection