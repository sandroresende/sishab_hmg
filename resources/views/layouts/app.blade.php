
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ str_replace('_', '-', app()->getLocale()) }}" xml:lang="pt-br">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
    <meta property="creator.productor" content="http://estruturaorganizacional.dados.gov.br/id/unidade-organizacional/26" />
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'SISHAB') }}</title>
    
   <!-- Scripts -->
   <script src="{{ mix('js/app.js') }}" defer></script>
<!-- Styles -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<link href="{{URL::asset('css/sweetalert2.css')}}" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/reset-cachekey-05f19b4e1825b7332a35448aee289ac6.css')}}" media="screen" />
       
        <!--[if lt IE 8]>    
    
    <link rel="stylesheet" type="text/css" href="http://www.portalpadrao.gov.br/portal_css/Sunburst%20Theme/IEFixes-cachekey-e79074df1bb9193fb3edb53a26ef0211.css" media="screen" />
        <![endif]-->
<!--
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/base-cachekey-5518dbd75b60103b24fe944c82b18e07.css')}}" /> 

    <script src="{{ asset('js/resource/plone/app/jquery-cachekey-14fec3f031c58f26b1d43002407af1a1.js') }}" defer></script>    
    <script src="{{ asset('js/resource/plone/formwidget/recurrencejquery/tmpl-beta1-cachekey-be321258a2e73cb09e63bff7f51247ef.js') }}" defer></script>    
    <script src="{{ asset('js/resource/collective/bootstrapjsbootstrap.min-cachekey-67cb02bdf7d60c7a543809ecc3e196b1.js') }}" defer></script>    
    <script src="{{ asset('js/resource/collective/coverjsmain-cachekey-ceea92c7e7ee540a3d522d488d341c0d.js') }}" defer></script>    
    <script src="{{ asset('js/resource/brasilgov/tilesvendorjquery/cycle2-cachekey-d7f5e842bac0e8a4c9e19834affe5a18.js') }}" defer></script>    
    <script src="{{ asset('js/resource/dropdown-menu-cachekey-2d3389bd132aab1c7d7a8b068eb67016.js') }}" defer></script>    
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/brasilgovagenda-b80d378.css')}}" />   
  <script src="{{ asset('js/resource/brasilgov/agenda/brasilgovagenda-b80d378.js') }}" defer></script>  
-->    
      
  
  
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/brasilgovportal-f357bf7.css')}}" />   
  <script src="{{ asset('js/resource/brasilgov/portal/brasilgovportal-f357bf7.js') }}" defer></script>    

   
        

@yield('scripts')


    <link rel="http://purl.org/dc/terms/subject http://schema.org/about http://xmlns.com/foaf/0.1/primaryTopic" href="http://vocab.e.gov.br/2011/03/vcge#esquema" />
    <link rel="author" href="http://www.portalpadrao.gov.br/author/Portal Padrão" title="Informações do Autor" />
    <link rel="canonical" href="http://www.portalpadrao.gov.br/noticias/ultimas-noticias" />

<!--
<script type="text/javascript">
    jQuery(function($){
        if (typeof($.datepicker) != "undefined"){
            $.datepick
-->
    <meta name="generator" content="Plone - http://plone.org" />
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <link rel="apple-touch-icon" sizes="180x180" href="/++theme++padrao/++theme++padrao/favicons/apple-touch-icon.png" />

    <link rel="icon" type="image/png" sizes="32x32" href="{{URL::asset('favicons/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('favicons/favicon-16x16.png')}}" />
    <link rel="manifest" href="{{URL::asset('favicons/manifest.json')}}" />
    <link rel="mask-icon" href="{{URL::asset('favicons/safari-pinned-tab.svg')}}" color="#00a300" />
    <meta name="msapplication-config" content="{{URL::asset('favicons/browserconfig.xml')}}" />
    <meta name="theme-color" content="#00a300" />
    
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/brasilgovtemas-7dd46b8.css')}}" />  



<!-- Fonts -->


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<link href="{{ asset('css/print.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}" />   



    </head>




<body  class="default-header-template template-summary_view portaltype-collection site-IDG section-noticias subsection-ultimas-noticias userrole-anonymous" dir="ltr">
    <div id="barra-identidade">
        <div id="barra-brasil" style="background:#7F7F7F; height: 20px; padding:0 0 0 10px;display:block;">
            <ul id="menu-barra-temp" style="list-style:none;">
                <li style="display:inline; float:left;padding-right:10px; margin-right:10px; border-right:1px solid #EDEDED"><a href="http://brasil.gov.br" style="font-family:sans,sans-serif; text-decoration:none; color:white;">Portal do Governo Brasileiro</a></li>
                <li><a style="font-family:sans,sans-serif; text-decoration:none; color:white;" href="http://epwg.governoeletronico.gov.br/barra/atualize.html">Atualize sua Barra de Governo</a></li>
            </ul>
        </div><!-- barra-brasil -->
    </div><!-- barra-identidade -->

    <ul id="skip-menu">
      <li><a accesskey="1" href="#content">Ir para o conteúdo</a></li>
      <li><a accesskey="2" href="#main-navigation">Ir para o menu</a></li>
      <li><a accesskey="3" href="#portal-searchbox">Ir para a busca</a></li>
      <li><a accesskey="4" href="#portal-footer">Ir para o rodapé</a></li>
    </ul><!-- User -->
    
    <!-- Header -->
    

    
    <div id="app" style="display:none;">
    @include('layouts.header.header')
        <div id="wrapper">
            <div id="main">
            @include('layouts.main')        
            </div><!-- div main -->
            <div class="conteudo-relacionado"></div>   
            @include('layouts.footer.footer')  
        </div><!-- div wrapper -->
    </div>
    <script src="{{URL::asset('js/sweetalert2.js')}}"></script>
    <script src="{{ asset('js/barra_2.0.js') }}" defer></script>
    <script src="{{ asset('js/brasilgovtemas-7dd46b8.js') }}" defer></script>
    
  

   @yield('scriptsjs')
       
    <div id="plone-analytics">
    </div>
    @include('layouts.flash')


</body>
</html>