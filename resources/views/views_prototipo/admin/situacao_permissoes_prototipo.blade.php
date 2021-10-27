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
            :link2="'{{ url('/admin/prototipo/permissoes/consulta') }}'"
            :titulo3='"Situação das Permissões"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Situação das Permissões '"
                    :subtitulo1="'Permissões ({{ count($permissoes) }})'"
                    @if($subtitulo2) subtitulo2="{{$subtitulo2}} " @endif
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            <div class="form-group">               
                @if(count($permissoes)>0)                
                <div class="tab-pane fade show active" id="nav-analise" role="tabpanel" aria-labelledby="nav-analise-tab">
                    <div  class="titulo">
                            <h3>Permissões em Análise</h3> 
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr class="text-center" >
                            <th>Id</th>
                            <th>UF</th>
                            <th>Município</th>
                            <th>Proponente</th>    
                            <th>CPF</th>       
                            <th>Nome</th>         
                            <th>Data Solicitação</th>       
                            <th>Analisada em</th>                    
                            <th>Analisada por</th>                    
                            <th>Situação</th>   
                            <th>Tipo indeferimento</th>   
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissoes as $dados)
                            
                            <tr class="text-center" >
                                <td>{{$dados->id}}</td>
                                <td>{{$dados->txt_sigla_uf}}</td>
                                <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                                <td>{{$dados->ds_municipio}}</td> 
                                <td>{{$dados->txt_ente_publico}}</td>
                                <td>{{$dados->txt_cpf_usuario}}</td>
                                <td>{{$dados->name}}</td>
                                <td>  {{date('d/m/Y',strtotime($dados->created_at))}} </td>                                
                                <td>  {{date('d/m/Y',strtotime($dados->dte_analise))}} </td>
                                <td>{{$dados->analisado_por}}</td>
                                <td>{{$dados->txt_status_permissao}}</td>
                                <td>{{$dados->txt_tipo_indeferimento}}</td>
                            
                            </tr>
                            
                        @endforeach
                        </tbody>
                    </table><!-- fechar table-->
                </div><!--nav-analise -->
            @endif
            </div>   
        
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                    </div>    
                </div>
            </div> 
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


