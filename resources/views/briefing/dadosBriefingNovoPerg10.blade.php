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
            <span> Briefing </span>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/briefing/novo/filtro')}}">Consulta Briefing Novo</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">
            Solicitações de Pagamento estão em aberto
            <span class="badge badge-primary">Novo</span></span>
        </span>
     
    </div>
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
      
    <h1  class="documentFirstHeading">
               {{$estado->txt_uf}}    
    </h1>

        
        
    
    <div id="content-core">
        


        @if($resumoMedicoes)
        <div class="form-group">       

            <div class="card-header text-center">
                <strong class="text-white">
                    <h4>FRAGILIDADES</h4>   
                </strong>                
            </div>

<!--Tabela MCMV 1-->
          
            
           
          
           

     

        <div class="titulo">
                <h5>10. Quais as solicitações de pagamento estão em aberto?</h5>
            </div>

            <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                            <th></th>
                            <th>PMCMV</th>                            
                        </tr>                     
                    </thead>
                    <tbody>
                    @foreach($resumoMedicoes as $item)                       
                        <tr>                        
                            <td>Nº de solicitações de pagamento em aberto</td>                            
                            <td class="tabelaNumero text-center">{{number_format($item->qtd_solicitacoes,0, ',' , '.')}}</td>                               
                        </tr>
                        <tr>                        
                            <td>Nº de empreendimentos afetados</td>                            
                            <td class="tabelaNumero text-center">{{number_format($item->qtd_contratos,0, ',' , '.')}}</td>                               
                        </tr>
                        <tr>                        
                            <td>Valor total devido ( milhões R$)</td>                            
                            <td class="tabelaNumero text-center">{{number_format($item->vlr_devido,2, ',' , '.')}}</td>                               
                        </tr>
                    @endforeach
                                             
                        </tbody>                                        
                </table>
            <!-- VALORES CONTRATADOS ANO -->
       
          
           
        </div>
        @endif
        
            <!-- FIM VALORES CONTRATADOS ANO -->
            <button class="btn-lg btn btn-success btn-block"
                            onclick="javascript:window.history.go(-1)">
                            Voltar
                        </button>
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 
                        

    </div><!-- content-core-->
</div><!-- content-->



@endsection
<!--  Section-->