@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            :url="'{{ url('/prototipo') }}'"
            :titulo1="'Protótipo de HIS'"
            :titulo2='"Infraestrutura Básica"'
            >
            
            </historico-navegacao>  
            <cabecalho-form
                    :barracompartilhar='false'
                    :titulo="'Infraestrutura Básica'"
                    
                    >
                    <span class="documentFirstHeadingSpan">
                
                        A seguir solicita-se o registro de informações sobre a disponibilidade de infraestrutura para servir ao terreno ofertado (infraestrutura não incidente).
                </span> 
                   
            </cabecalho-form> 
            <div class="linha-separa"></div>
             <!-- form-group-->              
            <div class="form-group">
                <form action="{{ url('prototipo/iniciar/infraestruturaBasica/salvar') }}" method="POST">
                     @csrf
                     <div class="well">
                         <div class="box">  
                  
                         <div class="linha-separa"></div>  
                             <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">                                                                                                                                  
                             <infraestrutura-basica :url="'{{ url('/') }}'"></infraestrutura-basica>
                         </div>
                     </div>    
                    
                 </form> 
               <!--form-group -->

            
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


