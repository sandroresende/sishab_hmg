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
                :titulo1="'Protótipo de HIS'"
                :titulo2='"Consulta da Situação da Permissão"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Consulta da Situação da Permissão'"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/admin/prototipo/permissoes/consulta") }}'"
                    barracompartilhar="true">
            </cabecalho-form> 
            <form action="{{ url('admin/prototipo/permissoes/situacao') }}" method="POST">
                <b>Selecione os dados para realização da pesquisa.  Para pesquisar os dados referente ao Brasil clique no botão Brasil sem aplicar nenhum filtro. </b>
                <div class="form-group">
                    
                         @csrf
                         <div class="well">
                             <div class="box">                                                                                 
                                <select-uf-municipio 
                                    coluf="column col-xs-12 col-sm-6"
                                    colmun="column col-xs-12 col-sm-6"
                                    :url="'{{ url('/') }}'">
                                </select-uf-municipio>
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
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


