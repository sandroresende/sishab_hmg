@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            :url="'{{ url('/selecao_beneficiarios') }}'"
            :titulo1="'Seleção de Beneficiários'"
            :titulo2='"Documentos e Especificações"'
            >
            </historico-navegacao>  
            <cabecalho-form
            :titulo="'Documentos e Especificações'"
            @if($usuario->dte_aceite_termo)
                :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->dte_aceite_termo))}}'"
            @else
                :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->created_at))}}'"
            @endif
            :barracompartilhar="true" >
                        
            </cabecalho-form> 

            <div class="form-group">
                <div class="titulo">                            
                    <h3>Legislações </h3>                        
                </div>
                @if(!$usuario->bln_visualizar_documentos)
                    <p class="text-justify">                    
                        Esse é seu primeiro acesso.  É importante ter conhecimento da legislação vigente.
                    </p>
                @endif    
              
                <div class="alert alert-danger" role="alert"><h4>VISUALIZAÇÃO OBRIGATÓRIA</h4></div>
                
                <div class="row mb-2">
                    @foreach($legislacao as $legis)
                        @if($legis->bln_leitura_obrigatoria)
                            <div class="col-md-12">
                                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                                    <div class="card-body d-flex flex-column align-items-start">
                                    <strong class="d-inline-block mb-2 text-primary">{{$legis->txt_titulo}}</strong>
                                    <h3 class="mb-0">
                                        
                                        
                                    </h3>
                                    <div class="mb-1 text-muted">
                                        @if(!empty($legis->data_visualizacao))
                                        Visualizado em: {{$legis->data_visualizacao->format('d/m/Y h:m:s')}}
                                        @endif
                                    </div>
                                    <em>{{$legis->txt_descricao_legislacao}}</em>
                                    @if($legis->bln_visualizacao)
                                        <button type="button" class="btn btn-primary" onclick='window.open("{{$legis->txt_caminho_arquivo}}")'>Visualizar</button>
                                        @else
                                        <form method="post" action='{{ url("/aceite/$legis->id")}}'>
                                                @csrf
                                                <button type="submit" class="btn btn-primary" onclick='window.open("{{$legis->txt_caminho_arquivo}}")'>Visualizar</button>
                                            </form>   
                                            
                                    @endif  
                                    </div>
                                    <i class="fas fa-file-pdf fa-4x"></i>
                                    
                                </div>
                            </div>
                        @endif  
                    @endforeach   
                    
                </div><!-- row mb-2 -->          

                <div class="linha-separa"></div> 
                <div class="alert alert-success" role="alert"><h4>VISUALIZAÇÃO OPCIONAL</h4></div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="card flex-md-row mb-4 box-shadow h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-primary">Lei Nº 10.741, DE 1º de Outubro de 2003</strong>
                            <h3 class="mb-0">
                                
                                
                            </h3>
                            <div class="mb-1 text-muted">
                            
                            </div>
                            <em>Dispõe sobre o Estatuto do Idoso e dá outras providências. </br></em>
                            <a class="btn btn-primary" target="_blank"  href='http://www.planalto.gov.br/ccivil_03/leis/2003/l10.741.htm'>Visualizar</a>
                            </div>
                            <i class="fas fa-file-pdf fa-4x"></i>
                            
                        </div>
                    </div><!--col-md-12-->  
                    <div class="col-md-12">
                        <div class="card flex-md-row mb-4 box-shadow h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-primary">Lei Nº 13.146, DE 12 de Julho de 2015</strong>
                            <h3 class="mb-0">
                                
                                
                            </h3>
                            <div class="mb-1 text-muted">
                            
                            </div>
                            <em>Institui a Lei Brasileira de Inclusão da Pessoa com Deficiência (Estatuto da Pessoa com Deficiência).</em>
                            <a class="btn btn-primary" target="_blank"  href='http://www.planalto.gov.br/ccivil_03/_ato2015-2018/2015/lei/l13146.htm'>Visualizar</a>
                            </div>
                            <i class="fas fa-file-pdf fa-4x"></i>
                            
                        </div>
                    </div><!--col-md-12-->    

                </div><!-- row mb-2 -->  

                <div class="titulo">                            
                    <h3>Documentos </h3>                        
                </div>
    
                <div class="alert alert-danger" role="alert"><h4>VISUALIZAÇÃO OBRIGATÓRIA</h4></div>
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="card flex-md-row mb-4 box-shadow h-md-250">
                            <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-primary">Termo de Compromisso</strong>
                            <h3 class="mb-0">
                                
                                
                            </h3>
                            <div class="mb-1 text-muted">
                                @if(!empty($dte_aceite_termo))
                                    Visualizado em: {{$dte_aceite_termo}}
                                @endif
                            </div>
                            <em>Termo de compromisso que confere habilitação para manuseio de dados identificados 
                                do Cadastro Único para Programas Sociais do Governo Federal (Cadastro Único/Ministério da Cidadania).</em>
                                <a class="btn btn-primary" href='{{ url("/selecao_beneficiarios/termo/")}}'>Visualizar</i></a>
                            </div>
                            <i class="fas fa-file-pdf fa-4x"></i>
                            
                        </div>
                    </div><!--col-md-12--> 
                </div><!-- row mb-2 -->      
            </div><!-- form-group -->   
            
            <div class="form-group">
                <div class="row">
                    
                    <div class=" col-xs-12 col-md-12">
                        
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
                    </div>    
                </div>
            </div> 
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


