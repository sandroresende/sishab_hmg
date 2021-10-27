@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            :url="'{{ url('/prototipo') }}'"
            :titulo1="'Protótipo de HIS'"
            :titulo2='"Introdução"'
            
            

            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'{{$prototipo->txt_nome_prototipo}} (id: {{$prototipo->id}} )'"
                    subtitulo1=" {{$municipio->ds_municipio}} - {{$municipio->txt_sigla_uf}}"
                    
                    :dataatualizacao="'{{date('d/m/Y',strtotime($prototipo->created_at))}}'"
                    :linkcompartilhar="'{{ url("/prototipo/levantamento/$prototipo->id") }}'"
                    :barracompartilhar="true">

                   
            </cabecalho-form> 
            <span class="documentFirstHeadingSpan">
                <h4  class="documentFirstHeading text-center">
                    1.	INTRODUÇÃO
                    </h4>
                    Este formulário é destinado aos representantes dos Entes Públicos subnacionais que, direta ou  indiretamente, por meio de secretarias, companhias, autarquias ou 
                    agências habitacionais, associados a ABC, estejam interessados em participar do Edital de Chamamento para a seleção de terrenos que receberão a implantação de 
                    estudo preliminar de projeto urbanístico e projeto executivo de conjunto arquitetônico de habitação de interesse social, pelos vencedores do concurso de ideias 
                    em arquitetura "Habitação de Interesse Sustentável".
            </span> 
            <form action='{{ url("prototipo/iniciar/levantamento/$prototipo->id") }}' method="get">
                @csrf
                    <div class="form-group">               
                        <div class="titulo">
                            <h5>Dados do Proponente </h5>                     
                        </div>
                        <div class="row">
                            <div class="column col-xs-12 col-md-2">
                                <label class="control-label">UF</label>
                                <input id="txt_sigla_uf" type="text" class="form-control" name="txt_sigla_uf" value="{{$municipio->txt_sigla_uf}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label">Município</label>
                                <input id="ds_municipio" type="text" class="form-control" name="ds_municipio" value="{{$municipio->ds_municipio}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-2">
                                <label class="control-label">CNPJ</label>
                                <input id="id" type="text" class="form-control" name="id" value="{{$ente->id}}" disabled>
                            </div> 
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label">Ente Público</label>
                                <input id="txt_ente_publico" type="text" class="form-control" name="txt_ente_publico" value="{{$ente->txt_ente_publico}}" disabled>
                            </div> 
                        </div>     
                        <div class="row">    
                            <div class="column col-xs-12 col-md-8">
                                <label class="control-label">Nome do Chefe do Poder Executivo</label>
                                <input id="txt_nome_chefe_executivo" type="text" class="form-control" name="txt_nome_chefe_executivo" value="{{$ente->txt_nome_chefe_executivo}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label">Cargo</label>
                                <input id="txt_cargo_executivo" type="text" class="form-control" name="txt_cargo_executivo" value="{{$ente->txt_cargo_executivo}}" disabled>
                            </div>
                        </div>   <!-- row-->
                        <div class="titulo">
                            <h5>Dados Representante máximo do órgão responsável </h5>                     
                        </div>
                        <div class="row">
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label">CPF</label>
                                <input id="txt_cpf_representante" type="text" class="form-control" name="txt_cpf_representante" value="{{$ente->txt_cpf_representante}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-6">
                                <label class="control-label">Nome do Representante</label>
                                <input id="txt_nome_representante" type="text" class="form-control" name="txt_nome_representante" value="{{$ente->txt_nome_representante}} {{$ente->txt_sobrenome_representante}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label">Cargo</label>
                                <input id="txt_cargo_representante" type="text" class="form-control" name="txt_cargo_representante" value="{{$ente->txt_cargo_representante}}" disabled>
                            </div>
                        </div>   <!-- row-->
                        <div class="titulo">
                            <h5>Orgão responsável </h5>                     
                        </div>
                        <div class="row">
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label">CNPJ</label>
                                <input id="txt_cnpj_orgao_rep" type="text" class="form-control" name="txt_cnpj_orgao_rep" value="{{$ente->txt_cnpj_orgao_rep}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-6">
                                <label class="control-label">Nome do Orgão</label>
                                <input id="txt_orgao_responsavel" type="text" class="form-control" name="txt_orgao_responsavel" value="{{$ente->txt_orgao_responsavel}}" disabled>
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label">Admin Indireta</label>
                                <input id="bln_adm_indireta" type="text" class="form-control" name="bln_adm_indireta" value="@if($ente->bln_adm_indireta) SIM @else NÃO @endif" disabled>
                            </div>
                        </div>   <!-- row-->
                        <div class="titulo">
                            <h5>Gestor ou técnico indicado como ponto focal do projeto </h5>                     
                        </div>
                        <div class="row">
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label">Nome</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}" disabled>
                            </div> 
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label">Email</label>
                                <input id="email" type="text" class="form-control" name="email" value="{{$usuario->email}}" disabled>
                            </div> 
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label">Cargo/função</label>
                                <input id="txt_cargo" type="text" class="form-control" name="txt_cargo" value="{{$usuario->txt_cargo}}" disabled>
                            </div> 
                        </div>   <!-- row-->        
                        <div class="row">
                            <div class="column col-xs-12 col-md-6">
                                <label class="control-label">Órgão/lotação</label>
                                <input id="txt_ente_publico" type="text" class="form-control" name="txt_ente_publico" value="{{$ente->txt_ente_publico}}" disabled>
                            </div> 
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label">Telefone fixo</label>
                                <input id="telefone_fixo" type="text" class="form-control" name="telefone_fixo" value="{{$usuario->txt_ddd_fixo}}-{{$usuario->txt_telefone_fixo}}" disabled>
                            </div> 
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label">Telefone móvel</label>
                                <input id="telefone_movel" type="text" class="form-control" name="telefone_movel" value="{{$usuario->txt_ddd_movel}}-{{$usuario->txt_telefone_movel}}" disabled>
                            </div> 
                        </div>   <!-- row-->             
                    </div>   <!-- form-group-->    
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="column col-xs-12 col-md-6">
                                <input class="btn btn-lg btn-info btn-block" type="submit" value="Iniciar Preenchimento">                           
                            </div>
                            <div class="column col-xs-12 col-md-6">
                                <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                            </div>    
                        </div>
                    </div> <!-- form-group -->
            </form>        

            
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


