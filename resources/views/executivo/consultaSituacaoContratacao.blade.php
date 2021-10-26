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
            <span> PMCMV</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Situação da Contratação nos Estados e Municípios</span>
    </span>
</div>


<div id="content">

<div id="viewlet-above-content-title"></div>
<h1 class="documentFirstHeading">
    Situação da Contratação nos Estados e Municípios
</h1>

<div class="linha-separa"></div>

<div id="viewlet-above-content-body">

</div>
    <div id="content-core">
           <!-- form-group-->              
           <div class="form-group">
               <form action="{{ url('executivo/contratacao') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <select-situacao-contratacao :url="'{{ url('/') }}'"></select-situacao-contratacao>
                        </div>
                    </div>    
                   
                   
                </form> 
              <!--form-group -->
          
          </div>
    </div>
    <!-- content-core-->
</div>
<!-- content-->

@endsection
