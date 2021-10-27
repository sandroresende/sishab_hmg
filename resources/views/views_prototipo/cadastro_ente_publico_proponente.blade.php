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
            :titulo2='"Ente Público"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Atualizar senha de acesso'"
                    :dataatualizacao="'{{date('d/m/Y',strtotime($ente->created_at))}}'"
                    :barracompartilhar="true"
                    >
                    <div class="alert alert-warning text-center" role="alert">
                        @if((Auth::user()->tipo_usuario_id==8) && (!Auth::user()->bln_ativo))
                            <strong>Olá!</strong> Esse é seu primeiro acesso utilizando o perfil principal do Ente Público.  Favor alterar a senha de acesso.
                        @elseif((Auth::user()->tipo_usuario_id==9) && (!Auth::user()->bln_ativo))
                            <strong>Olá!</strong> Esse é seu primeiro acesso utilizando o perfil de representante do Ente Público.  Favor alterar a senha de acesso.
                        @endif  
                    </div> 
                          
            </cabecalho-form> 
            <form class="form-horizontal" role="form" method="POST" action='{{ url("/selecao_beneficiarios/primeiro_acesso") }}'>
    
                @csrf
                    
                        <div class="form-group">
                            <div class="titulo">
                                <h5>Dados do Ente Público </h5> 
                                
                            </div>
                            <div class="row">
                                <div class="column col-xs-12 col-md-9">
                                    <label class="control-label">Nome do Ente Público</label>
                                    <input id="txt_ente_publico" type="text" class="form-control" name="txt_ente_publico" value="{{$ente->txt_ente_publico}}" disabled >
            
                                </div>
                                <div class="column col-xs-12 col-sm-3">
                                    <label for="txt_tipo_ente_publico">Tipo Ente Público</label>           
                                    <input id="txt_tipo_proponente" type="text" class="form-control" name="txt_tipo_proponente" value="{{$ente->tipoProponente->txt_tipo_proponente}}" disabled >                      
                                </div>
                            </div>  
                        </div><!-- fechar primeiro form-group-->
                        <div class="form-group">
                            <div class="row">
                                <div class="column col-xs-12 col-md-9">
                                    <label class="control-label ">Email</label>
                                    <input id="txt_email_ente_publico" type="email" class="form-control" name="txt_email_ente_publico" value="{{$ente->txt_email_ente_publico}}" disabled >
            
                                    @if ($errors->has('txt_email_ente_publico'))
                                        <span class="erro_validacao">
                                            <strong>{{ $errors->first('txt_email_ente_publico') }}</strong>
                                        </span>
                                    @endif
                                </div>   
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label ">CNPJ</label>
                                    <input id="txt_cnpj_ente_publico" type="text" class="form-control" name="txt_cnpj_ente_publico" value="{{$ente->id}}" disabled >
            
                                    @if ($errors->has('txt_cnpj_ente_publico'))
                                        <span class="erro_validacao">
                                            <strong>{{ $errors->first('txt_cnpj_ente_publico') }}</strong>
                                        </span>
                                    @endif
                                </div>                    
                                              
                            </div>
                        </div><!-- fechar segundo form-group-->
                   
                    <div class="titulo">
                    <h5>Dados do Responsável </h5> 
                    
                </div>
               
                     <div class="form-group">
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label">CPF</label>
                                    
                                    <input id="txt_cpf_usuario" type="text" class="form-control" maxlength="11"  name="txt_cpf_usuario" value="{{empty(old('txt_cpf_usuario')) ? $usuario->txt_cpf_usuario : old('txt_cpf_usuario')}}" disabled >
                               
            
                                    @if ($errors->has('txt_cpf_usuario'))
                                        <span class="erro_validacao">
                                            <strong>{{ $errors->first('txt_cpf_usuario') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                        </div>
                    </div><!-- fechar primeiro form-group-->  
             
            
                    <div class="form-group">
                        <div class="row">        
                            <div class="column col-xs-12 col-md-6">
                                <label for="name" class="control-label">Nome</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{empty(old('name')) ? $usuario->name : old('name')}}"  >
            
                                @if ($errors->has('name'))
                                    <span class="erro_validacao">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="column col-xs-12 col-md-6">
                            <label for="txt_cargo" class="control-label">Cargo</label>
            
                                <input id="txt_cargo" type="text" class="form-control" name="txt_cargo" value="{{empty(old('txt_cargo')) ? $usuario->txt_cargo : old('txt_cargo')}}" >
            
                                @if ($errors->has('txt_cargo'))
                                    <span class="erro_validacao">
                                        <strong>{{ $errors->first('txt_cargo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div><!-- fechar primeiro form-group-->  
                    <div class="form-group">
                            <div class="row">
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label ">Nova Senha</label>
                                    <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}"  >
            
                                    @if ($errors->has('password'))
                                        <span class="erro_validacao">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label">Confirmar Senha</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password-confirm') }}"  >
            
                                    @if ($errors->has('password-confirm'))
                                        <span class="erro_validacao">
                                            <strong>{{ $errors->first('password-confirm') }}</strong>
                                        </span>
                                    @endif
                                </div>  
                                                  
                            </div>
                            </div><!-- fechar terceiro form-group--> 
                        
                   
                   <div class="form-group">
                <input class="btn btn-lg btn-info btn-block" type="submit" value="Salvar">    
            </div><!-- fechar quarto form-group-->
            </form>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


