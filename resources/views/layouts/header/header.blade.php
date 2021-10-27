<header id="site-header" class="has-navigation-dropdown">
    <div class="header-wrapper secondary">
        <div class="portal-name">
            <a href="https://www.gov.br/pt-br" class="portal-logo">
            <span class="sr-only">Portal Gov.br</span>
            </a>
            <a href="https://www.gov.br" class="nome-orgao">Governo Federal</a>
        </div>
        <div class="site-header-links">
            <div class="links-rapidos">
                <a class="toggle-links-rapidos" href="#" title="Acesso rápido">
                <span class="fas fa-ellipsis-v"></span>
                <span class="sr-only">Acesso rápido</span>
                </a>
                <ul>
                    <li class="titulo">Acesso rápido</li>
                    <li><a href="https://www.gov.br/pt-br/orgaos-do-governo">Órgãos do Governo</a></li>
                    <li><a href="http://www.acessoainformacao.gov.br">Acesso à Informação</a></li>
                    <li><a href="http://www4.planalto.gov.br/legislacao">Legislação</a></li>
                    <li><a href="https://www.gov.br/governodigital/pt-br/acessibilidade-digital">Acessibilidade</a></li>
                    <!--<li>
                        <a href="http://www.vlibras.gov.br/" class="link-vlibras">
                          <span class="fas fa-assistive-listening-systems"></span>
                        </a>
                        </li>-->
                </ul>
            </div>
            <ul class="header-icons">
                <li>
                    <a href="#" class="link-contraste">
                    <span class="fas fa-adjust" aria-hidden="true"></span>
                    <span class="sr-only">Mudar para o modo de alto contraste</span>
                    </a>
                </li>
            </ul>
            <!--
            <a href="https://acesso.gov.br" class="link-acesso">
                <span class="fas fa-user"></span>
                Entrar
                </a>
            -->   
        </div>
    </div>
    <div class="main">
        <div class="header-wrapper">
            <div class="site-name-wrapper">
                <a class="ico-navegacao toggle-main-navigation" href="#">
                <span class="sr-only">Abrir menu principal de navegação</span>
                <span class="fa fa-bars" aria-hidden="true"></span>
                <span class="fa fa-times" aria-hidden="true"></span>
                </a>
                <!-- <a href="/" class="site-name">Nome do site</a> -->
                <!-- Usar nome completo -->
                <div class="site-name">
                    <a href="{{ url('/') }}" title="">Sistema de Gerenciamento da Habitação</a>
                </div>
            </div>
            <div class="site-header-links">
                <div class="links-rapidos">
                    @guest
                        <a href="{{ route('login') }}" class="link-acesso">
                            <span class="fas fa-user"></span>
                            Entrar
                        </a>
                    @else
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="link-acesso">
                        <span class="fas fa-sign-out-alt"></span>
                        Sair
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
                        
                    @endguest
                </div>
            </div>    
        </div>
    </div>
    <!-- Main Menu -->
    <nav class="navigation-wrapper navigation-dropdown" aria-label="Menu Principal">
        <div class="navigation-content">
            <div id="main-navigation" class="navigation-cell">
                <ul class="list-navigation">

                    @guest
                        @include('layouts.header.header_guest')
                    @else    
                        @if(Auth::user()->modulo_sistema_id==2)
                            @if(Auth::user()->bln_aceite_termo)
                                @include('layouts.header.header_selecao_demanda')                            
                            @endif    
                        @elseif(Auth::user()->modulo_sistema_id==3)
                            @if(Auth::user()->bln_aceite_termo)
                                @include('layouts.header.header_prototipo')
                            @endif    
                        @else
                            @include('layouts.header.header_sishab_logado')
                        @endif
                    @endguest
                    
                    <!-- 
                        
                    -->
                    
                </ul>
            </div>
        </div>
        <div class="navigation-content-extra">
            <div class="links-redes-wrap">
                <div class="links-uteis links-uteis-mobile">
                    <ul>
                        <li>
                            <a href="#">Acessibilidade</a>
                        </li>
                        <!-- <li class="language-selection">
                            <a href="" class="currentLanguage language-pt-br">
                              Português
                            </a>
                            <ul>
                              <li class="title">Idioma/Language</li>
                              <li class="currentLanguage language-pt-br">
                                <a href="" title="Português (Brasil)">Português (Brasil)</a>
                              </li>
                              <li class="language-en">
                                <a href="" title="English">English</a>
                              </li>
                              <li class="language-es">
                                <a href="" title="Español">Español</a>
                              </li>
                            </ul>
                            </li> -->
                        <li>
                            <a href="#" class="link-contraste">
                            <span class="fas fa-adjust" aria-hidden="true"></span>
                            <span class="sr-only">Mudar para o modo de alto contraste</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="links-uteis">
                    <div class="titulo">Links Úteis</div>
                    <ul>
                        <!-- <li>
                            <a href="#">Órgãos do Governo</a>
                            </li> -->
                        <li>
                            <a href="https://www.gov.br/pt-br/apps/@@galeria-de-aplicativos">Galeria de Aplicativos</a>
                        </li>
                        <li>
                            <a href="https://www.gov.br/pt-br/participacao-social">Participe</a>
                        </li>
                    </ul>
                </div>
                <div class="header-accessibility">
                    <ul>
                        <li>
                            <a href="https://www.gov.br/pt-br/orgaos-do-governo" class="orgaos-de-governo">Órgãos do Governo</a>
                        </li>
                        <li>
                            <a href="https://www.gov.br/pt-br/apps/@@galeria-de-aplicativos">Galeria de Aplicativos</a>
                        </li>
                        <li>
                            <a href="http://www4.planalto.gov.br/legislacao">Legislação</a>
                        </li>
                        <li>
                            <a href="http://www.acessoainformacao.gov.br">Acesso à Informação</a>
                        </li>
                        <li>
                            <a href="https://www.gov.br/pt-br/participacao-social">Participe</a>
                        </li>
                    </ul>
                </div>
                <div class="redes-sociais">
                    <div class="titulo">Redes sociais</div>
                    <ul class="portal-redes">
                        <li class="portalredes-twitter portalredes-item">
                            <a href="https://www.twitter.com/mdregional_br">Twitter</a>
                        </li>
                        <li class="portalredes-youtube portalredes-item">
                            <a href="https://www.youtube.com/ministeriododesenvolvimentoregional">YouTube</a>
                        </li>
                        <li class="portalredes-facebook portalredes-item">
                            <a href="https://www.facebook.com/mdregionalbr">Facebook</a>
                        </li>
                        <li class="portalredes-instagram portalredes-item">
                            <a href="https://www.instagram.com/mdregional_br">Instagram</a>
                        </li>
                        <li class="portalredes-flickr portalredes-item">
                            <a href="https://www.flickr.com//photos/desenvolvimento_regional/albums">Flickr</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main Menu -->
</header>