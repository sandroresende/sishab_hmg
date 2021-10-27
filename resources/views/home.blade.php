@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet">

@endsection

@section('content')

<div id="content">
  <a class="btn btn-link" target="_blank" href="https://www.gov.br/mdr/pt-br/assuntos/habitacao/casa-verde-e-amarela/casa-verde-e-amarela">
    <img class src="{{ asset('img/folder-site_mdr-dd86f69a-b2cd-489c-92f2-ea2cd6637e18.jpeg') }}" width="1150" height="200" class="left" alt="">
  </a>  

  <div class="linha-separa"></div>

      
  </div>

  @include('views_sishab.operacoes.painel_executivo')

  <div class="linha-separa"></div>

  @include('views_gerais.atalhos_consultas')

  <div class="linha-separa"></div>





@endsection

