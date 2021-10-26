@extends('layouts.app')

@section('content')
<?php 
  
  if(Session::get('ativarAba')){
    $ativarAba = Session::get('ativarAba');  
  }  

?>
<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/home') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> Codem</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Demanda</span>
    </span>
</div>


<div id="content">
  <div id="viewlet-above-content-title"></div>
  <h1 class="documentFirstHeading">
  Demanda
  </h1>
  
  <div class="linha-separa"></div>

  <div id="viewlet-above-content-body">

  </div>
  <div id="content-core">
  <form role="form" method="POST" action='{{ url("demanda/update/$demanda->demanda_id") }}'>
                @csrf
                    <div class="form-group"> 
                      <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link {{($ativarAba == 'demanda') ? 'active' : ''}}" id="nav-demanda-tab" data-toggle="tab" href="#nav-demanda" role="tab" aria-controls="nav-demanda" aria-selected="true">Demanda</a>
                            <a class="nav-item nav-link {{(Session::get('ativarAba') == 'responsaveis') ? 'active' : ''}}" id="nav-responsaveis-tab" data-toggle="tab" href="#nav-responsaveis" role="tab" aria-controls="nav-responsaveis" aria-selected="true">Responsáveis</a>
                            
                            <a class="nav-item nav-link {{(Session::get('ativarAba') == 'observacao') ? 'active' : ''}}" id="nav-observacoes-tab" data-toggle="tab" href="#nav-observacoes" role="tab" aria-controls="nav-observacoes" aria-selected="true">Observações</a>
                            
                            <a class="nav-item nav-link {{(Session::get('ativarAba') == 'processos') ? 'active' : ''}}" id="nav-processo-tab" data-toggle="tab" href="#nav-processo" role="tab" aria-controls="nav-processo" aria-selected="false">Processos</a>
                            <a class="nav-item nav-link {{(Session::get('ativarAba') == 'documentos') ? 'active' : ''}}" id="nav-documentos-tab" data-toggle="tab" href="#nav-documentos" role="tab" aria-controls="nav-documentos" aria-selected="false">Documentos</a>                          
                            <a class="nav-item nav-link {{(Session::get('ativarAba') == 'arquivos') ? 'active' : ''}}" id="nav-arquivos-tab" data-toggle="tab" href="#nav-arquivos" role="tab" aria-controls="nav-arquivos" aria-selected="false">Arquivos</a>                          
                        </div><!-- nav nav-tabs-->                
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                          <!-- inicio tab demanda-->
                            <div class="tab-pane fade {{($ativarAba == 'demanda') ? 'show active' : ''}}" id="nav-demanda" role="tabpanel" aria-labelledby="nav-demanda-tab">
                              <div class="titulo">
                                  <h5>Dados da Demanda </h5> 
                              </div><!-- titulo-->
                              <div class="form-group">
                                <div class="row">
                                  <div class="column col-md-2">
                                      <label for="cod_usuario" class="control-label">Data de Solicitação</label>
                                      <input id="dte_solicitacao" type="text" class="form-control" name="dte_solicitacao" value="{{date('d/m/Y',strtotime($demanda->dte_solicitacao))}}" disabled>
                                  </div>
                                  <div class="column col-md-3">
                                    <select-component
                                        url="'{{ url('/') }}'" 
                                        :dados="{{json_encode($situacoes)}}"
                                        textolabel="Situação"
                                        nomecampo="situacao_id"
                                        :selecionado = "{{($demanda->situacao_id) ? $demanda->situacao_id : 0 }}"
                                        textoescolha="Escolha uma Situação"
                                      >
                                    </select-component>                           
                                  </div>
                                  <div class="column col-md-2">
                                      <select-component
                                        url="'{{ url('/') }}'" 
                                        :dados="{{json_encode($tiposDemanda)}}"
                                        textolabel="Tipo de Demanda"
                                        nomecampo="tipo_demanda_id"
                                        :selecionado = "{{($demanda->tipo_demanda_id) ? $demanda->tipo_demanda_id : 0}}"
                                        textoescolha="Escolha um Tipo de Demanda"
                                      >
                                    </select-component>                                
                                  </div>
                                  <div class="column col-md-3">
                                      <select-component
                                        url="'{{ url('/') }}'" 
                                        :dados="{{json_encode($tiposAtendimento)}}"
                                        textolabel="Tipo de Atendimento"
                                        nomecampo="tipo_atendimento_id"
                                        :selecionado = "{{($demanda->tipo_atendimento_id) ? $demanda->tipo_atendimento_id : 0}}"
                                        textoescolha="Escolha um Tipo de Atendimento"
                                      >
                                    </select-component>   
                                  </div>
                                  <div class="column col-md-2">
                                    <select-component
                                          :url="'{{ url('/') }}'" 
                                          :dados="{{json_encode($modalidade)}}"
                                          textolabel="Modalidade"
                                          nomecampo="modalidade_demanda_id"
                                          :selecionado = "{{($demanda->modalidade_demanda_id) ? $demanda->modalidade_demanda_id : 0}}"
                                          textoescolha="Escolha uma Modalidade"
                                        >
                                      </select-component>                                  
                                  </div>
                                </div><!-- fim row -->
                                <!-- inicio row -->     
                                <select-tema-subtema
                                    :url="'{{ url('/') }}'"
                                    :subtemaselecionado = "{{$demanda->subtema_id}}"
                                    coltema="column col-md-4"
                                    colsubtema="column col-md-8">
                                </select-tema-subtema> 
                                <!-- fim row --> 
                                <!-- inicio row -->     
                                <div class="row">
                                  <div class="column col-md-4">
                                    <select-component
                                          :url="'{{ url('/') }}'" 
                                          :dados="{{json_encode($prioridade)}}"
                                          textolabel="Prioridade"
                                          nomecampo="prioridade_id"
                                          :selecionado = "{{$demanda->prioridade_id}}"
                                          textoescolha="Escolha uma Prioridade"
                                        >
                                      </select-component>                                  
                                  </div>
                                  <div class="column col-md-4">
                                      <label for="qtd_dias_conclusao">Quantidade de dias</label>
                                      <input class="form-control" type="text" name="qtd_dias_conclusao" value="{{empty(old('$demanda->qtd_dias_conclusao')) ? $demanda->qtd_dias_conclusao : old('$demanda->qtd_dias_conclusao')}}" required>

                                      @if ($errors->has('qtd_dias_conclusao'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('qtd_dias_conclusao') }}</strong>
                                          </span>
                                      @endif                      
                                  </div>
                                  <div class="column col-md-4">
                                      <label for="dte_previsao_conclusao">Data de Previsão Conclusão</label>
                                      <input class="form-control" type="text" name="dte_previsao_conclusao" value="{{empty(old('$demanda->dte_previsao_conclusao')) ? date('d/m/Y',strtotime($demanda->dte_previsao_conclusao)) : old(date('d/m/Y',strtotime($demanda->dte_previsao_conclusao)))}}" required>

                                      @if ($errors->has('dte_previsao_conclusao'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('dte_previsao_conclusao') }}</strong>
                                          </span>
                                      @endif                      
                                  </div>
                              </div>
                              <!-- fim row --> 
                              <!-- inicio row -->     
                              <div class="row ">
                                      <div class="column col-md-3">
                                        <select-component
                                              :url="'{{ url('/') }}'" 
                                              :dados="{{json_encode($tipoInteressado)}}"
                                              textolabel="Interessado"
                                              nomecampo="tipo_interessado_id"
                                              :selecionado = "{{($demanda->tipo_interessado_id) ? $demanda->tipo_interessado_id : 0}}"
                                              textoescolha="Escolha um Tipo de Interessado"
                                            >
                                          </select-component>                                  
                                      </div>
                                      <div class="column col-md-9">
                                          <label for="txt_nome_interessado">Nome do Interessado</label>
                                          <input class="form-control" type="text" name="txt_nome_interessado" value="{{empty(old('$demanda->txt_nome_interessado')) ? $demanda->txt_nome_interessado : old('$demanda->txt_nome_interessado')}}" required>

                                          @if ($errors->has('txt_nome_interessado'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('txt_nome_interessado') }}</strong>
                                              </span>
                                          @endif                      
                                      </div>
                                  </div>
                                  <!-- fim row -->                            
                              </div> <!-- form-group-->
                              
                              <select-uf-municipio 
                                                :url="'{{ url('/') }}'" 
                                                municipioselecionado="{{$demanda->municipio_id}}"
                                                coluf="column col-md-4"
                                                colmun="column col-md-8">
                              </select-uf-municipio>

                              <div class="form-group">
                                  <label for="dsc_demanda" class="control-label">Descrição da Demanda</label>
                                  <textarea class="form-control" id="txt_descricao_demanda" name="txt_descricao_demanda"  rows="10" placeholder="Descrição da Demanda" required>{{empty(old('$demanda->txt_descricao_demanda')) ? $demanda->txt_descricao_demanda : old('$demanda->txt_descricao_demanda')}}</textarea>
                                  
                                  @if ($errors->has('txt_descricao_demanda'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('txt_descricao_demanda') }}</strong>
                                            </span>
                                        @endif  
                              </div><!-- fim form-group-->

                              

                              <div class="container-fluid" >
                                <button class="btn-lg btn btn-success btn-block" type="submit">Atualizar</button>
                              </div>
                            </div>
                          <!-- fim tab demanda-->
                          <!-- inicio tab responsaveis-->
                          
                          <div class="tab-pane fade {{(Session::get('ativarAba') == 'responsaveis') ? 'show active' : ''}}" id="nav-responsaveis" role="tabpanel" aria-labelledby="nav-responsaveis-tab">
                              <div class="titulo">
                                  <h5>Responsáveis</h5> 
                              </div><!-- titulo-->
                              <div class="form-group">
                              <modallink tipo="link" nome="addResponsavel" titulo=" Criar" css="btn btn-outline-primary btn-sm"></modallink>
                              @if(count($responsaveisDemanda)>0)
                                <table class="table table-condensed">
                                  <thead>
                                    <tr>
                                      <th>Data de Atribuição</th>
                                      <th>Responsável</th>
                                      <th>Ação</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($responsaveisDemanda as $responsavel)
                                    <tr>
                                      <td>{{date('d/m/Y',strtotime($responsavel->dte_atribuicao_demanda))}}</td>
                                      <td>{{$responsavel->name}}</td>
                                      <td><i class="fas fa-trash-alt"></i>{{$responsavel->responsabilidade_demanda_id}}</td>
                                    </tr>   
                                    @endforeach                                 
                                  </tbody>
                                </table> 
                              @endif   
                              </div><!-- fim form-group-->
                          </div>
                          <!-- fim tab responsaveis-->
                          <!-- inicio tab observacoes-->
                          <div class="tab-pane fade {{(Session::get('ativarAba') == 'observacao') ? 'show active' : ''}}" id="nav-observacoes" role="tabpanel" aria-labelledby="nav-observacoes-tab">
                              <div class="titulo">
                                  <h5>Observações</h5> 
                              </div><!-- titulo-->
                              <div class="form-group">
                              <modallink tipo="link" nome="addObservacao" titulo=" Criar" css="btn btn-outline-primary btn-sm"></modallink>
                              @if(count($observacoes)>0)
                                <table class="table table-condensed">
                                    <thead>
                                      <tr>
                                        <th>Data da Observação</th>
                                        <th>Usuário</th>
                                        <th>Observação</th>
                                        <th>Ação</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($observacoes as $observacao)
                                      <tr>
                                      <td>{{date('d/m/Y',strtotime($observacao->dte_observacao))}}</td>
                                      <td>{{$observacao->name}}</td>
                                      <td>{{$observacao->txt_observacao}}</td>
                                      <td>
                                          <botao-excluir :url="'{{ url('/observacao/delete/') }}'" registro="{{$observacao->observacao_demanda_id}}"></botao-excluir>
                                      
                                      </tr>   
                                      @endforeach                                 
                                    </tbody>
                                  </table>   
                                @endif    
                                </div><!-- fim form-group-->
                          </div>
                          <!-- fim tab observacoes-->
                          <!-- inicio tab processo-->
                          <div class="tab-pane fade {{(Session::get('ativarAba') == 'processos') ? 'active show' : ''}}" id="nav-processo" role="tabpanel" aria-labelledby="nav-processo-tab">
                            <div class="titulo">
                                  <h5>Processos</h5> 
                              </div><!-- titulo-->
                              <div class="form-group">
                              <modallink tipo="link" nome="addProcesso" titulo=" Criar" css="btn btn-outline-primary btn-sm"></modallink>
                              @if(count($processos)>0)
                              <table class="table table-condensed">
                                  <thead>
                                    <tr>
                                      <th>Nº Processo</th>
                                      <th>SEI</th>
                                      <th>Data Atuação</th>
                                      <th>Data Atribuição Técnico</th>
                                      <th>Data Atribuição Assinatura</th>
                                      <th>Responsável Assinatura</th>
                                      <th>Data Assinatura</th>
                                      <th>Status</th>
                                      <th>Ação</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($processos as $processo)
                                    <tr>
                                      <td>{{$processo->txt_num_processo}}</td>
                                      <td>@if($processo->bln_processo_sei) Sim @else Não @endif</td>
                                      <td>{{date('d/m/Y',strtotime($processo->dte_autuacao))}}</td>
                                      <td>@if($processo->dte_atribuicao_tecnico){{date('d/m/Y',strtotime($processo->dte_atribuicao_tecnico))}}@endif</td>
                                      <td>@if($processo->dte_atribuicao_assinatura){{date('d/m/Y',strtotime($processo->dte_atribuicao_assinatura))}}@endif</td>
                                      <td>{{$processo->responsavelAssinatura['txt_responsavel_assinatura']}}</td>
                                      <td>@if($processo->dte_assinatura){{date('d/m/Y',strtotime($processo->dte_assinatura))}}@endif</td>                                      
                                      <td>{{$processo->statusProcesso['txt_status_processo']}}</td>
                                      <td>
                                      <botao-excluir :url="'{{ url('/processo/delete/') }}'" registro="{{$processo->id}}"></botao-excluir>
                                      </td>
                                    </tr>   
                                    @endforeach                                 
                                  </tbody>
                                </table>  
                                @endif    
                                </div><!-- fim form-group-->
                          </div>
                          <!-- fim tab processo-->
                          <!-- inicio tab documentos-->
                          <div class="tab-pane fade {{(Session::get('ativarAba') == 'documentos') ? 'active show' : ''}}" id="nav-documentos" role="tabpanel" aria-labelledby="nav-documentos-tab">
                              <div class="titulo">
                                  <h5>Documentos</h5> 
                              </div><!-- titulo-->
                              <div class="form-group">
                              <modallink tipo="link" nome="addDocumentos" titulo=" Criar" css="btn btn-outline-primary btn-sm"></modallink>
                              @if(count($documentos)>0)
                              <table class="table table-condensed">
                                  <thead>
                                    <tr>
                                      <th>Documento</th>
                                      <th>Descrição</th>
                                      <th>Tipo</th>
                                      <th>SEI</th>
                                      <th>Usuário</th>
                                      <th>Ação</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($documentos as $documento)
                                    <tr>
                                      <td>{{$documento->txt_documento}}</td>
                                      <td>{{$documento->txt_descricao_documento}}</td>
                                      <td>{{$documento->txt_tipo_documento}}</td>
                                      <td>{{$documento->num_sei}}</td>
                                      <td>{{$documento->name}}</td>
                                      <td>
                                      <botao-excluir :url="'{{ url('/documento/delete/') }}'" registro="{{$documento->id}}"></botao-excluir>
                                      </td>
                                    </tr>   
                                    @endforeach                                 
                                  </tbody>
                                </table>  
                                @endif    
                                </div><!-- fim form-group-->
                          </div>  
                          <!-- fim tab documentos-->
                          <!-- inicio tab arquivos-->
                          <div class="tab-pane fade {{(Session::get('ativarAba') == 'arquivos') ? 'active show' : ''}}" id="nav-arquivos" role="tabpanel" aria-labelledby="nav-arquivos-tab">
                              <div class="titulo">
                                  <h5>Arquivos</h5> 
                              </div><!-- titulo-->
                              <div class="form-group">
                              <modallink tipo="link" nome="addArquivos" titulo=" Criar" css="btn btn-outline-primary btn-sm"></modallink>
                              @if(count($arquivos)>0)
                              <table class="table table-condensed">
                                  <thead>
                                    <tr>
                                      <th>Nome arquivo</th>
                                      <th>Local</th>
                                      <th>Tipo</th>
                                      <th>Ação</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($arquivos as $arquivo)
                                    <tr>
                                      <td>{{$arquivo->txt_nome_arquivo}}</td>
                                      <td>{{$arquivo->txt_caminho_arquivo}}</td>
                                      <td>{{$arquivo->txt_tipo_arquivo}}</td>
                                      <td>
                                      <botao-excluir :url="'{{ url('/arquivo/delete/') }}'" registro="{{$arquivo->id}}"></botao-excluir>
                                      </td>
                                    </tr>   
                                    @endforeach                                 
                                  </tbody>
                                </table>  
                                @endif    
                                </div><!-- fim form-group-->
                          </div>  
                          <!-- fim tab arquivos-->
                      </div><!-- tab-content -->

                      
                    </div> <!-- form-group-->

                </form>   
                <input class="btn btn-lg btn-danger btn-block" type="button" name="cancelar" value="Fechar" onclick="javascript:window.location=document.referrer">         
    </div>
    <!-- content-core-->
