
<div id="content">

  @if(count($resumoContratadasProgramaMcmv)>0)
    <div id="viewlet-above-content-title"></div>    
    <h1 class="documentFirstHeading text-center"></h1>    
    <div id="viewlet-below-content-title"><h2 class="text-center">MINHA CASA MINHA VIDA</h2></div>
    <div class="titulo-linha-cinza text-center">
      @if($mostrarPeriodo)
      <h3>
        2009 - 2020
      </h3>
      @endif
  </div>
    <div class="container-fluid">
      
      @foreach($resumoContratadasProgramaMcmv as $dados)
        @if($dados->programa_id == 1)
          <div class="row container-fluid-cinza btn-link" data-toggle="collapse" data-target="#collapseMcmv" aria-expanded="true" aria-controls="collapseMcmv">
            <caixa-simples
                      valor="{{number_format($dados->num_uh, 0, ',' , '.')}}"
                      titulo="Contratadas"
                      colunasdiv="col-lg-3 col-md-6 col-sm-6"
                      unidademedida="Unidades Habitacionais"
                      corfundocaixa="card-header card-header-warning card-header-icon"
                      icone="material-icons fas fa-home"
                      titulorodape="UH Contratadas"
                      iconerodape="material-icons text-warning fas fa-home"
            ></caixa-simples>
            <caixa-simples
                      valor="{{number_format($dados->num_vlr_total, 2, ',' , '.')}}"
                      titulo="Contratadas"
                      colunasdiv="col-lg-3 col-md-6 col-sm-6"
                      unidademedida="Valor Contratado"
                      corfundocaixa="card-header card-header-success card-header-icon"
                      icone="material-icons fas  fa-hand-holding-usd"
                      titulorodape="Valor Contratado"
                      iconerodape="material-icons text-success fas  fa-hand-holding-usd"
            ></caixa-simples>
            <caixa-simples
                      valor="{{number_format($dados->num_vigentes, 0, ',' , '.')}}"
                      titulo="Vigentes"
                      colunasdiv="col-lg-3 col-md-6 col-sm-6"
                      unidademedida="Unidades Habitacionais"
                      corfundocaixa="card-header card-header-primary card-header-icon"
                      icone="material-icons fas fa-home"
                      titulorodape="UH Vigentes"
                      iconerodape="material-icons text-primary fas fa-home"
            ></caixa-simples>
          <caixa-simples
                      valor="{{number_format($dados->num_entregues, 0, ',' , '.')}}"
                      titulo="Entregues"
                      colunasdiv="col-lg-3 col-md-6 col-sm-6"
                      unidademedida="Unidades Habitacionais"
                      corfundocaixa="card-header card-header-info card-header-icon"
                      icone="material-icons fas fa-home"
                      titulorodape="UH Entregues"
                      iconerodape="material-icons text-info fas fa-home"
            ></caixa-simples>
            
          </div><!--row-->  
          @endif
       @endforeach   
       <div id="accordion">
        <div class="card">
          <div id="collapseMcmv" class="collapse" aria-labelledby="headingMcmv" data-parent="#accordion">
            <div class="card-body">
                <div class="titulo-linha-cinza text-center">
                  <h2>
                    Contratações Minha Casa Minha Vida (2009 - 2020)
                  </h2>
              </div>

              <table-executivo
              :dados="{{$operacoesContratadasMcmv}}" 
              :url="'{{ url('/') }}'"
               > </table-executivo>  
<!--
               <div class="form-group text-center">
                <div class="row">
                    <div class="column col-md-6 col-sm-12">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_uh_ano_mcmv">Unidades Contratadas por Ano</button>                      
                    </div>  
                    <div class="column col-md-6 col-sm-12">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_valor_ano_mcmv">Valores Contratados por Ano</button>
                    </div>  
                </div>  
             </div>       
            -->
          </div>

        </div>
      
    
    

  </div> <!--container-fluid-->  
@endif

