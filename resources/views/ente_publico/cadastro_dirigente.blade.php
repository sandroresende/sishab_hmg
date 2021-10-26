@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/ente_publico') }}">Página Inicial</a>
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
            <span id="breadcrumbs-current">Cadastrar Dirigente</span>
    </span>
</div>

<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Cadastrar Dirigente
  </h1>
  <div class="alert alert-warning text-center" role="alert">
        
         Favor realizar o cadastro do Dirigente.
        
  </div>
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
    <div class="titulo">
        <h5>Dados do Ente Público </h5> 
        
    </div>
    
    <form class="form-horizontal" role="form" method="POST" action='{{ url("/dirigente/cadastrar") }}'>
    
    @csrf
    @foreach($ente as $item)
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-9">
                        <label class="control-label">Nome do Ente Público</label>
                        <input id="txt_ente_publico" type="text" class="form-control" name="txt_ente_publico" value="{{$item->txt_ente_publico}}" disabled >

                    </div>
                    <div class="column col-xs-12 col-sm-3">
                        <label for="txt_tipo_ente_publico">Tipo Ente Público</label>           
                        <input id="txt_tipo_ente_publico" type="text" class="form-control" name="txt_tipo_ente_publico" value="{{$item->tipoEntePublico->txt_tipo_ente_publico}}" disabled >                      
                    </div>
                </div>  
            </div><!-- fechar primeiro form-group-->
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-9">
                        <label class="control-label ">Email</label>
                        <input id="txt_email_ente_publico" type="email" class="form-control" name="txt_email_ente_publico" value="{{$item->txt_email_ente_publico}}" disabled >

                        @if ($errors->has('txt_email_ente_publico'))
                            <span class="erro_validacao">
                                <strong>{{ $errors->first('txt_email_ente_publico') }}</strong>
                            </span>
                        @endif
                    </div>   
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label ">CNPJ</label>
                        <input id="txt_cnpj_ente_publico" type="text" class="form-control" name="txt_cnpj_ente_publico" value="{{$item->id}}" disabled >

                        @if ($errors->has('txt_cnpj_ente_publico'))
                            <span class="erro_validacao">
                                <strong>{{ $errors->first('txt_cnpj_ente_publico') }}</strong>
                            </span>
                        @endif
                    </div>                    
                                  
                </div>
            </div><!-- fechar segundo form-group-->
        @endforeach
            <div class="titulo">
                <h5>Dados do Dirigente </h5> 
                
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label">Nome do Dirigente</label>
                        <input id="txt_nome_dirigente" type="text" class="form-control" name="txt_nome_dirigente" value="{{old('txt_nome_dirigente')}}"  >

                        @if ($errors->has('txt_nome_dirigente'))
                            <span class="erro_validacao">
                                <strong>{{ $errors->first('txt_nome_dirigente') }}</strong>
                            </span>
                        @endif
                    </div> 
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label">Cargo do Dirigente</label>
                        <input id="txt_cargo_dirigente" type="text" class="form-control" name="txt_cargo_dirigente" value="{{old('txt_cargo_dirigente')}}"  >

                        @if ($errors->has('txt_cargo_dirigente'))
                            <span class="erro_validacao">
                                <strong>{{ $errors->first('txt_cargo_dirigente') }}</strong>
                            </span>
                        @endif
                    </div> 
                </div>  
            </div> <!-- fechar terceiro form-group--> 

           
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label">CPF</label>
                        <input id="txt_cpf_dirigente" type="text" class="form-control" maxlength="11"  name="txt_cpf_dirigente" value="{{old('txt_cpf_dirigente')}}"  >

                        @if ($errors->has('txt_cpf_dirigente'))
                            <span class="erro_validacao">
                                <strong>{{ $errors->first('txt_cpf_dirigente') }}</strong>
                            </span>
                        @endif
                    </div> 
                    
                    <div class="column col-xs-12 col-md-8">
                        <label class="control-label ">Email</label>
                        <input id="txt_email_dirigente" type="text" class="form-control" name="txt_email_dirigente" value="{{old('txt_email_dirigente')}}"  >

                        @if ($errors->has('txt_email_dirigente'))
                            <span class="erro_validacao">
                                <strong>{{ $errors->first('txt_email_dirigente') }}</strong>
                            </span>
                        @endif
                    </div>       
                </div>
            </div><!-- fechar quinto form-group-->
            

       
        <div class="form-group">
            <div class="row">
                <button type="submit"  class="btn btn-primary btn-lg btn-block">Salvar</button>
            </div>    
        </div><!-- fechar segundo form-group-->
    </form>
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection