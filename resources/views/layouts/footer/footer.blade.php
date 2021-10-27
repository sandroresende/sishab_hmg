<footer id="portal-footer" class="portal-footer">
    <div class="footer-wrapper">
        <!--
        <div class="govbr-logo"></div>
        <div class="colunas-rodape">
            <div class="coluna-menu">-->
        <ul class="list-navigation">
            @guest
                @include('layouts.footer.footer_guest')
            @else    
                @include('layouts.footer.footer_logado')
            @endguest
        </ul>
        <!--</div>
            </div>-->
        <div class="redes-e-logos">
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
            <div id="footer-brasil"></div>
        </div>
    </div>
    <div class="texto-copyright">
        <span omit-tag="">Todo o conteúdo deste site está publicado sob a licença</span> <a rel="license" href="https://creativecommons.org/licenses/by-nd/3.0/deed.pt_BR">Creative Commons Atribuição-SemDerivações 3.0 Não Adaptada</a>.
    </div>
</footer>