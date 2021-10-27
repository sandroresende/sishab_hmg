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
            :titulo2='"Caracterização do Terreno"'
            >
            
            </historico-navegacao>  
            <cabecalho-form
                    :barracompartilhar='false'
                    :titulo="'Caracterização do Terreno'"
                    :subTitulo1="'PARTE 3'"
                    >
                    <span class="documentFirstHeadingSpan">
                
                        Nessa seção são solicitadas informações básicas sobre as condições do terreno oferecido para o desenvolvimento do projeto.
                </span> 
                   
            </cabecalho-form> 
            <div class="linha-separa"></div>
             <!-- form-group-->              
            <div class="form-group">
                <form action="{{ url('prototipo/iniciar/caracterizacaoTerreno/parte3/salvar/') }}" role="form" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">  
                            <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">                                                        
                            <caracterizacao-terreno-parte3 :url="'{{ url('/') }}'" 
                                                            :urlarquivo="'{{ url('/prototipo/caracterizacaoTerreno/planta/adicionar') }}'" 
                                                            v-bind:prototipo="{{json_encode($prototipo->id)}}" 
                                                            token="{{ csrf_token() }}"
                                                            acao="salvar"
                                                            v-bind:dadosplanta="@if($plantasTerreno) {{json_encode($plantasTerreno)}}" @endif>
                            
                            </caracterizacao-terreno-parte3>
                        </div>
                    </div>    
                   
                </form> 
               <!--form-group -->    

            
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


