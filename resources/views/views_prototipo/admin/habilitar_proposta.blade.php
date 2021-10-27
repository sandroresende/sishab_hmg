@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            :url="'{{ url('/home') }}'"
            :titulo1="'Protótipo de HIS'"
            :titulo2='"Formulário de levantamento de informações"'
            :link2="'{{ url("/admin/prototipo/show/levantamento/$prototipo->id") }}'"
            :titulo3='"Formulário de Análise de Proposta"'
            

            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'{{$prototipo->txt_nome_prototipo}} (id: {{$prototipo->id}} )'"
                    subtitulo1=" {{$municipio->ds_municipio}} - {{$municipio->txt_sigla_uf}}"
                    @if($prototipo->situacao_prototipo_id == 3)
                        subtitulo2="Data Conclusão: {{date('d/m/Y',strtotime($prototipo->dte_conclusao_preenchimento))}}"                    
                    @elseif($prototipo->situacao_prototipo_id == 4)
                        subtitulo2="Data de Finalização: {{date('d/m/Y',strtotime($prototipo->dte_prototipo_finalizado))}}"                        
                    @endif
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/admin/prototipo/enviada/$prototipo->id") }}'"
                    :barracompartilhar="true">

                    @if($prototipo->situacao_prototipo_id == 3)
                        <div class="alert alert-primary text-center" role="alert">
                            <h4>CONCLUÍDO</h4>
                        </div>   
                        @elseif($prototipo->situacao_prototipo_id == 4)
                            <div class="alert alert-success  text-center" role="alert">
                                <h4>PROPOSTA ENVIADA</h4>
                            </div>   
                        @endif

            </cabecalho-form> 
            <div class="form-group">               
                <div class="titulo">
                    <h3>Dados do Proponente </h3>                     
                </div>

                <div class="row">
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">UF</label>
                        <input id="txt_sigla_uf" type="text" class="form-control input-relatorio" name="txt_sigla_uf" value="{{$municipio->txt_sigla_uf}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Município</label>
                        <input id="ds_municipio" type="text" class="form-control input-relatorio" name="ds_municipio" value="{{$municipio->ds_municipio}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">CNPJ</label>
                        <input id="id" type="text" class="form-control input-relatorio" name="id" value="{{$ente->id}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Ente Público</label>
                        <input id="txt_ente_publico" type="text" class="form-control input-relatorio" name="txt_ente_publico" value="{{$ente->txt_ente_publico}}" disabled>
                    </div> 
                </div>     
                <div class="row">    
                    <div class="column col-xs-12 col-md-8">
                        <label class="control-label label-relatorio">Nome do Chefe do Poder Executivo</label>
                        <input id="txt_nome_chefe_executivo" type="text" class="form-control input-relatorio" name="txt_nome_chefe_executivo" value="{{$ente->txt_nome_chefe_executivo}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Cargo</label>
                        <input id="txt_cargo_executivo" type="text" class="form-control input-relatorio" name="txt_cargo_executivo" value="{{$ente->txt_cargo_executivo}}" disabled>
                    </div>
                </div>   <!-- row-->
                <div class="titulo">
                    <h3>Dados Representante máximo do órgão responsável </h3>                     
                </div>
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">CPF</label>
                        <input id="txt_cpf_representante" type="text" class="form-control input-relatorio" name="txt_cpf_representante" value="{{$ente->txt_cpf_representante}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label label-relatorio">Nome do Representante</label>
                        <input id="txt_nome_representante" type="text" class="form-control input-relatorio" name="txt_nome_representante" value="{{$ente->txt_nome_representante}} {{$ente->txt_sobrenome_representante}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Cargo</label>
                        <input id="txt_cargo_representante" type="text" class="form-control input-relatorio" name="txt_cargo_representante" value="{{$ente->txt_cargo_representante}}" disabled>
                    </div>
                </div>   <!-- row-->
                <div class="titulo">
                    <h3>Orgão responsável </h3>                     
                </div>
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">CNPJ</label>
                        <input id="txt_cnpj_orgao_rep" type="text" class="form-control input-relatorio" name="txt_cnpj_orgao_rep" value="{{$ente->txt_cnpj_orgao_rep}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label label-relatorio">Nome do Orgão</label>
                        <input id="txt_orgao_responsavel" type="text" class="form-control input-relatorio" name="txt_orgao_responsavel" value="{{$ente->txt_orgao_responsavel}}" disabled>
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Admin Indireta</label>
                        <input id="bln_adm_indireta" type="text" class="form-control input-relatorio" name="bln_adm_indireta" value="@if($ente->bln_adm_indireta) SIM @else NÃO @endif" disabled>
                    </div>
                </div>   <!-- row-->
            </div> <!-- form-group -->

            <div class="form-group">                
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-outline-primary btn-lg btn-block " data-toggle="collapse" data-target="#collapsePontuacao" aria-expanded="true" aria-controls="collapsePontuacao">
                            Descrição Pontuação
                            </button>
                        </h5>
                        </div>
                    
                        <div id="collapsePontuacao" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">            
                                <table class="table table-hover">
                
                                    <thead>
                                    <tr class="text-center" >
                                        <th>Item</th>
                                        <th>Requisitos</th>
                                        <th>Distância/Tempo</th>
                                        <th>Pontuação</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($tabelaPontos as $dados)
                                    <tr>
                                        <td>{{$dados->txt_item}}</td>
                                        <td>{{$dados->txt_requisito}}</td>
                                        <td>{{$dados->txt_dist_temp_requisito}}</td>
                                        <td class="text-center">{{$dados->num_pontuacao_item}}</td>
                                    </tr>    
                                    @endforeach
                                    <tr class="total text-center">
                                        <td colspan="3" class="text-right">TOTAL</td>
                                        <td  class="text-center">{{$tabelaPontos->sum('num_pontuacao_item')}}</td>
                                    </tr>    
                                    </tbody>
                                </table><!-- fechar table-->    
                            </div>
                        </div>
                    </div>                    
                </div>             
            </div><!-- form-group--> 

            <form action='{{ url("admin/prototipo/habilitar") }}' role="form" method="POST">
                @csrf
                <input type="hidden" name="prototipo_id" value="{{ $prototipo->id }}">
           
                @include('views_prototipo.admin.form_content_habilitar_proposta')
            
                 
            </form>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


