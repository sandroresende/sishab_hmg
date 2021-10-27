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
                    :titulo2='"Resumo situação Manifestação de Interesse"'
                   
            >
            </historico-navegacao>

            <cabecalho-form
                    :titulo="'RESUMO SITUAÇÃO MANISFESTAÇÃO DE INTERESSE'"
                    :barracompartilhar="true"
                    :linkcompartilhar="'{{ url("/admin/pcva_parcerias/resumoSituacao/filtro")}}'"
                    >
              
            </cabecalho-form> 
           <!-- form-group-->              
           <div class="form-group">
            
            

        <div class="titulo">
            <h3>Manifestação de Interesse</h3>         
        </div>
        <div class="table-responsive">   
            <table class="table table-hover">
                <thead>
                <tr class="text-center" >
                    <th rowspan="2">UF</th>
                    <th rowspan="2">Município</th>
                    <th rowspan="2">Termos</th>                        
                    <th rowspan="2">UH</th>                                               
                    <th colspan="4">Registrados</th>  
                    <th colspan="4">Enviados</th>     
                    <th colspan="4">Validados</th>     
                    <th colspan="4">Recusados</th>     
                </tr>    
                        <tr>                                         
                            <th class="text-center">Termos</th>
                            <th class="text-center">UH</th>
                            <th class="text-center">Contrapartida</th>
                            <th class="text-center">Contrap Adic</th>
                                                            
                            <th class="text-center">Termos</th>
                            <th class="text-center">UH</th>
                            <th class="text-center">Contrapartida</th>
                            <th class="text-center">Contrap Adic</th>

                            <th class="text-center">Termos</th>
                            <th class="text-center">UH</th>
                            <th class="text-center">Contrapartida</th>
                            <th class="text-center">Contrap Adic</th>

                            <th class="text-center">Termos</th>
                            <th class="text-center">UH</th>
                            <th class="text-center">Contrapartida</th>
                            <th class="text-center">Contrap Adic</th>
                        </tr>                                          
            
                </thead>
                <tbody>
                @foreach($dadosSituacaoTermo as $dados)                                                     
                        <tr class="text-center">        
                        <td>{{$dados->txt_sigla_uf}}</td>
                        <td>{{$dados->ds_municipio}}</td>
                        <td>{{number_format($dados->num_termos_totais, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_uh_totais, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_termo_registrados, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_unidades_registradas, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->vlr_contr_est_uh_registradas, 2, ',' , '.')}}</td>
                        <td>{{number_format($dados->vlr_contr_adicional_registradas, 2, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_termo_enviados, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_unidades_enviadas, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->vlr_contr_est_uh_enviadas, 2, ',' , '.')}}</td>
                        <td>{{number_format($dados->vlr_contr_adicional_enviadas, 2, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_termo_validados, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_unidades_validadas, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->vlr_contr_est_uh_validadas, 2, ',' , '.')}}</td>
                        <td>{{number_format($dados->vlr_contr_adicional_validadas, 2, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_termo_recusados, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->num_unidades_recusadas, 0, ',' , '.')}}</td>
                        <td>{{number_format($dados->vlr_contr_est_uh_recusadas, 2, ',' , '.')}}</td>
                        <td>{{number_format($dados->vlr_contr_adicional_recusadas, 2, ',' , '.')}}</td>
                    </tr>                                                          
                @endforeach
                <tr class="total">
                    <td colspan="2" class="tabelaNumero">TOTAL:</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termos_totais'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_uh_totais'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termo_registrados'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_unidades_registradas'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_contr_est_uh_registradas'], 2, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_contr_adicional_registradas'], 2, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termo_enviados'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_unidades_enviadas'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_contr_est_uh_enviadas'], 2, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_contr_adicional_enviadas'], 2, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termo_validados'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_unidades_validadas'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_contr_est_uh_validadas'], 2, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_contr_adicional_validadas'], 2, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_termo_recusados'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_unidades_recusadas'], 0, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_contr_est_uh_recusadas'], 2, ',' , '.')}}</td>
                    <td class="tabelaNumero text-center">{{number_format($totais['total_contr_adicional_recusadas'], 2, ',' , '.')}}</td>
                </tr> 
                </tbody>
            </table><!-- fechar table-->
        </div>       
        </div><!-- fechar primeiro form-group-->

        <div class="form-group">
            <div class="row">
                <div class="column col-sm-6 col-xs-12">                                        
                    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">   
                </div>
                <div class="column col-sm-6 col-xs-12">
                    <input class="btn btn-lg btn-danger btn-block" type="button-danger" onclick="javascript:window.history.go(-1)" value="Fechar">    
                </div>
            </div>        
        </div><!-- fechar primeiro form-group-->

        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


