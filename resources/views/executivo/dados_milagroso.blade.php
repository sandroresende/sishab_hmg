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
            <span> PMCMV</span>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>
    
        <span dir="ltr" id="breadcrumbs-1">        
            <a href="{{url('/executivo/filtro')}}">Consulta Relatório Executivo</a>
            <span class="breadcrumbSeparator">
                &gt;
                
            </span>
        </span>

        <span dir="ltr" id="breadcrumbs-2">
            <span id="breadcrumbs-current">Relatório Executivo</span>
        </span>
    </div>
    <h4 class="text-center">Ministério do Desenvolvimento Regional</h4>    
    <h5 class="text-center">Secretaria Nacional da Habitação</h5>  
    <div class="linha-separa"></div>
<div id="content">
    
    <div id="viewlet-above-content-title"></div>
      
    <h1  class="documentFirstHeading">
        @if($municipio) 
            {{$municipio->ds_municipio}} - {{$estado->txt_sigla_uf}} 
        @else
            @if($estado)
                {{$estado->txt_uf}}
            @endif
        @endif 

        @if($rm_ride)
            {{$rm_ride}}
        @endif

        @if($regiao && !$estado)
            {{$regiao->txt_regiao}}    
        @endif

        @if(!$municipio && !$estado && !$rm_ride && !$regiao)
            BRASIL
        @endif
    </h1>
        @if($ano_de>0)
            <h3 class="documentFirstHeading text-center">Período de Janeiro/{{$ano_de}} até Dezembro/{{$ano_ate}}</h3>
            
         @endif
         <span class="documentFirstHeadingSpan">{{number_format( ($brasilComRm->num_populacao_estimada), 0, ',' , '.')}} habitantes ({{$brasilComRm->num_ano_referencia_populacao_estimada}})</span>    
    <div id="viewlet-below-content-title">
        <div class="documentByLine" id="plone-document-byline">
            
            <span class="documentModified"><span>última atualização</span> {{date('d/m/Y',strtotime($dataPosicao->dte_posicao))}}</span><!-- data atualização-->
            
        </div>
    </div> <!-- viewlet-below-content-title-->
    <div id="viewlet-above-content-body">
        

    </div>
    <div id="content-core">
        <div class="card">
            <div class="card-body dashboard-counts section-padding">
            <div class="row">
                <div class="column col-sm-6">

                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-body bg-light caixas">
                            <h5 class="card-title text-secondary text-center">Déficit Habitacional
                                            <a href="" data-toggle="modal" data-target="#modalIndicadores" class="small-box-footer">
                                            <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                            </h5>

                            <div class="row">
                                <div class="column col-sm-6">
                                    <caixa-simples qtd="{{number_format( ($deficit-> vlr_deficit_habitacional_urbano), 0, ',' , '.')}}" titulo="Unidades Habitacionais" subtitulo="Área Urbana" cor="#3498db" icone="fas fa-home"></caixa-simples>
                                </div>
                                <div class="column col-sm-6">
                                    <caixa-simples qtd="{{number_format( ($deficit->vlr_deficit_habitacional_rural), 0, ',' , '.')}}" titulo="Unidades Habitacionais" subtitulo="Área Rural" cor="#19751c" icone="fas fa-home"></caixa-simples>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="column col-sm-6 ">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-body bg-light text-light caixas">
                            <h5 class="card-title text-secondary text-center">Unidades Habitacionais Contratadas
                            @if($municipio) 
                                <a href="" data-toggle="modal" data-target="#modalContratacao" class="small-box-footer">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </a> 
                            @endif    
                            </h5>    
                            <div class="row">
                                <div class="column col-sm-6">
                                    <caixa-simples qtd="{{number_format( ($uhTotal_urbano), 0, ',' , '.')}}" titulo="Unidades Habitacionais" subtitulo="Oferta, FAR e FDS" cor="#3498db" icone="fas fa-home"></caixa-simples>
                                </div>
                                <div class="column col-sm-6">
                                    <caixa-simples qtd="{{number_format( ($uhTotal_rural), 0, ',' , '.')}}" titulo="Unidades Habitacionais"  subtitulo="Área Rural" cor="#19751c" icone="fas fa-home"></caixa-simples>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($municipio)

                <!--LIMITES -->
                <div class="column col-sm-6">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-body bg-light caixas">
                            <h5 class="card-title text-secondary text-center">Limites
                                            @if(($num_uh_selecao_ativa_ano>0) || ($num_uh_contratadas_ano>0))
                                                <a href="" data-toggle="modal" data-target="#modalLimite" class="small-box-footer">
                                                <i class="fa fa-arrow-circle-right"></i>
                                                </a>    
                                            @endif  
                                            </h5>
                            <div class="row">
                                <div class="column col-sm-6">
                                    <caixa-simples qtd="{{number_format( ($brasilComRm2->num_limite_uh), 0, ',' , '.')}}" titulo="Portaria" cor="#f1c40f" icone="fa fa-fw fa-home"></caixa-simples>
                                </div>
                                <div class="column col-sm-6">
                                    @if($saldoLimite>0)
                                    <caixa-simples qtd="{{number_format( ($saldoLimite), 0, ',' , '.')}}" titulo="Saldo" cor="#17a689" icone="fa fa-fw fa-home"></caixa-simples>
                                    @else
                                    <caixa-simples qtd="{{number_format( ($saldoLimite), 0, ',' , '.')}}" titulo="Saldo" cor="#e74c3c" icone="fa fa-fw fa-home"></caixa-simples>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="column col-sm-6">
                    <div class="card text-white bg-secondary mb-3">
                        <div class="card-body bg-light text-light caixas">
                            <h5 class="card-title text-secondary text-center">Situação do município para os processos seletivos</h5> @if($elegivel)
                            <caixa-simples qtd="ELEGÍVEL" titulo="Contratação inferior a 50% do déficit (Portaria 114: item 8.1.1-b)" cor="#17a689" icone="fas fa-thumbs-up"></caixa-simples>
                            @else
                            <caixa-simples qtd="INELEGÍVEL" titulo="Contratação superior a 50% do déficit (Portaria 114: item 8.1.1-b)" cor="#e74c3c" icone="fas fa-thumbs-down"></caixa-simples>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="column col-sm-12">
                    <div class="card text-white bg-secondary">
                        <div class="card-body bg-light text-light caixas">
                            <h5 class="card-title text-secondary text-center">Valor Máximo para as Unidades Habitacionais</h5>
                            <div class="row">
                                <div class="column col-sm-3">
                                    <caixa-simples qtd="R$ {{number_format(($valoresUh->vlr_imovel_faixa_1), 0, ',' , '.')}}" titulo="FAR e FDS" cor="#3498db" icone="fas fa-home"></caixa-simples>
                                </div>
                                <div class="column col-sm-3">
                                    <caixa-simples qtd="R$ {{number_format(($valoresUh->vlr_imovel_contrucao_pnhr), 0, ',' , '.')}}" titulo="PNHR(rural)" titulo="Unidades Habitacionais" cor="#19751c" icone="fas fa-home"></caixa-simples>
                                </div>
                                <div class="column col-sm-3">
                                    <caixa-simples qtd="R$ {{number_format(($valoresUh->vlr_res_836_faixa_15), 0, ',' , '.')}}" titulo="Faixa 1,5" titulo="Unidades Habitacionais" cor="#f7c307" icone="fas fa-home"></caixa-simples>
                                </div>
                                <div class="column col-sm-3">
                                    <caixa-simples qtd="R$ {{number_format(($valoresUh->vlr_res_836_faixa_2), 0, ',' , '.')}}" titulo="Faixas 2 e 3" titulo="Unidades Habitacionais" cor="tomato" icone="fas fa-home"></caixa-simples>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif
                </div> 
            </div><!-- card-body-->
        </div><!-- card-->    

        <div class="form-group">         

