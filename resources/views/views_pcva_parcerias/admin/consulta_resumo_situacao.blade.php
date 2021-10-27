@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                    :url="'{{ url('/') }}'"
                    :titulo1="'PCVA - Parcerias'"
                    :titulo2='"Consulta Resumo Situação"'
                   
            >
            </historico-navegacao>

            <cabecalho-form
                    :titulo="'CONSULTA RESUMO SITUAÇÃO'"
                    :barracompartilhar="true"
                    :linkcompartilhar="'{{ url("/admin/pcva_parcerias/resumoSituacao/filtro")}}'"
                    >
              
            </cabecalho-form> 
           <!-- form-group-->              
           <div class="form-group">
            
            <form action="{{ url('admin/pcva_parcerias/resumoSituacao/pesquisar') }}" method="POST">
                 @csrf
                 <div class="well">
                     <div class="box">                                                                                 
                         <consulta-termos-parceria 
                         coluf="column col-xs-12 col-sm-6"
                         colmun="column col-xs-12 col-sm-6"
                         :url="'{{ url('/') }}'"
                         :blnpesquisaprot="'false'"
                         :blnpesquisasituac="'false'">
                     </consulta-termos-parceria>
                     </div>
                 </div>    
        </form> 

        <div class="titulo">
            <h3>Manifestação de Interesse</h3>         
        </div>
            
        <table class="table table-hover">
            <thead>
            <tr class="text-center" >
                <th rowspan="2">UF</th>
                <th rowspan="2">Termos</th>                        
                <th rowspan="2">UH</th>                                               
                <th colspan="2">Registrados</th>  
                <th colspan="2">Enviados</th>     
                <th colspan="2">Validados</th>     
                <th colspan="2">Recusados</th>     
            </tr>    
                    <tr>                                         
                        <th class="text-center">Termos</th>
                        <th class="text-center">UH</th>
                                                           
                        <th class="text-center">Termos</th>
                        <th class="text-center">UH</th>

                        <th class="text-center">Termos</th>
                        <th class="text-center">UH</th>

                        <th class="text-center">Termos</th>
                        <th class="text-center">UH</th>
                    </tr>                                          
           
            </thead>
            <tbody>
            @foreach($dadosSituacaoTermo as $dados)                                                     
                    <tr class="text-center">        
                    <td>{{$dados->txt_sigla_uf}}</td>
                    <td>{{number_format($dados->num_termos_totais, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_uh_totais, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_termo_registrados, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_unidades_registradas, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_termo_enviados, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_unidades_enviadas, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_termo_validados, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_unidades_validadas, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_termo_recusados, 0, ',' , '.')}}</td>
                    <td>{{number_format($dados->num_unidades_recusadas, 0, ',' , '.')}}</td>                        
                </tr>  
            @endforeach
                <tr class="total">
                    <td class="tabelaNumero">TOTAL:</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termos_totais'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_uh_totais'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termo_registrados'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_unidades_registradas'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termo_enviados'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_unidades_enviadas'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termo_validados'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_unidades_validadas'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termo_recusados'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_unidades_recusadas'], 0, ',' , '.')}}</td>
                </tr>                                                          
            
            </tbody>
        </table><!-- fechar table-->
             
        </div><!-- fechar primeiro form-group-->

        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


