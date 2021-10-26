

<nav id="main-navigation" class="navigation-cell">
    <ul class="list-navigation">
        
    <li class="plain">
            <a href="#" title="Administrador" class="plain">Seleção</a>
            <ul class="submenu">
                
                <li>
                    <a href="{{ url('/selecao/demanda') }}" title="Seleção" class="state-published">Seleção</a>                   
                </li>            
            </ul>
        </li>             
    <li class="plain">
            <a href="#" title="Administrador" class="plain">Dirigente</a>
            <ul class="submenu">
                
                <li>
                    <a href="{{ url('/entePublico/dirigente') }}" title="Dados Dirigente" class="state-published">Dados Dirigente</a>                   
                </li>            
            </ul>
        </li>   
        @can('eEntePublico')  
        <li class="plain">
            <a href="#" title="Administrador" class="plain">Ente Público</a>
            <ul class="submenu">
                
                <li>
                    <a href="{{ url('/entePublico/usuarios') }}" title="Usuários e Responsáveis" class="state-published">Usuários e Responsáveis</a>                   
                </li>            
            </ul>
        </li>   
        @endcan
                 
    
     </ul>
  
  <div class="navigation-redes navigation-cell">
        <h3>Redes sociais</h3>
        <ul class="portal-redes">
            
        <li class="portalredes-twitter portalredes-item">
                            <a href="https://twitter.com/mincidades">Twitter</a>
                        </li>                    
                        <li class="portalredes-youtube portalredes-item">
                            <a href="http://youtube.com/mincidades">YouTube</a>
                        </li>                    
                        <li class="portalredes-facebook portalredes-item">
                            <a href="https://facebook.com/mincidades">Facebook</a>
                        </li>                    
                        <li class="portalredes-flickr portalredes-item">
                            <a href="http://flickr.com/mincidades">Flickr</a>
                        </li>  
            
        </ul>
    </div>
          </nav>