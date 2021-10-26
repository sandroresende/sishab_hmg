@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/prototipo') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span>Proposta</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Minhas Permissões</span>
    </span>
</div>

<div id="content">
<div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Minhas Permissões
        </h2>
        <div class="linha-separa"></div>
        
  </div>
  <div id="content-core">
      @if($permissaoDeferida == 0)
        <a class="btn btn-outline-primary" target="_blank" href='{{ url("/prototipo/permissao/nova")}}'><i class="fas fa-plus "></i> Nova Permissão</a>
      @endif

    @if(count($permissoes)>0)
    <div class="tab-pane fade show" id="nav-cancelada" role="tabpanel" aria-labelledby="nav-cancelada-tab">
         
                <table class="table table-hover">
                <thead>
                <tr class="text-center" >
                    <th>Id</th>
                    <th>Data Solicitação</th>       
                    <th>Status</th>
                    <th>Analisado Por</th>       
                    <th>Data Análise</th> 
                    <th>Motivo</th>                                          
                    <th>Observação</th> 
                    <th>Ofício</th>                                            
                                                              
                  </tr>
                </thead>
                <tbody>
                @foreach($permissoes as $dados)
                <tr class="text-center" >
                    <td>{{$dados->id}}</td>
                    <td>  {{date('d/m/Y',strtotime($dados->created_at))}} </td>
                    <td>{{$dados->statusPermissao->txt_status_permissao}}</td>
                    <td>@if($dados->userAnalisado){{$dados->userAnalisado->name}}@endif</td>
                    <td> @if($dados->dte_analise) {{date('d/m/Y',strtotime($dados->dte_analise))}} @endif</td>                        
                    <td>{{$dados->txt_tipo_indeferimento}} @if($dados->tipo_indeferimento_id == 99) : {{$dados->txt_outro_tipo_indeferimento}} @endif</td>
                      <td>{{$dados->txt_observacao}}</td>
                    <td>
                        <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->caminho_oficio")}}'><i class="fas fa-file-pdf fa-2x"></i></a>                         
                    </td>                      
                    </tr>
                    
                @endforeach
                </tbody>
              </table><!-- fechar table-->
             </div><!--nav-cancelada -->
        
    @endif 

    

  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection