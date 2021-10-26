@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            @if(Auth::user()->modulo_sistema_id==2)
                <a href="{{ url('/entePublico') }}">Página Inicial</a>
            @else
                <a href="{{ url('/prototipo') }}">Página Inicial</a>
            @endif            
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
        @if(Auth::user()->modulo_sistema_id==2)
            <span> Ente Público</span>
        @else
            <span> Protótipo</span>
        @endif    
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Dados do Responsável</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
    Dados do Responsável
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Dados do Usuário </h5> 
        
    </div>
    
    @if($usuario->tipo_usuario_id==2)
        <form class="form-horizontal" role="form" method="POST" action='{{ url("atualizar_usuario_if/$usuario->id/$usuario->instituicao_id") }}'>
    @else
        <form class="form-horizontal" role="form" method="POST" action='{{ url("atualizar_usuario/$usuario->id/$usuario->instituicao_id") }}'> 
    @endif        
            {{ csrf_field() }}
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label ">Status</label>
                        <input id="txt_status_usuario" type="text" class="form-control" name="txt_status_usuario" value="{{empty(old('txt_status_usuario')) ? $usuario->statusUsuario->txt_status_usuario : old('txt_status_usuario')}}" disabled>

                        @if ($errors->has('txt_status_usuario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_status_usuario') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label">Atualizado em</label>
                        <input id="updated_at" type="text" maxlength="9" class="form-control" name="updated_at" value="{{empty($usuario->updated_at->format('d/m/Y')) ? old('updated_at'): $usuario->updated_at->format('d/m/Y')}}" disabled >

                        @if ($errors->has('updated_at'))
                            <span class="help-block">
                                <strong>{{ $errors->first('updated_at') }}</strong>
                            </span>
                        @endif
                    </div> 
                    
                    <div class="column col-xs-12 col-md-4">
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
                    <div class="column col-xs-12 col-md-1">
                        <label class="control-label">DDD</label>
                        <input id="txt_ddd_fixo" type="text" maxlength="2" class="form-control" name="txt_ddd_fixo" value="{{empty(old('txt_ddd_fixo')) ? $usuario->txt_ddd_fixo : old('txt_ddd_fixo')}}"  >

                        @if ($errors->has('txt_ddd_fixo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_ddd_fixo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label">Telefone</label>
                        <input id="txt_telefone_fixo" type="text" maxlength="9" class="form-control" name="txt_telefone_fixo" value="{{empty($usuario->txt_telefone_fixo) ? old('txt_telefone_fixo'): $usuario->txt_telefone_fixo}}"  >

                        @if ($errors->has('txt_telefone_fixo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_telefone_fixo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-1">
                        <label class="control-label">DDD</label>
                        <input id="txt_ddd_movel" type="text" maxlength="2" class="form-control" name="txt_ddd_movel" value="{{empty(old('txt_ddd_movel')) ? $usuario->txt_ddd_movel : old('txt_ddd_movel')}}"  >

                        @if ($errors->has('txt_ddd_movel'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_ddd_movel') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label">Celular</label>
                        <input id="txt_telefone_movel" type="text" maxlength="9" class="form-control" name="txt_telefone_movel" value="{{empty($usuario->txt_telefone_movel) ? old('txt_telefone_movel'): $usuario->txt_telefone_movel}}"  >

                        @if ($errors->has('txt_telefone_movel'))
                            <span class="help-block">
                                <strong>{{ $errors->first('txt_telefone_movel') }}</strong>
                            </span>
                        @endif
                    </div>
                     
                </div>
            </div><!-- fechar terceiro form-group-->
            <div class="form-group">
                <div class="row">
            
                @if($idUsuarioLogado==$usuario->id)
                    <div class="column col-xs-12 col-md-6">
                   
                        <button type="submit" class="btn btn-lg btn-primary  btn-block">Salvar</button>        
                    </div> 
                    <div class="column col-xs-12 col-md-6">
                    @if(Auth::user()->modulo_sistema_id==2)                
                        <a type="submit"  class="btn btn-danger btn-lg btn-block"  href='{{ url("/entePublico")}}'>Fechar</a>
                    @else
                    <a type="submit"  class="btn btn-danger btn-lg btn-block"  href='{{ url("/prototipo")}}'>Fechar</a>
                    
                    @endif
                    </div>
                @else 
                    <div class="column col-xs-12 col-md-12">
                    @if(Auth::user()->modulo_sistema_id==2)                            
                        <a type="submit"  class="btn btn-danger btn-lg btn-block"  href='{{ url("/entePublico/usuarios")}}'>Fechar</a>
                    @else    
                        <a type="submit"  class="btn btn-danger btn-lg btn-block"  href='{{ url("/prototipo")}}'>Fechar</a>
                    </div>
                    @endif
                @endif



                </div>
            </div><!-- fechar quarto form-group-->
            


         </form>
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection