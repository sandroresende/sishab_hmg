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
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Propostas Cadastradas '"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :linkcompartilhar="'{{ url("/admin/prototipo/usuario/") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 

            <div class="form-group">
                <div class="titulo">
                    <h3>Propostas Enviadas e Habilitadas </h3>         
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-hover">
                    
                        <thead>
                        <tr class="text-center" >
                            <th>Id</th>
                            <th>UF</th>
                            <th>Município</th>
                            <th>Ente Público</th>
                            <th>Nome da Proposta</th>
                            <th>Situaçao</th>
                            <th>Inicio Preenchimento</th>                    
                            <th>Pontuação</th>                    
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($prototipos as $dados)
                            @if($dados->situacao_prototipo_id == 4 || $dados->situacao_prototipo_id == 6 )
                                @if($dados->situacao_prototipo_id == 4)   
                                    <tr class="text-center table-success">
                                @elseif($dados->situacao_prototipo_id == 6)   
                                    <tr class="text-center table-info">                                   
                                @endif   
                                
                                    <td>{{$dados->id}}</td>
                                    <td>{{$dados->txt_sigla_uf}}</td>
                                    <td>{{$dados->ds_municipio}}</td>
                                    <td>{{$dados->txt_ente_publico}}</td>
                                    <td>{{$dados->txt_nome_prototipo}}</td>
                                    <td>{{$dados->txt_situacao_prototipo}}</td>
                                    <td> @if($dados->dte_conclusao_caracterizacao_terreno) {{date('d/m/Y',strtotime($dados->dte_conclusao_caracterizacao_terreno))}} @endif</td>
                                    <td>{{$dados->num_pontuacao_total}}</td>
                                    <td>       
                                        @if($dados->situacao_prototipo_id >= 4)   
                                            <a href='{{ url("admin/prototipo/show/levantamento/$dados->id")}}' type="button" class="btn btn-link">
                                                <i class="fas fa-search"></i>Visualizar
                                            </a>                                
                                        @endif  
        
                                        @if($dados->situacao_prototipo_id == 4)   
                                            <a href='{{ url("admin/prototipo/enviada/$dados->id")}}' type="button" class="btn btn-link">
                                                <i class="fas fa-diagnoses"></i>Analisar
                                            </a>
                                        @endif    
                                    </td>            
                                </tr> 
                            @endif                                        
                        @endforeach
                        </tbody>
                    </table><!-- fechar table-->
                </div> <!-- table-responsive-sm -->
            </div> <!-- form-group -->    
        
            <div class="form-group">
                <div class="titulo">
                    <h3>Propostas Não Enviadas e Desabilitadas </h3>         
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-hover">  
                        <thead>
                            <tr class="text-center" >
                                <th>Id</th>
                                <th>UF</th>
                                <th>Município</th>
                                <th>Ente Público</th>
                                <th>Nome da Proposta</th>
                                <th>Situaçao</th>                
                                <th>Etapa 1</th>                    
                                <th>Etapa 2</th>                    
                                <th>Etapa 3</th>                    
                                <th>Pontuação</th>                    
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prototipos as $dados)
                                @if($dados->situacao_prototipo_id != 4 && $dados->situacao_prototipo_id != 6 )
                                    
                                    @if($dados->situacao_prototipo_id == 1)
                                        <tr class="text-center table-light">                        
                                    @elseif($dados->situacao_prototipo_id == 2) 
                                        <tr class="text-center table-secondary">
                                    @elseif($dados->situacao_prototipo_id == 3)                                       
                                        <tr class="text-center table-primary">
                                    @else  
                                         <tr class="text-center table-danger">        
                                    @endif   
                                    </tr> 
                                    <td>{{$dados->id}}</td>
                                    <td>{{$dados->txt_sigla_uf}}</td>
                                    <td>{{$dados->ds_municipio}}</td>
                                    <td>{{$dados->txt_ente_publico}}</td>
                                    <td>{{$dados->txt_nome_prototipo}}</td>
                                    <td>{{$dados->txt_situacao_prototipo}}</td>
                                    <td> @if($dados->dte_conclusao_caracterizacao_terreno) {{date('d/m/Y',strtotime($dados->dte_conclusao_caracterizacao_terreno))}} @endif</td>
                                    <td> @if($dados->dte_conclusao_infraestrutura_basica) {{date('d/m/Y',strtotime($dados->dte_conclusao_infraestrutura_basica))}} @endif</td>
                                    <td> @if($dados->dte_conclusao_insercao_urbana) {{date('d/m/Y',strtotime($dados->dte_conclusao_insercao_urbana))}} @endif</td>
                                    <td>{{$dados->num_pontuacao_total}}</td>                                        
                                    <td>       
                                        @if($dados->situacao_prototipo_id >= 4)   
                                            <a href='{{ url("admin/prototipo/show/levantamento/$dados->id")}}' type="button" class="btn btn-link">
                                                <i class="fas fa-search"></i>Visualizar
                                            </a>                                
                                        @endif  

                                        @if($dados->situacao_prototipo_id == 4)   
                                            <a href='{{ url("admin/prototipo/enviada/$dados->id")}}' type="button" class="btn btn-link">
                                                <i class="fas fa-diagnoses"></i>Analisar
                                            </a>
                                        @endif    
                                    </td>     
                                @endif  
                            @endforeach
                        </tbody>

                    </table><!-- fechar table-->
                </div> <!-- table-responsive-sm -->
            </div> <!-- form-group -->    
            
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                    </div>    
                </div>
            </div> <!-- form-group -->
        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


