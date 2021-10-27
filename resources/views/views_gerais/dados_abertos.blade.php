@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao           
                :url="'{{ url('/') }}'"
                :titulo1="'Dados Abertos'"           
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Dados Abertos'"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/dados_abertos/sistema_habitacao") }}'"
                    barracompartilhar="true">
                    
            </cabecalho-form> 
          
            <div class="titulo">
                <h3>Dados Abertos</h3> 
                
            </div>
            
           
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


