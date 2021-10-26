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
            <span>Seleção de Demandas</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/admin/entePublico/filtro')}}">Consulta de Entes Público</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Entes Públicos</span>
    </span>
</div>

<div id="content">
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
            Entes Públicos
        </h2>
        
        <div class="linha-separa"></div>


  <div id="content-core">
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
                    <a href='{{ url("admin/entes/$entes->ente_publico_id")}}' type="button"  class="btn  btn-sm">
                        <i class="fas fa-search"></i></a>
                </td>            
                </tr>                                         
        @endforeach
        </tbody>
        </table><!-- fechar table-->

        <button type="submit"  class="btn btn-danger btn-lg btn-block" onclick="javascript:window.history.go(-1)">Fechar</button>
  </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection