@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
    
    
@endsection


@section('content')

<div id="content">
    <div id="content-core">
        
        <historico-navegacao
            :url="'{{ url('/home') }}'"
            :titulo1='"Seleção de Propostas"'
            :titulo2='"Consulta Situação da Seleção no Município"'
            :link2="'{{ url('/proposta/selecao/resumo/filtro') }}'"
            :titulo3="'Resumo da Seleção'"
        >
        </historico-navegacao>

        <cabecalho-form
                :titulo="'Resumo da Seleção'"
                :dataatualizacao="'{{date('d/m/Y',strtotime($dataPosicao))}}'"
                :barracompartilhar="true"
                >
        </cabecalho-form>    

        <div class="form-group">        
            @if($NenqNSelecionada)
            <div class="titulo">
                <h3>Propostas Não Enquadradas</h3> 
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>UF</th>  
                        <th>Município</th>  
                        <th>Modalidade</th>  
                        <th>Qtd Propostas</th>
                        <th>UH Não Enquadradas</th>  
                        <th>Portaria</th>            
                        <th>Data Seleção</th>                                    
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasApresentadas as $propostas) 
                        @if((!$propostas->bln_enquadrada) && (!$propostas->bln_selecionada))
                            <tr class="text-center">          
                                <td>{{$propostas->txt_sigla_uf}}</td>                                    
                                <td>{{$propostas->ds_municipio}}</td>                                    
                                <td>{{$propostas->txt_modalidade}}</td>  
                                <td>{{number_format( ($propostas->qtd_propostas), 0, ',' , '.')}}</td>                                  
                                <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                <td>{{$propostas->num_portaria_resultado}}</td>   
                                <td>{{date('m/Y',strtotime($propostas->dte_portaria_resultado))}}</td>                           
                            </tr>
                        @endif    
                    @endforeach                           
                            <tr class="table-secondary totalFaixa text-center font-weight-bold">   
                                <td colspan="3">TOTAL</td>  
                                <td>{{number_format( ($qtdPropNenqNSelecionada), 0, ',' , '.')}}</td>                                  
                                <td class="tabelaNumero text-center">{{number_format( ($totalNEnqNSel), 0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center"></td>
                                <td class="tabelaNumero text-center"></td>                         
                            </tr>
                        </tbody>
                    </table> 
                </div> 
            @endif
            </div>
            <div class="form-group">
            @if($enqNSelecionada)
            <div class="titulo">
                <h3>Propostas Enquadradas e Não Selecionadas </h3> 
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>UF</th>  
                        <th>Município</th>  
                        <th>Modalidade</th>  
                        <th>Qtd Propostas</th>
                        <th>UH Enquadradas</th>  
                        <th>Portaria</th>            
                        <th>Data Seleção</th>                                    
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasApresentadas as $propostas) 
                        @if(($propostas->bln_enquadrada) && (!$propostas->bln_selecionada))
                            <tr class="text-center">          
                                <td>{{$propostas->txt_sigla_uf}}</td>                                    
                                <td>{{$propostas->ds_municipio}}</td>                                    
                                <td>{{$propostas->txt_modalidade}}</td>   
                                <td>{{number_format( ($propostas->qtd_propostas), 0, ',' , '.')}}</td>                                                                 
                                <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                <td>{{$propostas->num_portaria_resultado}}</td>   
                                <td>{{date('m/Y',strtotime($propostas->dte_portaria_resultado))}}</td>                           
                            </tr>
                        @endif    
                    @endforeach                           
                            <tr class="table-secondary totalFaixa text-center font-weight-bold">   
                                <td colspan="3">TOTAL</td>      
                                <td>{{number_format( ($qtdPropEnqNSelecionada), 0, ',' , '.')}}</td>                                    
                                <td class="tabelaNumero text-center">{{number_format( ($totalEnqNSel), 0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center"></td>
                                <td class="tabelaNumero text-center"></td>                          
                            </tr>
                        </tbody>
                    </table> 
                </div> 
            @endif
            </div>
            <div class="form-group">
           @if($selNaoCont)
            <div class="titulo">
                <h3>Propostas Selecionadas e Não Contratadas </h3> 
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>UF</th>  
                        <th>Município</th>  
                        <th>Modalidade</th>  
                        <th>Qtd Propostas</th>
                        <th>UH Selecionadas</th>  
                        <th>UH Contratadas</th>  
                        <th>Valor Contratado</th>  
                        <th>Portaria</th>            
                        <th>Data Seleção</th>                                    
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasApresentadas as $propostas) 
                        @if(($propostas->bln_selecionada) && (!$propostas->bln_contratada))
                            <tr class="text-center">          
                                <td>{{$propostas->txt_sigla_uf}}</td>                                    
                                <td>{{$propostas->ds_municipio}}</td>                                    
                                <td>{{$propostas->txt_modalidade}}</td>     
                                <td>{{number_format( ($propostas->qtd_propostas), 0, ',' , '.')}}</td>                                                                 
                                <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($propostas->num_uh_contratadas), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($propostas->vlr_contratado), 2, ',' , '.')}}</td>
                                <td>{{$propostas->num_portaria_resultado}}</td>   
                                <td>{{date('m/Y',strtotime($propostas->dte_portaria_resultado))}}</td>                           
                            </tr>
                        @endif    
                    @endforeach                           
                            <tr class="table-secondary totalFaixa text-center font-weight-bold">   
                                <td colspan="3">TOTAL</td>                                   
                                <td class="tabelaNumero text-center">{{number_format( ($selecionadaNaoContratadas['qtdPropSelNaoCont']), 0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format( ($selecionadaNaoContratadas['totalSelNContUH']), 0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format( ($selecionadaNaoContratadas['totalSelNContUHCont']), 0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format( ($selecionadaNaoContratadas['totalSelNContVlrContr']), 2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center"></td>   
                                <td class="tabelaNumero text-center"></td>                           
                            </tr>
                        </tbody>
                    </table> 
                </div> 
            @endif
            </div>
            <div class="form-group">
            @if($selCont)
                <div class="titulo">
                <h3>Propostas Selecionadas e Contratadas</h3> 
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>UF</th>  
                        <th>Município</th>  
                        <th>Modalidade</th>  
                        <th>Qtd Propostas</th>
                        <th>UH Selecionadas</th>  
                        <th>UH Contratadas</th>  
                        <th>Valor Contratado</th>  
                        <th>Portaria</th>            
                        <th>Data Seleção</th>                                    
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasApresentadas as $propostas) 
                        @if(($propostas->bln_selecionada) && ($propostas->bln_contratada))
                            <tr class="text-center">          
                                <td>{{$propostas->txt_sigla_uf}}</td>                                    
                                <td>{{$propostas->ds_municipio}}</td>                                    
                                <td>{{$propostas->txt_modalidade}}</td>  
                                <td>{{number_format( ($propostas->qtd_propostas), 0, ',' , '.')}}</td>                                                                                               
                                <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($propostas->num_uh_contratadas), 0, ',' , '.')}}</td>
                                <td>{{number_format( ($propostas->vlr_contratado), 2, ',' , '.')}}</td>
                                <td>{{$propostas->num_portaria_resultado}}</td>   
                                <td>{{date('m/Y',strtotime($propostas->dte_portaria_resultado))}}</td>                           
                            </tr>
                        @endif    
                    
                    @endforeach                           
                            <tr class="table-secondary totalFaixa text-center font-weight-bold">   
                                <td colspan="3">TOTAL</td>                                   
                                <td class="tabelaNumero text-center">{{number_format( ($selecionadaContratadas['qtdPropSelCont']), 0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format( ($selecionadaContratadas['totalSelUH']), 0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format( ($selecionadaContratadas['totalSelUHCont']), 0, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center">{{number_format( ($selecionadaContratadas['totalSelVlrContr']), 2, ',' , '.')}}</td>
                                <td class="tabelaNumero text-center"></td>   
                                <td class="tabelaNumero text-center"></td>                           
                            </tr>
                        </tbody>
                    </table> 
                </div> 
            @endif
            </div>

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
     </div>
    <!--content-core --> 
</div>
<!--content-->     
@endsection


