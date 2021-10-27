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
            :titulo2='"Filtro de Entes Públicos"'
            :link2="'{{ url('/admin/selecao_demanda/filtro') }}'"
            :titulo3='"Entes Públicos"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Entes Públicos '"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            <div class="form-group">               
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center" >
                        <th>UF</th>
                        <th>Município</th>
                        <th>Ente Público</th>
                        <th>Email</th>
                       <!--
                        <th>Excluir</th>
                       --> 
                        <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($entePublicos as $entes)
                            <tr class="text-center" >
                            <td>{{$entes->txt_sigla_uf}}</td>
                            <td>{{$entes->ds_municipio}}</td>
                            <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                            <td>{{$entes->txt_ente_publico}}</td> 
                            <td>{{$entes->txt_email_ente_publico}}</td> 
                           <!--
                            <td>
                                <form method="post" action='{{ url("admin/entes/excluir/$entes->ente_publico_id/")}}'>
                                                        {{csrf_field()}}                       
                                    <button type="submit"  class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                            -->
                            <td>
                                <a href='{{ url("admin/selecao_demanda/ente_publico/$entes->ente_publico_id")}}' type="button"  class="btn  btn-sm">
                                    <i class="fas fa-search"></i></a>
                            </td>            
                            </tr>                                         
                    @endforeach
                    </tbody>
                    </table><!-- fechar table-->
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


