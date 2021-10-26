@extends('layouts.app') @section('content')
<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
        <a href="{{ url('/home') }}">Página Inicial</a>
        <span class="breadcrumbSeparator">
            &gt;            
        </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
        <span >Oferta Pública</span>
    <span class="breadcrumbSeparator"> &gt;</span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/protocolos/filtro')}}">Consulta ao Protocolo</a>
            <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Protocolos</span>
    </span>

</div>

<div id="content">
    <div id="viewlet-above-content-title"></div>
    <h2 class="documentFirstHeading text-center">    Protocolos</h2>

    <div class="linha-separa"></div>

    <div id="content-core">
        <!-- form-group-->
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
                        <H1><a href='{{ url("protocolo/$protocolo->protocolo_id") }}'> {{$protocolo->txt_protocolo}}</a></H1>
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
        <!-- form-group-->
        <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">
    </div>
    <!-- content-core-->
</div>
<!-- content-->
@endsection