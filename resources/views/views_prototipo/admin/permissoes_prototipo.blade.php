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
                :titulo2='"Permissões"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Permissões ({{ count($permissoes) }})'"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/min/prototipo/permissoes") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
          
              
            <div class="form-group">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-analise-tab" data-toggle="tab" href="#nav-analise" role="tab" aria-controls="nav-analise" aria-selected="true">Em Análise ({{ count($permissoesAnalise) }})</a>
                      <a class="nav-item nav-link" id="nav-deferida-tab" data-toggle="tab" href="#nav-deferida" role="tab" aria-controls="nav-deferida" aria-selected="false">Deferidas ({{ count($permissoesDeferida) }})</a>
                      <a class="nav-item nav-link" id="nav-deferida-pend-tab" data-toggle="tab" href="#nav-deferida-pend" role="tab" aria-controls="nav-deferida-pend" aria-selected="false">Deferidas Com Pendencia ({{ count($permissoesDeferidaPendencia) }})</a>
                      <a class="nav-item nav-link" id="nav-indeferida-tab" data-toggle="tab" href="#nav-indeferida" role="tab" aria-controls="nav-indeferida" aria-selected="false">Indeferidas ({{ count($permissoesIndeferida) }})</a>
                      <a class="nav-item nav-link" id="nav-cancelada-tab" data-toggle="tab" href="#nav-cancelada" role="tab" aria-controls="nav-cancelada" aria-selected="false">Bloqueadas ({{ count($permissoesBloqueada) }})</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-analise" role="tabpanel" aria-labelledby="nav-analise-tab">
                        @if(count($permissoesAnalise)>0)                
                        
                            <div  class="titulo">
                                    <h3>Permissões em Análise</h3> 
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
                                    <th>Email</th>       
                                    <th>Ofício Prefeitura</th>   
                                    <th>COHAB, Agência ou Órg da Adm Indireta</th>                               
                                    <th>Ofício COHAB</th>       
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
                                        <td>{{$dados->email}}</td>
                                        <td>
                                            <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio")}}'><i class="fas fa-file-pdf fa-2x"></i></a>                         
                                        </td>
                                        <td>@if($dados->bln_adm_indireta == true) Sim @else Não @endif</td>
                                        <td>
                                            @if($dados->caminho_oficio_cohab)<a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio_cohab")}}'><i class="fas fa-file-pdf fa-2x"></i></a>@endif                         
                                        </td>
                                        
                                        <td>  {{date('d/m/Y',strtotime($dados->created_at))}} </td>
                                        <td>
                                            <button type="button" 
                                            class="btn btn-outline-primary btn-lg btn-block nav-link active" 
                                            href='{{ url("/admin/permissao/deferir/show/$dados->id")}}'><i class="fas fa-plus"></i></button>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-outline-danger btn-lg btn-block nav-link active" href='{{ url("/admin/permissao/indeferir/abrir/$dados->id")}}'>
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </td>                                    
                                    </tr>                                    
                                @endforeach
                                </tbody>
                            </table><!-- fechar table-->                            
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-deferida" role="tabpanel" aria-labelledby="nav-deferida-tab">
                        @if(count($permissoesDeferida)>0)                       
                            <div class="titulo">
                                    <h3>Permissões Deferidas</h3> 
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
                                    <th>Email</th>       
                                    <th>Ofício Prefeitura</th>   
                                    <th>COHAB, Agência ou Órg da Adm Indireta</th>                               
                                    <th>Ofício COHAB</th>           
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
                                        <td>{{$dados->email}}</td>
                                        <td>
                                            <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio")}}'><i class="fas fa-file-pdf fa-2x"></i></a>                         
                                        </td>
                                        <td>@if($dados->bln_adm_indireta == true) Sim @else Não @endif</td>
                                        <td>
                                            @if($dados->caminho_oficio_cohab)<a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio_cohab")}}'><i class="fas fa-file-pdf fa-2x"></i></a>@endif                         
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
                         @endif    
                    </div>
                    <div class="tab-pane fade" id="nav-deferida-pend" role="tabpanel" aria-labelledby="nav-deferida-pend-tab">
                        @if(count($permissoesDeferidaPendencia)>0)
                         
                            <div class="titulo">
                                    <h3>Permissões Deferidas com Pendência</h3> 
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
                                    <th>Email</th>       
                                    <th>Ofício Prefeitura</th>   
                                    <th>COHAB, Agência ou Órg da Adm Indireta</th>                               
                                    <th>Ofício COHAB</th>           
                                    <th>Data Solicitação</th>       
                                    <th>Data Análise</th>       
                                    <th>Observação</th>       
                                    <th>Deferir</th>                                        
                                    <th>Bloquear</th>                                        
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissoesDeferidaPendencia as $dados)
                                    
                                    <tr class="text-center" >
                                        <td>{{$dados->id}}</td>
                                        <td>{{$dados->txt_sigla_uf}}</td>
                                        <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                                        <td>{{$dados->ds_municipio}}</td> 
                                        <td>{{$dados->txt_ente_publico}}</td>
                                        <td>{{$dados->txt_cpf_usuario}}</td>
                                        <td>{{$dados->name}}</td>
                                        <td>{{$dados->email}}</td>
                                        <td>
                                            <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio")}}'><i class="fas fa-file-pdf fa-2x"></i></a>                         
                                        </td>
                                        <td>@if($dados->bln_adm_indireta == true) Sim @else Não @endif</td>
                                        <td>
                                            @if($dados->caminho_oficio_cohab)<a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio_cohab")}}'><i class="fas fa-file-pdf fa-2x"></i></a>@endif                         
                                        </td>
                                        <td>  {{date('d/m/Y',strtotime($dados->created_at))}} </td>
                                        <td>  {{date('d/m/Y',strtotime($dados->dte_analise))}} </td>
                                        <td>{{$dados->txt_observacao}}</td>
                                        <td>
                                            <botao-acao-icone  
                                                :url="'{{ url('/admin/permissao/deferir/pendencia') }}'" 
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
                        @endif
                    </div>
                    <div class="tab-pane fade" id="nav-indeferida" role="tabpanel" aria-labelledby="nav-indeferida-tab">
                        @if(count($permissoesIndeferida)>0)                        
                            <div class="titulo">
                                    <h3>Permissões Indeferidas</h3> 
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
                                    <th>Ofício Prefeitura</th>   
                                    <th>COHAB, Agência ou Órg da Adm Indireta</th>                               
                                    <th>Ofício COHAB</th>            
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
                                        <td>@if($dados->bln_adm_indireta == true) Sim @else Não @endif</td>
                                        <td>
                                            @if($dados->caminho_oficio_cohab)<a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio_cohab")}}'><i class="fas fa-file-pdf fa-2x"></i></a>@endif                         
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
                         @endif    
                    </div>
                    <div class="tab-pane fade" id="nav-cancelada" role="tabpanel" aria-labelledby="nav-cancelada-tab">
                        @if(count($permissoesBloqueada)>0)
                            <div class="titulo">
                                    <h3>Permissões Bloqueadas</h3> 
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
                                    <th>Ofício Prefeitura</th>   
                                    <th>COHAB, Agência ou Órg da Adm Indireta</th>                               
                                    <th>Ofício COHAB</th>      
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
                                        <td>@if($dados->bln_adm_indireta == true) Sim @else Não @endif</td>
                                        <td>
                                            @if($dados->caminho_oficio_cohab)<a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio_cohab")}}'><i class="fas fa-file-pdf fa-2x"></i></a>@endif                         
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
                        @endif    
                    </div>
                  </div>


                

                
        
                <div class="tab-content" id="nav-tabContent">
        
                        
                        
                        
                        
                        
                        
                    </div>   
                </div>   

                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-6">
                            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
                        </div>
                        <div class="column col-xs-12 col-md-6">
                            <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                        </div>    
                    </div>
                </div> 
        </div>     
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


