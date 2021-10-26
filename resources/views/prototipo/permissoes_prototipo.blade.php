@extends('layouts.app')
@section('scripts')
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- Section-->
<div id="portal-breadcrumbs">
        <span id="breadcrumbs-you-are-here">Você está aqui:</span>
        <span id="breadcrumbs-home">
            <a href="{{ url('/home') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-1">        
            <span> Permissões </span>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>        

    </div> 

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
     <h2  class="documentFirstHeading text-center">
     Permissões ({{ count($permissoes) }})
        </h2>
     <span class="documentFirstHeadingSpan"></span>          
       
    <div id="viewlet-above-content-body">

    </div>
    <div id="content-core">

        <nav>
        <ul class="nav nav-pills nav-fill">
            
            <li class="nav-item">
                <button type="button" 
                        class="btn btn-outline-primary btn-block nav-link active" 
                        id="nav-analise-tab" 
                        data-toggle="tab" 
                        href="#nav-analise" role="tab" aria-controls="nav-analise" aria-selected="true">Em Análise ({{ count($permissoesAnalise) }})</button>
            </li>
            <li class="nav-item">                            
                <button type="button" class="btn btn-outline-success btn-block nav-link " id="nav-deferida-tab" data-toggle="tab" href="#nav-deferida" role="tab" aria-controls="nav-deferida" aria-selected="true">Deferidas ({{ count($permissoesDeferida) }})</button>                
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-outline-danger btn-block nav-link " id="nav-indeferida-tab" data-toggle="tab" href="#nav-indeferida" role="tab" aria-controls="nav-indeferida" aria-selected="true">Indeferidas ({{ count($permissoesIndeferida) }})</button>                
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-outline-warning btn-block nav-link " id="nav-cancelada-tab" data-toggle="tab" href="#nav-cancelada" role="tab" aria-controls="nav-cancelada" aria-selected="true">Bloqueadas ({{ count($permissoesBloqueada) }})</a>
            </li>
            <br/>
        </ul>
        
