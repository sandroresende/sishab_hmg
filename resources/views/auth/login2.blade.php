





<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'SISHAB') }}</title>
    
  
  <meta property="creator.productor" content="http://estruturaorganizacional.dados.gov.br/id/unidade-organizacional/2981">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="assets/govbr/img/favicon.ico" type="image/x-icon">
  <!-- Fontawesome -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login/all.min.css')}}"  media="screen" />
  
  <!-- Fonts -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login/rawline.css')}}"  media="screen" />
  <link href="http://fonts.cdnfonts.com/css/rawline" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" crossorigin="anonymous" />
  
  <!-- Page CSS -->
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login/govbr-highcontrast.css')}}"  media="screen" />
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login/govbr-templates.css')}}"  media="screen" />
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/login/govbr-modal.css')}}"  media="screen" />

  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />

   <!-- Scripts -->
   <script src="{{ mix('js/app.js') }}" defer></script>
<!-- Styles -->


  <!-- Scripts -->
  <script src="{{URL::asset('js/login/contrast.class.js')}}"></script>
  <script src="{{URL::asset('js/login/modal.js')}}"></script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-80181585-36"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-80181585-36');
    </script>


</head>

<body>
    <a tabindex="0" href="#conteudo" class="sr-only sr-only-focusable" aria-label="Pular para o conteÃºdo principal. Navegue sempre com a tecla TAB">Pular para o conteÃºdo principal</a>

    <!-- div aria-hidden="true" id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;">
            <ul aria-hidden="true" id="menu-barra-temp" style="list-style:none;">
                    <li aria-hidden="true" style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED"><a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a></li>
                    <li aria-hidden="true"><a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a></li>
            </ul>
    </div-->

    

    <header>
        
            <img src="{{URL::asset('css/login/img/govbr.png')}}" alt="Logomarca GovBR" />            
            <div class="site-name">
           
                <a  href="{{ url('/') }}">Sistema de Gerenciamento da Habitação</a>
            </div>
        
        <div id="acessibilidade">
            <span>
                <a href="#" onClick="contrastScript().toggleContrast(event)"><i class="fas fa-adjust"></i>Alto Contraste</a>
            </span>
            <span>
                <a href="//www.vlibras.gov.br" target="_BLANK"><i class="fas fa-deaf"></i>VLibras</a>
            </span>
        </div>
    </header>
<div class="container">
    
    <main>
        <form class="text-left form-validate" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}  
        
            <div class="card" id="login-cpf">
               <input type="hidden" name="_csrf" value="b255a43c-b1c9-4de7-b5e2-69c506d47a98" />
               <h3>Acesse sua conta com Email</h3>
               

               <div class="accordion-panel" id="accordion-panel-id">
                
                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                  <input tabindex="1" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{ old('email') }}" placeholder="Digite seu Email" required autofocus>
                  
                  @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif

                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>
                    <input tabindex="2" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Digite sua senha"  required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

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




  <footer>
      <!--div id="footer-brasil">
          <div id="wrapper-footer-brasil">
              <a class="logo-acesso-footer" href="http://www.acessoainformacao.gov.br/" alt="Acesso Ã  informaÃ§Ã£o" title="Acesso Ã  informaÃ§Ã£o"></a>
              <a class="logo-governo-federal" href="http://www.brasil.gov.br/" alt="Governo Federal" title="Governo Federal"></a>
          </div>
      </div-->
  </footer>

  
  <!-- Jquery -->
  <script src="{{URL::asset('js/login/jquery-2.2.4.min.js')}}"></script>
  <!-- Barra do Governo -->
  <!--script defer="defer" src="//barra.brasil.gov.br/barra_2.0.js" type="text/javascript"></script-->
  <!-- JS Website -->
  <script src="{{URL::asset('js/login/scripts.js')}}"></script>
  <script src="{{URL::asset('js/login/jquery.maskedinput.js.js')}}"></script>
  
</body>

</html><script>
	focusOnLoad('accountId');
	
    (function () {
        window.addEventListener("load", function () {
            cpfMask("accountId");
            var userAgentString = navigator.userAgent || navigator.vendor || window.opera;
            var isMobile = userAgentString.includes("Android") || userAgentString.includes("iPad") || userAgentString.includes("iPhone");
            if (isMobile) {
                document.getElementById("cert-digital").style = "display: none;";
                document.getElementById("link-duvidas-desk").style = "display: none;";
                document.getElementById("link-duvidas-mob").style = "display: contents;";
            } else {
                document.getElementById("cert-digital").style = "display: flex;";
                document.getElementById("link-duvidas-desk").style = "display: contents;";
                document.getElementById("link-duvidas-mob").style = "display: none;";
            }
        });
    })();

    function accordion(elem) {
        var panel = document.getElementById(elem)
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = 0;
        }
    }

    setTimeout(function () { location.reload(true); }, 29 /* minutes */ * 60 /* seconds */ * 1000 /* millis */);
</script>
