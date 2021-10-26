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
            <span id="breadcrumbs-current">Dados Dirigente</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Dados Dirigente
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Dados do Dirigente </h5> 
        
    </div>
    
    <form class="form-horizontal" role="form" method="POST" action='{{ url("/dirigente/atualizar/$dirigente->id") }}'>
    
    @csrf
   
    <div class="form-group">
        <div class="row">        
            <div class="column col-xs-12 col-md-6">
                <label for="txt_nome_dirigente" class="control-label">Nome</label>
                <input id="txt_nome_dirigente" type="text" class="form-control" name="txt_nome_dirigente" value="{{empty(old('txt_nome_dirigente')) ? $dirigente->txt_nome_dirigente : old('txt_nome_dirigente')}}"  >

                @if ($errors->has('txt_nome_dirigente'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('txt_nome_dirigente') }}</strong>
                    </span>
                @endif
            </div>
            <div class="column col-xs-12 col-md-6">
            <label for="txt_cargo_dirigente" class="control-label">Cargo</label>

                <input id="txt_cargo_dirigente" type="text" class="form-control" name="txt_cargo_dirigente" value="{{empty(old('txt_cargo_dirigente')) ? $dirigente->txt_cargo_dirigente : old('txt_cargo_dirigente')}}" >

                @if ($errors->has('txt_cargo_dirigente'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('txt_cargo_dirigente') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div><!-- fechar primeiro form-group-->  

    <div class="form-group">
        <div class="row">        
            <div class="column col-xs-12 col-md-4">
                <label for="txt_cpf_dirigente" class="control-label">CPF</label>
                <input id="txt_cpf_dirigente" type="text" maxlength="11" class="form-control" name="txt_cpf_dirigente" value="{{empty(old('txt_cpf_dirigente')) ? $dirigente->txt_cpf_dirigente : old('txt_cpf_dirigente')}}" >

                @if ($errors->has('txt_cpf_dirigente'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('txt_cpf_dirigente') }}</strong>
                    </span>
                @endif
            </div>
   
            <div class="column col-xs-12 col-md-8">
                <label for="txt_email_dirigente" class="control-label">E-Mail</label>
                <input id="txt_email_dirigente" type="text" class="form-control" name="txt_email_dirigente" value="{{empty(old('txt_email_dirigente')) ? $dirigente->txt_email_dirigente : old('txt_email_dirigente')}}"> 

                @if ($errors->has('txt_email_dirigente'))
                    <span class="erro_validacao">
                        <strong>{{ $errors->first('txt_email_dirigente') }}</strong>
                    </span>
                @endif
            </div>
        </div>    
    </div><!-- fechar segundo form-group-->
    <div class="form-group">
        <div class="checkbox">
            <label>
            <input type="checkbox" name="bln_ativo" value="{{empty(old('bln_ativo')) ? $dirigente->bln_ativo : old('bln_ativo')}}"   {{ $dirigente->bln_ativo ? 'checked' : '' }}> Ativo
            </label>
        </div>   
    </div><!-- fechar segundo form-group-->



    
    @can('eEntePublico')
    <div class="form-group">
        <div class="row">      
            <div class="column col-xs-12 col-md-6">
            
                <button type="submit" class="btn btn-lg btn-primary  btn-block">Salvar</button>        
            </div> 
            <div class="column col-xs-12 col-md-6">
                
                <a type="submit"  class="btn btn-danger btn-lg  btn-block"  href='{{ url("/entePublico")}}'>Fechar</a>

            </div>
        </div>    
    </div><!-- fechar segundo form-group-->    
   @endcan

   @can('eRepresentanteEntePublico')
   <div class="form-group">
        <div class="row"> 
            <div class="column col-xs-12 col-md-12">
                
                <a type="submit"  class="btn btn-danger btn-lg btn-block"  href='{{ url("/entePublico")}}'>Fechar</a>

            </div>
        </div>    
    </div><!-- fechar segundo form-group-->  
        @endcan
    </form>
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection