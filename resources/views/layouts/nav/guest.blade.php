<nav id="main-navigation" class="navigation-cell">
    <ul class="list-navigation">
        
        <li class="plain">
            <a href="#" title="Seleção de Propostas" class="plain">Seleção de Propostas</a>
            <ul class="submenu">
                <li>
                    <a href="{{ url('/selecao') }}" title="Propostas Apresentadas" class="state-published">Propostas Apresentadas</a>
                </li>
                <li>
                    <a href="{{ url('/selecao/resumo/filtro') }}" title="Resumo Seleção" class="state-published">Resumo Seleção</a>
                </li>
                <li>
                    <a href="{{ url('/contratadas/resumo/filtro') }}" title="Resumo Contratadas" class="state-published">Resumo Contratadas</a>
                </li>
            </ul>
        </li>
        <li class="plain">
            <a href="" title="Programa Minha Casa Minha Vida" class="plain">PMCMV</a>
            <ul class="submenu">
               
            <li>
                  <a href="{{url('/empreendimentos/filtro')}}" title="Empreendimentos" class="state-published">Empreendimentos</a>
                </li> 
                <li>
                    <a href="{{url('/novo_executivo/filtro')}}" title="Relatório Executivo">Relatório Executivo </a>
                </li>               
                            
                

                
            </ul>
        </li> 
        <li class="plain">
            <a href="#" title="Solicitações e Liberações" class="plain">Solicitações e Liberações</a>
            <ul class="submenu">                
                <li>
                    <a href="{{url('/externo/pagamento/situacao/filtro')}}" title="Situação Pagamentos">Situação Pagamentos <span class="badge badge-danger">Novo</span></a>
                </li>  
                             
            </ul>
        </li>  
        @can('eAdmin')
  
      
                 
 
        <li class="plain">
            <a href="#" title="Protótipo" class="plain">Protótipo</a>
            <ul class="submenu">                
                <li>
                    <a href="{{url('/prototipo/registro')}}" title="Solicitar Registro">Solicitar Registro</a>
                </li>  
                             
            </ul>
        </li>  
       
        @endcan         
      
                 
            
     </ul>
  
  <div class="navigation-redes navigation-cell">
        <h3>Redes sociais</h3>
        <ul class="portal-redes">
            
                <li class="portalredes-twitter portalredes-item">
                    <a href="https://www.twitter.com/twitter">Twitter</a>
                </li>
            
                <li class="portalredes-youtube portalredes-item">
                    <a href="https://www.youtube.com/youtube">YouTube</a>
                </li>
            
                <li class="portalredes-facebook portalredes-item">
                    <a href="https://www.facebook.com/facebook">Facebook</a>
                </li>
            
                <li class="portalredes-flickr portalredes-item">
                    <a href="https://www.flickr.com/flickr">Flickr</a>
                </li>
            
        </ul>
    </div>
          </nav>