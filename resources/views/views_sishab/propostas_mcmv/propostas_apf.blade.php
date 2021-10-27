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
            :titulo1='"Seleção de Propostas"'
            :titulo2='"Filtro Seleção de Propostas"'
            :link2="'{{ url('/selecao') }}'"
            :titulo3="'Propostas Apresentadas'"
        >
        </historico-navegacao>

        <cabecalho-form
                :titulo="'Propostas Apresentadas'"
                :subtitulo1="'{{$titulo1}}'"
                :subtitulo2="'{{$titulo2}}'"
                :dataatualizacao="'{{date('d/m/Y',strtotime($dataAtualizacao))}}'"
                :barracompartilhar="true"
                >
        </cabecalho-form>    

        <colunas-duas-situacao 
                    v-bind:itens="{{$propostas}}" 
                    :url="'{{ url('/') }}'"
        >             
        </colunas-duas-situacao>

        <div class="form-group">
            <div class="row">
                <div class="column col-sm-6 col-xs-12">                                        
                    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">   
                </div>
                <div class="column col-sm-6 col-xs-12">
                    <input class="btn btn-lg btn-danger btn-block" type="button-danger" onclick="javascript:window.history.go(-1)" value="Fechar">    
                </div>
            </div>        
        </div><!-- fechar primeiro form-group-->


        
     </div>
    <!--content-core --> 
</div>
<!--content-->     
@endsection