<hr/>

        </nav>
        <div class="tab-content" id="nav-tabContent">
        @if(count($permissoesAnalise)>0)
        
            <div class="tab-pane fade show active" id="nav-analise" role="tabpanel" aria-labelledby="nav-analise-tab">
                <div  class="titulo">
                        <h5>Permissões em Análise</h5> 
                </div>
                <table class="table table-hover">
                <thead>
                  <tr class="text-center" >
                    <th>Id</th>
                    <th>UF</th>
                    <th>Município</th>
                    <th>Proponente</th>    
                    <th>CPF</th>       
                    <th>Nome</th>       
                    <th>Ofício</th>       
                    <th>Data Solicitação</th>       
                    <th>Deferir</th>                    
                    <th>Indeferir</th>                    
                  </tr>
                </thead>
                <tbody>
                @foreach($permissoesAnalise as $dados)
                    
                     <tr class="text-center" >
                        <td>{{$dados->id}}</td>
                        <td>{{$dados->txt_sigla_uf}}</td>
                        <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                        <td>{{$dados->ds_municipio}}</td> 
                        <td>{{$dados->txt_ente_publico}}</td>
                        <td>{{$dados->txt_cpf_usuario}}</td>
                        <td>{{$dados->name}}</td>
                        <td>
                            <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio")}}'><i class="fas fa-file-pdf fa-2x"></i></a>                         
                        </td>
                        
                        <td>  {{date('d/m/Y',strtotime($dados->created_at))}} </td>
                        <td>
                            <botao-acao-icone  
                                :url="'{{ url('/admin/permissao/deferir/') }}'" 
                                registro="{{$dados->id}}"                               
                                mensagem="Deseja deferir essa permissão?" 
                                titulo="Atenção!"
                                txtbotaoconfirma="Deferir"
                                txtbotaocancela="Cancelar"
                                cssbotao="btn btn-success btn-sm"                               
                                cssicone="fas fa-plus" 
                             ></botao-acao-icone>
                        </td>
                        <td>
                        <a href='{{ url("/admin/permissao/indeferir/abrir/$dados->id")}}' type="button"  class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></a>
                   
                            
                        </td>
                       
                      </tr>
                    
                @endforeach
                </tbody>
              </table><!-- fechar table-->
            </div><!--nav-analise -->
        @endif
    
    @if(count($permissoesDeferida)>0)
            <div class="tab-pane fade show" id="nav-deferida" role="tabpanel" aria-labelledby="nav-deferida-tab">
                <div class="titulo">
                        <h5>Permissões Deferidas</h5> 
                </div>
                <table class="table table-hover">
                <thead>
                  <tr class="text-center" >
                    <th>Id</th>
                    <th>UF</th>
                    <th>Município</th>
                    <th>Proponente</th>    
                    <th>CPF</th>       
                    <th>Nome</th>       
                    <th>Ofício</th>       
                    <th>Data Solicitação</th>       
                    <th>Data Análise</th>       
                    <th>Bloquear</th>                                        
                  </tr>
                </thead>
                <tbody>
                @foreach($permissoesDeferida as $dados)
                    
                     <tr class="text-center" >
                        <td>{{$dados->id}}</td>
                        <td>{{$dados->txt_sigla_uf}}</td>
                        <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                        <td>{{$dados->ds_municipio}}</td> 
                        <td>{{$dados->txt_ente_publico}}</td>
                        <td>{{$dados->txt_cpf_usuario}}</td>
                        <td>{{$dados->name}}</td>
                        <td>
                            <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio")}}'><i class="fas fa-file-pdf fa-2x"></i></a>                         
                        </td>
                        
                        <td>  {{date('d/m/Y',strtotime($dados->created_at))}} </td>
                        <td>  {{date('d/m/Y',strtotime($dados->dte_analise))}} </td>
                        <td>
                            <botao-acao-icone  
                                :url="'{{ url('/admin/permissao/bloquear/') }}'" 
                                registro="{{$dados->id}}"                               
                                mensagem="Deseja bloquear essa permissão?" 
                                titulo="Atenção!"
                                txtbotaoconfirma="Bloquear"
                                txtbotaocancela="Cancelar"
                                cssbotao="btn btn-danger btn-sm"                               
                                cssicone="fas fa-minus"                               
                             ></botao-acao-icone>
                           
                        </td>
                      

                      </tr>
                    
                @endforeach
                </tbody>
              </table><!-- fechar table-->
             </div><!--nav-deferida -->
        
    @endif
    @if(count($permissoesIndeferida)>0)
            <div class="tab-pane fade show" id="nav-indeferida" role="tabpanel" aria-labelledby="nav-indeferida-tab">
                <div class="titulo">
                        <h5>Permissões Indeferidas</h5> 
                </div>
                <table class="table table-hover">
                <thead>
                <tr class="text-center" >
                    <th>Id</th>
                    <th>UF</th>
                    <th>Município</th>
                    <th>Proponente</th>    
                    <th>CPF</th>       
                    <th>Nome</th>       
                    <th>Ofício</th>       
                    <th>Data Solicitação</th>       
                    <th>Analisado Por</th>       
                    <th>Data Análise</th>       
                    <th>Motivo</th>                                          
                    <th>Observação</th>                                         
                  </tr>
                </thead>
                <tbody>
                @foreach($permissoesIndeferida as $dados)
                <tr class="text-center" >
                        <td>{{$dados->id}}</td>
                        <td>{{$dados->txt_sigla_uf}}</td>
                        <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                        <td>{{$dados->ds_municipio}}</td> 
                        <td>{{$dados->txt_ente_publico}}</td>
                        <td>{{$dados->txt_cpf_usuario}}</td>
                        <td>{{$dados->name}}</td>
                        <td>
                            <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio")}}'><i class="fas fa-file-pdf fa-2x"></i></a>                         
                        </td>
                        
                        <td>  {{date('d/m/Y',strtotime($dados->created_at))}} </td>
                        <td>{{$dados->analisado_por}}</td>
                        <td>  {{date('d/m/Y',strtotime($dados->dte_analise))}} </td>
                        
                        <td>{{$dados->txt_tipo_indeferimento}} @if($dados->tipo_indeferimento_id == 99) : {{$dados->txt_outro_tipo_indeferimento}} @endif</td>
                        <td>{{$dados->txt_observacao}}</td>
                       
                      </tr>
                    
                @endforeach
                </tbody>
              </table><!-- fechar table-->
             </div><!--nav-indeferida -->
        
    @endif
    @if(count($permissoesBloqueada)>0)
    <div class="tab-pane fade show" id="nav-cancelada" role="tabpanel" aria-labelledby="nav-cancelada-tab">
                <div class="titulo">
                        <h5>Permissões Bloqueadas</h5> 
                </div>
                <table class="table table-hover">
                <thead>
                <tr class="text-center" >
                    <th>Id</th>
                    <th>UF</th>
                    <th>Município</th>
                    <th>Proponente</th>    
                    <th>CPF</th>       
                    <th>Nome</th>       
                    <th>Ofício</th>       
                    <th>Data Solicitação</th>       
                    <th>Analisado Por</th>       
                    <th>Data Análise</th>   
                                                            
                    <th>Desbloquear</th>                                          
                  </tr>
                </thead>
                <tbody>
                @foreach($permissoesBloqueada as $dados)
                <tr class="text-center" >
                        <td>{{$dados->id}}</td>
                        <td>{{$dados->txt_sigla_uf}}</td>
                        <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                        <td>{{$dados->ds_municipio}}</td> 
                        <td>{{$dados->txt_ente_publico}}</td>
                        <td>{{$dados->txt_cpf_usuario}}</td>
                        <td>{{$dados->name}}</td>
                        <td>
                            <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio")}}'><i class="fas fa-file-pdf fa-2x"></i></a>                         
                        </td>
                        
                        <td>  {{date('d/m/Y',strtotime($dados->created_at))}} </td>
                        <td>{{$dados->analisado_por}}</td>
                        <td>  {{date('d/m/Y',strtotime($dados->dte_analise))}} </td>                        
                      
                        <td>
                            <botao-acao-icone  
                                :url="'{{ url('/admin/permissao/desbloquear/') }}'" 
                                registro="{{$dados->id}}"                               
                                mensagem="Deseja desbloquear essa permissão?" 
                                titulo="Atenção!"
                                txtbotaoconfirma="Desbloquear"
                                txtbotaocancela="Cancelar"
                                cssbotao="btn btn-success btn-sm"                               
                                cssicone="fas fa-plus" 
                             ></botao-acao-icone>
                        </td>
                      </tr>
                    
                @endforeach
                </tbody>
              </table><!-- fechar table-->
             </div><!--nav-cancelada -->
        
    @endif

        
     
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
    
    </div><!-- content-core-->
