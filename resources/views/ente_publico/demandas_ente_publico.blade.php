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
            <span> Ente Público</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Demandas</span>
    </span>
</div>

<div id="content">
<div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Demandas
        </h2>
         
        <div class="linha-separa"></div>

  </div>
  <div id="content-core">
   
    @if(count($demandas) >0)
          
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >
                <th>APF</th>
                <th>UH Contratadas</th>
                <th>UH Indicadas</th>
                <th>Arquivo Gerado</th>
                </tr>
            </thead>
            <tbody>
            @foreach($demandas as $dados)
                    <tr class="text-center" >
                    <td>{{$dados->operacao_id}}</td>
                    <td>{{$dados->num_uh}}</td>
                    <td>{{$dados->num_uh_indicadas}}</td>
                    <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                    <td>
                        @if($dados->bln_arquivo_gerado)
                            <a href='{{ url("/usuario/$usuario->id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-search"></i></a>
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