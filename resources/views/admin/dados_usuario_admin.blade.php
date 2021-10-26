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
            <span> Seleção de Demanda</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Dados Usuário</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Dados Usuário
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Dados do Usuário </h5> 
        
    </div>
    

            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label ">Status</label>
                        <input id="txt_status_usuario" type="text" class="form-control" name="txt_status_usuario" value="{{empty(old('txt_status_usuario')) ? $usuario->statusUsuario->txt_status_usuario : old('txt_status_usuario')}}" disabled>

                        @if ($errors->has('txt_status_usuario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_status_usuario') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        
                    </div>
                    
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label">Tipo Usuário</label>
                        <input id="txt_tipo_usuario" type="text" class="form-control" name="txt_tipo_usuario" value="{{empty(old('txt_tipo_usuario')) ? $usuario->tipoUsuario->txt_tipo_usuario : old('txt_tipo_usuario')}}"  disabled>

                        @if ($errors->has('txt_tipo_usuario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_tipo_usuario') }}</strong>
                            </span>
                        @endif
                    </div>
                     
                </div>
            </div><!-- fechar primeiro form-group-->
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label ">CPF</label>
                        <input id="txt_cpf_usuario" type="text" class="form-control" name="txt_cpf_usuario" value="{{empty(old('txt_cpf_usuario')) ? $usuario->txt_cpf_usuario : old('txt_cpf_usuario')}}" disabled>

                        @if ($errors->has('txt_cpf_usuario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_cpf_usuario') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label ">Nome</label>
                        <input id="txt_nome" type="text" class="form-control" name="txt_nome" value="{{empty(old('txt_nome')) ? $usuario->name : old('txt_nome')}}"  >

                        @if ($errors->has('txt_nome'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_nome') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label">Cargo</label>
                        <input id="txt_cargo" type="text" class="form-control" name="txt_cargo" value="{{empty(old('txt_cargo')) ? $usuario->txt_cargo : old('txt_cargo')}}"  >

                        @if ($errors->has('txt_cargo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_cargo') }}</strong>
                            </span>
                        @endif
                    </div>
                     
                </div>
            </div><!-- fechar segundo form-group-->
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label ">Email</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{empty(old('email')) ? $usuario->email : old('email')}}"  >

                        @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{{$errors->first('email')}}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label">DDD</label>
                        <input id="txt_ddd_telefone" type="text" maxlength="2" class="form-control" name="txt_ddd_telefone" value="{{empty(old('txt_ddd_telefone')) ? $usuario->txt_ddd_telefone : old('txt_ddd_telefone')}}"  >

                        @if ($errors->has('txt_ddd_telefone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_ddd_telefone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label">Telefone</label>
                        <input id="txt_telefone" type="text" maxlength="9" class="form-control" name="txt_telefone" value="{{empty($usuario->txt_telefone) ? old('txt_telefone'): $usuario->txt_telefone}}"  >

                        @if ($errors->has('txt_telefone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_telefone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label">Atualizado em</label>
                        <input id="updated_at" type="text" maxlength="9" class="form-control" name="updated_at" value="{{empty($usuario->updated_at->format('d/m/Y')) ? old('updated_at'): $usuario->updated_at->format('d/m/Y')}}" disabled >

                        @if ($errors->has('updated_at'))
                            <span class="help-block">
                                <strong>{{ $errors->first('updated_at') }}</strong>
                            </span>
                        @endif
                    </div>  
                </div>
            </div><!-- fechar terceiro form-group-->
            <button type="submit"  class="btn btn-danger btn-lg btn-block" onclick="javascript:window.history.go(-1)">Fechar</button>
            


       
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection