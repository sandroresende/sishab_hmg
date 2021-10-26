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
        <span> Seleção de Propostas</span>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-1">        
        <a href="{{url('/selecao/resumo/filtro')}}">Consulta Situação da Seleção no Município</a>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Resumo</span>
    </span>
</div> 
<h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        {{$estado->txt_uf}}
        </h2>
        <span class="documentFirstHeadingSpan">Resumo da Seleção</span> 
        <div class="linha-separa"></div>


    <div id="content-core">
            <div class="form-group">        
            @if($NenqNSelecionada)
            <div class="titulo">
                <h5>Propostas Não Enquadradas</h5> 
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
                <h5>Propostas Enquadradas e Não Selecionadas </h5> 
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
                <h5>Propostas Selecionadas e Não Contratadas </h5> 
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
                <h5>Propostas Selecionadas e Contratadas</h5> 
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
                    <span class="documentByLine">
                        <span class="summary-view-icon">Posição: {{date('d/m/Y',strtotime($dataPosicao))}}</span>  
                    </span>  
                </div> <!-- fechar form-group-->      
            <button class="btn-lg btn btn-success btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">  
    <a href='{{ url("/selecao/resumo-download")."/".$dadosPropostas["estado"] }}' class="btn btn-lg btn-light btn-block text-reset">Download para Excel</a>               
    </div><!-- content-core-->
</div><!-- content-->

    
@endsection