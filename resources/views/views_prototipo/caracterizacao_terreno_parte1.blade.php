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
                    :subTitulo1="'PARTE 1'"
                    >
                    <span class="documentFirstHeadingSpan">
                
                        Nessa seção são solicitadas informações básicas sobre as condições do terreno oferecido para o desenvolvimento do projeto.
                </span> 
                   
            </cabecalho-form> 
            <div class="linha-separa"></div>
             <!-- form-group-->              
            <div class="form-group">
                <form action="{{ url('prototipo/iniciar/caracterizacaoTerreno/parte1/salvar/') }}" role="form" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="well">
                         <div class="box">  
                             <input type="hidden" class="form-control" id="prototipo_id" name="prototipo_id" value="{{$prototipo->id}}">                                                        
                             <caracterizacao-terreno-parte1 :url="'{{ url('/') }}'" ></caracterizacao-terreno-parte1>
                         </div>
                     </div>    
                    
                 </form> 
               <!--form-group -->    

            
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


