@extends('layouts.app') @section('scripts')
<link href="{{ asset('css/style.blue.css') }}" rel="stylesheet">
<link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> @endsection 


@section('content')



<div id="viewlet-above-content-title"></div>

<div class="linha-separa"></div>
<div id="content"> 
<registro-usuario  
    id="formregistro" 
    css="" 
    action='{{ url("/prototipo/registro/salvar") }}' 
    url='{{ url("/") }}' 
    metodo="post" 
    enctype="multipart/form-data" 
    token="{{ csrf_token() }}"
    :show="'{{ url('/documents/modelos/oficios/prototipo/') }}'"
   errorshas="{{$errors->has('modalidade_participacao')}}"
   errorsfirst="{{ $errors->first('modalidade_participacao') }}">
                  

<!--SLOT -->
        
        
        <div class="titulo">
            <h5>Dados do Proponente</h5> 
        </div>          
        <select-uf-municipio 
                coluf="column col-xs-12 col-sm-4"
                colmun="column col-xs-12 col-sm-8"
                requeruf="true"
                requermunicipio="true"
                @if(old('municipio')) municipioselecionado= "{{ old('municipio') }}" @endif
                @if(old('estado')) ufselecionada= "{{old('estado')}}" @endif
                
                :url="'{{ url('/') }}'"></select-uf-municipio>
            
               
        <!--fim row-->
        
        <div class="row">  
            <div class="column col-xs-12 col-md-4">
                <label for="tipo_proponente">Tipo Proponente</label>           
                <select 
                    id="tipo_proponente_id"
                     class="form-control{{ $errors->has('tipo_proponente_id') ? ' is-invalid' : '' }}"  
                    name="tipo_proponente_id"     
                    value="{{ old('tipo_proponente_id') }}"           
                    required
                    >
                    <option value="">Escolha um Tipo:</option>
                    @foreach($tipos_proponente as $tipo_proponente)
                        @if($tipo_proponente->id == old('tipo_proponente_id'))
                            <option value="{{ $tipo_proponente->id }}" selected>
                                {{ $tipo_proponente->txt_tipo_proponente }}
                            </option>
                        @else
                            <option value="{{ $tipo_proponente->id }}">
                                {{ $tipo_proponente->txt_tipo_proponente }}
                            </option>
                        @endif
                        
                    @endforeach
                </select>

                @if ($errors->has('tipo_proponente_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('tipo_proponente_id') }}</strong>
                    </span>
                @endif                            
                                          
            </div>
         
            <div class="column col-xs-12 col-md-8">
                <label for="cnpj">CNPJ</label>   
                <input type="text" 
                    name="txt_cnpj"   
                    class="form-control{{ $errors->has('txt_cnpj') ? ' is-invalid' : '' }}"   
                    maxlength="14" 
                    value="{{ old('txt_cnpj') }}" >

                @if ($errors->has('txt_cnpj'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_cnpj') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="row">  
            <div class="column col-xs-12 col-md-12">
                <label for="nome_proponente">Ente Proponente (Estado, DF ou Município)
                </label>   
                <input type="text" 
                    name="txt_nome_proponente"   
                    class="form-control{{ $errors->has('txt_nome_proponente') ? ' is-invalid' : '' }}"   
                    value="{{ old('txt_nome_proponente') }}" >

                @if ($errors->has('txt_nome_proponente'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_nome_proponente') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <!--fim row-->
        
        
         <div class="row">  
            <div class="column col-xs-12 col-md-6">
                <label for="cargo_executivo">Cargo do Chefe do Executivo</label>           
                <select 
                    id="cargo_executivo"
                     class="form-control{{ $errors->has('cargo_executivo') ? ' is-invalid' : '' }}"  
                    name="cargo_executivo"               
                    value="{{ old('cargo_executivo') }}" 
                    >
                    <option value="">Escolha um cargo:</option>
                    <option value="Governador" @if(old('cargo_executivo') == "Governador") selected @endif>Governador</option>
                    <option value="Prefeito" @if(old('cargo_executivo') == "Prefeito") selected @endif>Prefeito</option>                                
                </select>                             
                @if ($errors->has('cargo_executivo'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('cargo_executivo') }}</strong>
                    </span>
                @endif  
            </div>
            <div class="column col-xs-12 col-md-6">
                <label for="nome_chefe_executivo">Nome do Chefe do Executivo</label>   
                <input type="text" 
                    name="txt_nome_chefe_executivo"  
                    class="form-control{{ $errors->has('txt_nome_chefe_executivo') ? ' is-invalid' : '' }}"   
                    value="{{ old('txt_nome_chefe_executivo') }}" >

                @if ($errors->has('txt_nome_chefe_executivo'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_nome_chefe_executivo') }}</strong>
                    </span>
                @endif
            </div>   
        </div>
        <!--fim row-->
       
        <div class="titulo">  
        <h5>Dados do órgão responsável pela proposta</h5> 
        </div>     
        <div class="row">  
            <div class="column col-xs-12 col-md-4">
                <label for="cnpj">CNPJ</label>   
                <input type="text" 
                    name="txt_cnpj_orgao_rep"   
                    class="form-control{{ $errors->has('txt_cnpj_orgao_rep') ? ' is-invalid' : '' }}"   
                    maxlength="14" 
                    value="{{ old('txt_cnpj_orgao_rep') }}" >

                @if ($errors->has('txt_cnpj_orgao_rep'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_cnpj_orgao_rep') }}</strong>
                    </span>
                @endif
            </div>
            <div class="column col-xs-12 col-md-8">
                <label for="orgao_responsavel">Órgão responsável pela proposta</label>   
                <input type="text" 
                    name="txt_orgao_responsavel"  
                class="form-control{{ $errors->has('txt_orgao_responsavel') ? ' is-invalid' : '' }}"  
                value="{{ old('txt_orgao_responsavel') }}" >
                
                @if ($errors->has('txt_orgao_responsavel'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_orgao_responsavel') }}</strong>
                    </span>
                @endif
            </div>
        </div>    
        <!--fim row-->     
        <div class="titulo">  
            <h5>Dados do representante máximo do Órgão Responsável pela Proposta</h5> 
            </div>
        <div class="row">  
            <div class="column col-xs-12 col-md-6">
                <label for="nome_representante">Nome do Representante  </label>   
                <input type="text" 
                    name="txt_nome_representante"  
                class="form-control{{ $errors->has('txt_nome_representante') ? ' is-invalid' : '' }}"  
                value="{{ old('txt_nome_representante') }}" >
                
                @if ($errors->has('txt_nome_representante'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_nome_representante') }}</strong>
                    </span>
                @endif
            </div>
            <div class="column col-xs-12 col-md-6">
                <label for="sobrenome_representante">Sobrenome do Representante </label>   
                <input type="text" 
                name="txt_sobrenome_representante"  
            class="form-control{{ $errors->has('txt_sobrenome_representante') ? ' is-invalid' : '' }}"  
            value="{{ old('txt_sobrenome_representante') }}" >
            
                @if ($errors->has('txt_sobrenome_representante'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_sobrenome_representante') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <!--fim row-->        
        
         <div class="row">  
            <div class="column col-xs-12 col-md-6">
                <label for="cargo_representante">Cargo</label>   
                <input type="text" 
                    name="txt_cargo_representante"  
                class="form-control{{ $errors->has('txt_cargo_representante') ? ' is-invalid' : '' }}"  
                value="{{ old('txt_cargo_representante') }}" >
                
                @if ($errors->has('txt_cargo_representante'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_cargo_representante') }}</strong>
                    </span>
                @endif
            </div>
            <div class="column col-xs-12 col-md-6">
                <label for="cpf">CPF</label>   
                <input type="text" 
                name="txt_cpf_representante"   
               class="form-control{{ $errors->has('txt_cpf_representante') ? ' is-invalid' : '' }}"   
                maxlength="11" 
                value="{{ old('txt_cpf_representante') }}" >
            
                @if ($errors->has('txt_cpf_representante'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('txt_cpf_representante') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <!--fim row-->
                <div class="titulo">
                    <h5>Dados do usuário responsável pela proposta</h5> 
                </div>          
                <div class="row">  
                    <div class="column col-xs-12 col-md-6 {{ $errors->has('txt_nome') ? ' is-invalid' : '' }}">
                        <label for="nome">Nome</label>   
                        <input type="text" 
                                name="txt_nome"  
                                class="form-control{{ $errors->has('txt_nome') ? ' is-invalid' : '' }}" 
                                value="{{ old('txt_nome') }}" >

                        @if ($errors->has('txt_nome'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('txt_nome') }}</strong>
                            </span>
                        @endif
                    </div>
                     
                    <div class="column col-xs-12 col-md-6">
                        <label for="sobrenome">Sobrenome</label>   
                        <input type="text" 
                            name="txt_sobrenome"  
                            class="form-control{{ $errors->has('txt_sobrenome') ? ' is-invalid' : '' }}" 
                           value="{{ old('txt_sobrenome') }}" >

                        @if ($errors->has('txt_sobrenome'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('txt_sobrenome') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!--fim row-->
                <div class="row">  
                    <div class="column col-xs-12 col-md-6">
                        <label for="cpf">CPF</label>   
                        <input type="text" 
                            name="txt_cpf_usuario"   
                            id="txt_cpf_usuario"   
                            class="form-control{{ $errors->has('txt_cpf_usuario') ? ' is-invalid' : '' }}"  
                            maxlength="11" 
                            value="{{ old('txt_cpf_usuario') }}" >

                        @if ($errors->has('txt_cpf_usuario'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('txt_cpf_usuario') }}</strong>
                            </span>
                        @endif
                    </div>
               
                    <div class="column col-xs-12 col-md-6">
                        <label for="cargo">Cargo</label>   
                        <input type="text" 
                            name="txt_cargo"   
                            class="form-control{{ $errors->has('txt_cargo') ? ' is-invalid' : '' }}"   
                            value="{{ old('txt_cargo') }}" >

                        @if ($errors->has('txt_cargo'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('txt_cargo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!--fim row-->
                
                <div class="row">  
                    <div class="column col-xs-12 col-md-6">
                        <label for="ddd">DDD</label>   
                        <input type="text" 
                            name="txt_ddd"   
                            class="form-control{{ $errors->has('txt_ddd') ? ' is-invalid' : '' }}"   
                            value="{{ old('txt_ddd') }}" 
                            maxlength="2">

                        @if ($errors->has('txt_ddd'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('txt_ddd') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <label for="telefone">Telefone</label>   
                        <input type="text" 
                            name="txt_telefone"   
                            class="form-control{{ $errors->has('txt_telefone') ? ' is-invalid' : '' }}"   
                            value="{{ old('txt_telefone') }}" 
                            maxlength="10">

                        @if ($errors->has('txt_telefone'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('txt_telefone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!--fim row-->  
                <div class="row">  
                    <div class="column col-xs-12 col-md-6">
                        <label for="ddd">DDD</label>   
                        <input type="text" 
                            name="txt_ddd_movel"  
                            class="form-control{{ $errors->has('txt_ddd_movel') ? ' is-invalid' : '' }}"   
                            value="{{ old('txt_ddd_movel') }}" 
                            maxlength="2">

                        @if ($errors->has('txt_ddd_movel'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('txt_ddd_movel') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <label for="celular">Celular</label>   
                        <input type="text" 
                            name="txt_celular"   
                            class="form-control{{ $errors->has('txt_celular') ? ' is-invalid' : '' }}"   
                            value="{{ old('txt_celular') }}" 
                            maxlength="10">

                        @if ($errors->has('txt_celular'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('txt_celular') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!--fim row-->
                <div class="row">  
                    <div class="column col-xs-12 col-md-12">
                        <label for="email">Email</label>   
                        <input type="email" 
                            name="email"   
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"   
                            value="{{ old('email') }}" >

                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!--fim row-->  
                
<!--FIM SLOT -->                    
 <!--fim row-->
   
      
</registro-usuario>   
                       
                
               

</div>
<!-- content-->



@endsection