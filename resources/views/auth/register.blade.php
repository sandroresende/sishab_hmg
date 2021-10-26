@extends('layouts.app')

@section('content')
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        {{ __('Cadastro de Usuários') }}
        </h2>
        
        <div class="linha-separa"></div>


    <div id="content-core">
        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
        @csrf
            <div class="form-group">   
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <label for="name">{{ __('Name') }}</label>           
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <label for="email">{{ __('E-Mail Address') }}</label>           
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 {{ $errors->has('tipo_usuario_id') ? ' has-error' : '' }}">
                        <label for="tipo_usuario_id">Tipo Usuário</label>           
                        <select name="tipo_usuario_id" id="tipo_usuario_id" class="form-control" >
                            
                            @if(Auth::user()->tipo_usuario_id!=8)
                                <option value="">Selecione um Tipo </option>
                                <option value="1">Administrador</option>
                                <option value="3">Consulta</option>
                                <option value="8">Ente Público</option>
                                <option value="5">Financeiro</option>
                                <option value="7">Instituição Financeira</option>
                                <option value="2">Master</option>
                                <option value="4">Oferta Pública</option>
                            @else
                                <option value="9">Usuário - Ente Público</option>
                            @endif
                                </select>

                                @if ($errors->has('tipo_usuario_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo_usuario_id') }}</strong>
                                    </span>
                                @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <label for="password">{{ __('Password') }}</label>           
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>           
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        @if ($errors->has('password-confirm'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password-confirm') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

            </div>    
            <!-- form-group-->     
            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Registrar') }}
            </button>
        </form>      
        
    </div><!-- content-core-->


</div><!-- content-->


@endsection
