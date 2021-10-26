@extends('layouts.app')

@section('content')

<div class="card-header text-white text-center">
            <strong><h2></h2></strong> 
            <h5></h5>              
          </div>



          <div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
        <a href="{{ url('/prototipo') }}">Página Inicial</a>
        <span class="breadcrumbSeparator">
            &gt;            
        </span>
    </span>
    
    <span dir="ltr" id="breadcrumbs-1">        
    <span >Proposta</span>
        <span class="breadcrumbSeparator"> &gt;</span>
    </span>

    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Propostas Cadastradas</span>
    </span>
</div>  <!-- portal-breadcrumbs -->   

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        PROPOSTAS CADASTRADAS
        </h2>
        
        <div class="linha-separa"></div>
        
        @if(count($prototipos) >0)
    <div class="titulo">
        <h5>Propostas </h5>         
    </div>
           
            <table class="table table-hover">
                  
                <thead>
                  <tr class="text-center" >
                    <th>Id</th>
                    <th>Nome da Proposta</th>
                    <th>Situaçao</th>
                    <th>Inicio Preenchimento</th>
                    <th>Excluir</th>
                    <th>Ação</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($prototipos as $dados)
                    @if($dados->situacao_prototipo_id <= 1)
                        <tr class="text-center table-light">                        
                    @elseif($dados->situacao_prototipo_id == 2) 
                        <tr class="text-center table-secondary">
                    @elseif($dados->situacao_prototipo_id == 3)   
                    <a href='{{ url("/prototipo/show/levantamento/$dados->id")}}' type="button" class="btn btn-link">
                        <tr class="text-center table-primary">
                    @elseif($dados->situacao_prototipo_id == 4)   
                        <tr class="text-center table-success">
                    @endif   
                     
                        <td>{{$dados->id}}</td>
                        <td>{{$dados->txt_nome_prototipo}}</td>
                     <td>{{$dados->txt_situacao_prototipo}}</td>
                        <td> @if($dados->dte_conclusao_caracterizacao_terreno) {{date('d/m/Y',strtotime($dados->dte_conclusao_caracterizacao_terreno))}} @endif</td>
                        <td>
                            @if($dados->situacao_prototipo_id != 4)
                            <form method="post" action='{{ url("/prototipo/excluir/$dados->id/")}}'>
                                {{csrf_field()}}
                                <button type="submit"  class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                
                                
                            </form>
                            @endif
                        </td>
                        <td>
                            
                                  
                                    @if($dados->situacao_prototipo_id <= 1)
                                    <a href='{{ url("/prototipo/perguntas/$dados->id")}}' type="button" class="btn btn-link">
                                        Iniciar Preenchimento <i class="fas fa-pencil-alt"> </i> 
                                     @elseif($dados->situacao_prototipo_id == 2)   
                                        <a href='{{ url("/prototipo/perguntas/$dados->id")}}'  type="button" class="btn btn-link">
                                     Continuar Preenchimento <i class="fas fa-edit"></i></a>
                                    
                                    @elseif($dados->situacao_prototipo_id == 3)   
                                    <a href='{{ url("/prototipo/show/levantamento/$dados->id")}}' type="button" class="btn btn-link">
                                     Enviar Proposta <i class="fas fa-search"></i></a>
                                    @elseif($dados->situacao_prototipo_id == 4)   
                                    <a href='{{ url("/prototipo/show/levantamento/$dados->id")}}' type="button" class="btn btn-link">
                                        Visualizar <i class="fas fa-search"></i></a>
                                    @endif    
                            
                        </td>            
                      </tr>                                         
                @endforeach
                </tbody>
              </table><!-- fechar table-->
            @endif  
            
           

            
                <a href='{{ url("prototipo/novo") }}' class="btn btn-outline-primary btn-block btn-lg">Nova Proposta</a>
                <br/>
               

</div><!-- content-->



@endsection
