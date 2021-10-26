@extends('layouts.app') @section('scripts')
<link href="{{ asset('css/style.blue.css') }}" rel="stylesheet">
<link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> @endsection 


@section('content')



<div id="viewlet-above-content-title"></div>
<h3  class="documentFirstHeading text-center">
    Seleção de terrenos para a contratação de 
Protótipos de Habitação de Interesse Social
</h3>
<div class="linha-separa"></div>
<div id="content">   
    <div class="row">
        <div class="column col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div id="viewlet-above-content-title"></div>
                    <h3 class="documentFirstHeading text-center">
                    Solicitar Acesso
                        </h3>
                    <div class="linha-separa"></div>
                    
                    <div class="row">  
                        
                        <blockquote class="blockquote">   
                            <h5>Quais são as modalidades de participação?                            </h5>                     
                            <footer class="blockquote-footer">Modalidade I - Protótipos para a concepção e implementação de empreendimentos inovadores; e 
                            </footer>
                             <footer class="blockquote-footer">
                                Modalidade II - Protótipos para implementação de empreendimentos cuja concepção será proveniente de projetos selecionados em concurso de ideias.
                            </footer>
                            <footer class="blockquote-footer">  
                                Para maiores informações consultar a portaria de regulamentação.
                            </footer>
                             
                            <h5>Quem pode enviar propostas?</h5>                     
                            <footer class="blockquote-footer">
                                Entes Públicos locais (municípios, estados e Distrito Federal) direta ou indiretamente, por meio de companhias, autarquias ou agências habitacionais, detentores de terrenos para doação.
                            </footer>
                            <footer class="blockquote-footer">
                                Para a modalidade II, podem participar apenas aqueles associados à Associação Brasileira de COHABS e Agentes Públicos de Habitação (ABC).
                            </footer>
                            <footer class="blockquote-footer">
                                Os interessados devem optar por uma das modalidades para participação.
                            </footer>
                                             
                                                   
                            <h5>Como se registrar para acessar o sistema?</h5>
                            <footer class="blockquote-footer">
                                Deve ser enviado Ofício assinado pelo Chefe do Poder Executivo com a indicação do responsável pelo encaminhamento da proposta e e-mail institucional para cadastro e homologação. Para a modalidade II, deve ser enviado também Ofício assinado pelo Presidente da companhia, autarquia ou agência habitacional associada à ABC.
                            </footer>
                            <footer class="blockquote-footer">    
                                Os documentos devem ser elaborados em papel timbrado, digitalizados e enviados por intermédio do sistema, conforme os modelos disponibilizados abaixo:

                            </footer>
                            
                        </blockquote>
                        <!-- Modelo de Ofício -->
                        <div class="card text-white">
                            <div class="card-header header-secundario">
                                <h4><i class="fas fa-file-alt"></i> <b>Modelos de Ofício</b></h4> 
                            </div>
                            <div class="card-body">
                                
                                <a 
                                class="modeloOficio" 
                                href="https://docs.google.com/document/d/1xWlmI6QH8NeiEb9-iXskncVlRw71nru-bK02LaSTDck/edit?usp=sharing"
                                target="_blank">
                                1. Modelo de Ofício Entes Públicos Locais</a>
                                
                                <a 
                                class="modeloOficio" 
                                href="https://docs.google.com/document/d/1xWlmI6QH8NeiEb9-iXskncVlRw71nru-bK02LaSTDck/edit?usp=sharing"
                                target="_blank">
                                2. Modelo de Ofício Ofício companhias, autarquias e agências de habitação </a>
                            </div>
                        </div>  
                        <blockquote class="blockquote">   
                            <h5>Passo a passo para cadastramento de propostas:</h5>
                        
                            <footer class="blockquote-footer">1. Informe seus dados pessoais no Formulário de Registro;</footer>
                            <footer class="blockquote-footer">2. Informe qual Proponente representará;</footer>
                            <footer class="blockquote-footer">3. Informe qual modalidade deseja participar;</footer>
                            <footer class="blockquote-footer">4. Anexe os ofícios necessários conforme a modalidade desejada. Verifique o conteúdo necessário conforme os modelos disponibilizados acima.
                            </footer>
                            <footer class="blockquote-footer">5. Clique em enviar.                            </footer>
                            <footer class="blockquote-footer">6. Aguarde o envio de confirmação de aprovação do cadastro por e-mail.
                            </footer>
                            <footer class="blockquote-footer">7. Acesse o SISHAB para cadastrar propostas.</footer>
                        </blockquote>                               
                    </div>
                    <!--fim row-->

                </div><!--fim card-body-->
            </div><!--fim card-->
        </div><!--fim column col-sm-6-->
        
        <div class="column col-sm-6">
            <div class="card">
                <div class="card-body">
                <form action="{{ url('prototipo/registro/salvar') }}" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="viewlet-above-content-title"></div>
                    <h3 class="documentFirstHeading text-center">
                    Registro
                        </h3>
                    <div class="linha-separa"></div>
                    <div class="titulo">
                        <h5>Dados Pessoais</h5> 
                    </div>          
                    <div class="row">  
                        <div class="column col-xs-12 col-md-12 {{ $errors->has('txt_nome') ? ' is-invalid' : '' }}">
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
                    </div>
                    <!--fim row-->
                    <div class="row">      
                        <div class="column col-xs-12 col-md-12">
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
                        <div class="column col-xs-12 col-md-12">
                            <label for="cpf">CPF</label>   
                            <input type="text" 
                                name="txt_cpf_usuario"   
                                class="form-control{{ $errors->has('txt_cpf_usuario') ? ' is-invalid' : '' }}"  
                                maxlength="11" 
                                value="{{ old('txt_cpf_usuario') }}" >

                            @if ($errors->has('txt_cpf_usuario'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('txt_cpf_usuario') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <!--fim row-->
                    <div class="row">  
                        <div class="column col-xs-12 col-md-12">
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
                                value="{{ old('txt_ddd') }}" >

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
                                value="{{ old('txt_telefone') }}" >

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
                                value="{{ old('txt_ddd_movel') }}" >

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
                                value="{{ old('txt_celular') }}" >

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
                        <div class="column col-xs-12 col-md-12">
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
                            <label for="nome_proponente">Nome Ente do Proponente</label>   
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
                        <div class="column col-xs-12 col-md-12">
                            <label for="tipo_proponente">Tipo Proponente</label>           
                            <select 
                                id="tipo_proponente_id"
                                 class="form-control{{ $errors->has('tipo_prototipo') ? ' is-invalid' : '' }}"  
                                name="tipo_proponente_id"     
                                value="{{ old('tipo_proponente_id') }}"           
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
                    </div>
                    
                     <!--fim row-->
                     <div class="row">  
                        <div class="column col-xs-12 col-md-12">
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
                    
                     <div class="row">  
                        <div class="column col-xs-12 col-md-12">
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
                    </div>
                    <!--fim row-->
                    <div class="row">  
                        <div class="column col-xs-12 col-md-12">
                            <label for="tipo_prototipo">Modalidade de Participação</label>     
                            <select 
                                id="modalidade_participacao"
                                class="form-control" 
                                name="modalidade_participacao" >
                                <option value="">Escolha uma modalidade:</option>
                                @foreach($modalidades_participacao as $modalidade)
                                @if($modalidade->id == old('modalidade_participacao'))
                                    <option value="{{ $modalidade->id }}" selected>
                                        {{ $modalidade->txt_modalidade_participacao }}
                                    </option>
                                @else
                                    <option value="{{ $modalidade->id }}">
                                        {{ $modalidade->txt_modalidade_participacao }}
                                    </option>
                                @endif
                                
                            @endforeach
                        </select>
                           


                        @if ($errors->has('modalidade_participacao'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('modalidade_participacao') }}</strong>
                            </span>
                        @endif                              
                        </div>
                    </div>
                    <!--fim row-->
                    <div class="row">
                        <div class="column col-xs-12 col-md-12">
                            <label for="caminho_doc_cartorio">Anexar Ofício Assinado Entes Públicos Locais</label>
                            <input type="file" class="form-control-file" id="txt_caminho_oficio" name="txt_caminho_oficio" accept="image/* , application/pdf" required>
                        </div>
                        <div class="column col-xs-12 col-md-12" v-if='tipo_prototipo == 2'>
                            <label for="caminho_doc_cartorio">Anexar Ofício Assinado companhias, autarquias e agências de habitação </label>
                            <input type="file" class="form-control-file" id="txt_caminho_oficio" name="txt_caminho_oficio" accept="image/* , application/pdf" required>
                        </div>
                    </div>    
                    <!--fim row-->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
                </form>    
                </div><!--fim card-body-->
            </div><!--fim card-->
        </div><!--fim column col-sm-6-->
    </div>
    <!--fim row-->       

</div>
<!-- content-->



@endsection