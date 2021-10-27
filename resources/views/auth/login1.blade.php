@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card text-center">
                <h3>Acesse sua conta com Email</h3>
                <hr>
                <div class="card-body">

                <form class="text-left form-validate" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}  

                        <div class="form-group row">
                            <label for="email" class="text-md-right">{{ __('E-Mail') }}</label>

                            
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group row">
                            <label for="password" class="text-md-right">{{ __('Senha') }}</label>

                            
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                        <div class="form-group row">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                <span>Esqueceu sua senha?</span>
                            </a>
                        </div>

                        <div class="form-group row align-center text-center">
                            <div class="align-center text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>       
                            </div>
                        </div>
                        <hr>
                        <div class="form-group align-center">
                            
                                <img class="align-center" src="{{URL::asset('img/logo-mcmv-cvea.png')}}"  >
                                
                            
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