<div class="card-header text-center">
    <strong class="text-white">
    <h2>Dados da Contratação</h2>
</strong>
</div>

<!--Tabela MCMV 1-->
<div class="titulo">
    <h5>Relatório Executivo <span style="float:right; font-size:13px;">

    <a href="{{url('executivo/relatorio/detalhesContratacao/')}}"  style="color:tomato;"> Detalhar <i class="fa fa-arrow-circle-right" style="color:#2b90d9;"></i></a></span></h5>
</div>

<table-executivo 
    :dados="{{$relatorioExecutivo}}" 
    :url="'{{ url('/') }}'"
    v-bind:codibge=" @if($municipio){{$municipio->id}}@else 0 @endif"
> </table-executivo>

<!-- VALORES CONTRATADOS ANO -->
@if(count($contratadasAno2)>0)
    
<div class="card-header text-center">
    <strong class="text-white">
    <h2>Dados da Seleção</h2>
</strong>
</div>

<div class="titulo">
    <h5>Valores Contratados por Ano <span style="float:right; font-size:13px;">
    <a href="{{url('executivo/relatorio/detalhesPropostas/')}}"  style="color:tomato;"> Detalhar <i class="fa fa-arrow-circle-right" style="color:#2b90d9;"></i></a></span>
</div> 
<div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <thead  class="text-center">
            <tr class="text-center">
                <th rowspan="2" class="align-middle">Ano</th>  
                <th colspan="4">Entidades</th>                          
                <th colspan="4">Far Empresas</th>                          
                <th colspan="4">Rural</th>                          
            </tr>
            <tr class="text-center">
                <th>Propostas</th>                          
                <th>UH Selecionadas</th>                          
                <th>UH Contratadas</th>                          
                <th>Valor</th>  
                <th>Propostas</th>                          
                <th>UH Selecionadas</th>                          
                <th>UH Contratadas</th>                          
                <th>Valor</th>  
                <th>Propostas</th>                          
                <th>UH Selecionadas</th>                          
                <th>UH Contratadas</th>                          
                <th>Valor</th>                          
            </tr>
        </thead>
        <tbody>      
        <?php $count = 0 ?>
        @foreach($contratadasAno2 as $ano) 
                <tr class="text-center">          
                    <td>{{$ano->num_ano_selecao}}</td>
                    <td>{{number_format( ($ano->total_prop_selec_entidade), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_selecionada_entidade), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_contratadas_entidades), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_vlr_contratado_entidades), 2, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_prop_selec_far), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_selecionada_far), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_contratadas_far), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_vlr_contratado_far), 2, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_prop_selec_rural), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_selecionada_rural), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_contratadas_rural), 0, ',' , '.')}}</td>
                    <td>{{number_format( ($ano->total_vlr_contratado_rural), 2, ',' , '.')}}</td>
                </tr>            
        @endforeach   
            <tr  class="text-center">     
                    <th>TOTAL</th>     
                    <th>{{number_format( ($totalAno2['total_prop_selec_entidade']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_selecionada_entidade']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_contratadas_entidades']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_vlr_contratado_entidades']), 2, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_prop_selec_far']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_selecionada_far']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_contratadas_far']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_vlr_contratado_far']), 2, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_prop_selec_rural']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_selecionada_rural']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_contratadas_rural']), 0, ',' , '.')}}</th>
                    <th>{{number_format( ($totalAno2['total_vlr_contratado_rural']), 0, ',' , '.')}}</th>                                
                </tr>                          
            </tbody>
        </table> 
    </div> 
  
