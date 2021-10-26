@extends('layouts.app')

@section('content')



<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Painel de Controle
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">
  
  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Responsável e Permissões </h5>         
    </div>
    <div class="panel-body">
        <div class="row">            
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("/usuario/$usuario->id") }}'>
                            <img src='{{ URL::asset("/images/icones/dados_usuarios.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Dados do<br/>Responsável</p>
                    </h4>
                </div>  
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("/prototipo/permissoes") }}'>
                            <img src='{{ URL::asset("/images/icones/permissao_usuario.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Minhas<br/>Permissões</p>
                    </h4>
                </div>  
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    
                </div>
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    
                </div>                    
           </div>
     </div>   
     <div class="titulo">
        <h5>Documentos e Legislações </h5>         
    </div>
    
    <div class="panel-body">
        <div class="row">            
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("/documents/prototipo/manual_uso_sistema.pdf") }}'>
                            <img src='{{ URL::asset("/images/icones/documentos_pdf.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Manual de uso <br/>do Sistema</p>
                    </h4>
                </div>     
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("/documents/prototipo/questoes_formulario.pdf") }}'>
                            <img src='{{ URL::asset("/images/icones/documentos.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Questões do <br/>Formulário</p>
                    </h4>
                </div>
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("/documents/prototipo/modelo_mapeamento.pdf") }}'>
                            <img src='{{ URL::asset("/images/icones/documentos_pdf.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Modelo de <br/>Mapeamento</p>
                    </h4>
                </div>  
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("/documents/prototipo/portaria.pdf") }}'>
                            <img src='{{ URL::asset("/images/icones/documentos_pdf.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Portaria <br/></p>
                    </h4>
                </div>                    
           </div>
     </div> 
     @if(count($permissao) > 0)
     <div class="titulo">
        <h5>Propostas </h5>         
    </div>
    
    <div class="panel-body">
        <div class="row">            
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("prototipo/novo") }}'>
                            <img src='{{ URL::asset("/images/icones/questionarios_novo.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Nova <br/>Proposta</p>
                    </h4>
                </div>     
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("/prototipos/usuario/$usuario->id") }}'>
                            <img src='{{ URL::asset("/images/icones/questionarios.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Minhas <br/>Propostas</p>
                    </h4>
                </div>
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    
                </div>    
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    
                </div>                  
           </div>
     </div> 
    @endif
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection