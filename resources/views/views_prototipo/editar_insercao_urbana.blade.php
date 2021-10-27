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
            :titulo3='"Inserção Urbana"'
            >
            
            </historico-navegacao>  
            <cabecalho-form
                    :barracompartilhar='false'
                    :titulo="'Inserção Urbana'"
                    
                    >
                    <span class="documentFirstHeadingSpan">
                        Nessa seção são solicitadas informações sobre a disponibilidade de equipamentos públicos e serviços urbanos no entorno do terreno disponibilizado para o desenvolvimento do projeto.
                </span> 
                   
            </cabecalho-form> 
            <div class="linha-separa"></div>
             
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-parte1-tab" data-toggle="tab" href="#nav-parte1" role="tab" aria-controls="nav-parte1" aria-selected="true">Parte 1</a>

                <a class="nav-item nav-link" id="nav-parte2-tab" data-toggle="tab" href="#nav-parte2" role="tab" aria-controls="nav-parte2" aria-selected="true">Parte 2</a>

            </div>
          </nav> 

          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-parte1" role="tabpanel" aria-labelledby="nav-parte1-tab">
                <div class="form-group">
                    <form id="form-inserca-urbana" name="form-inserca-urbana" action="{{ url('prototipo/editar/insercaoUrbana/parte1') }}" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="well">
                            <div class="box">                    
                                                                                                          
                                <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">   
                                <input type="hidden" class="form-control" id="insercaoUrbanaId" name="insercaoUrbanaId" value="{{$insercaoUrbana->id}}">                                                           
                                <insercao-urbana-parte1 :url="'{{ url('/') }}'"
                                v-bind:dados="@if($insercaoUrbana) {{json_encode($insercaoUrbana)}}" @endif
                                v-bind:dadosmapa="@if($mapasInsercaoUrbana) {{json_encode($mapasInsercaoUrbana)}}" @endif></insercao-urbana-parte1>
                                
                                                                                                        
                            </div>
                        </div>    
                    </form> 
            </div><!--form-group -->
        </div><!--tab-pane -->

        <div class="tab-pane fade " id="nav-parte2" role="tabpanel" aria-labelledby="nav-parte2-tab">
            <form id="form-inserca-urbana" name="form-inserca-urbana" action="{{ url('prototipo/editar/insercaoUrbana/parte2') }}" role="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="well">
                    <div class="box">                    
                                                                                                  
                        <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">   
                        <input type="hidden" class="form-control" id="insercaoUrbanaId" name="insercaoUrbanaId" value="{{$insercaoUrbana->id}}">                                                           
                        <insercao-urbana-parte2 :url="'{{ url('/') }}'"
                                    v-bind:dadosmapa="@if($mapasInsercaoUrbana) {{json_encode($mapasInsercaoUrbana)}}" @endif
                                    v-bind:dadosrota="@if($rotasInsercaoUrbana) {{json_encode($rotasInsercaoUrbana)}}" @endif
                                    :urlarquivomapa="'{{ url('/prototipo/insercaoUrbana/mapa/adicionar') }}'" 
                                    :urlarquivorota="'{{ url('/prototipo/insercaoUrbana/rota/adicionar') }}'" 
                                    v-bind:prototipo="{{json_encode($prototipo->id)}}" 
                                    token="{{ csrf_token() }}"
                                    acao="editar"
                            ></insercao-urbana-parte2>
                        
                                                                                                
                    </div>
                </div>    
            </form>  
        </div><!--tab-pane -->
        </div><!-- tab-content -->     

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
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