@endif
<!-- FIM VALORES CONTRATADOS ANO -->
<button class="btn-lg btn btn-success btn-block"
                onclick="javascript:window.history.go(-1)">
                Voltar
            </button>
            <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();"> 
            <a class="btn btn-lg btn-light btn-block text-reset" href='{{ url("executivo/relatorio-download"."/".$dadosPropostas["regiao"]."/".$dadosPropostas["estado"]."/".$dadosPropostas["municipio"]."/".$dadosPropostas["rm_ride"]."/".$dadosPropostas["ano_de"]."/".$dadosPropostas["ano_ate"])}}'>Donwload para Excel</a>

    </div><!-- content-core-->
</div><!-- content-->

@if($municipio) 
<!-- Modal -->
<div class="modal fade" id="modalContratacao" tabindex="-1" role="dialog" aria-labelledby="modalContratacaoTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalContratacaoTitle">Dados de Contratação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead  class="text-center">
                    <tr>
                    <th>Modalidade</th>  
                    <th>Nº UH</th>  
                    <th>Valor</th>                      
                    </tr>
                </thead>
                <tbody>      
                <?php $count = 0 ?>
                @foreach($contratacao as $valor) 
                    @if(($valor->modalidade_id != 7) && ($valor->modalidade_id != 1) )
                        <tr class="text-center">                                   
                            <td>{{$valor->txt_modalidade}}</td>                                    
                            <td>{{number_format( ($valor->num_uh_contratadas), 0, ',' , '.')}}</td>
                            <td>{{number_format( ($valor->vlr_contratacao), 2, ',' , '.')}}</td>                                                                            
                        </tr>
                    @endif    
                @endforeach                           
            
                    </tbody>
                </table> 
            </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalLimite" tabindex="-1" role="dialog" aria-labelledby="modalLimiteTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLimiteTitle">Limite do Município</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>Limite (A)</th>  
                        <th>UH Contratadas (B)</th>  
                        <th>UH Dentro do Prazo Contratação (C)</th>         
                        <th>Saldo (A - B - C)</th>         
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr class="text-center">          
                            <td>{{number_format( ($brasilComRm2->num_limite_uh), 0, ',' , '.')}}</td>                                    
                            <td>{{number_format( ($num_uh_contratadas_ano), 0, ',' , '.')}}</td>                                     
                            <td>{{number_format( ($num_uh_selecao_ativa_ano), 0, ',' , '.')}}</td> 
                            <td>{{number_format( ($brasilComRm2->num_limite_uh - $num_uh_contratadas_ano - $num_uh_selecao_ativa_ano), 0, ',' , '.')}}</td>                                                                                  
                        </tr>                                        
                    </tbody>
                </table> 
            </div> 
        @if(count($propostasFeitas)>0)            
            <!-- panel body -->   
            @if($num_uh_contratadas_ano>0)   
            <div class="titulo">
                <h5>Propostas Contratadas em 2018 - FAR Empresas</h5> 
            </div>                            
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>APF</th>  
                        <th>Empreendimento</th>  
                        <th>UH Contratada</th>         
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasFeitas as $propostas) 
                        @if(($propostas->bln_contratada) && ($propostas->modalidade_id == 3) && ($propostas->num_ano_selecao == date('Y')) && (!$propostas->bln_ativo)) 
                            <tr class="text-center">          
                                <td>{{$propostas->num_apf}}</td>                                    
                                <td>{{$propostas->txt_nome_empreendimento}}</td>                                    
                                <td>{{number_format( ($propostas->num_uh_contratadas), 0, ',' , '.')}}</td>                                                                                   
                            </tr>
                        @endif    
                    @endforeach                           
                    <tr class="text-center table-secondary table-active">          
                                <td></td>                                    
                                <td class="text-right"><strong>TOTAL</strong></td>                                    
                                <td><strong>{{number_format( ($num_uh_contratadas_ano), 0, ',' , '.')}}</strong></td>                                                                                   
                            </tr>
                        </tbody>
                    </table> 
                </div>  
            @endif

            @if($num_uh_selecao_ativa_ano>0)    
                <!-- panel body -->   
            <div class="titulo">
                <h5>Propostas com a seleção dentro do prazo de contratação em 2018 - FAR Empresas</h5> 
            </div>                            
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead  class="text-center">
                        <tr class="text-center">
                        <th>APF</th>  
                        <th>Empreendimento</th>  
                        <th>UH Contratada</th>         
                        </tr>
                    </thead>
                    <tbody>      
                    <?php $count = 0 ?>
                    @foreach($propostasFeitas as $propostas) 
                        @if(($propostas->bln_selecionada) && ($propostas->modalidade_id == 3) && ($propostas->num_ano_selecao == 2018) && ($propostas->bln_ativo))
                            <tr class="text-center">          
                                <td>{{$propostas->num_apf}}</td>                                    
                                <td>{{$propostas->txt_nome_empreendimento}}</td>                                    
                                <td>{{number_format( ($propostas->num_uh), 0, ',' , '.')}}</td>                                                                                   
                            </tr>
                        @endif    
                    @endforeach                           
                    <tr class="text-center table-secondary table-active">          
                                <td></td>                                    
                                <td class="text-right"><strong>TOTAL</strong></td>                                    
                                <td><strong>{{number_format( ($num_uh_selecao_ativa_ano), 0, ',' , '.')}}</strong></td>                                                                                   
                            </tr>
                        </tbody>
                    </table> 
                </div> 
            @endif    
        @else
        <div class="alert alert-danger alert-dismissible fade in shadowed" role="alert">                                 
            <i class="fa fa-fw fa-info-circle"></i> Não existem propostas apresentadas para este município.
        </div>     
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>        
      </div>
    </div>
  </div>
