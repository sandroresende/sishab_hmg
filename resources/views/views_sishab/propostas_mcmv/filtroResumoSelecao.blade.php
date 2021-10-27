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
            :titulo2="'Consulta Situação da Seleção no Município'"
            >
        </historico-navegacao>



        <cabecalho-form
                :titulo="'Consulta Situação da Seleção no Município'"
                :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                :linkcompartilhar="'{{ url('/selecao') }}'"
                :barracompartilhar="true">
        </cabecalho-form>
        <b>Selecione os dados para realização do filtro. </b>
        <div class="form-group">
            <form action="{{ url('proposta/selecao/resumo/') }}" method="POST">
                @csrf
                <div class="well">
                    <div class="box">                                                                                 
                        <select-mult-municipio :url="'{{ url('/') }}'"></select-mult-municipio>
                    </div>
                </div>    
                <input  class="btn btn-lg btn-info btn-block" type="submit" value="Pesquisar">   
            </form> 
            </div><!--form-group -->
     </div>
     <!--Content-core --> 
</div>
<!--Content--> 
@endsection


