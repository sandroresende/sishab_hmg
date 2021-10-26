@extends('layouts.app') 

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
        <a href="{{ url('/home') }}">Página Inicial</a>
        <span class="breadcrumbSeparator">
            &gt;            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Consulta Rápida</span>
    </span>
</div>

<div id="content">

<div id="viewlet-above-content-title"></div>
<h2 class="documentFirstHeading text-center">
    Relatório Executivo
    </h2>
<div class="linha-separa">

    <div id="content-core">
        <div class="titulo">
            <H3>Por Município</H3>
        </div>
        <caption>Selecione um município para acesso rápido aos dados gerais de contratação para o município.</caption>
        <div class="form-group">
            <div class="help-parent">
                @if ($errors->has('municipio_id'))
                <span class="help-block">
                                <strong>{{ $errors->first('municipio_id') }}</strong>
                            </span> @endif
            </div>
            <form action="{{ url('novo_executivo/relatorio') }}" method="POST">
                @csrf
                <div class="input-group">
                    <select class="form-control drop" id="municipio" name="municipio" required>
                        <option value="">Selecione um Município</option>
                        @foreach($municipiosExecutivo as $municipioExecutivo)
                        <option value="{{$municipioExecutivo->municipio_id }}">
                            {{$municipioExecutivo->ds_municipio}} - {{$municipioExecutivo->txt_sigla_uf}}
                        </option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
<!--
        <div class="titulo">
                <H3>Limite Contratação - Por município</H3>
            </div>
            <caption>Selecione um município para acesso rápido aos limites de contratação para o município.</caption>
            <div class="form-group">
                <div class="help-parent">
                    @if ($errors->has('municipio_id'))
                    <span class="help-block">
                            <strong>{{ $errors->first('municipio_id') }}</strong>
                        </span> @endif
                </div>
                <form action="{{ url('executivo/relatorio') }}" method="POST">
                    @csrf
                    <div class="input-group">

                        <select class="form-control drop" id="municipio" name="municipio" required>
                            <option value="">Selecione um Município</option>
                            @foreach($municipiosLimite as $municipioLimite)
                            <option value="{{$municipioLimite->id }}">
                                {{$municipioLimite->ds_municipio}} - {{$municipioLimite->txt_sigla_uf}}
                            </option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
-->
            <div class="titulo">
                <H3>Por APF</H3>
            </div>
            <caption>Utilize o código do APF para acesso rápido aos dados do empreendimento.</caption>
            <div class="form-group">
                <form action="{{ url('empreendimentos/consulta') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="num_apf" placeholder="Ex.: 1254863 (sem os zeros a esquerda e sem caracteres especiais)" 
                           class="form-control" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>      
                    </div>
                    
                </form>
            </div>

            
    </div>
    <!-- content-core-->
    <div id="content-core">
        
            <div class="titulo">
                <H3>Situação de Pagamento Por APF <span class="badge badge-danger"> Novo</span></H3>
            </div>
            <caption>Utilize o código do APF para acesso rápido aos dados de pagamento dos empreendimento.</caption>
            <div class="form-group">
            <form action="{{ url('/pagamento/situacao') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="num_apf" name="num_apf" placeholder="Ex.: 1254863 (sem os zeros a esquerda e sem caracteres especiais)" 
                           class="form-control" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>      
                    </div>
                    
                </form>
            </div>

            
    </div>
    <!-- content-core-->


    <div id="viewlet-above-content-title"></div>
    <h2 class="documentFirstHeading text-center">
        Seleção de Propostas
    </h2>
    <div class="linha-separa"></div>
    <div id="content-core">
        <!-- form-group-->
        <div class="form-group">
            <div class="titulo">
                <H3>Por APF</H3>
            </div>
            <caption>Utilize o código do APF para acesso rápido aos dados das propostas enviadas.</caption>
            <div class="form-group">
                <div class="help-parent">
                    @if ($errors->has('txt_num_apf'))
                    <span class="help-block">
                            <strong>{{ $errors->first('txt_num_apf') }}</strong>
                        </span> @endif
                </div>
                <form action="{{ url('proposta/apf') }}" method="POST">
                    @csrf
                    <autocomplete-apf :url="'{{ url('/') }}'"></autocomplete-apf>
                </form>
            </div>

            <!-- row-->
            <div class="titulo">
                <H3>Por CNPJ do Proponente</H3>
            </div>
            <caption>Utilize o código do CNPJ do proponente para acesso rápido aos dados das propostas enviadas.</caption>
            <div class="form-group">
                <div class="help-parent">
                    @if ($errors->has('txt_cnpj'))
                    <span class="help-block">
                            <strong>{{ $errors->first('txt_cnpj') }}</strong>
                        </span> @endif
                </div>
                <form action="{{ url('proposta/proponente') }}" method="POST">
                    @csrf
                    <autocomplete-cnpj :url="'{{ url('/') }}'"></autocomplete-cnpj>
                </form>
            </div>

            <div class="titulo">
                <H3>Por Número da Portaria de Seleção</H3>
            </div>
            <caption>Utilize o número da portaria de seleção para acesso rápido aos dados das propostas selecionadas.</caption>
            <div class="form-group">
                <div class="help-parent">
                    @if ($errors->has('selecao_id'))
                    <span class="help-block">
                            <strong>{{ $errors->first('selecao_id') }}</strong>
                        </span> @endif
                </div>
                <form action="{{ url('selecao/portaria') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <select class="form-control drop" id="selecao_id" name="selecao_id" required>
                            <option value="">Selecione uma Portaria</option>
                            @foreach($selecoes as $selecao)
                            <option value="{{$selecao->id }}">
                                Portaria nº {{$selecao->num_portaria_resultado}} ({{$selecao->num_selecao}}ª seleção {{$selecao->num_ano_selecao}} - {{$selecao->modalidade->txt_modalidade}})
                            </option>
                            @endforeach
                        </select>

                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            
        </div>
        <!--form-group -->
    </div>
    <!-- content-core-->


    <div id="viewlet-above-content-title"></div>
    <h2 class="documentFirstHeading text-center">
    Oferta Pública
    </h2>
    <div class="linha-separa">
        <div id="content-core">
            <div class="titulo">
                <H3>Por protocolo</H3>
            </div>
            <caption>Digite um número protocolo para saber a situação dos contratos</caption>
            <div class="form-group">
                <form action="{{ url('protocolo') }}" method="POST">
                    @csrf
                    <autocomplete-protocolo :url="'{{ url('/') }}'"></autocomplete-protocolo>
                </form>
            </div>

            <div class="titulo">
                <H3>Por NIS</H3>
            </div>
            <caption>Digite um número do NIS para saber a situação do contrato</caption>
            <div class="form-group">
                <form id="form_enviar" action="{{ url('contrato') }}" method="POST">
                    @csrf
                    <autocomplete-nis :url="'{{ url('/') }}'"></autocomplete-nis>
                </form>
            </div>
        </div>
        <!-- content-core-->
</div>
<!-- content-->

@endsection