</div>
@endif
<div class="modal fade" id="modalIndicadores" tabindex="-1" role="dialog" aria-labelledby="modalIndicadoresTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalIndicadoresTitle">Déficit Habitacional</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                <div class="titulo">
                    <h5>Urbano</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Urbano</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano), 0, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo até 3 Salários</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_ate3_sal), 2, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo de 3 a 10 Salários</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_de3a10_sal), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo até 10 Salários</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_ate10), 2, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo acima de 10 Salários</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_urbano_relativo_acima10_sal), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titulo">
                    <h5>Rural</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rural</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_rural), 0, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_rural_relativo), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titulo">
                    <h5>Total</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Total</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_total), 0, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Relativo Total</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_deficit_habitacional_total_relativo), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="titulo">
                    <h5>Diversos</h5>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Domicílio Precário</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_domicilios_precarios), 2, ',' , '.')}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Coabitação Familiar</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_coabitacao_familiar), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Ônus Excessivo com Aluguel</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_onus_excessivo_com_aluguel), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group branco">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Adensamento Excessivo com Domicílios Alugados</div>
                                </div>
                                <input type="text" disabled class="form-control" id="inlineFormInputGroupUsername" value="{{number_format( ($deficit->vlr_adensamento_excessivo_domicilios_alugados), 2, ',' , '.')}}">
                            </div>
                        </div>
                    </div>
                </div>

                <p class="font-italic">Ano de Referência: {{$deficit->num_ano_referencia}}</p>

            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>        
      </div>
    </div>
  </div>
</div>

@endsection
<!--  Section-->