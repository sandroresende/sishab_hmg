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
    <span >Oferta Pública</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Consulta aos Remessas de Devolução</span>
    </span>
</div>  

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
    <h2  class="documentFirstHeading text-center">
    Remessas de Devolução
    </h2>    
    <span class="documentFirstHeadingSpan">Selecione os dados para realização da pesquisa.</span>   
    <div class="linha-separa"></div>
    

    <div id="content-core">
      <!-- form-group-->              
      <div class="form-group">
        
               
                <form id="filtrarPropostas" method="post" action='{{url("/remessa_devolucao")}}'>
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <form id="filtrarPropostas" method="post" action='{{url("/remessa_devolucao")}}'>
                            {{csrf_field()}}
                                <div class="form-group">
                                    <label for="codigo_devolucao">Código da Devolução</label>
                                    <select class="form-control drop" id="remessa_devolucao_id" name="remessa_devolucao_id" required>
                                        <option value="">Selecione uma Remessa</option>
                                        @foreach($remessas as $remessa)
                                            <option value="{{$remessa->id}}">{{$remessa->id}}</option>
                                        @endforeach
                                    </select>
                                </div>                                       
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>    
                            </form>
                        </div>
                    </div>    
                
                
                
              <!--form-group -->
          </div>
          
    </div><!-- content-core-->
</div><!-- content-->



@endsection