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
            <span id="breadcrumbs-current">Consulta de Beneficiários</span>
    </span>
</div>


<div id="content">

<div id="viewlet-above-content-title"></div>
<h1 class="documentFirstHeading">
    Consulta de Beneficiários
</h1>

<div class="linha-separa"></div>

<div id="viewlet-above-content-body">

</div>
    <div id="content-core">
           <!-- form-group-->              
           <div class="form-group">
               <form action="{{ url('beneficiarios/consulta') }}" method="POST">
                    @csrf
                    
                    <div class="well">
                        <div class="box">                                                                                 
                            <consulta-beneficiario 
                                :url="'{{ url('/') }}'"
                                coluf="column col-md-4"
                                colmun="column col-md-8">
                                                
                            </consulta-beneficiario>
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
