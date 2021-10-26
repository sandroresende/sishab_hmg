@extends('layouts.app') @section('scripts')
<link href="{{ asset('css/style.blue.css') }}" rel="stylesheet">
<link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> @endsection 


@section('content')
<div id="content">   
    <div class="row">
        <div class="column col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div id="viewlet-above-content-title"></div>
                    <h3 class="documentFirstHeading text-center">
                    Anexar Novo Ofício
                        </h3>
                    <div class="linha-separa"></div>
                    
                    <div class="row">  
                        
                        <blockquote class="blockquote">   
                                                 
                            <h5>Como se registrar para acessar o sistema?</h5>
                            <footer class="blockquote-footer">
                                Deve ser enviado Ofício assinado pelo Chefe do Poder Executivo com a indicação do responsável pelo encaminhamento da proposta e e-mail institucional para cadastro e homologação. Para a modalidade II, deve ser enviado também Ofício assinado pelo Presidente da companhia, autarquia ou agência habitacional associada à ABC.
                            </footer>
                            <footer class="blockquote-footer">    
                                Os documentos devem ser elaborados em papel timbrado, digitalizados e enviados por intermédio do sistema, conforme os modelos disponibilizados abaixo:
    
                            </footer>
                        </blockquote>
                       <!-- Modelo de Ofício -->
                    <div class="card text-white">
                        <div class="card-header header-secundario">
                            <h4><i class="fas fa-file-alt"></i> <b>Modelos de Ofício</b></h4> 
                        </div>
                        <div class="card-body">
                            
                            <a 
                            class="modeloOficio" 
                            v-bind:href="show + '/modelo_oficio_prefeitura_1.pdf'"
                            target="_blank">
                            1. Modelo de Ofício Entes Públicos Locais</a>
                            
                            
                            <a 
                            class="modeloOficio" 
                            v-bind:href="show + '/modelo_oficio_COHAB.pdf'"
                            target="_blank">
                            2. Modelo de Ofício Ofício companhias, autarquias e agências de habitação </a>

                            <a 
                            class="modeloOficio" 
                            v-bind:href="show + '/modelo_oficio_prefeitura_2.pdf'"
                            target="_blank">
                            3. Modelo de Oficio Entes Públicos Locais, quando a proposta for de companhias, autarquias e agências de habitação.
  </a>
                        </div>
                    </div> 
                                                     
                    </div>
                    <!--fim row-->

                </div><!--fim card-body-->
            </div><!--fim card-->
        </div><!--fim column col-sm-6-->
        
        <div class="column col-sm-6">
            <div class="card">
                <div class="card-body">
                <form action="{{ url('prototipo/oficio/novo') }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="viewlet-above-content-title"></div>
                    <h3 class="documentFirstHeading text-center">
                    Ofício
                        </h3>
                    <div class="linha-separa"></div>
                    
                    <div class="row">
                        <div class="column col-xs-12 col-md-12">
                            <label for="caminho_doc_cartorio">Anexar Ofício Assinado </label>
                            <input type="file" class="form-control-file" id="txt_caminho_oficio" name="txt_caminho_oficio" accept="image/* , application/pdf" required>
                        </div>  
                    </div>    
                    <!--fim row-->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
                </form>    
                </div><!--fim card-body-->
            </div><!--fim card-->
        </div><!--fim column col-sm-6-->
    </div>
    <!--fim row-->       

</div>
<!-- content-->



@endsection