</div><!-- content-->



<modal nome="addObservacao" titulo="Adicionar Observação">
<formulario id="formIndeferir" css="" action='{{ url("/admin/permissao/indeferir/$dados->id") }}' method="post" enctype="" token="{{ csrf_token() }}">

    <div class="row" >
        <div class="column col-xs-12 col-md-12">
           
            <select-component
                  :url="'{{ url('/') }}'" 
                  :dados="{{json_encode($tipoIndeferimento)}}"
                  textolabel="Motivo do Indeferimento"
                  nomecampo="id"
                  :selecionado = "0"
                  textoescolha="Escolha uma Motivo do Indeferimento"
                >
              </select-component>
            
        </div>       
    </div>
    <div class="row"  v-if='tipo_indeferimento == 99'>
        <div class="column col-xs-12 col-md-12">
                <label for="sistema_em_obras">Outro Tipo de Indeferimento:</label>  
                 <textarea class="form-control" id="txt_sistema_em_obras" name="txt_sistema_em_obras"  rows="10" required></textarea>                 
            </div>         
    </div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="sistema_em_obras">Observações</label>  
        <textarea class="form-control" id="txt_observacao" name="txt_observacao"  rows="10"></textarea>
        </div>
    </div>   
</formulario>    
    <span slot="botoes">
    
    <button form="formIndeferir" class="btn btn-danger  btn-block" >Indeferir</i></button>    
     
    </span>

  </modal>

@endsection
