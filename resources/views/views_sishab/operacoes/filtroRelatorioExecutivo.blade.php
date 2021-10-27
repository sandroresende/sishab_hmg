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
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Relatório Executivo '"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/operacoes/filtro/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
            <b>Selecione os dados para realização da pesquisa.  Para pesquisar os dados referente ao Brasil clique no botão Brasil sem aplicar nenhum filtro. </b>
            <div class="form-group">
                <form action="{{ url('operacoes/relatorio') }}" method="POST">
                     @csrf
                     <div class="well">
                         <div class="box">                                                                                 
                         <select-painel :url="'{{ url('/') }}'"    vidvigente = "true" ateano = "true"></select-painel>                             
                         </div>
                     </div>    
                    
                 </form> 
               <!--form-group -->
    

            <div class="form-group">
                <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
            </div>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


