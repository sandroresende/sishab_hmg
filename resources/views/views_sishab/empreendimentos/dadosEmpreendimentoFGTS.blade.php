@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
    <link rel="stylesheet" type="text/css" href="{{ asset('css/graficos.css') }}"  media="screen" > 

@endsection

@section('content')
    <div id="content">
        <div id="content-core">  
            <historico-navegacao
                    :url="'{{ url('/home') }}'"
                    :titulo1="'Empreendimentos'"
                    :titulo2='"Filtro de Empreendimentos"'
                    :link2="'{{ url('/empreendimentos/filtro') }}'"
                    :titulo3='"Dados do Empreendimetnos"'
                    >
            </historico-navegacao>  
            <cabecalho-form
                titulo="{{$operacao->txt_modalidade}}"
                subtitulo1="{{trim($operacao->ds_municipio)}}-{{$operacao->txt_sigla_uf}}"
                :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                :linkcompartilhar="'{{ url("/empreendimentos/$operacao->txt_apf") }}'"
                :barracompartilhar="true">

            </cabecalho-form> 
            <div class="alert alert-info text-center" role="alert">
                <h3> APF: {{$operacao->txt_apf}}</h3>
            </div>  <!-- div alert  --> 
            
            @if(COUNT($dadosEmpreendimento)>0)
            <div class="card" >
                <div class="card-body">    
                    @foreach($dadosEmpreendimento as $dados)
                        @if($dados->origem_id == 2)
                        <div class="titulo">
                            <h3>Contratos construtoras</h3> 
                        </div>
                        <div class="row ">                                                    
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">CNPJ</label>
                                <input id="proponente_id" type="text" class="form-control input-relatorio" name="proponente_id" value="{{$dados->proponente_id}}" disabled >
                            </div>
                            <div class="column col-xs-12 col-md-8">
                                <label class="control-label label-relatorio">Nome Construtora</label>
                                <input id="txt_razao_social" type="text" class="form-control input-relatorio" name="txt_razao_social" value="{{$dados->txt_razao_social}}" disabled >
                            </div>                        
                        </div>  
                        <div class="row ">                                                    
                            <div class="column col-xs-12 col-md-6">
                                <label class="control-label label-relatorio">Empreendimento</label>
                                <input id="txt_nome_empreendimento" type="text" class="form-control input-relatorio" name="txt_nome_empreendimento" value="{{$dados->txt_nome_empreendimento}}" disabled >
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio ">Data de Contratação</label>
                                <input id="dte_assinatura" type="text" class="form-control input-relatorio" name="dte_assinatura" value="@if($dados->dte_assinatura) {{date('d/m/Y',strtotime($dados->dte_assinatura))}}@endif" disabled >
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">Status</label>
                                <input id="txt_status_empreendimento" type="text" class="form-control input-relatorio" name="txt_status_empreendimento" value="{{$dados->txt_status_empreendimento}}" disabled >
                            </div>                        
                        </div>
                        <div class="row ">     
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">UH Inicial</label>
                                <input id="num_uh_inicial" type="text" class="form-control input-relatorio" name="num_uh_inicial" value="{{number_format($dados->num_uh_inicial, 0, ',' , '.')}}" disabled >
                            </div>                                               
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">UH Contratadas</label>
                                <input id="num_uh" type="text" class="form-control input-relatorio" name="num_uh" value="{{number_format($dados->num_uh, 0, ',' , '.')}}" disabled >
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">UH Desligadas</label>
                                <input id="uh_desligadas" type="text" class="form-control input-relatorio" name="uh_desligadas" value="{{number_format($dados->num_uh_inicial-$dados->num_uh , 0, ',' , '.')}}" disabled >
                            </div>  
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">Valor Operação</label>
                                <input id="num_valor" type="text" class="form-control input-relatorio" name="num_valor" value="{{number_format($dados->num_valor, 2, ',' , '.')}}" disabled >
                            </div>
                                     
                        </div>
                        <div class="row ">     
                            <div class="column col-xs-12 col-md-5">
                                <label class="control-label label-relatorio">Endereço</label>
                                <input id="txt_endereco" type="text" class="form-control input-relatorio" name="txt_endereco" value="{{$dados->txt_endereco}}" disabled >
                            </div>                                               
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label label-relatorio">Localicadade</label>
                                <input id="txt_localidade" type="text" class="form-control input-relatorio" name="txt_localidade" value="{{$dados->txt_localidade}}" disabled >
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label class="control-label label-relatorio">CEP</label>
                                <input id="txt_cep" type="text" class="form-control input-relatorio" name="txt_cep" value="{{$dados->txt_cep}}" disabled >
                            </div>  
                                     
                        </div>
                       @endif 
                  @endforeach  
                </div><!--fim card-body -->   
            </div><!--fim card -->  
            @endif

            @if(COUNT($dadosEmpreendimentoPF)>0)
            <div class="card" >
                <div class="card-body">                    
                    <div class="titulo">
                        <h3>Contratos com mutuários realizados pelas construtoras</h3> 
                    </div>  
                   
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm ">
                                <thead  class="text-center">
                                    <tr class="text-center ">
                                        <th scope="col">Programa</th>  
                                        <th scope="col" >Faixa</th>
                                        <th scope="col" >UH</th>
                                        <th scope="col" >Investimento</th>
                                        <th scope="col" >Financiamento</th>
                                        <th scope="col" >Subsídio OGU</th>
                                        <th scope="col" >Subsídio FGTS</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($dadosEmpreendimentoPF as $dados)                    
                                        @if($dados->origem_id != 2)                 
                                        <tr  class="text-center conteudoTabela">
                                            <td >{{$dados->txt_sigla_programa}}</td>                                                
                                            <td >{{$dados->txt_faixa_programa}}</td>                                                
                                            <td >{{number_format($dados->num_uh, 0, ',' , '.')}}</td>                                                
                                            <td >{{number_format($dados->vlr_investimento, 2, ',' , '.')}}</td>                                                
                                            <td >{{number_format($dados->vlr_financiamento, 2, ',' , '.')}}</td>                                                
                                            <td >{{number_format($dados->vlr_sub_ogu, 2, ',' , '.')}}</td>                                                
                                            <td >{{number_format($dados->vlr_sub_fgts, 2, ',' , '.')}}</td>                                                
                                        </tr>   
                                        @endif 
                                   @endforeach  
                                    <tr  class="text-center conteudoTabela">
                                        <td colspan="2">TOTAL</td>                                                
                                        <td >{{number_format($totalFGTS['total_uh'], 0, ',' , '.')}}</td>                                                
                                        <td >{{number_format($totalFGTS['total_investimento'], 2, ',' , '.')}}</td>                                                
                                        <td >{{number_format($totalFGTS['total_financiamento'], 2, ',' , '.')}}</td>                                                
                                        <td >{{number_format($totalFGTS['total_OGU'], 2, ',' , '.')}}</td>                                                
                                        <td >{{number_format($totalFGTS['total_FGTS'], 2, ',' , '.')}}</td>                                                
                                    </tr>                              
                                </tbody>
                            </table> 
                        </div> 
                </div><!--fim card-body -->   
            </div><!--fim card -->   
           @endif

           
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">  
                    </div>
                    <div class="column col-xs-12 col-md-6">    
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
                    </div>

            </div>  <!--form-group -->

        </div><!-- content-core -->
    </div><!-- content -->





@endsection