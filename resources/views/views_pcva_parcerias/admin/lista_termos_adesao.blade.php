@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                    :url="'{{ url('/') }}'"
                    :titulo1="'PCVA - Parcerias'"
                    :titulo2='"Lista Manifestação de Interesse"'
                   
            >
            </historico-navegacao>

            <cabecalho-form
                    :titulo="'LISTA MANIFESTAÇÃO DE INTERESSE'"
                    @if($subTitulo1) :subTitulo1="'{{$subTitulo1}}'" @endif
                    @if($subTitulo2) :subTitulo2="'{{$subTitulo2}}'" @endif

                    :barracompartilhar="true"
                    :linkcompartilhar="'{{ url("/admin/pcva_parcerias/termo/filtro")}}'"
                    >
              
            </cabecalho-form> 
           <!-- form-group-->              
           <div class="form-group">
            <div class="titulo">
                <H3>Manifestação de Interesse</H3>         
            </div>
                
            <table class="table table-hover">
                <thead>
                <tr class="text-center" >
                    <th>Protocolo</th>
                    <th>UF</th>
                    <th>Município</th>
                    <th>Ente Público</th>                        
                    <th>Data Envio</th>                       
                    <th>Situaçao</th>                       
                    <th>Data Análise</th>                       
                    <th>Ação</th>                       
                </tr>
                </thead>
                <tbody>
                @foreach($dadosTermo as $dados)
                    
                        @if($dados->situacao_adesao_id == 1)
                            <tr class="text-center table-light">                        
                        @elseif($dados->situacao_adesao_id == 2) 
                            <tr class="text-center table-primary">
                        @elseif($dados->situacao_adesao_id == 3)                               
                            <tr class="text-center table-success">
                        @elseif($dados->situacao_adesao_id == 4)      
                            <tr class="text-center table-danger">        
                        @endif   
                        
                        <td>{{$dados->txt_protocolo_aceite}}</td>
                        <td>{{$dados->txt_sigla_uf}}</td>
                        <td>{{$dados->ds_municipio}}</td>
                        <td>{{$dados->txt_ente_publico}}</td>
                        <td> @if($dados->dte_envio_termo) {{date('d/m/Y',strtotime($dados->dte_envio_termo))}} @endif</td>
                        <td>{{$dados->txt_situacao_adesao}}</td>
                        <td> @if($dados->dte_validacao) {{date('d/m/Y',strtotime($dados->dte_validacao))}} @endif</td>

                        <td>
                            <a href='{{ url("admin/pcva_parcerias/termo/protocolo/$dados->txt_protocolo_aceite")}}' type="button" class="btn btn-link">
                                <i class="fas fa-search"></i>Visualizar
                            </a> 
                        </td>
                    </tr>                                                          
                @endforeach
                </tbody>
            </table><!-- fechar table-->
       </div><!--form-group -->   
       <div class="form-group">
        <div class="row">
            <div class="column col-sm-6 col-xs-12">                                        
                <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">   
            </div>
            <div class="column col-sm-6 col-xs-12">
                <botao-acao  
                :url="'{{ url("/admin/pcva_parcerias/termo/filtro")}}'" 
                registro=""                               
                cssbotao="btn btn-lg btn-danger btn-block"                               
                textobotao="Fechar" 
                tipobotao="button-danger"
            ></botao-acao>  
            </div>
        </div>        
    </div><!-- fechar primeiro form-group-->

        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


