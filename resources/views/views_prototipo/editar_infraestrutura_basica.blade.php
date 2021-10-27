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
            :titulo2='"Minhas Propostas"'
            :link2="'{{ url('/propostas') }}'"
            :titulo3='"Infraestrutura Básica"'
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
                <form action="{{ url('prototipo/editar/infraestruturaBasica/salvar') }}" method="POST">
                     @csrf
                     <div class="well">
                         <div class="box">  
                  
                         <div class="linha-separa"></div>  
                             <input type="hidden" class="form-control" id="infraestrututaBasicaId" name="infraestrututaBasicaId" value="{{$infraestrututaBasica->id}}">                                                                                                                                  
                             <infraestrutura-basica 
                                             :url="'{{ url('/') }}'"
                                             v-bind:dados="@if($infraestrututaBasica) {{json_encode($infraestrututaBasica)}}" @endif
                             ></infraestrutura-basica>
                         </div>
                     </div>    
                    
                 </form> 
               <!--form-group -->
                                                     
               <div class="form-group">
                <div class="row text-center">
                    <div class="column col-sm-12 col-xs-12">
                        <botao-acao  
                            :url="'{{ url("/prototipo/show/levantamento")}}'" 
                            registro="{{$prototipo->id}}"                               
                            cssbotao="btn btn-lg btn-danger btn-block"                               
                            textobotao="Cancelar" 
                            tipobotao="button-danger"
                        ></botao-acao>  
                    </div>    
                </div>    
            </div><!-- form-group--> 
            
           </div>
            </div><!-- tab-content -->    

            
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


