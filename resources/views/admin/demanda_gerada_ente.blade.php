@extends('layouts.app')

@section('scripts')
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet">
@endsection

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
            <span> Seleção demanda</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{ url('/admin/arquivos/gerados') }}">Arquivos</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Demanda Gerada</span>
    </span>
</div>

<div id="content">
<div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Demanda Gerada
        </h2>
        <h3  class="documentFirstHeading text-center">
            {{$arquivosMunicipioPrincipal->entePublico->txt_ente_publico}}
        </h3>
        <span class="documentFirstHeadingSpan">
        {{$arquivosMunicipioPrincipal->municipio->ds_municipio}} - {{$arquivosMunicipioPrincipal->municipio->uf->txt_sigla_uf}}
        </span> 
        <div class="linha-separa"></div>

  </div>
  <div id="content-core">
  @if(count($demandaConsolidada) >0)
  <div class="titulo">
        <h5>Demanda Consolidada</h5> 
    </div>   
    
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >                    
                    <th>APF</th>
                    <th>Empreendimento</th>
                    <th>Status Empreendimento</th>
                    <th>Situação Obra</th>
                    <th>UH</th>
                    <th>UH Entregues</th>                   
                </tr>
            </thead>
            <tbody>
            @foreach($demandaConsolidada as $dados)
                
                <tr class="text-center" >
                    <td>{{$dados->operacao_id}}</td>
                    <td>{{$dados->operacoesContratadas->txt_nome_empreendimento}}</td>
                    <td>{{$dados->operacoesContratadas->txt_status_empreendimento}}</td>
                    <td>{{$dados->operacoesContratadas->txt_situacao_obra}}</td>
                    <td>{{number_format($dados->operacoesContratadas->qtd_uh_contratadas, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->operacoesContratadas->qtd_uh_entregues, 0, ',' , '.')}}</td>
                    </tr>                                         
            @endforeach
            <tr class="total">
                    <td class="text-center">TOTAL</td>
                    <td  class="text-center">{{number_format($totalDemanda['num_empreendimento'], 0, ',' , '.')}}</td>
                    <td></td>
                    <td></td>
                    <td class="text-center">{{number_format($totalDemanda['num_contratadas'], 0, ',' , '.')}}</td>
                    <td class="text-center">{{number_format($totalDemanda['num_entregues'], 0, ',' , '.')}}</td>
                    </tr>  
            </tbody>
        </table><!-- fechar table-->
    @endif
    
 
    <div class="titulo">
        <h5>Arquivo Principal</h5> 
        
    </div>     
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >
                   
                    <th>Id</th>
                    <th>Tipo Arquivo</th>
                    <th>N°</th>
                    <th>Nº Indicações</th>
                    <th>Nº Aptos</th>
                    <th>Nº Complementos</th>
                    <th>Ente Responsável</th>
                    <th>Data Download</th>
                    <th>Download realizado por</th>
                </tr>
            </thead>
            <tbody>
           
                
                <tr class="text-center" >
                   
                    <td>{{$arquivosMunicipioPrincipal->id}}</td>
                    <td>{{$arquivosMunicipioPrincipal->tipoArquivo->txt_tipo_arquivo}}</td>
                    <td>{{$arquivosMunicipioPrincipal->num_arquivo_enviado}}</td>
                    <td>{{$arquivosMunicipioPrincipal->num_beneficiarios_total}}</td>
                    <td>{{$arquivosMunicipioPrincipal->num_apto_requisito_criterio}}</td>
                    <td>{{$arquivosMunicipioPrincipal->num_registro_complemento}}</td>
                    <td>@if($arquivosMunicipioPrincipal->ente_publico) {{$arquivosMunicipioPrincipal->entePublico->txt_ente_publico}} @endif</td>
                    <td>@if($arquivosMunicipioPrincipal->dte_download_ente) {{date('d/m/Y',strtotime($arquivosMunicipioPrincipal->dte_download_ente))}}@endif</td>
                    
                    <td>@if($arquivosMunicipioPrincipal->user_id) {{$arquivosMunicipioPrincipal->user->name}} @endif  </td>     
                    </tr>                                         
        
            </tbody>
        </table><!-- fechar table-->
  

          
 @if(count($arquivosMunicipioComplemento) >0)
    <div class="titulo">
        <h5>Arquivos Complemento</h5> 
        
    </div>     
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >
                  
                    <th>Id</th>
                    <th>Tipo Arquivo</th>
                    <th>N°</th>
                    <th>Nº Indicações</th>
                    <th>Nº Aptos</th>
                    <th>Nº Complementos</th>
                    <th>Ente Responsável</th>
                    <th>Data Download</th>
                    <th>Download realizado por</th>
                </tr>
            </thead>
            <tbody>
            @foreach($arquivosMunicipioComplemento as $dados)
                
                <tr class="text-center" >
                    
                    <td>{{$dados->id}}</td>
                    <td>{{$dados->tipoArquivo->txt_tipo_arquivo}}</td>
                    <td>{{$dados->num_arquivo_enviado}}</td>
                    <td>{{$dados->num_beneficiarios_total}}</td>
                    <td>{{$dados->num_apto_requisito_criterio}}</td>
                    <td>{{$dados->num_registro_complemento}}</td>
                    <td>@if($dados->ente_publico) {{$dados->entePublico->txt_ente_publico}} @endif</td>
                    <td> @if($dados->dte_download_ente) {{date('d/m/Y',strtotime($dados->dte_download_ente))}}@endif</td>
                    <td>@if($dados->user_id) {{$dados->user->name}} @endif  </td>     
                    </tr>                                         
            @endforeach
            </tbody>
        </table><!-- fechar table-->
    @endif  

       
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection