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
                :titulo2='"Filtro das Solicitações de Pagamentos das Medições"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Solicitações de Pagamentos das Medições'"
                    :dataatualizacao="'{{getPosicaoDadosMedicoes()}}'"
                    :linkcompartilhar="'{{ url("/medicoes/situacao/filtro/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
            <b>Selecione os dados para realização da pesquisa.  Para pesquisar os dados referente ao Brasil clique no botão Brasil sem aplicar nenhum filtro. </b>
            <div class="form-group">
                <form action="{{ url('/medicoes/situacao/pagamentos') }}" method="POST">
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                        <select-solicitacoes-pagamento 
                            :url="'{{ url('/') }}'"
                            tipoliberacao="false"
                        
                        ></select-solicitacoes-pagamento>
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


