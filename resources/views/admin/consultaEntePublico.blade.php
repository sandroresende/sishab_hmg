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
            <span> Seleção de Demanda</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Consulta de Entes Públicos</span>
    </span>
</div>


<div id="content">

<div id="viewlet-above-content-title"></div>
<h1 class="documentFirstHeading">
    Consulta de Entes Públicos
</h1>

<div class="linha-separa"></div>

<div id="viewlet-above-content-body">

</div>
    <div id="content-core">
           <!-- form-group-->              
           <div class="form-group">
               <form action="{{ url('admin/entePublicos') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <select-uf-municipio 
                            coluf="column col-xs-12 col-sm-6"
                            colmun="column col-xs-12 col-sm-6"
                            :url="'{{ url('/') }}'"></select-uf-municipio>
                        </div>
                    </div>    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
                </form> 
              <!--form-group -->
          
          </div>
    </div>
    <!-- content-core-->
</div>
<!-- content-->

@endsection
