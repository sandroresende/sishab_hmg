<li class="plain dropdown-submenu">                        
    <a href="{{ url('/dados_programa') }}" title="Dados do Programas" class="plain">Dados do Programas</a>
    <ul class="submenu">
        <li class="dropdown-submenu">
            <a href="#" title="Empreendimentos" class="state-published hasDropDown">Empreendimentos</a>
            
            <ul class="submenu navTree navTreeLevel1">
                <li><a href="{{url('/empreendimentos/filtro')}}" title="Dados dos Empreendimentos" class="state-published">Dados dos Empreendimentos</a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Relatórios</a>
            <ul class="submenu navTree navTreeLevel1">
                <li><a href="{{url('/operacoes/filtro')}}" title="Relatório Executivo" class="state-published">Relatório Executivo</a></li>
                <li><a href="{{url('/medicoes/situacao/filtro')}}" title="Situação Medições" class="state-published">Situação das Medições</a></li>                                    
            </ul>
        </li>                            
    </ul>
</li>

<li class="plain dropdown-submenu">                        
    <a href="#" title="Seleção de Propostas" class="plain">Oferta Pública</a>
    <ul class="submenu">
       
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Financeiro</a>
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href='{{ url("oferta_publica/filtro_relatorio_devolucao/") }}'>Remessas de Devolução</a>            
                </li>
            </ul>
        </li>     
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Obras</a>
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href="{{ url('/oferta_publica/filtro_execucao_obras') }}" title="Execução de Obras" class="state-published">Execução de Obras</a>                   
                </li>
            </ul>
        </li> 
        <li class="dropdown-submenu">
            <a href="#" class="state-published hasDropDown">Protocolos</a>
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href="{{ url('/oferta_publica/protocolos/instituicao/filtro') }}" title="Protocolos IF" class="state-published">Protocolos IF</a>
                </li> 
                <li>
                    <a href="{{ url('/oferta_publica/protocolos/filtro') }}" title="Situação Protocolo" class="state-published">Situação Protocolo</a>
                </li> 
            </ul>    
        </li>                           
    </ul>
</li>

<li class="plain dropdown-submenu">                        
    <a href="#" title="PCVA - Parcerias" class="plain">PCVA - Parcerias</a>
    <ul class="submenu">
        <li class="dropdown-submenu">
            <a href="#" title="Manifestação de Interess" class="state-published hasDropDown">Manifestação de Interesse</a>
            
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href="{{ url('admin/pcva_parcerias/resumoSituacao/filtro') }}" title="Relatório de Recebimento" class="state-published">Relatório de Recebimento</a>
                </li>
                <li>
                    <a href="{{ url('admin/pcva_parcerias/termo/filtro') }}" title="Manifestação de Interesse" class="state-published">Manifestação de Interesse</a>
                </li>
            </ul>
        </li>
                              
    </ul>
</li>

<li class="plain dropdown-submenu">                        
    <a href="#" title="Protótipo de HIS" class="plain">Protótipo de HIS</a>
    <ul class="submenu">       
       
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Permissões</a>
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href='{{ url("admin/prototipo/permissoes/") }}' title="Usuários" class="state-published">Analisar Permissões</a>                   
                </li>     
                
                <li>
                    <a href='{{ url("admin/prototipo/permissoes/consulta") }}' title="Usuários" class="state-published">Situação das Permissões</a>                                       
                </li>                                
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Propostas</a>
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href='{{ url("/admin/prototipo/consulta") }}' title="Usuários" class="state-published">Propostas</a>                   
                </li>                             
            </ul>
        </li> 
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Usuários</a>
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href='{{ url("admin/prototipo/usuarios") }}' title="Usuários" class="state-published">Usuários</a>                   
                </li>                           
            </ul>
        </li>                            
    </ul>
</li>

<li class="plain dropdown-submenu">                        
    <a href="#" title="Seleção de Demandas" class="plain">Seleção de Demandas</a>
    <ul class="submenu">       
       
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Arquivos</a>
            <ul class="submenu navTree navTreeLevel1">
                <li><a href="{{ url('admin/selecao_demanda/arquivos/gerados/filtro') }}" title="Arquivos Gerados" class="state-published">Arquivos Gerados</a></li>                                
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Reponsáveis</a>
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href='{{ url("/admin/selecao_demanda/filtro") }}' title="Entes Públicos" class="state-published">Entes Públicos</a>                   
                </li> 
                <li>
                    <a href='{{ url("admin/selecao_demanda/usuarios/entes/filtro") }}' title="Usuários" class="state-published">Usuários</a>                   
                </li>                            
            </ul>
        </li>                            
    </ul>
</li>

<li class="plain dropdown-submenu">                        
    <a href="#" title="Seleção de Propostas" class="plain">Seleção de Propostas</a>
    <ul class="submenu">
        <li class="dropdown-submenu">
            <a href="#" class="state-published hasDropDown">Propostas</a>
            <ul class="submenu navTree navTreeLevel1">
                <li><a href="{{ url('/proposta/selecao') }}" title="Propostas Apresentadas" class="state-published">Propostas Apresentadas</a></li>                                   
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a href="#" title="Resumos" class="state-published hasDropDown">Resumos</a>
            <ul class="submenu navTree navTreeLevel1">
                <li><a href="{{ url('/proposta/contratadas/resumo/filtro') }}" title="Resumo Contratadas" class="state-published">Resumo Contratadas</a></li>
                <li><a href="{{ url('/proposta/selecao/resumo/filtro') }}" title="Resumo Seleção" class="state-published">Resumo Seleção</a></li>                                    
            </ul>
        </li>                            
    </ul>
</li>
