<?php 
  
  $mensagem = null;
  if(Session::get('mensagem')){
    $mensagem = 'O perfil principal do Ente Público ainda não foi ativado.';  
  }  

?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SISHAB') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles Template-->
    <link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/grasp_mobile_progress_circle-1.0.0.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/small-n-flat.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

</head>
<body>
    <div id="app">
        <div class="page login-page">
            <div class="container"> 
                <div class="form-outer text-center d-flex align-items-center">
                    <div class="form-inner">

                        <div class="logo text-uppercase"> <img src="{{URL::asset('img/logo-mcmv-cvea.png')}}"  ></div>
                        <p>Sistema de Gerenciamento da Habitação</p>
                        {{ $mensagem }}{{ Session::get('mensagem')}}

                        @if (!empty($mensagem))
                                <div class="alert alert-warning text-center" role="alert">
                                    <span class="help-block">
                                        <strong>{{ $mensagem }}</strong>
                                    </span>
                                </div>
                                @endif
                    

                        <form class="text-left form-validate" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}  
                            <div class="form-group-material">
                                <div class="help-parent">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend {{ $errors->has('email') ? ' has-error' : '' }}"><span class="input-group-text">@</span></div>
                                    <input id="email" type="email"  name="email" placeholder="Email" class="form-control" value="{{ old('email') }}" autofocus>
                                </div>  
                            </div>
                            <div class="form-group-material">
                                @if ($errors->has('password'))
                                <div class="help-parent">
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="input-group-prepend {{ $errors->has('password') ? ' has-error' : '' }}"><span class="input-group-text"><i class="fa fa-fw fa-lock"></i></span></div>
                                    <input id="password" type="password" name="password" class="form-control" placeholder="Senha" value="{{ old('password') }}" autofocus>
                                </div> 
                            </div>

                            <div class="form-group row mb-0">
                                <div class="column col-md-8 offset-md-4">
                                   

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Esqueceu sua senha?') }}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="form-group text-center">
                            <button type="submit" class="btn btn-block btn-primary">Entrar</button>
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </div>
                        </form>                        
                    </div>
                    <div class="copyrights text-center">
                        <p>Desenvolvido pela <a href="https://bootstrapious.com" class="external">Secretaria Nacional da Habitação</a></p>
                        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
                    </div>               
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts Template-->
<script src="{{ asset('js/grasp_mobile_progress_circle-1.0.0.min.js') }}" defer></script>

<script src="{{ asset('js/charts-home.js') }}" defer></script>
<script src="{{ asset('js/front.js') }}" defer></script>
</body>
</html>

