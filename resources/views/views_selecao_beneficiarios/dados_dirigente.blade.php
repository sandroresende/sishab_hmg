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
                :titulo2='"Dados Dirigente"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'{{$dirigente->name}}'"
                    :dataatualizacao="'{{$dirigente->updated_at->format('d/m/Y')}}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
          
            <div class="titulo">
                <h5>Dados do Dirigente </h5> 
                
            </div>
            
            <form class="form-horizontal" role="form" method="POST" action='{{ url("/selecao_beneficiarios/dirigente/atualizar/$dirigente->id") }}'>
            
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
                            <input class="btn btn-lg btn-info btn-block" type="submit" value="Salvar">          
                        </div> 
                        <div class="column col-xs-12 col-md-6">
                            
                            <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">

                        </div>
                    </div>    
                </div><!-- fechar segundo form-group-->    
            @endcan

            @can('eRepresentanteEntePublico')
            <div class="form-group">
                    <div class="row"> 
                        <div class="column col-xs-12 col-md-12">
                            
                            <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">

                        </div>
                    </div>    
                </div><!-- fechar segundo form-group-->  
                    @endcan
                    
                 </form>
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


