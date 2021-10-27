@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
@endsection


@section('content')

<div id="content">
    

    <div id="content-core">
        <historico-navegacao
            :url="'{{ url('/home') }}'"
            :titulo1='"Seleção de Propostas"'
            :titulo2="'Consulta das Propostas Contratadas'"
            >
        </historico-navegacao>



        <cabecalho-form
                :titulo="'Seleção das Propostas Contratadas'"
                :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                :linkcompartilhar="'{{ url('/selecao') }}'"
                :barracompartilhar="true">
        </cabecalho-form>
        <b>Selecione os dados para realização do filtro. </b>
        <div class="form-group">   
            <form method="POST" action="{{url('/proposta/contratadas')}}">
                @csrf
                <div class="well">
                    <div class="box">                                                                                 
                        <select-propostas-contratadas :url="'{{ url('/') }}'"></select-propostas-contratadas>
                    </div>
                </div>    
                <input  class="btn btn-lg btn-info btn-block" type="submit" value="Pesquisar">   
            </form>      
        </div>   
        <!--form-group --> 
     </div>
     <!--Content-core --> 
</div>
<!--Content--> 
@endsection


