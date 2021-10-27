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
                :titulo1='"Seleção"'
                :link1="'{{ url('/selecao') }}'"
                :titulo2="'Dados Seleção'"
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Dados Seleção'"
                    :dataatualizacao="'{{date('d/m/Y',strtotime($selecao->dte_portaria_resultado))}}'"
                    :linkcompartilhar="'{{ url("/selecao/$selecao->id") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            
            <div class="titulo-linha-cinza text-left">
                <h2>
                  Seleção
                </h2>
            </div>
            <div class="form-group-border">
                <div class="row">
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Seleção</label>
                        <input id="selecao" type="text" class="form-control input-relatorio" name="selecao" value="{{$selecao->num_selecao}}ª seleção {{$selecao->num_ano_selecao}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Modalidade</label>
                        <input id="txt_modalidade" type="text" class="form-control input-relatorio" name="txt_modalidade" value="{{$selecao->modalidade->txt_modalidade}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Data Seleção</label>
                        <input id="dte_selecao" type="text" class="form-control input-relatorio" name="dte_selecao" value="{{date('d/m/Y',strtotime($selecao->dte_selecao))}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Portaria</label>
                        <input id="txt_portaria_resultado" type="text" class="form-control input-relatorio" name="txt_portaria_resultado" value="{{$selecao->txt_portaria_resultado}}" disabled >
                    </div>
                </div>
            </div> 
             <!--form-group --> 
            <div class="form-group-relatorio">
                <div class="row">
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Propostas Enquadradas</label>
                        <input id="num_total_enquadradas" type="text" class="form-control input-relatorio" name="num_total_enquadradas" value="{{number_format($selecao->num_total_enquadradas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3">
                        <label class="control-label label-relatorio">Propostas Selecionadas</label>
                        <input id="num_total_selecionadas" type="text" class="form-control input-relatorio" name="num_total_selecionadas" value="{{number_format($selecao->num_total_selecionadas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">UH Propostas</label>
                        <input id="num_total_uh" type="text" class="form-control input-relatorio" name="num_total_uh" value="{{number_format($selecao->num_total_uh, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">UH Selecionadas</label>
                        <input id="num_uh_selecionadas" type="text" class="form-control input-relatorio" name="num_uh_selecionadas" value="{{number_format($selecao->num_uh_selecionadas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-2">
                        <label class="control-label label-relatorio">Investimento</label>
                        <input id="vlr_total_investimento" type="text" class="form-control input-relatorio" name="vlr_total_investimento" value="{{number_format($selecao->vlr_total_investimento, 2, ',' , '.')}}" disabled >
                    </div>
                    
                </div>
            </div>        
             <!--form-group --> 

             <div class="form-group">        
                @if($NenqNSelecionada)
                <div class="titulo-linha-cinza text-left">
                    <h2>Propostas Não Enquadradas</h2>
                </div>
        
                <div class="table-responsive ">
                    <table class="table table-striped table-hover table-sm">
                        <thead  class="text-center ">
                            <tr class="text-center">
                            <th>UF</th>  
                            <th>Qtd Municípios</th>                          
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
                                    <td>{{number_format( ($propostas->qtd_municipios), 0, ',' , '.')}}</td>   
                                    <td>{{number_format( ($propostas->qtd_propostas), 0, ',' , '.')}}</td>                                  
                                    <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                    <td>{{$propostas->num_portaria_resultado}}</td>   
                                    <td>{{date('m/Y',strtotime($propostas->dte_portaria_resultado))}}</td>                           
                                </tr>
                            @endif    
                        @endforeach                           
                                <tr class="table-secondary totalFaixa text-center font-weight-bold">   
                                    <td colspan="1">TOTAL</td>  
                                    <td>{{number_format( ($qtdMunNenqNSelecionada), 0, ',' , '.')}}</td>                                  
                                    <td>{{number_format( ($qtdPropNenqNSelecionada), 0, ',' , '.')}}</td>                                  
                                    <td class="tabelaNumero text-center">{{number_format( ($totalNEnqNSel), 0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center"></td>
                                    <td class="tabelaNumero text-center"></td>                         
                                </tr>
                            </tbody>
                        </table> 
                    </div> 
                    <!-- table-responsive -->
                @endif
                </div>
                <!-- form-group -->

                <div class="form-group">
                    @if($enqNSelecionada)
                    <div class="titulo-linha-cinza text-left">
                        <h2>Propostas Enquadradas e Não Selecionadas</h2>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead  class="text-center">
                                <tr class="text-center">
                                <th>UF</th>  
                                <th>Qtd Municípios</th>    
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
                                        <td>{{number_format( ($propostas->qtd_municipios), 0, ',' , '.')}}</td>  
                                        <td>{{number_format( ($propostas->qtd_propostas), 0, ',' , '.')}}</td>                                                                 
                                        <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                        <td>{{$propostas->num_portaria_resultado}}</td>   
                                        <td>{{date('m/Y',strtotime($propostas->dte_portaria_resultado))}}</td>                           
                                    </tr>
                                @endif    
                            @endforeach                           
                                <tr class="table-secondary totalFaixa text-center font-weight-bold">   
                                    <td colspan="1">TOTAL</td>      
                                    <td>{{number_format( ($qtdMunEnqNSelecionada), 0, ',' , '.')}}</td>                                    
                                    <td>{{number_format( ($qtdPropEnqNSelecionada), 0, ',' , '.')}}</td>                                    
                                    <td class="tabelaNumero text-center">{{number_format( ($totalEnqNSel), 0, ',' , '.')}}</td>
                                    <td class="tabelaNumero text-center"></td>
                                    <td class="tabelaNumero text-center"></td>                          
                                </tr>
                            </tbody>
                        </table> 
                    </div> 
                       <!-- table-responsive -->
                    @endif
                </div>
                <!-- form-group -->
                <div class="form-group">
                    @if($selNaoCont)
                    
                    <div class="titulo-linha-cinza text-left">
                        <h2>Propostas Selecionadas e Não Contratadas </h2>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead  class="text-center">
                                <tr class="text-center">
                                <th>UF</th>  
                                <th>Qtd Município</th>  
                                <th>Qtd Propostas</th>
                                <th>UH Selecionadas</th>  
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
                                        <td>{{number_format( ($propostas->qtd_municipios), 0, ',' , '.')}}</td>      
                                        <td>{{number_format( ($propostas->qtd_propostas), 0, ',' , '.')}}</td>                                                                 
                                        <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>
                                        <td>{{$propostas->num_portaria_resultado}}</td>   
                                        <td>{{date('m/Y',strtotime($propostas->dte_portaria_resultado))}}</td>                           
                                    </tr>
                                @endif    
                            @endforeach                           
                                    <tr class="table-secondary totalFaixa text-center font-weight-bold">   
                                        <td colspan="1">TOTAL</td>                                   
                                        <td class="tabelaNumero text-center">{{number_format( $qtdMunSelNaoCont, 0, ',' , '.')}}</td>
                                        <td class="tabelaNumero text-center">{{number_format( ($selecionadaNaoContratadas['qtdPropSelNaoCont']), 0, ',' , '.')}}</td>
                                        <td class="tabelaNumero text-center">{{number_format( ($selecionadaNaoContratadas['totalSelNContUH']), 0, ',' , '.')}}</td>                                
                                        <td class="tabelaNumero text-center"></td>   
                                        <td class="tabelaNumero text-center"></td>                           
                                    </tr>
                                </tbody>
                            </table> 
                        </div> 
                        <!-- table-responsive -->
                        @endif
                    </div>
                    <!-- form-group -->
                    <div class="form-group">
                        @if($selCont)                    
                        <div class="titulo-linha-cinza text-left">
                            <h2>Propostas Selecionadas e Contratadas</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-sm">
                                <thead  class="text-center">
                                    <tr class="text-center">
                                    <th>UF</th>  
                                    <th>Qtd Município</th> 
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
                                            <td>{{number_format( ($propostas->qtd_municipios), 0, ',' , '.')}}</td>  
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
                                        <td colspan="1">TOTAL</td>        
                                                        
                                        <td class="tabelaNumero text-center">{{number_format( ($qtdMunSelCont), 0, ',' , '.')}}</td>
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
                            <!-- table-responsive -->
                @endif
            </div>
            <!-- form-group -->

            <div class="form-group">
                <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
                <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">  
            </div>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