</div>
<!-- content-->


<!--modais das tabs -->
<modal nome="addResponsavel" titulo="Adicionar Observação">
    <formulario id="formAddObservacao" css="" action='{{ url("observacao/nova/demanda/$demanda->id") }}' method="post" enctype="" token="{{ csrf_token() }}">

      <div class="form-group">
      <div class="row">
              <div class="column col-md-3">
                <select-component
                      :url="'{{ url('/') }}'" 
                      :dados="{{json_encode($secretaria)}}"
                      textolabel="Secretaria"
                      nomecampo="secretaria_id"
                      :selecionado = "0"
                      textoescolha="Escolha uma Secretaria"
                    >
                  </select-component>                                  
              </div>
          </div>
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formAddObservacao" class="btn btn-info">Adicionar</button>
    </span>

  </modal>

<modal nome="addObservacao" titulo="Adicionar Observação">
    <formulario id="formAddObservacao" css="" action='{{ url("observacao/nova/demanda/$demanda->id") }}' method="post" enctype="" token="{{ csrf_token() }}">

      <div class="form-group">
        <label for="name">Observação</label>
        <textarea class="form-control" id="txt_observacao" name="txt_observacao"  rows="10" placeholder="Observação" required>{{empty(old('$demanda->txt_observacao')) ? $demanda->txt_observacao : old('$demanda->txt_observacao')}}</textarea>
                                  
              @if ($errors->has('txt_observacao'))
                  <span class="help-block">
                      <strong>{{ $errors->first('txt_observacao') }}</strong>
                  </span>
              @endif  
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formAddObservacao" class="btn btn-info">Adicionar</button>
    </span>

  </modal>

  <modal nome="addProcesso" titulo="Adicionar Processo">
    <formulario id="formAddProcesso" css="" action='{{ url("processo/novo/demanda/$demanda->id") }}' method="post" enctype="" token="{{ csrf_token() }}">

      <div class="form-group">
        <div class="row">
              <div class="column col-md-4">
                <label for="name">Nº Processo</label>
                <input class="form-control" type="text" name="txt_num_processo" maxlength="20" value="{{old('txt_num_processo')}}" required>

                @if ($errors->has('txt_num_processo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('txt_num_processo') }}</strong>
                    </span>
                @endif  
              </div>
        
              <div class="column col-md-4">
                <label for="name">Processo anexo ao SEI?</label>
                </br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="bln_processo_sei" id="processo_sei_sim" value="true" checked>
                  <label class="form-check-label" for="inlineRadio1">Sim</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="bln_processo_sei" id="processo_sei_nao" value="false">
                  <label class="form-check-label" for="inlineRadio2">Não</label>
                </div>
                
                @if ($errors->has('bln_processo_sei'))
                    <span class="help-block">
                        <strong>{{ $errors->first('bln_processo_sei') }}</strong>
                    </span>
                @endif  
              </div>

              <div class="column col-md-4">
                <select-component
                      :url="'{{ url('/') }}'" 
                      :dados="{{json_encode($statusProcesso)}}"
                      textolabel="Status do Processo"
                      nomecampo="status_processo_id"
                      :selecionado = "0"
                      textoescolha="Escolha um Status"
                    >
                  </select-component>                                  
              </div>
          </div>      
      </div>
      <div class="form-group">
          <div class="row">
            <div class="column col-md-4">
              <label for="name">Data de Autuação</label>
              <input class="form-control" datetime="dd/MM/yyyy" type="date" name="dte_autuacao" value="{{old('dte_autuacao')}}" required>

              @if ($errors->has('dte_autuacao'))
                  <span class="help-block">
                      <strong>{{ $errors->first('dte_autuacao') }}</strong>
                  </span>
              @endif      
            </div>
            <div class="column col-md-4">
              <label for="name">Data de Atribuição</label>
              <input class="form-control" datetime="dd/MM/yyyy" type="date" name="dte_atribuicao_tecnico" value="{{old('dte_atribuicao_tecnico')}}" >

              @if ($errors->has('dte_atribuicao_tecnico'))
                  <span class="help-block">
                      <strong>{{ $errors->first('dte_autuacao') }}</strong>
                  </span>
              @endif      
            </div>
            <div class="column col-md-4">
              <label for="name">Data de Atribuição Assinatura</label>
              <input class="form-control" datetime="dd/MM/yyyy" type="date" name="dte_atribuicao_assinatura" value="{{old('dte_atribuicao_assinatura')}}" >

              @if ($errors->has('dte_atribuicao_assinatura'))
                  <span class="help-block">
                      <strong>{{ $errors->first('dte_atribuicao_assinatura') }}</strong>
                  </span>
              @endif      
            </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <select-component
                      :url="'{{ url('/') }}'" 
                      :dados="{{json_encode($responsavelAssinatura)}}"
                      textolabel="Responsável Assinatura"
                      nomecampo="responsavel_assinatura_id"
                      :selecionado = "0"
                      textoescolha="Escolha um Responsável"
                    >
                  </select-component>                                  
              </div>
              <div class="col-md-6">
                <label for="name">Data de Assinatura</label>
                <input class="form-control" datetime="dd/MM/yyyy" type="date" name="dte_assinatura" value="{{old('dte_assinatura')}}" >

                @if ($errors->has('dte_assinatura'))
                    <span class="help-block">
                        <strong>{{ $errors->first('dte_assinatura') }}</strong>
                    </span>
                @endif                      
              </div>
          </div>
          <!-- fim row -->  

        
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formAddProcesso" class="btn btn-info">Adicionar</button>
    </span>

  </modal>

  <modal nome="addDocumentos" titulo="Adicionar Documentos">
    <formulario id="formAddDocumentos" css="" action='{{ url("documento/novo/demanda/$demanda->id") }}' method="post" enctype="" token="{{ csrf_token() }}">
      <div class="form-group">
        <div class="row">
          <div class="column col-md-4">
            <label for="name">Documento</label>
            <input class="form-control" type="text" name="txt_documento" value="{{old('txt_documento')}}" required>

            @if ($errors->has('txt_documento'))
                <span class="help-block">
                    <strong>{{ $errors->first('txt_documento') }}</strong>
                </span>
            @endif  
          </div>
          <div class="column col-md-4">
            <select-component
                  :url="'{{ url('/') }}'" 
                  :dados="{{json_encode($tipoDocumento)}}"
                  textolabel="Tipo de Documento"
                  nomecampo="tipo_documento_id"
                  :selecionado = "0"
                  textoescolha="Escolha um Tipo"
                >
              </select-component>                                  
          </div>
          <div class="column col-md-4">
            <label for="name">Nº Sei</label>
            <input class="form-control" type="text" name="num_sei" maxlength="20" value="{{old('num_sei')}}" required>

            @if ($errors->has('num_sei'))
                <span class="help-block">
                    <strong>{{ $errors->first('num_sei') }}</strong>
                </span>
            @endif  
          </div>
        </div>
      </div>


      <div class="form-group">
        <div class="row">
            <div class="col-md-12">
              <label for="name">Descrição do Documento</label>
              <textarea class="form-control" id="txt_descricao_documento" name="txt_descricao_documento"  rows="10" placeholder="Descrição do Documento" required>{{old('txt_descricao_documento')}}</textarea>
                                        
                    @if ($errors->has('txt_descricao_documento'))
                        <span class="help-block">
                            <strong>{{ $errors->first('txt_descricao_documento') }}</strong>
                        </span>
                    @endif  
            </div>
        </div>        
      </div>

    </formulario>
    <span slot="botoes">
      <button form="formAddDocumentos" class="btn btn-info">Adicionar</button>
    </span>

  </modal>

  <modal nome="addArquivos" titulo="Adicionar Arquivos">
    <formulario id="formAddArquivos" css="" action='{{ url("arquivo/novo/demanda/$demanda->id") }}' method="post" enctype="multipart/form-data" token="{{ csrf_token() }}">
    <div class="form-group">
        <div class="row">
        <div class="column col-md-4">
            <label for="name">Nome do Arquivo</label>
            <input class="form-control" type="text" name="txt_nome_arquivo" value="{{old('txt_nome_arquivo')}}">

            @if ($errors->has('txt_nome_arquivo'))
                <span class="help-block">
                    <strong>{{ $errors->first('txt_nome_arquivo') }}</strong>
                </span>
            @endif  
          </div>
          <div class="column col-md-4">
            <label for="name">Caminho do Arquivo</label>
            <input class="form-control" type="text" name="txt_caminho_arquivo" maxlength="20" value="{{old('txt_caminho_arquivo')}}">

            @if ($errors->has('txt_caminho_arquivo'))
                <span class="help-block">
                    <strong>{{ $errors->first('txt_caminho_arquivo') }}</strong>
                </span>
            @endif  
          </div>
          <div class="column col-md-4">
            <select-component
                  :url="'{{ url('/') }}'" 
                  :dados="{{json_encode($tipoArquivo)}}"
                  textolabel="Tipo de Arquivo"
                  nomecampo="tipo_arquivo_id"
                  textoescolha="Escolha um Tipo"
                >
              </select-component>                                  
              @if ($errors->has('tipo_arquivo_id'))
                <span class="help-block">
                    <strong>{{ $errors->first('tipo_arquivo_id') }}</strong>
                </span>
            @endif 
          </div>
        </div>
      </div>
    </formulario>
    <span slot="botoes">
      <button form="formAddArquivos" class="btn btn-info">Adicionar</button>
    </span>

  </modal>
 
@endsection

 @section('scriptsjs')
      
      @if(Session::has('errors'))
      <script type="text/javascript">
          $(document).read(funciona(){
              alert('Ops!! Teve erros no seu formulário. Vamos abrir novamente para que você possa corrigir. ;) ');
              $('#addArquivos').modal('show');
          });
      </script>  

@endif 
@endsection