@if(count($resumoContratadasProgramaCvea)>0)
  <div class="linha-separa"></div>

      <div id="viewlet-above-content-title"></div>    
      <h1 class="documentFirstHeading text-center"></h1>    
      <div id="viewlet-below-content-title"><h2 class="text-center">CASA VERDE E AMARELA</h2></div>
      <div class="titulo-linha-cinza text-center">
        @if($mostrarPeriodo)
        <h3>
          A partir de 2020
        </h3>
        @endif
    </div>

      <div class="container-fluid">
        
        @foreach($resumoContratadasProgramaCvea as $dados)
          @if($dados->programa_id == 2)
            <div class="row container-fluid-cinza btn-link" data-toggle="collapse" data-target="#collapseCvea" aria-expanded="true" aria-controls="collapseCvea">
              <caixa-simples
                        valor="{{number_format($dados->num_uh, 0, ',' , '.')}}"
                        titulo="Contratadas"
                        colunasdiv="col-lg-3 col-md-6 col-sm-6"
                        unidademedida="Unidades Habitacionais"
                        corfundocaixa="card-header card-header-warning card-header-icon"
                        icone="material-icons fas fa-home"
                        titulorodape="UH Contratadas"
                        iconerodape="material-icons text-warning fas fa-home"
              ></caixa-simples>
              <caixa-simples
                        valor="{{number_format($dados->num_vlr_total, 2, ',' , '.')}}"
                        titulo="Contratadas"
                        colunasdiv="col-lg-3 col-md-6 col-sm-6"
                        unidademedida="Valor Contratado"
                        corfundocaixa="card-header card-header-success card-header-icon"
                        icone="material-icons fas  fa-hand-holding-usd"
                        titulorodape="Valor Contratado"
                        iconerodape="material-icons text-success fas  fa-hand-holding-usd"
              ></caixa-simples>
              <caixa-simples
                        valor="{{number_format($dados->num_vigentes, 0, ',' , '.')}}"
                        titulo="Vigentes"
                        colunasdiv="col-lg-3 col-md-6 col-sm-6"
                        unidademedida="Unidades Habitacionais"
                        corfundocaixa="card-header card-header-primary card-header-icon"
                        icone="material-icons fas fa-home"
                        titulorodape="UH Vigentes"
                        iconerodape="material-icons text-primary fas fa-home"
              ></caixa-simples>
            <caixa-simples
                        valor="{{number_format($dados->num_entregues, 0, ',' , '.')}}"
                        titulo="Entregues"
                        colunasdiv="col-lg-3 col-md-6 col-sm-6"
                        unidademedida="Unidades Habitacionais"
                        corfundocaixa="card-header card-header-info card-header-icon"
                        icone="material-icons fas fa-home"
                        titulorodape="UH Entregues"
                        iconerodape="material-icons text-info fas fa-home"
              ></caixa-simples>
            </div>
            <!--
            <div class="row">
              <button class="btn btn-secondary btn-lg btn-block" data-toggle="collapse" data-target="#collapseCvea" aria-expanded="true" aria-controls="collapseCvea">
                Relatório Executivo
              </button>
            </div>
          -->
            @endif
            
        @endforeach   
        
        
            <div id="accordion">
              <div class="card">
                <div id="collapseCvea" class="collapse" aria-labelledby="headingCvea" data-parent="#accordion">
                  <div class="card-body">
                      <div class="titulo-linha-cinza text-center">
                        <h2>
                          Contratações Casa Verde e Amarela (A partir de 2020)
                        </h2>
                    </div>
                    <table-executivo-cvea
                            :dados="{{$operacoesContratadasCvea}}" 
                            :url="'{{ url('/') }}'"
                    > </table-executivo-cvea>        
                  </div>
                </div>
              </div>
              
        
      </div> <!--container-fluid-->  
  @endif 



  <div class="modal fade" id="modal_uh_ano_mcmv" tabindex="-1" role="dialog" aria-labelledby="modal_uh_ano_mcmv_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="modal_uh_ano_mcmv_label">Unidades Contratadas por Ano</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
        
      <div class="titulo">
            <h5>Unidades Contratadas por Ano</h5> 
        </div>
        <div class="table-responsive">		
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th  rowspan="2"> Ano</th>
                        <th colspan="4">Faixa 1</th>                        
                        <th rowspan="2" class="totalFaixa text-secondary">Total Faixa 1</th>   
                        <th colspan="4">FGTS</th>                      
                        <th rowspan="2" class="totalFaixa text-secondary">Total FGTS</th>                        
                        <th rowspan="2"  class="bg-dark">Total</th> 
                    </tr>
                    <tr class="text-center">                                               
                        <th>Entidades</th>
                        <th>Far</th>
                        <th>Oferta Pública</th>
                        <th>Rural</th>
                        <th>Prod/Estoque</th> 
                        <th>Faixa 1,5</th> 
                        <th>Faixa 2</th> 
                        <th>Faixa 3</th>           
                    </tr>                        
                </thead>
                <tbody>
                    @foreach($dadosRelatorioExecutivoPorAnoMcmv as $item)
                    <tr >                        
                        <td>{{$item->num_ano_assinatura}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_entidades), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_far + $item->total_uh_far_vinc), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_oferta), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_rural), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa totalFaixa">{{number_format( ($item->valor_total_num_uh_1), 0, ',' , '.')}}</td>   
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_prod), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_15), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_2), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_3), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa totalFaixa">{{number_format( ($item->valor_total_num_uh_23 + $item->total_uh_fgts_15+ $item->total_uh_fgts_prod), 0, ',' , '.')}}</td>                         
                        <td class="tabelaFaixa text-bold table-dark">{{number_format( ($item->valor_total_num_uh_1 + $item->valor_total_num_uh_23 + $item->total_uh_fgts_15+ $item->total_uh_fgts_prod), 0, ',' , '.')}}</td>                         
                    </tr>
                    @endforeach
                    @foreach($resumoRelatorioExecutivoPorAnoMcmv as $item)
                    <tr class="total">                        
                        <td>TOTAL</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_entidades), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_far + $item->total_uh_far_vinc), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_oferta), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_rural), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_num_uh_1), 0, ',' , '.')}}</td>  
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_prod), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_15), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_2), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->total_uh_fgts_3), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa">{{number_format( ($item->valor_total_num_uh_23 + $item->total_uh_fgts_15+$item->total_uh_fgts_prod), 0, ',' , '.')}}</td>
                        <td class="tabelaFaixa table-dark">{{number_format( ($item->valor_total_num_uh_1+$item->valor_total_num_uh_23 + $item->total_uh_fgts_15+$item->total_uh_fgts_prod), 0, ',' , '.')}}</td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>     
        </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


  </div>

  

  


