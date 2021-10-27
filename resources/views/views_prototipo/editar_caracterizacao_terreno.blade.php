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
            :titulo3='"Caracterização do Terreno"'
            >
            
            </historico-navegacao>  
            <cabecalho-form
                    :barracompartilhar='false'
                    :titulo="'Caracterização do Terreno'"
                    
                    >
                    <span class="documentFirstHeadingSpan">
                
                        Nessa seção são solicitadas informações básicas sobre as condições do terreno oferecido para o desenvolvimento do projeto.
                </span> 
                   
            </cabecalho-form> 
            <div class="linha-separa"></div>
             <!-- form-group-->              
             <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <a class="nav-item nav-link active" id="nav-parte1-tab" data-toggle="tab" href="#nav-parte1" role="tab" aria-controls="nav-parte1" aria-selected="true">Parte 1</a>

                  <a class="nav-item nav-link" id="nav-parte2-tab" data-toggle="tab" href="#nav-parte2" role="tab" aria-controls="nav-parte2" aria-selected="true">Parte 2</a>

                  <a class="nav-item nav-link" id="nav-parte3-tab" data-toggle="tab" href="#nav-parte3" role="tab" aria-controls="nav-parte3" aria-selected="true">Parte 3</a>
              </div>
            </nav>  
         
          
          <!-- tab-content -->  
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-parte1" role="tabpanel" aria-labelledby="nav-parte1-tab">
                <!-- form-group-->              
                  <div class="form-group">
                    <form action="{{ url('prototipo/editar/caracterizacaoTerreno/parte1/') }}" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="well">
                            <div class="box">  
                                <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">      
                                <input type="hidden" class="form-control" id="caracterizacaoTerrenoId" name="caracterizacaoTerrenoId" value="{{$caracterizacaoTerreno->id}}">                                                                                                          
                                <caracterizacao-terreno-parte1 :url="'{{ url('/') }}'" 
                                v-bind:dados="@if($caracterizacaoTerreno) {{json_encode($caracterizacaoTerreno)}} @endif"
                                v-bind:dadosplanta="@if($plantasTerreno) {{json_encode($plantasTerreno)}}" @endif ></caracterizacao-terreno-parte1>
                            </div>
                          </div>
                    </form>                    
                  </div> <!--form-group -->
                </div> <!-- tab-pane -->     

                <div class="tab-pane fade" id="nav-parte2" role="tabpanel" aria-labelledby="nav-parte2-tab">
                  <!-- form-group-->              
                    <div class="form-group">
                      <form action="{{ url('prototipo/editar/caracterizacaoTerreno/parte2/') }}" role="form" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="well">
                              <div class="box">  
                                  <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">      
                                  <input type="hidden" class="form-control" id="caracterizacaoTerrenoId" name="caracterizacaoTerrenoId" value="{{$caracterizacaoTerreno->id}}">                                                                                                          
                                  <caracterizacao-terreno-parte2 :url="'{{ url('/') }}'" 
                                  v-bind:dados="@if($caracterizacaoTerreno) {{json_encode($caracterizacaoTerreno)}} @endif"
                                  v-bind:dadosplanta="@if($plantasTerreno) {{json_encode($plantasTerreno)}}" @endif ></caracterizacao-terreno-parte2>
                              </div>
                            </div>
                      </form>                    
                    </div> <!--form-group -->
                  </div> <!-- tab-pane -->
                  
                  <div class="tab-pane fade" id="nav-parte3" role="tabpanel" aria-labelledby="nav-parte3-tab">
                    <!-- form-group-->              
                      <div class="form-group">
                        <form action="{{ url('prototipo/editar/caracterizacaoTerreno/parte3/') }}" role="form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="well">
                                <div class="box">  
                                    <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">      
                                    <input type="hidden" class="form-control" id="caracterizacaoTerrenoId" name="caracterizacaoTerrenoId" value="{{$caracterizacaoTerreno->id}}">                                                                                                          
                                    <caracterizacao-terreno-parte3 :url="'{{ url('/') }}'" 
                                    :urlarquivo="'{{ url('/prototipo/caracterizacaoTerreno/planta/adicionar') }}'" 
                                    v-bind:prototipo="{{json_encode($prototipo->id)}}" 
                                    v-bind:dados="@if($caracterizacaoTerreno) {{json_encode($caracterizacaoTerreno)}} @endif"
                                    v-bind:dadosplanta="@if($plantasTerreno) {{json_encode($plantasTerreno)}}" @endif 
                                    token="{{ csrf_token() }}"
                                    acao="editar"></caracterizacao-terreno-parte3>
                                </div>
                              </div>
                        </form>   
                                         
                      </div> <!--form-group -->
                    </div> <!-- tab-pane -->
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
               
            </div><!-- tab-content -->    

            
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


