<!-- Columns -->
<main id="main-content" role="main">
    <div id="viewlet-above-content">
    </div>
    <div class="">
        <dl class="portalMessage info" id="kssPortalMessage" style="display:none">
            <dt>Info</dt>
            <dd></dd>
        </dl>
        @yield('content')
        
        <div id="viewlet-above-content-body"></div>
        
        
        <div id="viewlet-below-content-body">
            <div class="visualClear"><!-- --></div>
            <div class="documentActions">
            </div>
        </div>                            
    </div>
                    

                    

            

    <div id="viewlet-below-content">
        <div class="voltar-topo">
            <a href="#wrapper">Voltar ao topo</a>
        </div>
        <div class="texto-copyright">
            
         <!--   <a rel="license" href="http://www.cidades.gov.br/habitacao-cidades">Secretaria Nacional da Habitação</a>.-->
         @auth
            <span omit-tag=""> Usuário: {{ auth()->user()->name }}</span> </br>
         @endauth   
            <span omit-tag=""> (Versão {{ config('app.versao') }})</span> 
        </div>
    </div>
</main>