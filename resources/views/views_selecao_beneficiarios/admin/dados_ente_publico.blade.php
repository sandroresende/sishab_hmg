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
            :titulo1="'Seleção de Demanda'"
            :titulo2='"Filtro de Entes Públicos"'
            :link2="'{{ url('/admin/selecao_demanda/filtro') }}'"
            :titulo3='"Entes Públicos"'
            :titulo4="'{{$entePublico->txt_ente_publico}}'"
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'{{$entePublico->txt_ente_publico}}'"
                   :subtitulo1="'{{$entePublico->municipio->ds_municipio}} - {{$entePublico->municipio->uf->txt_sigla_uf}}'"
                   :dataatualizacao="'{{date('d/m/Y',strtotime($entePublico->created_at))}}'"                 
                    :linkcompartilhar="'{{ url("/admin/selecao_demanda/ente_publico/$entePublico->id") }}'"
                    :barracompartilhar="true">
                    
            </cabecalho-form> 
            <div class="form-group">               
                <div class="titulo">
                    <h3>Dados do Ente Público </h3>         
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-9">
                            <label class="control-label label-relatorio">Nome do Ente Público</label>
                            <input id="txt_ente_publico" type="text" class="form-control input-relatorio" name="txt_ente_publico" value="{{$entePublico->txt_ente_publico}}" disabled >
            
                        </div>
                        <div class="column col-xs-12 col-sm-3">
                            <label for="txt_tipo_ente_publico">Tipo Ente Público</label>           
                            <input id="txt_tipo_ente_publico" type="text" class="form-control input-relatorio" name="txt_tipo_ente_publico" value="{{$entePublico->tipoEntePublico->txt_tipo_ente_publico}}" disabled >                      
                        </div>
                    </div>  
                </div><!-- fechar primeiro form-group-->
                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-9">
                            <label class="control-label label-relatorio ">Email</label>
                            <input id="txt_email_ente_publico" type="email" class="form-control input-relatorio" name="txt_email_ente_publico" value="{{$entePublico->txt_email_ente_publico}}" disabled >
            
                            @if ($errors->has('txt_email_ente_publico'))
                                <span class="erro_validacao">
                                    <strong>{{ $errors->first('txt_email_ente_publico') }}</strong>
                                </span>
                            @endif
                        </div>   
                        <div class="column col-xs-12 col-md-3">
                            <label class="control-label label-relatorio ">CNPJ</label>
                            <input id="txt_cnpj_ente_publico" type="text" class="form-control input-relatorio" name="txt_cnpj_ente_publico" value="{{$entePublico->id}}" disabled >
            
                            @if ($errors->has('txt_cnpj_ente_publico'))
                                <span class="erro_validacao">
                                    <strong>{{ $errors->first('txt_cnpj_ente_publico') }}</strong>
                                </span>
                            @endif
                        </div>                    
                                        
                    </div>
                </div><!-- fechar segundo form-group-->
            
                @if($dirigente)
                <div class="titulo">
                    <h3>Dados do Dirigente </h3>         
                </div>
            
                <div class="form-group">
                    <div class="row">        
                        <div class="column col-xs-12 col-md-6">
                            <label for="txt_nome_dirigente" class="control-label label-relatorio">Nome</label>
                            <input id="txt_nome_dirigente" type="text" class="form-control input-relatorio" name="txt_nome_dirigente" value="{{$dirigente->txt_nome_dirigente}}" disabled >
                        </div>
                        <div class="column col-xs-12 col-md-4">
                            <label for="txt_cargo_dirigente" class="control-label label-relatorio">Cargo</label>
                            <input id="txt_cargo_dirigente" type="text" class="form-control input-relatorio" name="txt_cargo_dirigente" value="{{$dirigente->txt_cargo_dirigente}}"  disabled >
                        </div>
                        <div class="column col-xs-12 col-md-2">
                            <label for="txt_cargo_dirigente" class="control-label label-relatorio">Status</label>
                            <input id="bln_ativo" type="text" class="form-control input-relatorio" name="bln_ativo" value="{{ $dirigente->bln_ativo ? 'Ativo' : 'Inativo' }} "  disabled >
                        </div>
            
            
                        
                    </div>
                </div><!-- fechar primeiro form-group-->  
                
                <div class="form-group">
                    <div class="row">        
                        <div class="column col-xs-12 col-md-4">
                            <label for="txt_cpf_dirigente" class="control-label label-relatorio">CPF</label>
                            <input id="txt_cpf_dirigente" type="text" maxlength="11" class="form-control input-relatorio" name="txt_cpf_dirigente" value="{{$dirigente->txt_cpf_dirigente}}"  disabled>
                        </div>
               
                        <div class="column col-xs-12 col-md-8">
                            <label for="txt_email_dirigente" class="control-label label-relatorio">E-Mail</label>
                            <input id="txt_email_dirigente" type="text" class="form-control input-relatorio" name="txt_email_dirigente" value="{{$dirigente->txt_email_dirigente}}"  disabled > 
                        </div>
                    </div>    
                </div><!-- fechar segundo form-group-->
            
                @endif
                <div class="titulo">
                    <h3>Usuários Cadastrados </h3>         
                </div>
                <div class="form-group">
                    <div class="row">  
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center" >                  
                                    <th>Nome do Usuário</th>
                                    <th>Email do Usuário</th>
                                    <th>Cargo do Usuário</th>
                                    <th>Tipo Usuário</th>    
                                    <th>Status Usuário</th>    
                                    <th>Data Aceite</th>                              
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usuario)
                                    <tr class="text-center" >
                                    <td>{{$usuario->name}}</td> 
                                    <td>{{$usuario->email}}</td> 
                                    <td>{{$usuario->txt_cargo}}</td> 
                                    <td>{{$usuario->tipoUsuario->txt_tipo_usuario}}</td>
                                    <td><span class="label label-danger">{{$usuario->statusUsuario->txt_status_usuario}}</span></td>
                                    <td> @if($usuario->dte_aceite_termo) {{date('d/m/Y',strtotime($usuario->dte_aceite_termo))}} @endif </td>
                                             
                                    </tr>                                         
                            @endforeach
                            </tbody>
                        </table><!-- fechar table-->
                    </div>    
                </div><!-- fechar segundo form-group-->      
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


