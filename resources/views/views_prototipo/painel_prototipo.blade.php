@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            
            <cabecalho-form
            :titulo="'Painel de Controle'"
            :barracompartilhar="false"
           
                    >
                        
            </cabecalho-form> 

            <div class="titulo">
                <h3>Responsável e Permissões </h3>         
            </div>
            <div class="panel-body">
                <div class="row">            
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/usuario/$usuario->id") }}'>
                                    <img src='{{ URL::asset("/img/icones/dados_usuarios.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Dados do<br/>Responsável</p>
                            </h4>
                        </div>  
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/prototipo/permissoes") }}'>
                                    <img src='{{ URL::asset("/img/icones/permissao_usuario.png")}}'  class="img-thumbnail img-responsive" >
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
                <h3>Documentos e Legislações </h3>         
            </div>
            
            <div class="panel-body">
                <div class="row">            
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/manual_uso_sistema.pdf") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos_pdf.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Manual de uso <br/>do Sistema</p>
                            </h4>
                        </div>     
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/questoes_formulario.docx") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Questões do <br/>Formulário</p>
                            </h4>
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/portaria_959.pdf") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos_pdf.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Portaria n° 959/2021<br/></p>
                            </h4>
                        </div>  
                       
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/edital_chamamento.pdf") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos_pdf.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p> Edital de<br/>Chamamento</p>
                            </h4>
                        </div> 
                    </div>  
                    <div class="row">    
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/sintese_edital.pdf") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos_pdf.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Síntese Edital<br/>de Chamamento</p>
                            </h4>
                        </div> 
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/modelo_planta.png") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos_pdf.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Modelo de <br/>Planta do Terreno (Item 1.11)</p>
                            </h4>
                        </div>  
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/modelo_mapeamento.pdf") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos_pdf.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Modelo de <br/>Mapeamento (Item 3.3)</p>
                            </h4>
                        </div>   
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/mapeamento_rotas.docx") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Modelo de Registro<br/>das Rotas (Item 3.4)</p>
                            </h4>
                        </div>   
                              
                                 
                   </div>
             </div> 
             @if(count($permissao) > 0)
             <div class="titulo">
                <h3>Propostas </h3>         
            </div>
            
            <div class="panel-body">
                <div class="row">            
                        
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/propostas") }}'>
                                    <img src='{{ URL::asset("/img/icones/questionarios.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Minhas <br/>Propostas</p>
                            </h4>
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <!--
                            <h4>
                                @if($numPrototipos <= 10)
                                    <a href='{{ url("prototipo/novo") }}'>
                                        <img src='{{ URL::asset("/img/icones/questionarios_novo.png")}}'  class="img-thumbnail img-responsive" >
                                    </a>
                                <p>Nova <br/>Proposta</p>
                                @else 
                                <a href="#" class="btn disabled"  role="button">
                                        <img src='{{ URL::asset("/img/icones/questionarios_novo.png")}}'  class="img-thumbnail img-responsive" >
                                   
                                    <p class="text-muted">Nova <br/>Proposta</p>
                                <a>    
                                @endif
                            </h4>
                        -->
                        </div>     
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            
                        </div>    
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            
                        </div>                  
                   </div>
             </div> 
            @endif
            
            <div class="titulo">
                <h3>Resultados</h3>         
            </div>
            
            <div class="panel-body">
                <div class="row">            
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h4>
                                <a href='{{ url("/documents/prototipo/ata_julgamento_3305240.pdf") }}' target="_blank">
                                    <img src='{{ URL::asset("/img/icones/documentos_pdf.png")}}'  class="img-thumbnail img-responsive" >
                                </a>
                                <p>Ata de<br/>Julgamento</p>
                            </h4>
                        </div>     
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            
                        </div>  
                       
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            
                        </div> 
                    </div>  
                    
             </div> 
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


