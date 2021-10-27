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
                    :titulo2='"Propostas Cadastradas"'
                   
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Propostas Cadastradas '"
                    :barracompartilhar="true"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    >
            </cabecalho-form> 

            @if(count($prototipos) >0)
                <div class="titulo">
                    <h3>Propostas </h3>         
                </div>
                @if(count($prototipos) <= 10)
                <a href='{{ url("prototipo/novo") }}' class="btn btn-outline-primary btn-block btn-lg">Nova Proposta</a>
                <br/>
               @endif

                <div class="table-responsive-sm">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center" >
                              <th>Id</th>
                              <th>Nome da Proposta</th>
                              <th>Situação</th>
                              <th>Etapa 1</th>                    
                              <th>Etapa 2</th>                    
                              <th>Etapa 3</th>     
                              <th>Excluir</th>
                              <th>Ação</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($prototipos as $dados)
                                @if($dados->situacao_prototipo_id <= 1)
                                    <tr class="text-center table-light">                        
                                @elseif($dados->situacao_prototipo_id == 2) 
                                    <tr class="text-center table-secondary">
                                @elseif($dados->situacao_prototipo_id == 3)   
                                    <tr class="text-center table-primary">
                                @elseif($dados->situacao_prototipo_id == 4)   
                                    <tr class="text-center table-success">                       
                                @elseif($dados->situacao_prototipo_id == 6)   
                                    <tr class="text-center table-info">
                                @elseif($dados->situacao_prototipo_id == 7)   
                                    <tr class="text-center table-danger">           
                                @endif  
                                <td>{{$dados->id}}</td>
                                <td>{{$dados->txt_nome_prototipo}}</td>
                             <td>{{$dados->txt_situacao_prototipo}}</td>
                                <td> 
                                    @if($dados->bln_caracterizacao_terreno && $dados->situacao_prototipo_id == 2)
                                    <a href='{{ url("/prototipo/caracterizacao_terreno/editar/$dados->caracterizacao_terreno_id")}}'>
                                        {{date('d/m/Y',strtotime($dados->dte_conclusao_caracterizacao_terreno))}} 
                                    </a>
                                    @else
                                        @if($dados->dte_conclusao_caracterizacao_terreno) {{date('d/m/Y',strtotime($dados->dte_conclusao_caracterizacao_terreno))}} @endif
                                    @endif    
                                </td>
                                <td> 
                                    @if($dados->infraestrutura_basica_id && $dados->situacao_prototipo_id == 2)
                                    <a href='{{ url("/prototipo/infraestruturaBasica/editar/$dados->infraestrutura_basica_id")}}'>
                                        {{date('d/m/Y',strtotime($dados->dte_conclusao_infraestrutura_basica))}} 
                                    </a>
                                    @else
                                        @if($dados->dte_conclusao_infraestrutura_basica) {{date('d/m/Y',strtotime($dados->dte_conclusao_infraestrutura_basica))}} @endif</td>
                                    @endif    
                                <td> @if($dados->dte_conclusao_insercao_urbana) {{date('d/m/Y',strtotime($dados->dte_conclusao_insercao_urbana))}} @endif</td>
                                <td>
                                    @if($dados->situacao_prototipo_id != 4)
                                    <botao-acao-icone  
                                        :url="'{{ url("/prototipo/excluir/")}}'" 
                                        registro="{{$dados->id}}"                               
                                        mensagem="Deseja excluir esse protótipo?" 
                                        titulo="Atenção!"
                                        txtbotaoconfirma="OK"
                                        txtbotaocancela="Cancelar"
                                        cssbotao="btn btn-danger btn-sm"                               
                                        cssicone="fas fa-trash-alt"                               
                                     ></botao-acao-icone>
        
                                    
                                    @endif
                                </td>
                                <td>
                                    
                                          
                                            @if($dados->situacao_prototipo_id <= 1)
                                            <a href='{{ url("/prototipo/perguntas/$dados->id")}}' type="button" class="btn btn-link">
                                                Iniciar Preenchimento <i class="fas fa-pencil-alt"> </i> 
                                             @elseif($dados->situacao_prototipo_id == 2)   
                                                <a href='{{ url("/prototipo/perguntas/$dados->id")}}'  type="button" class="btn btn-link">
                                             Continuar Preenchimento <i class="fas fa-edit"></i></a>
                                            
                                            @elseif($dados->situacao_prototipo_id == 3)   
                                            <a href='{{ url("/prototipo/show/levantamento/$dados->id")}}' type="button" class="btn btn-link">
                                             Enviar Proposta <i class="fas fa-search"></i></a>
                                            @elseif($dados->situacao_prototipo_id == 4)   
                                            <a href='{{ url("/prototipo/show/levantamento/$dados->id")}}' type="button" class="btn btn-link">
                                                Visualizar <i class="fas fa-search"></i></a>
                                                
                                            @endif    
                                          <!--
                                            @if($dados->situacao_prototipo_id >= 3)   
                                            <a href='{{ url("/prototipo/show/levantamento/$dados->id")}}' type="button" class="btn btn-link">
                                                Visualizar <i class="fas fa-search"></i></a>                                            
                                            @endif 
                                            -->
                                </td>            
                              </tr>  
                            @endforeach
                        </tbody><!-- fechar tbody-->
                    </table><!-- fechar table-->
                </div> <!-- table-responsive-sm -->
            @endif  
            
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


