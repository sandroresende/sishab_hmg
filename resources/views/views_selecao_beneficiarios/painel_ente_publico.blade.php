@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            
            <cabecalho-form
            :titulo="'Painel Ente Público'"
            :barracompartilhar="false"
           
                    >
                        
            </cabecalho-form> 

            @if($mensagemTempo != '')
                <div class="alert alert-danger" role="alert">
                    <a href='{{ url("/arquivos") }}' class="alert-link">{{$mensagemTempo}}</a>
                </div>
            @endif  
            <div class="titulo">
                <h3>Usuários e Responsáveis </h3>         
            </div>
        
            <div class="panel-body">                    
                
            <div class="row"> 
                @can('eEntePublico')
                    @if($numUsuarios<3)
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center ">
                            <h5>
                                <a href='{{ url("/usuario/novo") }}'>
                                    <img src='{{ URL::asset("/img/icones/novo_usuario.png")}}'  class="img-thumbnail" >
                                </a>
                                <p>Novo<br/>Usuário</p>
                            </h5>
                        </div>       
                    @else
                    <div class="column col-xs-12 col-sm-6 col-md-3 text-center ">
                            <h5>
                                
                                    <img src='{{ URL::asset("/img/icones/novo_usuario_disabled.png")}}'  class="img-thumbnail" >
                                
                                <p>Novo<br/>Usuário</p>
                            </h5>
                        </div>     
                    @endif  
                @endcan    
                    <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                        <h5>
                        <a href='{{ url("/usuario/$usuario->id") }}'>
                            <img src='{{ URL::asset("/img/icones/dados_usuarios.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Dados do<br/>Usuário</p>
                    </h5>
                </div>  
                @if($usuario->tipo_usuario_id==8)
                    @if($numUsuarios>0)
                    <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                        <h5>
                            <a href='{{ url("selecao_beneficiarios/usuarios") }}'>
                                <img src='{{ URL::asset("/img/icones/usuarios.png")}}' class="img-thumbnail">
                            </a>
                            <p>Usuários e <br/>Responsáveis</p>
                        </h5>                          
                    </div>  
                    @endif
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h5>
                        <a href='{{ url("selecao_beneficiarios/dirigente") }}'>
                            <img src='{{ URL::asset("/img/icones/dirigentes.png")}}' class="img-thumbnail">
                        </a>
                        <p>Dados do <br/>Dirigente</p>


                    </h5>                          
                </div>  
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                </div>
                @else
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                <h5>
                        <a href='{{ url("selecao_beneficiarios/dirigente") }}'>
                            <img src='{{ URL::asset("/img/icones/dirigentes.png")}}' class="img-thumbnail">
                        </a>
                        <p>Dados do <br/>Dirigente</p>


                    </h5>    
                </div>
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">              
                </div>  
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">              
                </div>  
                @endif              
            </div>
            </div>   

            <div class="titulo">
            <h3>Demandas </h3>         
            </div>
            <div class="panel-body">                    
            <div class="row"> 
            @if($arquivosmunicipio>0)
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h5>
                        <a href='{{ url("/selecao_beneficiarios/arquivos") }}'>
                            <img src='{{ URL::asset("/img/icones/arquivos.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Arquivos</p>
                    </h5>
                </div>
            @endif  
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                <!-- 
                    <h5>
                        <a href='{{ url("/selecao_beneficiarios/demandas") }}'>
                            <img src='{{ URL::asset("/img/icones/demandas.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Demandas</p>
                    </h5>
                        -->
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


