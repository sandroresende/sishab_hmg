@extends('layouts.app')

@section('content')



<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Painel Ente Público
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">
  @if($mensagemTempo != '')
    <div class="alert alert-danger" role="alert">
        <a href='{{ url("/arquivos") }}' class="alert-link">{{$mensagemTempo}}</a>
    </div>
  @endif  
  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Usuários e Responsáveis </h5>         
    </div>

    <div class="panel-body">                    
        
    <div class="row"> 
        @can('eEntePublico')
            @if($numUsuarios<3)
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center ">
                    <h4>
                        <a href='{{ url("/usuario/novo") }}' disabled="disabled">
                            <img src='{{ URL::asset("/images/icones/novo_usuario.png")}}'  class="img-thumbnail" >
                        </a>
                        <p>Novo<br/>Usuário</p>
                    </h4>
                </div>       
            @else
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center ">
                    <h4>
                        
                            <img src='{{ URL::asset("/images/icones/novo_usuario_disabled.png")}}'  class="img-thumbnail" >
                        
                        <p>Novo<br/>Usuário</p>
                    </h4>
                </div>     
            @endif  
        @endcan    
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                <h4>
                    <a href='{{ url("/usuario/$usuario->id") }}'>
                        <img src='{{ URL::asset("/images/icones/dados_usuarios.png")}}'  class="img-thumbnail" >
                    </a>
                    <p>Dados do<br/>Usuário</p>
                </h4>
            </div>  
            @if($usuario->tipo_usuario_id==8)
                @if($numUsuarios>0)
                <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                    <h4>
                        <a href='{{ url("entePublico/usuarios") }}'>
                            <img src='{{ URL::asset("/images/icones/usuarios.png")}}' class="img-thumbnail">
                        </a>
                        <p>Usuários e <br/>Responsáveis</p>
                    </h4>                          
                </div>  
                @endif
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                <h4>
                    <a href='{{ url("entePublico/dirigente") }}'>
                        <img src='{{ URL::asset("/images/icones/dirigentes.png")}}' class="img-thumbnail">
                    </a>
                    <p>Dados do <br/>Dirigente</p>


                </h4>                          
            </div>  
             <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
             </div>
            @else
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
            <h4>
                    <a href='{{ url("entePublico/dirigente") }}'>
                        <img src='{{ URL::asset("/images/icones/dirigentes.png")}}' class="img-thumbnail">
                    </a>
                    <p>Dados do <br/>Dirigente</p>


                </h4>    
             </div>
              <div class="column col-xs-12 col-sm-6 col-md-3 text-center">              
              </div>  
              <div class="column col-xs-12 col-sm-6 col-md-3 text-center">              
              </div>  
            @endif              
        </div>
     </div>   
    
     <div class="titulo">
        <h5>Demandas </h5>         
    </div>
    <div class="panel-body">                    
        <div class="row"> 
        @if($arquivosmunicipio>0)
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                <h4>
                    <a href='{{ url("/arquivos") }}'>
                        <img src='{{ URL::asset("/images/icones/arquivos.png")}}'  class="img-thumbnail" >
                    </a>
                    <p>Arquivos</p>
                </h4>
            </div>
          @endif  
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
            <h4>
                    <a href='{{ url("/demandas") }}'>
                        <img src='{{ URL::asset("/images/icones/demandas.png")}}'  class="img-thumbnail" >
                    </a>
                    <p>Demandas</p>
                </h4>
             </div>
              <div class="column col-xs-12 col-sm-6 col-md-3 text-center">              
              </div>  
              <div class="column col-xs-12 col-sm-6 col-md-3 text-center">              
              </div> 

        </div>
     </div> 
    
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection