@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/entePublico') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> Seleção de Demanda</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Arquivos</span>
    </span>
</div>

<div id="content">
<div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Arquivos
        </h2>
         
        <div class="linha-separa"></div>

  </div>
  <div id="content-core">
   
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
                  
                   
                    <td> @if($dados->municipio) {{$dados->municipio->uf->txt_sigla_uf}} @endif</td>
                    <td> @if($dados->municipio) {{$dados->municipio->ds_municipio}} @endif</td>
                    <td> @if($dados->entePublico) {{$dados->entePublico->txt_ente_publico}} @endif</td>
                    <td>{{$dados->id}}</td>
                    <td>{{$dados->tipoArquivo->txt_tipo_arquivo}}</td>
                    <td>{{$dados->num_arquivo_enviado}}</td>
                    <td>{{$dados->num_beneficiarios_total}}</td>
                    <td>{{$dados->num_apto_requisito_criterio}}</td>
                    <td>{{$dados->num_registro_complemento}}</td>
                    <td> @if($dados->dte_download_ente) {{date('d/m/Y',strtotime($dados->dte_download_ente))}}@endif</td>
                    <td>@if($dados->user_id) {{$dados->user->name}} @endif  </td>     
                    <td>
                        @if($dados->bln_arquivo_gerado)
                            <a href='{{ url("/admin/arquivo/$dados->demanda_gerada_id/$dados->id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-search"></i></a>
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
    <!-- content-core-->
</div>
<!-- content-->




@endsection