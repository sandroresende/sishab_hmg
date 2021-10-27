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
                :titulo1="'Relatórios'"
                :titulo2='"Filtro Relatório Executivo"'
                :link2="'{{ url('/operacoes/filtro') }}'"
                :titulo3='"Relatório Executivo"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'{{strtoupper($titulo)}} '"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    @if($subtitulo2) subtitulo2="{{$subtitulo2}} " @endif
                    @if($subtitulo3) subtitulo3="{{$subtitulo3}} " @endif                    
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/operacoes/filtro/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
            @include('views_sishab.operacoes.painel_executivo')
    

            <div class="form-group">
                <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
            </div>    
    </div>   
    <!-- content-core -->



    </modal-form>    


</div>    
<!-- content -->
@endsection


