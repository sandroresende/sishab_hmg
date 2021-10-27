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
            :titulo2="'Consulta à Seleção de Propostas Apresentadas'"
            >
        </historico-navegacao>



        <cabecalho-form
                :titulo="'Seleção de Propostas Apresentadas'"
                :dataatualizacao="'31/03/2021'"
                :linkcompartilhar="'{{ url('/selecao') }}'"
                :barracompartilhar="true">
        </cabecalho-form>
        <b>Selecione os dados para realização do filtro. </b>
        <div class="form-group">
            <form method="POST" action="{{url('/propostas')}}">
                @csrf
                <select-propostas :url="'{{ url('/') }}'"></select-propostas>   
                            
            </form>               
        </div>
        <!--form-group --> 

        <div class="form-group">   
            <tabela-relatorio
                v-bind:titulos="{{json_encode($tituloTabela)}}"
                v-bind:itens="{{json_encode($selecoes)}}"
                :show="'{{ url('selecao/') }}'"
            ></tabela-relatorio>        
        </div>   
        <!--form-group --> 
     </div>
     <!--Content-core --> 
</div>
<!--Content--> 
@endsection


