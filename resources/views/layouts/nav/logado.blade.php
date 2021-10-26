

<nav id="main-navigation" class="navigation-cell">
    <ul class="list-navigation">
        <li class="plain">
            <a href="#" title="Oferta Pública" class="plain">Oferta Pública</a>
            <ul class="submenu">

                <li>
                    <a href="{{ url('/execucao/obras/filtro') }}" title="Execução de Obras" class="state-published">Execução de Obras</a>                   
                </li>
                <li>
                  <a href="{{ url('/protocolos/instituicao/filtro') }}" title="Protocolos IF" class="state-published">Protocolos IF</a>
                </li>    
                <li>
                 <a href='{{ url("filtro_relatorio_devolucao/") }}'>Remessas de Devolução</a>            
                </li>
                
                <li>
                  <a href="{{ url('/protocolos/filtro') }}" title="Situação Protocolo" class="state-published">Situação Protocolo</a>
                </li>
                
            </ul>
        </li>
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
                    <a href="{{url('/beneficiarios/filtro')}}" title="Beneficiários" class="state-published">Beneficiários</a>                   
                </li>
               
                <li>
                  <a href="{{url('/empreendimentos/filtro')}}" title="Empreendimentos" class="state-published">Empreendimentos</a>
                </li> 
                
                <li>
                    <a href="{{url('/novo_executivo/filtro')}}" title="Relatório Executivo">Relatório Executivo </a>
                </li>                
               
                <li>
                  <a href="{{url('/executivo/contratacao/filtro')}}" title="Situação Contratação" class="state-published">Situação Contratação</a>
                </li>             
            </ul>
        </li> 
        @can('eGestao')  
        <li class="plain">
            <a href="#" title="Administrador" class="plain">Solicitações e Liberações</a>
            <ul class="submenu">                
                <li>
                    <a href="{{ url('/pagamento/situacao/filtro') }}" title="Solicitações de Pagamento" class="state-published">Situação das Solicitações de Pagamento</a>
                </li>
                             
            </ul>
        </li>  
        @endcan
        @can('eSNHDemanda')
        <li class="plain">
            <a href="#" title="Administrador" class="plain">Seleção de Demandas</a><span class="badge badge-danger"> Novo</span>
            <ul class="submenu">
                <li>
                    <a href="{{ url('/admin/arquivos/gerados') }}" title="Arquivos Gerados" class="state-published">Arquivos Gerados</a>                   
                </li>
                <li>
                    <a href='{{ url("admin/usuarios/entes") }}' title="Usuários" class="state-published">Usuários</a>                   
                </li>
                <li>
                    <a href='{{ url("/admin/entePublico/filtro") }}' title="Entes Públicos" class="state-published">Entes Públicos</a>                   
                </li>
                     
            </ul>
        </li> 
      



        <a href=>

        @endcan
        @can('eAdmin')
        <li class="plain">
            <a href="#" title="Administrador" class="plain">Protótipo</a><span class="badge badge-danger"> Novo</span>
            <ul class="submenu">
               
                <li>
                    <a href='{{ url("admin/usuarios/prototipos") }}' title="Usuários" class="state-published">Usuários</a>                   
                </li>
                <li>
                    <a href='{{ url("admin/permissoes/prototipos") }}' title="Usuários" class="state-published">Permissões</a>                   
                </li>     
            </ul>
        </li> 
        <li class="plain">
            <a href="#" title="Administrador" class="plain">Painel</a>
            <ul class="submenu">
                <li>
                    <a href="{{ url('/resumo/contratacao/filtro') }}" title="Contratação Total" class="state-published">Contratação Total</a>                   
                </li>
                <li>
                    <a href="{{ url('/resumo/contratos_vigentes/filtro') }}" title="Contratos Vigentes" class="state-published">Contratos Vigentes</a>                   
                </li>
                <li>
                    <a href="{{ url('/resumo/contratacao/ano/filtro') }}" title="Contratação Ano" class="state-published">Contratação Ano</a>                   
                </li>
                <li>
                    <a href="{{ url('/resumo/entrega/ano/filtro') }}" title="Entrega An" class="state-published">Entrega Ano</a>                   
                </li>
                <li>
                    <a href="{{ url('/resumo/paralisadas/filtro') }}" title="Obras Paralisadas" class="state-published">Obras Paralisadas</a>                   
                </li>        
            </ul>
        </li>   
        <li class="plain">
            <a href="#" title="Administrador" class="plain">Briefing<span class="badge badge-danger">Novo</span></a>
            <ul class="submenu">
                  
                <li>
                  <a href="{{url('/briefing/novo/filtro')}}" title="Briefing Novo" class="state-published">Briefing Novo</a>
                </li>     
                
            </ul>
        </li>   
      

             

        
        <li class="plain">
            <a href="" title="Programa Minha Casa Minha Vida" class="plain">PAC <span class="badge badge-danger">Em Desenvolvimento</span></a>
            <ul class="submenu">
                <li>
                  <a href="{{url('/vinculadas/filtro')}}" title="PAC" class="state-published">Projetos PAC<span class="badge badge-danger">Novo</span></a>
                </li>                
            </ul>
        </li>    
        @endcan
         
        @if(Auth::user()->bln_codem)
        <li class="plain">
            <a href="#" title="Controle de Demandas" class="plain">Codem&nbsp;<div class="badge badge-info">Breve</div></a>
            <ul class="submenu">
                <li>
                    <a href="{{ url('/codem/nova') }}" title="Nova Demanda" class="state-published">Nova Demanda</a>                   
                </li>
                <li>
                  <a href="{{ url('/demanda/usuario/lista') }}" title="Minhas Demandas" class="state-published">Minhas Demandas</a>
                </li>
                <li>
                  <a href="{{ url('/demanda/responder/usuario/lista') }}" title="Demandas a Responder" class="state-published">Demandas a Responder</a>
                </li>                
            </ul>
        </li> 
        @endif
        
        @can('eAdmin')
        <li class="plain">
            <a href="#" title="Administrador" class="plain">Administrador</a>
            <ul class="submenu">
                <li>
                    <a href="{{ url('/register') }}" title="Registrar Usuários" class="state-published">Registrar Usuários</a>                   
                </li>
                <li>
                    <a href="{{ url('/entePublico/usuario/novo') }}" title="Registrar Usuários" class="state-published">Registrar Usuário Ente Público</a>                   
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