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
            <span id="breadcrumbs-current">Cadastrar Usuário</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Cadastrar Usuário
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Dados do Usuário </h5> 
        
    </div>
    
    <form class="form-horizontal" role="form" method="POST" action='{{ url("/usuario/salvar") }}'>
    
    @csrf
   
    <div class="form-group">
        <div class="row">        
            <div class="column col-xs-12 col-md-3">
                <label for="cod_usuario" class="control-label">CPF</label>
                <input id="txt_cpf_usuario" type="text" maxlength="11" class="form-control" name="txt_cpf_usuario" value="{{ old('txt_cpf_usuario') }}" >

                @if ($errors->has('txt_cpf_usuario'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('txt_cpf_usuario') }}</strong>
                    </span>
                @endif
            </div>
            <div class="column col-xs-12 col-md-9">
            <label for="txt_nome" class="control-label">Nome</label>

                <input id="txt_nome" type="text" class="form-control" name="txt_nome" value="{{ old('txt_nome') }}" >

                @if ($errors->has('txt_nome'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('txt_nome') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- fechar primeiro form-group-->  

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="row">
            <div class="column col-xs-12 col-md-12">
                <label for="email" class="control-label">E-Mail</label>
                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}"> 

                @if ($errors->has('email'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>    
    </div><!-- fechar segundo form-group-->
    <div class="form-group">
        <div class="row">
            
                <button type="submit"  class="btn btn-primary btn-lg btn-block">Salvar</button>
            
            
        </div>    
    </div><!-- fechar segundo form-group-->
    </form>
    <div class="form-group">
        <div class="row">
             
                <form class="form-horizontal" role="form" method="GET" action='{{ url("/entePublico/")}}'>                    
                    <button type="submit"  class="btn btn-danger btn-lg btn-block">Fechar</button>
                </form>    
           
        </div>    
    </div><!-- fechar segundo form-group-->
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection