@extends('layouts.app')



@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login/all.min.css')}}"  media="screen" />
  

<!-- Page CSS -->
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/login/govbr-templates.css')}}"  media="screen" />

@endsection

@section('content')
<div class="container">
    <main>
        <form class="text-left form-validate" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}  
        
            <div class="card" id="login-cpf">
               <input type="hidden" name="_csrf" value="b255a43c-b1c9-4de7-b5e2-69c506d47a98" />
               <h3>Acesse sua conta com Email</h3>
               

              <div class="form-group">
                <div class="form-group row">
                    <div class="column col-xs-12 col-md-12">
                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                        <input tabindex="1" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('email') }}" placeholder="Digite seu Email" required autofocus>
                        
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                    </div>
                    <div class="column col-xs-12 col-md-12">

                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>
                        <input tabindex="2" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Digite sua senha"  required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>          
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        <span>Esqueceu sua senha?</span>
                    </a>

                <div class="button-panel" id="login-button-panel">                     
                     <button name="action" value="enterAccountId" class="button-ok" type="submit" tabindex="3">Entrar</button>
                     
                  </div>
                  <hr>
              </div>

               <div class="item-login-signup-ways align-center">
                <img class="align-center" src="{{URL::asset('img/logo-mcmv-cvea.png')}}"  >
                
               </div>
               
            </div>           
         </form> 
    </main>
   
</div>
@endsection
