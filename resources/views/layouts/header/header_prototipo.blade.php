<li class="plain dropdown-submenu">                        
    <a href="#" title="Seleção de Propostas" class="plain">Protótipos De HIS</a>
    <ul class="submenu">
        <li class="dropdown-submenu">
            <a href="#" class="state-published hasDropDown">Propostas</a>
            <ul class="submenu navTree navTreeLevel1">
                <li>
                    <a href='{{ url("/propostas") }}' title="Minhas Permissões" class="state-published">Minhas Propostas</a>                   
                </li> 
            </ul>
        </li>
        
    </ul>
</li>
<li class="plain dropdown-submenu">                        
    <a href="#" title="Ente Público" class="plain">Ente Público</a>
    <ul class="submenu">
        <li class="dropdown-submenu">
            <a href="#" title="Empreendimentos" class="state-published hasDropDown">Usuários e Responsáveis</a>
            
            <ul class="submenu navTree navTreeLevel1">
                <li><a href="{{ url('/selecao_beneficiarios/usuarios') }}" title="Usuários e Responsáveis" class="state-published">Dados do Responsável</a></li>
            </ul>
        </li>
        <li class="dropdown-submenu">
            <a href="#" title="Empreendimentos" class="state-published hasDropDown">Permissões</a>
            
            <ul class="submenu navTree navTreeLevel1">
                <li><a href="{{ url('/prototipo/permissoes') }}" title="Minhas Permissões" class="state-published">Minhas Permissões</a>   </li>
                
            </ul>
        </li>
                               
    </ul>
</li>