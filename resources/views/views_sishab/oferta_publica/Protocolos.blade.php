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
            :titulo1="'Oferta Pública'"
            :titulo2='"Filtro Protocolos"'
            :link2="'{{ url('/oferta_publica/protocolos/filtro') }}'"
            :titulo3='"Protocolos"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Protocolos '"
                    subtitulo1="{{$municipio->ds_municipio}} / {{$estado->txt_sigla_uf}}"
                    :dataatualizacao="'{{getPosicaoDadosOperacoes()}}'"
                    :barracompartilhar="true"
                    >
            </cabecalho-form> 
            <div class="form-group">
                @foreach($protocolos as $protocolo)
            <div class="row">
                <div class="colunm col-sm-2 exec">
                    <div class="status_enquadrada">
                        <H1>{{$protocolo->num_oferta}}</H1>
                        <p>{{$protocolo->txt_nome_if}}</p>                        
                    </div>
                </div>
                <div class="colunm col-sm-10">
                    <div id="valores">
                        <H1><a href='{{ url("oferta_publica/protocolo/$protocolo->instituicao_id/$protocolo->protocolo_id") }}'> {{$protocolo->txt_protocolo}}</a></H1>
                        <p>{{$protocolo->ds_municipio}} / {{$protocolo->sg_uf}} </p>
                        <h5>
                                <i class="fas fa-home 2x icone_blue"></i> {{$protocolo->num_uh_contratadas}} | 
                                <i class="fas fa-hand-holding-usd 2x"></i> Valor Previsto: {{number_format($protocolo->vlr_uh * $protocolo->num_uh_contratadas,0, ',' , '.')}}
                            </h5>
                    </div>
                </div>
            </div>
            <!-- row-->
            @endforeach
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


