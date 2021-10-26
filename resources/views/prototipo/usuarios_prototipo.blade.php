@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/entePublico') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> Ente Público</span>
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
        <span class="documentFirstHeadingSpan">
        Para acesso à ferramenta você poderá ter no<strong> máximo 3 (três) usuários Ativos por Ente Público</strong>, 
        que terão acesso ao módulo de inserção e atualização.
        </span>   
        <div class="linha-separa"></div>

  </div>
  <div id="content-core">
 

    @if(count($usuariosAtivos) >0)
    <div class="titulo">
        <h5>Usuários Ativos </h5>         
    </div>
           
            <table class="table table-hover">
                <thead>
                  <tr class="text-center" >
                    <th>Id</th>
                    <th>Login</th>
                    <th>Nome do Usuário</th>
                    <th>Tipo Usuário</th>    
                    <th>Data Aceite</th>       
                    <th>Excluir</th>
                    <th>Ver</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($usuariosAtivos as $usuario)
                     <tr class="text-center" >
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->email}}</td>
                        <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                        <td>{{$usuario->name}}</td> 
                        <td>{{$usuario->tipoUsuario->txt_tipo_usuario}}</td>
                        <td>  {{date('d/m/Y',strtotime($usuario->dte_aceite_termo))}} </td>
                        <td>
                            <form method="post" action='{{ url("/usuario/excluir/$usuario->id/")}}'>
                                {{csrf_field()}}
                                <button type="submit"  class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                
                                
                            </form>
                        </td>
                        <td>
                            <a href='{{ url("/usuario/$usuario->id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-search"></i></a>
                        </td>            
                      </tr>                                         
                @endforeach
                </tbody>
              </table><!-- fechar table-->
            @endif  

            @if(count($usuariosInativos) >0)
              <div class="titulo">
                  <h5>Usuários Inativos </h5>         
              </div>
           
            <table class="table table-hover">
                <thead>
                  <tr class="text-center" >
                    <th>Id</th>
                    <th>Login</th>
                    <th>Nome do Usuário</th>
                    <th>Tipo Usuário</th>                            
                    <th>Excluir</th>
                    <th>Ver</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($usuariosInativos as $usuario)
                     <tr class="text-center" >
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->email}}</td>
                        <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                        <td>{{$usuario->name}}</td> 
                        <td>{{$usuario->tipoUsuario->txt_tipo_usuario}}</td>
                        <td>
                            <form method="post" action='{{ url("/usuario/excluir/$usuario->id/")}}'>
                                {{csrf_field()}}
                                <button type="submit"  class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                
                                
                            </form>
                        </td>
                        <td>
                            <a href='{{ url("/usuario/$usuario->id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-search"></i></a>
                        </td>           
                      </tr>                                         
                @endforeach
                </tbody>
              </table><!-- fechar table-->
            @endif  

            
            @if(count($usuariosExcluidos) >0)
              <div class="titulo">
                  <h5>Usuários Excluídos </h5>         
              </div>
           
            <table class="table table-hover">
                <thead>
                  <tr class="text-center" >
                    <th>Id</th>
                    <th>Login</th>
                    <th>Nome do Usuário</th>
                    <th>Tipo Usuário</th>            
                   <th>Ver</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($usuariosExcluidos as $usuario)
                     <tr class="text-center" >
                        <td>{{$usuario->id}}</td>
                        <td>{{$usuario->email}}</td>
                        <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                        <td>{{$usuario->name}}</td> 
                        <td>{{$usuario->tipoUsuario->txt_tipo_usuario}}</td>
                       
                        <td>
                            <a href='{{ url("/usuario/$usuario->id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-search"></i></a>
                        </td>             
                      </tr>                                         
                @endforeach
                </tbody>
              </table><!-- fechar table-->
            @endif  

            <div class="form-group">
                <div class="row">                
                    <div class="column col-xs-12 col-md-6">    
                        @if($numUsuarios<3)
                            <form class="form-horizontal" role="form" method="GET" action='{{ url("/usuario/novo") }}'>                    
                                <button type="submit"  class="btn btn-info btn-lg  btn-block"  >Novo Usuário</button>
                            </form>  
                        
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-6">    
                        <form class="form-horizontal" role="form" method="GET" action='{{ url("/entePublico")}}'>                    
                            <button type="submit"  class="btn btn-danger btn-lg btn-block"  >Fechar</button>
                        </form>    
                    </div>
                </div>
            </div><!-- fechar quarto form-group-->

  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection