@extends('layouts.app')

@section('scripts')
<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet">
@endsection

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
            <span> Ente Público</span>
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
         
        <div class="linha-separa"></div>
        <p>Senhor gestor municipal,

informamos que deve ser considerada a lista principal disponibilizada, na qual consta as seguintes informações de cada família: RF idoso; família da qual faz parte pessoa com deficiência; e especificação dos critérios atendidos, conforme Portaria nº 2.081, de 30 de julho de 2020, para que o Ente Público proceda a averiguação das famílias consideradas compatíveis.
Caso as famílias previstas na lista principal sejam insuficientes para suprir as reservas referentes ao atendimento de idoso e de pessoa com deficiência, deve-se utilizar as respectivas listas complementares disponibilizadas, em quantidade suficiente para o atendimento da reserva, considerando-se o dobro para compor a lista de suplentes. 
</p>
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
    
    @if(count($arquivosMunicipioPrincipal) >0)
    <div class="titulo">
        <h5>Arquivo Principal</h5> 
        
    </div>     
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >
                    <th><i class="fas fa-download"></i></th>
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
            @foreach($arquivosMunicipioPrincipal as $dados)
                
                <tr class="text-center" >
                    <td>
                    <form method="post" action='{{ url("/download/arquivo/$dados->id")}}'>
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file-pdf"></i></button>
                        </form>   
                    </td>
                    <td>{{$dados->id}}</td>
                    <td>{{$dados->tipoArquivo->txt_tipo_arquivo}}</td>
                    <td>{{$dados->num_arquivo_enviado}}</td>
                    <td>{{$dados->num_beneficiarios_total}}</td>
                    <td>{{$dados->num_apto_requisito_criterio}}</td>
                    <td>{{$dados->num_registro_complemento}}</td>
                    <td>@if($dados->entePublico) {{$dados->entePublico->txt_ente_publico}} @endif</td>
                    <td>@if($dados->dte_download_ente) {{date('d/m/Y',strtotime($dados->dte_download_ente))}}@endif</td>
                    
                    <td>@if($dados->user_id)<a href='{{ url("/usuario/$dados->user_id")}}' type="button" target="_blank"  class="btn btn-sm">{{$dados->user->name}}</a>@endif  </td>     
                    </tr>                                         
            @endforeach
            </tbody>
        </table><!-- fechar table-->
    @endif  

          
 @if(count($arquivosMunicipioComplemento) >0)

    <div class="titulo">
        <h5>Arquivos Complemento</h5> 
    
    </div>     
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >
                    <th><i class="fas fa-download"></i></th>
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
                    <td>
                    <form method="post" action='{{ url("/download/arquivo/$dados->id")}}'>
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-file-pdf"></i></button>
                        </form>   
                    </td>
                    <td>{{$dados->id}}</td>
                    <td>{{$dados->tipoArquivo->txt_tipo_arquivo}}</td>
                    <td>{{$dados->num_arquivo_enviado}}</td>
                    <td>{{$dados->num_beneficiarios_total}}</td>
                    <td>{{$dados->num_apto_requisito_criterio}}</td>
                    <td>{{$dados->num_registro_complemento}}</td>
                    <td>@if($dados->ente_publico) {{$dados->entePublico->txt_ente_publico}} @endif</td>
                    <td> @if($dados->dte_download_ente) {{date('d/m/Y',strtotime($dados->dte_download_ente))}}@endif</td>
                    <td>@if($dados->user_id)<a href='{{ url("/usuario/$dados->user_id")}}' type="button" target="_blank"  class="btn btn-sm">{{$dados->user->name}}</a>@endif  </td>     
                    </tr>                                         
            @endforeach
            </tbody>
        </table><!-- fechar table-->
    @endif  

<button type="submit"  class="btn btn-danger btn-lg btn-block" onclick="javascript:window.history.go(-1)">Fechar</button>
       
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection