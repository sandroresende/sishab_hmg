@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/home') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> PMCMV</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/executivo/contratacao/filtro')}}">Conslulta Situação da Contratação nos Estados e Municípios</a>
            <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Situação da Contratação</span>
    </span>
</div>
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">

    <div id="viewlet-above-content-title"></div>
    <h1 class="documentFirstHeading">
    Situação da Contratação
    </h1>
    <span class="documentFirstHeadingSpan">{{$estado->txt_uf}}</span>
    <span class="documentFirstHeadingSpan">{{number_format( ($valoresUF['mun_contratadas']+$valoresUF['mun_nao_contratadas']), 0, ',' , '.') }} municípios</span>
    <div class="linha-separa"></div>

    <div id="viewlet-above-content-body">

    </div>
    <div id="content-core">
           @if($valoresUF['mun_contratadas']>0)
                <div class="shadow p-3 mb-5 bg-white rounded">
               
                    <div class="form-group">
                        <div class="row">
                        
                          <div class="column col-xs-12 col-md-4">
                                <label class="control-label ">Municípios com contratação</label>
                                <input id="mun_contratadas" type="text" class="form-control" name="mun_contratadas" value="{{number_format( ($valoresUF['mun_contratadas']), 0, ',' , '.') }}" disabled >
                            </div>
                          
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label ">UHs Contratadas</label>
                                <input id="uh_contratadas" type="text" class="form-control" name="uh_contratadas" value="{{number_format( ($valoresUF['uh_contratadas']), 0, ',' , '.') }}" disabled >
                            </div>
                            
                            <div class="column col-xs-12 col-md-4">
                                <label class="control-label ">Municípios sem contratação</label>
                                <input id="mun_nao_contratadas" type="text" class="form-control" name="mun_nao_contratadas" value="{{number_format( ($valoresUF['mun_nao_contratadas']), 0, ',' , '.') }}" disabled >
                            </div>
                        </div>
                  </div><!-- fechar form-group--> 
                   
                
                </div>
                @endif   
               <!-- form-group-->              
               <div class="form-group">
                    <div class="row">       
                    @foreach($dadosUF as $dados)     
                        <div class="column col-md-4 col-sm-6 col-lg-4"> 
                            @if($dados->bln_contratou_pmcmv)
                             <i class="fas fa-check-circle 3x text-success"></i> {{$dados->ds_municipio}} 
                             <span class="muted font-weight-light text-gray"> &nbsp (@if($dados->num_uh) {{number_format( ($dados->num_uh), 0, ',' , '.') }} uhs @endif )</span> 
                             
                            @else
                            <i class="fas fa-times-circle 5x text-danger"></i>  {{$dados->ds_municipio}}
                            @endif
                            
                        </div>                      
                    @endforeach
                    </div>
                    
                </div>   
              <!--form-group -->
              <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">
            Voltar
        </button>
        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">
    </div>
    <!-- content-core-->
</div>
<!-- content-->

@endsection