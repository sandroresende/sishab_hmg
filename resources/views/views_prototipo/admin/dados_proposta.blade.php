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
            :titulo2='"Consulta de Propostas"'
            :link2="'{{ url('/admin/prototipo/consulta') }}'"
            :titulo3='"Propostas Cadastradas"'
            :titulo4='"Formulário de levantamento de informações"'
            

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
                    :dataatualizacao="'{{date('d/m/Y',strtotime($prototipo->updated_at))}}'"
                    :linkcompartilhar="'{{ url("/admin/prototipo/show/levantamento/$prototipo->id") }}'"
                    :barracompartilhar="true">

                    @if($prototipo->situacao_prototipo_id == 3)
                        <div class="alert alert-primary text-center" role="alert">
                            <h3>CONCLUÍDO</h3>
                        </div>   
                    @elseif($prototipo->situacao_prototipo_id == 4)
                        <div class="alert alert-success  text-center" role="alert">
                            <h3>PROPOSTA ENVIADA</h3>
                        </div>   
                    @elseif($prototipo->situacao_prototipo_id >=6)
                        <span class="documentFirstHeadingSpan">
                            <strong style="color:grey">Data Habilitação: </strong>{{date('d/m/Y',strtotime($habilitacao->dte_habilitacao))}}
                        </span> 
                            @if($habilitacao->bln_habilitada)
                                <div class="alert alert-success  text-center" role="alert">
                                    <h3>PROPOSTA HABILITADA</h3>
                                </div>   
                                @if($prototipo->num_pontuacao_total)
                                    <div class="alert alert-info text-center" role="alert">
                                        <strong style="color:grey"> Pontuação Total: </strong>{{$prototipo->num_pontuacao_total}} pontos <a  href="#collapsePontuacao" class="text-reset"><i class="fas fa-search text-reset"></i></a>
                                    </div>
                                @endif    
                             @else
                                <div class="alert alert-primary text-center" role="alert">
                                    <h3>PROPOSTA DESABILITADA</h3>
                                </div>           
                            @endif
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
                <div class="titulo">
                    <h3>Gestor ou técnico indicado como ponto focal do projeto </h3>                     
                </div>
                <div class="row">
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Nome</label>
                        <input id="name" type="text" class="form-control input-relatorio" name="name" value="{{$usuario->name}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Email</label>
                        <input id="email" type="text" class="form-control input-relatorio" name="email" value="{{$usuario->email}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Cargo/função</label>
                        <input id="txt_cargo" type="text" class="form-control input-relatorio" name="txt_cargo" value="{{$usuario->txt_cargo}}" disabled>
                    </div> 
                </div>   <!-- row-->        
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label label-relatorio">Órgão/lotação</label>
                        <input id="txt_ente_publico" type="text" class="form-control input-relatorio" name="txt_ente_publico" value="{{$ente->txt_ente_publico}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Telefone fixo</label>
                        <input id="telefone_fixo" type="text" class="form-control input-relatorio" name="telefone_fixo" value="{{$usuario->txt_ddd_fixo}}-{{$usuario->txt_telefone_fixo}}" disabled>
                    </div> 
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Telefone móvel</label>
                        <input id="telefone_movel" type="text" class="form-control input-relatorio" name="telefone_movel" value="{{$usuario->txt_ddd_movel}}-{{$usuario->txt_telefone_movel}}" disabled>
                    </div> 
                </div>   <!-- row-->             
            </div>   <!-- form-group-->             

            @include('views_prototipo.form_dados_prototipo')

            @if($prototipo->situacao_prototipo_id == 6 || $prototipo->situacao_prototipo_id == 7)  
               
                
                <div class="form-group">
                    <div class="titulo">
                        <h3>Situação Habilitação</h3>                     
                    </div>
                    <div class="row">
                        <div class="column col-xs-12 col-md-12">
                            <botao-acao-icone  
                                        :url="'{{ url("/admin/prototipo/habilitar/cancelar/")}}'" 
                                        registro="{{$habilitacao->id}}"                               
                                        mensagem="Deseja cancelar a análise da proposta?" 
                                        titulo="Atenção!"
                                        txtbotaoconfirma="Sim"
                                        txtbotaocancela="Cancelar"
                                        cssbotao="btn btn-danger btn-lg btn-block"                               
                                        cssicone=""
                                        textobotao="Cancelar Análise" 
                                    ></botao-acao-icone>
                        </div>
                    </div>                
                    <div class="row">
                        <div class="column col-xs-12 col-md-12">
                        <table class="table table-hover">
                            <thead>
                            <tr class="text-center" >
                                
                                <th>Requisito do Edital</th>
                                <th>Descrição</th>
                                <th>Situação</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                          
                                
                                <tr>
                                    @if($habilitacao->vlr_populacao_estimada<=750000)
                                    <td>4.2</td>  
                                    <td>Município com população abaixo de 750 mil habitantes devem atender a pelo menos 07 requisitos adicionais</td>
                                    @else
                                        <td>4.3</td>  
                                        <td> Município com população a partir de 750 mil habitantes devem atender a pelo menos 08 requisitos adicionais</td>
                                    @endif    
                                    <td>@if($habilitacao->bln_req_edital_42_43) Sim @else Não @endif</td>
                                </tr>
                                <tr>                                
                                    <td>3.6, a)</td>  
                                    <td>Comportar entre 100 e 150 unidades habitacionais.</td>
                                    <td>@if($habilitacao->bln_req_edital_36_a) Sim @else Não @endif</td>
                                </tr>
                                <tr>                                    
                                    <td>3.6, b)</td>  
                                    <td>Ter a titularidade comprovada em nome do Ente Público proponente ou das companhias, autarquias e agencias de habitação associadas à ABC, ou ainda de município parceiro.</td>
                                    <td>@if($habilitacao->bln_req_edital_36_b) Sim @else Não @endif</td>
                                </tr>
                                <tr>                                    
                                    <td>3.6, c) </td>  
                                    <td>Dispor dos requisitos obrigatórios de Inserção Urbana, constantes na Tabela 1 do Anexo I da Portaria nº 959, de 18 de maio de 2021. </td>    
                                    <td>@if($habilitacao->bln_req_edital_36_c) Sim @else Não @endif</td>
                                </tr>
                                <tr>                                    
                                    <td>3.6, e)</td>  
                                    <td>Estar localizado a uma distância máxima de até 200 quilômetros de aeroporto comercial, tendo em vista o caráter experimental dos empreendimentos.  </td>
                                    <td>@if($habilitacao->bln_req_edital_36_e) Sim @else Não @endif</td>
                                    
                                </tr>
                                <tr>                                    
                                    <td>Observações</td>  
                                    <td colspan="2">{{$habilitacao->txt_observacao}}</td>
                                </tr>
                            </tbody>
                        </table><!-- fechar table-->
                        </div>               
                    </div>
                </div><!-- form-group-->  
                @endif

                <div class="form-group">
                    <div class="titulo">
                        <h3>Tabela de Requisitos</h3>                     
                    </div>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h3 class="mb-0">
                                <button class="btn btn-outline-primary btn-lg btn-block " data-toggle="collapse" data-target="#collapsePontuacao" aria-expanded="true" aria-controls="collapsePontuacao">
                                Descrição Pontuação
                                </button>
                            </h3>
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
                
                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-6">
                            @if($habilitacao->bln_habilitada)
                                <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
                            @else    
                                <botao-acao  
                                    :url="'{{ url("admin/prototipo/enviada/")}}'" 
                                    registro="{{$prototipo->id}}"                               
                                    cssbotao="btn btn-lg btn-info btn-block"                               
                                    textobotao="Analisar" 
                                ></botao-acao>
                           @endif
                        </div>
                        <div class="column col-xs-12 col-md-6">
                            <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Fechar" onclick="javascript:window.history.go(-1)">  
                        </div>    
                    </div>
                </div> 
        </div> 
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


