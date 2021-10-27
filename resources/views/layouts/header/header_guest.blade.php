
<li class="plain dropdown-submenu">                        
    <a href="{{ url('/dados_programa') }}" title="Dados do Programas" class="plain">Dados do Programas</a>
    <ul class="submenu">
        <li class="dropdown-submenu">
            <li>
            <a href="{{url('/dados_abertos/sistema_habitacao')}}" title="Dados Abertos"  class="state-published">Dados Abertos</a>
            </li>
        </li>    
        <li class="dropdown-submenu">
            <li><a href="{{url('/empreendimentos/filtro')}}" title="Dados dos Empreendimentos" class="state-published">Dados dos Empreendimentos</a></li>
            
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
    <a href="#" title="PCVA - Parcerias" class="plain">PCVA - Parcerias</a>
    <ul class="submenu">
        <li class="dropdown-submenu">
            
                <li>
                    <a href="{{ url('/pcva_parcerias/termo/consultar') }}" title="Consultar Manifestação de Interesse" class="state-published">Consultar Manifestação</a>
                </li>
                <!--
                <li>
                    <a href="{{ url('/pcva_parcerias/solicitar_adesao') }}" title="Manifestar Interesse" class="state-published">Manifestar Interesse</a>
                </li>
            -->
                <li>
                    <a href="{{ url('/pcva_parcerias/validacao/filtro') }}" title="Validar Manifestação de Interesse" class="state-published">Validar Manifestação</a>
                </li>
            
        </li>
                              
    </ul>
</li>
<li class="plain dropdown-submenu">                        
    <a href="#" title="Seleção de Propostas" class="plain">Seleção de Propostas</a>
    <ul class="submenu">
        <li class="dropdown-submenu">
        
                <li><a href="{{ url('/proposta/selecao') }}" title="Propostas Apresentadas" class="state-published">Propostas Apresentadas</a></li>                                   
        
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
