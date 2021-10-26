@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/home') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span>Seleção de Demanda</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Usuários e Responsáveis</span>
    </span>
</div>

<div id="content">
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
            Usuários e Responsáveis
        </h2>
        
        <div class="linha-separa"></div>


  <div id="content-core">
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
            <th>Excluir</th>
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
                    <form method="post" action='{{ url("admin/usuario/excluir/$usuario->usuario_id/")}}'>
                        {{csrf_field()}}
                        @if($usuario->txt_tipo_usuario != 'Ente Público' )
                        <button type="submit"  class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        @endif
                        
                    </form>
                </td>
                <td>
                    <a href='{{ url("admin/usuario/$usuario->usuario_id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-search"></i></a>
                </td>            
               </tr>                     
        @endforeach
        </tbody>
        </table><!-- fechar table-->

        
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection