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
                    :titulo2='"Usuários e Responsáveis"'
                    
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Usuários e Responsáveis'"
                    :barracompartilhar="true"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    >
            </cabecalho-form> 

            <div class="form-group">
                <div class="titulo">
                    <h3>Usuários e Responsáveis</h3>         
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center" >
                            <th>UF</th>
                            <th>Município</th>
                            <th>Ente Público</th>
                            <th>Nome do Usuário</th>
                            <th>Tipo Usuário</th>    
                            <th>Status Usuário</th>    
                            <th>Status Permissão</th>    
                            <th>Data Aceite</th>   
                            <th>Ver</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($usuarios as $usuario)
                                <tr class="text-center" >
                                <td>{{$usuario->txt_sigla_uf}}</td>
                                <td>{{$usuario->ds_municipio}}</td>
                                <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                                <td>{{$usuario->txt_ente_publico}}</td> 
                                <td>{{$usuario->name}}</td> 
                                <td>{{$usuario->txt_tipo_usuario}}</td>
                                <td><span class="label label-danger">{{$usuario->txt_status_usuario}}</span></td>
                                <td><span class="label label-danger">{{$usuario->txt_status_permissao}}</span></td>
                                <td> @if($usuario->dte_aceite_termo) {{date('d/m/Y',strtotime($usuario->dte_aceite_termo))}} @endif </td>
                                <td>
                                    <a href='{{ url("admin/prototipo/usuario/$usuario->id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-search"></i></a>
                                </td>            
                               </tr>                     
                        @endforeach
                        </tbody>
                        </table><!-- fechar table-->
                </div> <!-- table-responsive-sm -->
            </div> <!-- form-group -->    
            
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                    </div>    
                </div>
            </div> <!-- form-group -->
        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


