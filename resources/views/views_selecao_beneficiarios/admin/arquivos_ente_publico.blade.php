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
            :titulo1="'Seleção de Demanda'"
            :titulo2='"Filtro Arquivos Gerados"'
            :link2="'{{ url('/admin/selecao_demanda/arquivos/gerados/filtro') }}'"
            :titulo3='"Arquivos Gerados"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Arquivos Gerados '"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    :dataatualizacao="'{{date('d/m/Y',strtotime($dataAtualizacao['formatted']))}}'"
                    :barracompartilhar="true"
                    >
            </cabecalho-form> 
            <div class="form-group">               
                @if(count($arquivosmunicipio) >0)
                    
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center" >
                        
                            <th>UF</th>
                            <th>Município</th>
                            <th>Ente Responsável</th>
                            <th>Id</th>
                            <th>Tipo Arquivo</th>
                            <th>N°</th>
                            <th>Nº Indicações</th>
                            <th>Nº Aptos</th>
                            <th>Nº Complementos</th>
                            <th>Data Download</th>
                            <th>Download realizado por</th>
                            <th>Arquivo Gerado</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($arquivosmunicipio as $dados)
                        <tr class="text-center" >
                        
                        
                            <td> {{$dados->txt_sigla_uf}}</td>
                            <td> {{$dados->ds_municipio}}</td>
                            <td> {{$dados->txt_ente_publico}}</td>
                            <td>{{$dados->id}}</td>
                            <td>{{$dados->txt_tipo_arquivo}}</td>
                            <td>{{$dados->num_arquivo_enviado}}</td>
                            <td>{{$dados->num_beneficiarios_total}}</td>
                            <td>{{$dados->num_apto_requisito_criterio}}</td>
                            <td>{{$dados->num_registro_complemento}}</td>
                            <td> @if($dados->dte_download_ente) {{date('d/m/Y',strtotime($dados->dte_download_ente))}}@endif</td>
                            <td>@if($dados->user_id) {{$dados->name}} @endif  </td>     
                            <td>
                                @if($dados->bln_arquivo_gerado)
                                    <a href='{{ url("/admin/selecao_demanda/arquivo/$dados->demanda_gerada_id/$dados->id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-search"></i></a>
                                @else
                                        <button type="button"  class="btn  btn-sm btn-danger"><i class="fas fa-times-circle"></i></button>
                                @endif    
                            </td>            
                            </tr>                                         
                    @endforeach
                    </tbody>
                </table><!-- fechar table-->
            @endif  
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
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


