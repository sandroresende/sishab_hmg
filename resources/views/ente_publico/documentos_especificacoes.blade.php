@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/entePublico') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> Ente Público</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Documentos e Especificações</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Documentos e Especificações
  </h1>

  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
        <div class="titulo">                            
                <h5>Legislações </h5>                        
        </div>
        <p class="text-justify">                    
            Esse é seu primeiro acesso.  É importante ter conhecimento da legislação vigente.
        </p>
        <div class="linha-separa"></div> 
        <div class="alert alert-danger" role="alert"><h4>VISUALIZAÇÃO OBRIGATÓRIA</h4></div>
            
            @foreach($legislacao as $legis)
              @if($legis->bln_leitura_obrigatoria)
                <div class="form-group">
                      <div class="well">
                          <div id="{{$legis->id}}" class="form-group">
                              <div class="row">
                                  <div class="column col-md-1 col-xs-3">
                                  @if($legis->bln_visualizacao)
                                  <button type="button" class="btn btn-primary" onclick='window.open("{{$legis->txt_caminho_arquivo}}")'><i class="fas fa-file-pdf fa-4x"></i></button>
                                  @else
                                  <form method="post" action='{{ url("/aceite/$legis->id")}}'>
                                          @csrf
                                          <button type="submit" class="btn btn-primary" onclick='window.open("{{$legis->txt_caminho_arquivo}}")'><i class="fas fa-file-pdf fa-4x"></i></button>
                                      </form>   
                                         
                                 @endif   
                                  </div>
                                  <div  class="column col-md-11 col-xs-9">
                                      <p class="text-justify">
                                          <strong>{{$legis->txt_titulo}}</strong> {{$legis->txt_descricao_legislacao}}
                                      </p>
                                  </div>
                              </div>
                              @if(!empty($legis->data_visualizacao))
                              <em>Visualizado em: {{$legis->data_visualizacao->format('d/m/Y h:m:s')}}</em>
                              @endif
                          </div>
                      </div>
                          <br/>
                  </div> <!-- FECHA from_group -->
                @endif  
            @endforeach

            <div class="alert alert-success" role="alert"><h4>VISUALIZAÇÃO OPCIONAL</h4></div>
       
        <div class="form-group">
            <div class="well">
                <div id="1" class="form-group">
                    <div class="row">
                        <div class="col-md-1 col-xs-3">
                            
                                <a class="btn btn-primary" target="_blank"  href='http://www.planalto.gov.br/ccivil_03/leis/2003/l10.741.htm'><i class="fas fa-file fa-4x"></i></a>
                            
                        </div>
                        <div  class="col-md-11 col-xs-9">
                            <p class="text-justify">
                                <strong>Lei Nº 10.741, DE 1º de Outubro de 2003</strong> 
                                Dispõe sobre o Estatuto do Idoso e dá outras providências.
                            </p>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
                <br/>
        </div> <!-- FECHA from_group -->

         <div class="form-group">
            <div class="well">
                <div id="1" class="form-group">
                    <div class="row">
                        <div class="col-md-1 col-xs-3">
                            
                                <a class="btn btn-primary" target="_blank"  href='http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2015/lei/l13146.htm'><i class="fas fa-file fa-4x"></i></a>
                            
                        </div>
                        <div  class="col-md-11 col-xs-9">
                            <p class="text-justify">
                                <strong>Lei Nº 13.146, DE 6 de Julho de 2015</strong> 
                                	
Institui a Lei Brasileira de Inclusão da Pessoa com Deficiência (Estatuto da Pessoa com Deficiência).
                            </p>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
                <br/>
        </div> <!-- FECHA from_group -->
            
   
           
        <div class="titulo">                            
                <h5>Documentos </h5>                        
        </div>

        <div class="alert alert-danger" role="alert"><h4>VISUALIZAÇÃO OBRIGATÓRIA</h4></div>
        
        <div class="form-group">
            <div class="well">
                <div id="1" class="form-group">
                    <div class="row">
                        <div class="col-md-1 col-xs-3">
                           
                                <a class="btn btn-primary" href='{{ url("/entePublico/termo/")}}'><i class="fas fa-file fa-4x"></i></a>
                           
                        </div>
                        <div  class="col-md-11 col-xs-9">
                            <p class="text-justify">
                                <strong>Termo de Compromisso</strong> 
                                Termo de compromisso que confere habilitação para manuseio de dados identificados 
                                do Cadastro Único para Programas Sociais do Governo Federal (Cadastro Único/Ministério da Cidadania).
                            </p>
                        </div>
                    </div>
                    @if(!empty($dte_aceite_termo))
                              <em>Visualizado em: {{$dte_aceite_termo}}</em>
                              @endif
                </div>
            </div>
                <br/>
        </div> <!-- FECHA from_group -->
        
    
    
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection