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
            :titulo2='"Inserção Urbana"'
            >
            
            </historico-navegacao>  
            <cabecalho-form
                    :barracompartilhar='false'
                    :titulo="'Inserção Urbana'"
                    :subTitulo1="'PARTE 2'"
                    >
                    <span class="documentFirstHeadingSpan">
                        Nessa seção são solicitadas informações sobre a disponibilidade de equipamentos públicos e serviços urbanos no entorno do terreno disponibilizado para o desenvolvimento do projeto.
                    </span> 
                   
            </cabecalho-form> 
            <div class="linha-separa"></div>
            <!-- form-group-->              
            <div class="form-group">
                <form id="form-inserca-urbana" name="form-inserca-urbana" action="{{ url('prototipo/iniciar/insercaoUrbana/parte2/salvar') }}" role="form" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="well">
                         <div class="box">  
                  
                              <div class="linha-separa"></div>                                                                            
                              <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">                                                        
                             <insercao-urbana-parte2 :url="'{{ url('/') }}'"
                                     v-bind:dadosmapa="@if($mapasInsercaoUrbana) {{json_encode($mapasInsercaoUrbana)}}" @endif
                                     v-bind:dadosrota="@if($rotasInsercaoUrbana) {{json_encode($rotasInsercaoUrbana)}}" @endif
                                     :urlarquivomapa="'{{ url('/prototipo/insercaoUrbana/mapa/adicionar') }}'" 
                                     :urlarquivorota="'{{ url('/prototipo/insercaoUrbana/rota/adicionar') }}'" 
                                     v-bind:prototipo="{{json_encode($prototipo->id)}}" 
                                     token="{{ csrf_token() }}"
                                     acao="salvar"
                             ></insercao-urbana-parte2>
                             
                             <div class="linha-separa"></div>      
                         </div>
                     </div>    
                 </form> 
               <!--form-group -->           
           </div>
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


