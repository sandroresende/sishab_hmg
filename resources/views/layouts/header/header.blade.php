<!--================Header Menu Area =================-->
<header id="main-header">    
    <div class="header-wrapper">
        <div id="logo">
            <a id="portal-logo" title="Sistema da Habitação. " href="http://sishab.cidades.gov.br">
                <div id="portal-title" class="corto">SISHAB</div>
                <span id="portal-description">Ministério do Desenvolvimento Regional</span>
            </a>
        </div><!-- div logo -->

        <div class="header-accessibility">
            <ul>
                <li id="siteaction-contraste"><a href="#" accesskey="6">Alto Contraste</a></li>
                <li id="siteaction-vlibras"><a href="http://www.vlibras.gov.br/" accesskey="">VLibras</a></li>
            </ul>            
        </div><!-- header-accessibility -->
    </div><!-- header-wrapper -->

    <!-- Segunda linha do header -->
     <div class="search-wrapper">
        <!-- icones -->
        <div class="header-icons">
            <a class="ico-navegacao">Navegação</a>
        </div>
        <!-- links destaque -->
        <div class="links-destaque">
            <ul id="portal-services">        
                    @guest
                        <li>
                            <a href="{{url('/novo_executivo/filtro')}}" title="Relatório Executivo">Relatório Executivo</a>
                        </li>
                        <li >
                            <a href="{{url('/empreendimentos/filtro')}}" title="Empreendimentos" class="state-published">Empreendimentos</a>
                        </li>
                        <li >
                            <a href="{{ url('/selecao') }}" title="Propostas Apresentadas">Propostas Apresentadas</a>
                        </li>
                        <li >
                                <a href="{{ url('/externo/pagamento/situacao/filtro') }}"  role="presentation" class="active" title="Propostas Apresentadas">Situação Pagamento<span class="badge badge-danger"> Novo</span></a> 
                            </li> 
                    @else   

                        @if(Auth::user()->modulo_sistema_id==2)
                            @if(Auth::user()->bln_aceite_termo)
                                <li >
                                    <a href="{{ url('/documentos') }}" title="Consulta Rápida">Documentos</a>
                                </li>
                            @endif    
                        @elseif(Auth::user()->modulo_sistema_id==3)
                           
                                <li >
                                    <a href="{{ url('/prototipo/permissoes') }}" title="Consulta Rápida">Minhas Permissões</a>
                                </li>
                               
                           
                        @else
                            <li >
                                <a href="{{ url('/consultaRapida') }}" title="Consulta Rápida">Consulta Rápida</a>
                            </li>
                        
                            <li >
                                <a href="{{url('/novo_executivo/filtro')}}" title="Relatório Executivo">Relatório Executivo</a>
                            </li>
                            <li >
                                <a href="{{url('/empreendimentos/filtro')}}" title="Empreendimentos" class="state-published">Empreendimentos</a>
                            </li>
                        
                            <li >
                                <a href="{{ url('/selecao') }}" title="Propostas Apresentadas">Propostas Apresentadas</a>
                            </li>  

                            <li >
                                <a href="{{ url('/pagamento/situacao/filtro') }}"  role="presentation" class="active" title="Propostas Apresentadas">Situação Pagamento<span class="badge badge-danger"> Novo</span></a> 
                            </li>  
                        @endif       
                        
                        
                        
                                            
                    @endguest
                
            </ul>
        </div><!--links-destaque-->

        
        <!-- Search -->
        <div id="portal-searchbox text-right">
            <ul id="portal-services">   
                    @guest
                    <li id="portal-services-manuais-1536932235" class="nav-item">
                        <a href="{{ route('login') }}"  class="sf-sign-error"class="nav-link logout"> 
                        <i class="fas fa-sign-out-alt"></i><span class="d-none d-sm-inline-block"> </span>  Login 
                                        
                        </a>                    
                        </li>
                    @else          
                    <li id="portal-services-manuais-1536932235" class="nav-item">
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sf-sign-error"class="nav-link logout"> 
                        <i class="fas fa-sign-out-alt"></i><span class="d-none d-sm-inline-block"> </span>  Sair 
                                        
                        </a>                    
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        
                    @endguest
                
               
            </ul>
        <!--
            <form id="nolivesearchGadget_form" action="http://www.portalpadrao.gov.br/@@busca">                
                <fieldset class="LSBox">
                    <legend class="hiddenStructure">Buscar no portal</legend>
                    <label class="hiddenStructure" for="nolivesearchGadget">Buscar no portal</label>
                    <input name="SearchableText" type="text" size="18" title="Buscar no portal" placeholder="Buscar no portal" class="searchField" id="nolivesearchGadget" />
                    <input class="searchButton" type="submit" value="Buscar no portal" />
                </fieldset>
            </form>
        -->    
        </div><!-- div portal-searchbox -->
      </div><!-- div search-wrapper-->
      
      <!-- Main Menu -->
      <div class="navigation-wrapper">

        <div class="navigation-content">
            @guest
                @include('layouts.nav.guest')                
            @else 
            
                @if(Auth::user()->modulo_sistema_id==2)
                    @if(Auth::user()->bln_aceite_termo)
                        @include('layouts.nav.ente_publico')  
                    @endif    
                @elseif(Auth::user()->modulo_sistema_id==3)
                    @if(Auth::user()->bln_aceite_termo)
                        @include('layouts.nav.prototipo')  
                    @endif    
                @else
                    @include('layouts.nav.logado')  
                @endif

                
            @endguest
        </div>
      </div>
    </header>
<!--================Header Menu Area =================-->