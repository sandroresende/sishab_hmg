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
            :titulo2='"Cadastrar Usuário"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Cadastrar Usuário'"
                    :barracompartilhar="false">
                    
                        <div class="alert alert-warning text-center" role="alert">Favor realizar o cadastro do Usuário.</div>       
            </cabecalho-form> 
           
            <div class="titulo">
                <h3>Dados do Usuário </h3> 
                
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
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="submit" value="Salvar">                           
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                    </div>    
                </div>
            </div> <!-- form-group -->
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


