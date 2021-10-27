@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                    :url="'{{ url('/selecao_beneficiarios') }}'"
                    :titulo1="'Seleção de Beneficiários'"
                    :titulo2='"Usuários e Responsáveis"'
                    
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Usuários e Responsáveis'"
                    :barracompartilhar="false"
                    >
                    <span class="documentFirstHeadingSpan">
                      Para acesso à ferramenta você poderá ter no<strong> máximo 3 (três) usuários Ativos por Ente Público</strong>, 
                      que terão acesso ao módulo de inserção e atualização.
                      </span>
            </cabecalho-form> 

            <div class="form-group">
              @if(count($usuariosAtivos) >0)
              <div class="titulo">
                  <h3>Usuários Ativos </h3>         
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
                            <h3>Usuários Inativos </h3>         
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
                            <h3>Usuários Excluídos </h3>         
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
            </div> <!-- form-group -->    
            
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                      @if($numUsuarios<3)
                            <form class="form-horizontal" role="form" method="GET" action='{{ url("/usuario/novo") }}'>                    
                              <input class="btn btn-lg btn-info btn-block" type="submit" value="Novo Usuário">                                    
                            </form>  
                      @else
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">      
                        @endif
                        
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


