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
            :titulo2='"Cadastrar Dirigente"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Cadastrar Dirigente'"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/selecao_beneficiarios/dirigente") }}'"
                    :barracompartilhar="true">
                    
                        <div class="alert alert-warning text-center" role="alert"><h5>Favor realizar o cadastro do Dirigente.</h5></div>       
            </cabecalho-form> 
           
        
        <form action="{{ url('/selecao_beneficiarios/dirigente/cadastrar') }}" method="POST">
            @csrf
            <div class="form-group">
               
                   
                <div class="well">
                    <div class="box">                                                                                 
                        
                        {{csrf_field()}}
                            <div class="form-group">
                                <div class="titulo">
                                    <h5>Dados do Ente Público </h5>         
                                </div>
                                @foreach($ente as $item)
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="column col-xs-12 col-sm-9">
                                                <label class="control-label">Nome do Ente Público</label>
                                                <input id="txt_ente_publico" type="text" class="input-group" name="txt_ente_publico" value="{{$item->txt_ente_publico}}" disabled >
                                
                                            </div>
                                            <div class="column col-xs-12 col-sm-3">
                                                <label for="txt_tipo_ente_publico">Tipo Ente Público</label>           
                                                <input id="txt_tipo_ente_publico" type="text" class="input-group" name="txt_tipo_ente_publico" value="{{$item->tipoEntePublico->txt_tipo_ente_publico}}" disabled >                      
                                            </div>
                                        </div>  
                                    </div><!-- fechar segundo form-group-->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="column col-xs-12 col-sm-9">
                                                <label class="control-label">Email</label>
                                                <input id="txt_email_ente_publico" type="email" class="input-group" name="txt_email_ente_publico" value="{{$item->txt_email_ente_publico}}" disabled >
                                
                                                @if ($errors->has('txt_email_ente_publico'))
                                                    <span class="erro_validacao">
                                                        <strong>{{ $errors->first('txt_email_ente_publico') }}</strong>
                                                    </span>
                                                @endif
                                            </div>   
                                            <div class="column col-xs-12 col-sm-3">
                                                <label class="control-label">CNPJ</label>
                                                <input id="txt_cnpj_ente_publico" type="text" class="input-group" name="txt_cnpj_ente_publico" value="{{$item->id}}" disabled >
                                
                                                @if ($errors->has('txt_cnpj_ente_publico'))
                                                    <span class="erro_validacao">
                                                        <strong>{{ $errors->first('txt_cnpj_ente_publico') }}</strong>
                                                    </span>
                                                @endif
                                            </div>                    
                                                            
                                        </div>
                                    </div><!-- fechar terceiro form-group-->
                                    @endforeach     
                            </div> 
                            
                            <div class="titulo">
                                <h5>Dados do Dirigente </h5>         
                            </div>
                        
                            <div class="form-group">
                                <div class="row">        
                                    <div class="column col-xs-12 col-md-8">
                                        <label for="txt_nome_dirigente" class="control-label">Nome</label>
                                        <input id="txt_nome_dirigente" type="text" class="input-group" name="txt_nome_dirigente" value="{{old('txt_nome_dirigente')}}" required>
                                        @if ($errors->has('txt_nome_dirigente'))
                                            <span class="erro_validacao">
                                                <strong>{{ $errors->first('txt_nome_dirigente') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="column col-xs-12 col-md-4">
                                        <label for="txt_cargo_dirigente" class="control-label">Cargo</label>
                                        <input id="txt_cargo_dirigente" type="text" class="input-group" name="txt_cargo_dirigente" value="{{old('txt_cargo_dirigente')}}" required  >
                                        @if ($errors->has('txt_cargo_dirigente'))
                                            <span class="erro_validacao">
                                                <strong>{{ $errors->first('txt_cargo_dirigente') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- fechar quarto form-group-->  
                            <div class="form-group">
                                <div class="row">        
                                    <div class="column col-xs-12 col-md-4">
                                        <label for="txt_cpf_dirigente" class="control-label">CPF</label>
                                        <input id="txt_cpf_dirigente" type="text" maxlength="11" class="input-group" name="txt_cpf_dirigente" value="{{old('txt_cpf_dirigente')}}" required>
                                        @if ($errors->has('txt_cpf_dirigente'))
                                            <span class="erro_validacao">
                                                <strong>{{ $errors->first('txt_cpf_dirigente') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                        
                                    <div class="column col-xs-12 col-md-8">
                                        <label for="txt_email_dirigente" class="control-label">E-Mail</label>
                                        <input id="txt_email_dirigente" type="text" class="input-group" name="txt_email_dirigente" value="{{old('txt_email_dirigente')}}" required> 
                                        @if ($errors->has('txt_email_dirigente'))
                                            <span class="erro_validacao">
                                                <strong>{{ $errors->first('txt_email_dirigente') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>    
                            </div><!-- fechar quinto form-group-->
                    </div>                                       
                </div>                                       
                               
            </div>              
           <!--form-group -->


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
    
            

            </div><!-- fechar primeiro form-group-->
        </form>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


