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
                :titulo1="'Empreendimentos'"
                :titulo2='"Filtro de Empreendimentos"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Empreendimentos'"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/empreendimentos/filtro/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
            <b>Selecione os dados para realização da pesquisa.
            <div class="form-group">
                <form action="{{ url('/empreendimentos/consulta') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <consulta-empreendimentos 
                            :url="'{{ url('/') }}'">
                                            
                        </consulta-empreendimentos>
                        </div>
                    </div>    
                   
                </form> 
               <!--form-group -->
            </div>

            <div class="form-group">
                <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
            </div>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


