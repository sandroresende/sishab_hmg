@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                :url="'{{ url('/home') }}'"
                :titulo1="'Oferta Pública'"
                :titulo2='"Filtro Protocolos"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Situação dos Protocolos'"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/oferta_publica/protocolos/filtro/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            <form action="{{ url('oferta_publica/protocolos') }}" method="POST">                
            <b>Selecione os dados para realização da pesquisa. </b>
            <div class="form-group">
                
                     @csrf
                     <div class="well">
                         <div class="box">                                                                                 
                            <select-protocolos :url="'{{ url('/') }}'"></select-protocolos>
                         </div>
                     </div>    
                    
                 
               
           </div><!--form-group -->  
           <div class="form-group">
            <div class="row">                                                    
                <div class="column col-xs-12 col-md-12">
                    <button type="submit" class="btn btn-primary btn-block">Pesquisar</button>  
                </div>
            </div><!--form-group -->  
        </form> 
        </div>     
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


