

<div class="form-group">
    <div class="titulo">
        <h5>Tabela de Requisitos</h5>                     
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Item Edital</th>
                <th>Requisitos</th>
                <th>Situação</th>
            </tr>
            </thead>
            
            <tbody>
                
                <tr data-toggle="collapse" data-target="#accordion1" class="clickable">
                    <td rowspan="20" class="align-middle">
                        @if($criteriosHabilitacao->vlr_populacao_estimada >= 750000)
                            4.3 Município com população a partir de 750 mil habitantes devem atender a pelo menos 08 requisitos adicionais ({{number_format( ($criteriosHabilitacao->vlr_populacao_estimada), 0, ',' , '.')}} hab.)
                        @else
                            4.2  Município com população abaixo de 750 mil habitantes devem atender a pelo menos 07 requisitos adicionais  ({{number_format( ($criteriosHabilitacao->vlr_populacao_estimada), 0, ',' , '.')}} hab.)
                        @endif
                    </td>
                    <td>Sete dos 8 os sistemas do item 2.1, desde que o sistema que não conste esteja a uma distância de até 1000 metros do terreno</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_1) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="accordion1" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label ">2.1 Sistemas de infraestrutura básica estão disponíveis no acesso ao terreno (não assinalar obras em andamento)</label>
                                    <div class="row">
                                        @if($infraBasica->bln_sistema_abastecimento)
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxAbastecimentoAgua" value="option1" @if($infraBasica->bln_sistema_abastecimento) checked @endif disabled>
                                                <label class="form-check-label" for="inlineCheckbox1">Sistema de abastecimento de água</label>
                                            </div>
                                        </div>
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_abast" value="{{$infraBasica->vlr_dist_sis_abast}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_sistema_coleta_esgoto)
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxEsgoto" value="option2" @if($infraBasica->bln_sistema_coleta_esgoto) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de coleta e destinação de esgoto</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_coleta" value="{{$infraBasica->vlr_dist_sis_coleta}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_sistema_coleta_lixo)
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxLixo" value="option2" @if($infraBasica->bln_sistema_coleta_lixo) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de coleta e destinação de lixo</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_coleta_lixo" value="{{$infraBasica->vlr_dist_sis_coleta_lixo}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                        @endif    
                                        @if($infraBasica->bln_sistema_renagem_ag_pluviais)
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxAguasPluviais" value="option3" @if($infraBasica->bln_sistema_renagem_ag_pluviais) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Sistema de drenagem de águas pluviais</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_dren_ag_pluv" value="{{$infraBasica->vlr_dist_sis_dren_ag_pluv}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div>                                                         
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_dist_energia_eletrica)
                                        <div class="column col-xs-12 col-md-12">  
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxEnergiaEletrica" value="option1" @if($infraBasica->bln_dist_energia_eletrica) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox1">Sistema de distribuição de energia elétrica</label>
                                            </div>
                                        </div>  
                                        
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_dist_ener_elet" value="{{$infraBasica->vlr_dist_sis_dist_ener_elet}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div>                                                         
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_iluminacao_publica)
                                        <div class="column col-xs-12 col-md-12">         
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxIluminacao" value="option2" @if($infraBasica->bln_iluminacao_publica) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de iluminação pública</label>
                                            </div>
                                        </div>  
                                        
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_ilum_pub" value="{{$infraBasica->vlr_dist_sis_ilum_pub}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_guias_sarjetas)
                                        <div class="column col-xs-12 col-md-12">   
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxGuiasSarjetas" value="option3" @if($infraBasica->bln_guias_sarjetas) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Guias e sarjetas</label>
                                            </div>
                                        </div>
                                        <div class="column col-xs-12 col-md-12"> 
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_guias_sarj" value="{{$infraBasica->vlr_dist_sis_guias_sarj}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_pavimentacao)                               
                                        <div class="column col-xs-12 col-md-12">       
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxPavimentacao" value="option3" @if($infraBasica->bln_pavimentacao) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Pavimentação</label>
                                            </div>
                                        </div>   
                                        <div class="column col-xs-12 col-md-12">                                                            
                                            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_pavim" value="{{$infraBasica->vlr_dist_sis_pavim}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            
                                        </div>
                                        @endif                              
                                    </div>   <!-- row-->                                     
                                </div>
                            </div>   <!-- row-->  

                        </div>
                    </td>
                </tr>
                <tr data-toggle="collapse" data-target="#accordion2" class="clickable">
                    <td>Ponto de transporte público) a uma distância de até 1000 metros do terreno</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_2) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="accordion2" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-5">
                                    <label class="control-label "><strong style="color:grey">3.1 O Município dispõe de transporte público coletivo?</strong></label>
                                    <input id="bln_transporte_publico_coletivo" type="text" class="form-control" name="bln_transporte_publico_coletivo" value="@if($insercaoUrbana->bln_transporte_publico_coletivo) Sim @else Não @endif" disabled>
                                </div> 
                            </div>   <!-- row-->    
                            @if($insercaoUrbana->bln_transporte_publico_coletivo)
                                <label class="control-label "><strong style="color:grey">3.1.1 Se houver transporte público coletivo:</strong></label>
                                <div class="row">
                                        <div class="column col-xs-12 col-md-12">
                                                <label class="control-label ">a) Distância caminhável, em metros, do ponto ou terminal de embarque e desembarque de passageiros mais próximo ao terreno</label>
                                                <input id="vlr_distancia_ponto" type="text" class="form-control" name="vlr_distancia_ponto" value=" {{$insercaoUrbana->vlr_distancia_ponto}}" disabled>
                                        </div> 
                            
                                </div>   <!-- row-->                           
                            @endif  
                        </div>
                    </td>
                </tr>    

                <tr data-toggle="collapse" data-target="#accordion3" class="clickable">
                    <td>Ao menos uma linha atenda o ponto de ônibus existente</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_3) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="accordion3" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-5">
                                    <label class="control-label "><strong style="color:grey">3.1 O Município dispõe de transporte público coletivo?</strong></label>
                                    <input id="bln_transporte_publico_coletivo" type="text" class="form-control" name="bln_transporte_publico_coletivo" value="@if($insercaoUrbana->bln_transporte_publico_coletivo) Sim @else Não @endif" disabled>
                                </div> 
                            </div>   <!-- row-->    
                            @if($insercaoUrbana->bln_transporte_publico_coletivo)
                                <label class="control-label "><strong style="color:grey">3.1.1 Se houver transporte público coletivo:</strong></label>
                                <div class="row">
                                        <div class="column col-xs-12 col-md-12">
                                            <label class="control-label ">b) Quantos itinerários estão disponíveis para o ponto mencionado</label>
                                            <input id="num_itinerarios" type="text" class="form-control" name="num_itinerarios" value=" {{$insercaoUrbana->num_itinerarios}}" disabled>
                                        </div> 
                            
                                </div>   <!-- row-->                           
                            @endif  
                        </div>
                    </td>
                </tr>
                <tr data-toggle="collapse" data-target="#accordion4" class="clickable">
                    <td>Mercearia, mercadinho, padaria ou farmácia (3.2, I, a), b) ou c)) a uma distância caminhável de até 1000 metros</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_4) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion4" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">
                                    @if($insercaoUrbana->bln_mercadinho_mercado )
                                        <label class="control-label ">- Mercadinho ou mercearia</label>
                                        <input id="vlr_dist_mts_mercadinho" type="text" class="form-control" name="vlr_dist_mts_mercadinho" value=" {{$insercaoUrbana->vlr_dist_mts_mercadinho}}" disabled>
                                    @endif
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                    @if($insercaoUrbana->bln_padaria)
                                        <label class="control-label ">- Padaria</label>
                                        <input id="vlr_dist_mts_padaria" type="text" class="form-control" name="vlr_dist_mts_padaria" value=" {{$insercaoUrbana->vlr_dist_mts_padaria}}" disabled>
                                    @endif    
                                </div> 
                                <div class="column col-xs-12 col-md-4">
                                    @if($insercaoUrbana->bln_farmacia)
                                        <label class="control-label ">-	Farmácia ou Drogaria</label>
                                        <input id="vlr_dist_mts_farmacia" type="text" class="form-control" name="vlr_dist_mts_farmacia" value=" {{$insercaoUrbana->vlr_dist_mts_farmacia}}" disabled>
                                    @endif
                                </div> 
                        </div>   <!-- row-->
                        </div>
                    </td>
                </tr>  
                <tr data-toggle="collapse" data-target="#accordion5" class="clickable">
                    <td>Supermercado, agência bancária, lotéricas ou correios (3.2, II, a), b), c) ou d)) a uma distância caminhável de até 1500 metros</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_5) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion5" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-6">
                                    
                                    <label class="control-label ">- Supermercado @if(!$insercaoUrbana->bln_supermercado ) <span class="text-danger">(Não possui)</span> @endif</label>
                                    <div class="row">
                                        
                                            <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Distância</label>
                                                <input id="vlr_dist_mts_supermercado" type="text" class="form-control" name="vlr_dist_mts_supermercado" value=" {{$insercaoUrbana->vlr_dist_mts_supermercado}}" disabled>
                                            </div>    
                                            <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Tempo</label>
                                                <input id="num_tempo_min_supermercado" type="text" class="form-control" name="num_tempo_min_supermercado" value=" {{$insercaoUrbana->num_tempo_min_supermercado}}" disabled>
                                            </div>    
                                    </div>   <!-- row-->                           
                                
                                </div> 
                                <div class="column col-xs-12 col-md-6">
                                    
                                    <label class="control-label ">- Agência bancária @if(!$insercaoUrbana->bln_agencia_bancaria ) <span class="text-danger">(Não possui)</span> @endif</label>
                                    <div class="row">
                                        
                                            <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Distância</label>
                                                <input id="vlr_dist_mts_ag_bancaria" type="text" class="form-control" name="vlr_dist_mts_ag_bancaria" value=" {{$insercaoUrbana->vlr_dist_mts_ag_bancaria}}" disabled>
                                            </div>    
                                            <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Tempo</label>
                                                <input id="num_tempo_min_ag_bancaria" type="text" class="form-control" name="num_tempo_min_ag_bancaria" value=" {{$insercaoUrbana->num_tempo_min_ag_bancaria}}" disabled>
                                            </div>    
                                    </div>   <!-- row-->                           
                                
                                </div> 
                                                                        
                            </div>   <!-- row-->    
                            <div class="row">
                                <div class="column col-xs-12 col-md-6">
                                    <label class="control-label ">- Agência dos correios @if(!$insercaoUrbana->bln_agencia_correios ) <span class="text-danger">(Não possui)</span> @endif</label>
                                    <div class="row">
                                        
                                            <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Distância</label>
                                                <input id="vlr_dist_mts_correios" type="text" class="form-control" name="vlr_dist_mts_correios" value=" {{$insercaoUrbana->vlr_dist_mts_correios}}" disabled>
                                            </div>    
                                            <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Tempo</label>
                                                <input id="num_tempo_min_correios" type="text" class="form-control" name="num_tempo_min_correios" value=" {{$insercaoUrbana->num_tempo_min_correios}}" disabled>
                                            </div>    
                                    </div>   <!-- row-->                           
                                
                                </div> 
                                <div class="column col-xs-12 col-md-6">
                                    
                                    <label class="control-label ">- Lotérica @if(!$insercaoUrbana->bln_loterica ) <span class="text-danger">(Não possui)</span> @endif</label>
                                    <div class="row">
                                        
                                            <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Distância</label>
                                                <input id="vlr_dist_mts_loterica" type="text" class="form-control" name="vlr_dist_mts_loterica" value=" {{$insercaoUrbana->vlr_dist_mts_loterica}}" disabled>
                                            </div>    
                                            <div class="column col-xs-12 col-md-6">
                                                <label class="control-label ">Tempo</label>
                                                <input id="num_tempo_min_loterica" type="text" class="form-control" name="num_tempo_min_loterica" value=" {{$insercaoUrbana->num_tempo_min_loterica}}" disabled>
                                            </div>    
                                    </div>   <!-- row-->   
                                </div> 
                                                                    
                            </div>   <!-- row-->  
                        </div>
                    </td>
                </tr>   
                <tr data-toggle="collapse" data-target="#accordion6" class="clickable">
                    <td>Escola pública de educação infantil (3.2, III, a)) a uma distância caminhável de até 1000 metros</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_6) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion6" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">                                            
                                    <label class="control-label ">-	Escola pública de educação infantil @if(!$insercaoUrbana->bln_escola_ed_infantil ) <span class="text-danger">(Não possui)</span> @endif</label>
                                </div>                                                     
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Distância</label>
                                    <input id="vlr_dist_mts_ed_inf" type="text" class="form-control" name="vlr_dist_mts_ed_inf" value=" {{$insercaoUrbana->vlr_dist_mts_ed_inf}}" disabled>
                                </div>    
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Tempo</label>
                                    <input id="num_tempo_min_ed_inf" type="text" class="form-control" name="num_tempo_min_ed_inf" value=" {{$insercaoUrbana->num_tempo_min_ed_inf}}" disabled>
                                </div>    
                            </div>   <!-- row-->                                            
                        </div>
                    </td>
                </tr>   
                <tr data-toggle="collapse" data-target="#accordion7" class="clickable">
                    <td>Escola pública de ensino fundamental - Ciclo I (3.2, III, b)) a uma distância caminhável de até 1500 metros</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_7) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion7" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">                                            
                                    <label class="control-label ">- Escola pública de ensino fundamental (ciclo I) @if(!$insercaoUrbana->bln_escola_ed_fund_ciclo_1 ) <span class="text-danger">(Não possui)</span> @endif</label>
                                </div>
                                        
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Distância</label>
                                    <input id="vlr_dist_mts_ed_fund_c1" type="text" class="form-control" name="vlr_dist_mts_ed_fund_c1" value=" {{$insercaoUrbana->vlr_dist_mts_ed_fund_c1}}" disabled>
                                </div>    
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Tempo</label>
                                    <input id="num_tempo_min_ed_fund_c1" type="text" class="form-control" name="num_tempo_min_ed_fund_c1" value=" {{$insercaoUrbana->num_tempo_min_ed_fund_c1}}" disabled>
                                </div>    
                                
                            </div>   <!-- row-->                                                                   


                        </div>
                    </td>
                </tr>  
                <tr data-toggle="collapse" data-target="#accordion8" class="clickable">
                    <td>Escola pública de ensino fundamental - Ciclo II (3.2, III, c)) a uma distância caminhável de até 1500 metros</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_8) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion8" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">                                            
                                    <label class="control-label ">- Escola pública de ensino fundamental (ciclo II) @if(!$insercaoUrbana->bln_escola_ed_fund_ciclo_2 ) <span class="text-danger">(Não possui)</span> @endif</label>
                                </div>                                                
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Distância</label>
                                    <input id="vlr_dist_mts_ed_fund_c2" type="text" class="form-control" name="vlr_dist_mts_ed_fund_c2" value=" {{$insercaoUrbana->vlr_dist_mts_ed_fund_c2}}" disabled>
                                </div>    
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Tempo</label>
                                    <input id="num_tempo_min_ed_fund_c2" type="text" class="form-control" name="num_tempo_min_ed_fund_c2" value=" {{$insercaoUrbana->num_tempo_min_ed_fund_c2}}" disabled>
                                </div>    
                            </div>   <!-- row-->   
                        </div>
                    </td>
                </tr>   
                <tr data-toggle="collapse" data-target="#accordion9" class="clickable">
                    <td>Equipamento de proteção social básica - CRAS (3.2, III, d)) a uma distância caminhável de até 2000 metros</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_9) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion9" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">                                            
                                    <label class="control-label ">- Centro de Referência de Assistência Social (CRAS) @if(!$insercaoUrbana->bln_cras ) <span class="text-danger">(Não possui)</span> @endif</label>
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Distância</label>
                                    <input id="vlr_dist_mts_cras" type="text" class="form-control" name="vlr_dist_mts_cras" value=" {{$insercaoUrbana->vlr_dist_mts_cras}}" disabled>
                                </div>    
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Tempo</label>
                                    <input id="num_tempo_min_cras" type="text" class="form-control" name="num_tempo_min_cras" value=" {{$insercaoUrbana->num_tempo_min_cras}}" disabled>
                                </div>    
                            </div>   <!-- row-->                           
                        </div>
                    </td>
                </tr>   
                <tr data-toggle="collapse" data-target="#accordion10" class="clickable">
                    <td>Equipamento de saúde básica - UBS (3.2, III, e)) a uma distância caminhável de até 2500 metros</td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_10) Sim @else Não @endif</td>
                </tr>
                <tr class="table table-bordered">
                    <td colspan="4">
                        <div id="accordion10" class="collapse">
                            <div class="row">                                        
                                <div class="column col-xs-12 col-md-4">                                            
                                    <label class="control-label ">- Unidade Básica de Saúde (UBS) @if(!$insercaoUrbana->bln_ubs ) <span class="text-danger">(Não possui)</span> @endif</label>
                                </div>
                                        
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Distância</label>
                                    <input id="vlr_dist_mts_ubs" type="text" class="form-control" name="vlr_dist_mts_ubs" value=" {{$insercaoUrbana->vlr_dist_mts_ubs}}" disabled>
                                </div>    
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Tempo</label>
                                    <input id="num_tempo_min_ubs" type="text" class="form-control" name="num_tempo_min_ubs" value=" {{$insercaoUrbana->num_tempo_min_ubs}}" disabled>
                                </div>    
                            </div>   <!-- row-->  
                        </div>
                    </td>
                </tr>  
                <tr class="table-secondary" >
                    <td rowspan="8" class="align-middle"> 3.6 Como critérios de habilitação, os terrenos ofertados para a parceria devem atender, no mínimo, o seguinte:</td>
                    <td data-toggle="collapse" data-target="#accordion11" class="clickable">a) Comportar entre 100 e 150 unidades habitacionais.</td>
                    <td>
                        <div class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="requisitos_habilitacao_id_11" id="requisitos_habilitacao_id_11-1" value="true" required>
                                <label class="form-check-label" for="exampleRadios1">
                                Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="requisitos_habilitacao_id_11" id="requisitos_habilitacao_id_11-2" value="false" required>
                                <label class="form-check-label" for="exampleRadios2">
                                Não
                                </label>
                            </div>
                        </div>

                    </td>
                </tr>
                <tr  class="table table-bordered">
                    <td colspan="4">
                        <div id="accordion11" class="collapse">
                            <div class="row">                                
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label ">1.3 Qual a área do terreno em m²?</label>
                                    <input id="vlr_area_terreno" type="text" class="form-control" name="vlr_area_terreno" value="{{$caracTerreno->vlr_area_terreno}} m²" disabled>
                                </div> 
                            </div>  
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                                                            
                                        <label class="control-label ">1.11 Planta do terreno com indicação das coordenadas geográficas</label>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome do Arquivo</th>
                                                    <th>Arquivo</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($plantaTerreno as $dados)
                                                        <tr>
                                                            <td >{{$dados->id}}</td>
                                                            <td>{{$dados->txt_nome_arquivo}}</td>
                                                            <td><a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dados->txt_caminho_planta")}}'><i class="fas fa-file-image fa-2x"></i></a></td>
                                                        </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>

                                </div>
                            </div>   <!-- row--> 
                        </div>
                    </td>
                </tr>    
                <tr  class="table-secondary" >
                    <td data-toggle="collapse" data-target="#accordion12" class="clickable">b) Ter a titularidade comprovada em nome do Ente Público proponente ou das companhias, autarquias e agencias de habitação associadas à ABC, ou ainda de município parceiro.</td>
                    <td>
                        <div class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="requisitos_habilitacao_id_12" id="requisitos_habilitacao_id_12-1" value="true" required>
                                <label class="form-check-label" for="exampleRadios1">
                                Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="requisitos_habilitacao_id_12" id="requisitos_habilitacao_id_12-2" value="false" required>
                                <label class="form-check-label" for="exampleRadios2">
                                Não
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion12" class="collapse">
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <div class="media"> 
                                        <div class="media-body">                                          
                                            <label class="control-label ">1.1 Cópia da documentação registrada em cartório com a comprovação da titularidade do terreno</label>
                                        </div>
                                        <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$caracTerreno->txt_caminho_doc_cartorio")}}'><i class="fas fa-file-image fa-2x"></i></a>                         
                                    </div>
                                </div>
                            </div> 
                            <!-- row-->  
                            <div class="row"> 
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">1.4 Quem é o proprietário do terreno?</label>
                                    <input id="txt_proprietario_terreno" type="text" class="form-control" name="txt_proprietario_terreno" value="{{$caracTerreno->txt_proprietario_terreno}}" disabled>
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">1.5 Situação da titularidade do terreno?</label>
                                    <input id="txt_titularidade_terreno" type="text" class="form-control" name="txt_titularidade_terreno" value="{{$caracTerreno->txt_titularidade_terreno}}" disabled>
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    @if($caracTerreno->titularidade_terreno_id == 3)
                                        <label class="control-label ">1.5.1 Terreno registrado em nome de</label>
                                        <input id="txt_terreno_terceiro" type="text" class="form-control" name="txt_terreno_terceiro" value="{{$caracTerreno->txt_terreno_terceiro}}" disabled>
                                    @endif
                                </div>    
                            </div>   <!-- row-->  
                        </div>
                    </td>
                </tr>   
                <tr  class="table-secondary" >
                    <td data-toggle="collapse" data-target="#accordion13" class="clickable">c) Dispor dos requisitos obrigatórios de Inserção Urbana, constantes na Tabela 1 do Anexo I da Portaria nº 959, de 18 de maio de 2021.</td>
                    <td>
                        <div class="row">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="requisitos_habilitacao_id_13" id="requisitos_habilitacao_id_13-1" value="true" required>
                                <label class="form-check-label" for="exampleRadios1">
                                Sim
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="requisitos_habilitacao_id_13" id="requisitos_habilitacao_id_13-2" value="false" required>
                                <label class="form-check-label" for="exampleRadios2">
                                Não
                                </label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion13" class="collapse">
                            <div class="row" >        
                                <label for="situacao_terreno">1.10 Situação do terreno proposto:</label>   
                            
                                <div class="column col-xs-12 col-md-12">
                                    @foreach($situacaoTerreno as $dados)
                                        <div class="form-check">
                                            <input class="form-check-input" 
                                                type="radio" 
                                                name="exampleRadios" 
                                                id="exampleRadios{{$dados->id}}" 
                                                value="{{$dados->id}}"
                                                @if($caracTerreno->situacao_terreno_id = $dados->id) checked @endif
                                            >
                                            @if($dados->id != 99)
                                                <label class="form-check-label" for="exampleRadios{{$dados->id}}">{{$dados->txt_situacao_terreno}}</label>
                                            @else
                                            <div class="column col-xs-12 col-md-12">
                                                <label class="form-check-label form-inline" for="exampleRadios1">
                                                    {{$dados->txt_situacao_terreno}} 
                                                    @if($dados->id == 99)
                                                        : {{$caracTerreno->txt_outra_situacao_terreno}}
                                                    @endif
                                                </label>
                                            </div> 
                                            @endif
                                        </div>
                                            @endforeach
                                    
                                </div>             
                            
                                <div class="column col-xs-12 col-md-12">
                                    <label for="origem_recurso">1.10.1 Indicar legislação e artigo(s) pertinente(s): </label>   
                                    <input type="text" name="txt_legislacao_artigos" class="form-control" value="{{$caracTerreno->txt_legislacao_artigos}}" required>
                                </div>       
                            </div>
                            <div class="row">
                                <div class="column col-xs-12 col-md-12">
                                    <label class="control-label ">2.1 Sistemas de infraestrutura básica estão disponíveis no acesso ao terreno (não assinalar obras em andamento)</label>
                                    <div class="row">
                                        @if($infraBasica->bln_sistema_abastecimento)
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxAbastecimentoAgua" value="option1" @if($infraBasica->bln_sistema_abastecimento) checked @endif disabled>
                                                <label class="form-check-label" for="inlineCheckbox1">Sistema de abastecimento de água</label>
                                            </div>
                                        </div>
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_abast" value="{{$infraBasica->vlr_dist_sis_abast}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_sistema_coleta_esgoto)
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxEsgoto" value="option2" @if($infraBasica->bln_sistema_coleta_esgoto) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de coleta e destinação de esgoto</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_coleta" value="{{$infraBasica->vlr_dist_sis_coleta}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_sistema_coleta_lixo)
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxLixo" value="option2" @if($infraBasica->bln_sistema_coleta_lixo) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de coleta e destinação de lixo</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_coleta_lixo" value="{{$infraBasica->vlr_dist_sis_coleta_lixo}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            </div>
                                        @endif    
                                        @if($infraBasica->bln_sistema_renagem_ag_pluviais)
                                        <div class="column col-xs-12 col-md-12">                                            
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxAguasPluviais" value="option3" @if($infraBasica->bln_sistema_renagem_ag_pluviais) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Sistema de drenagem de águas pluviais</label>
                                            </div>
                                        </div>  
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_dren_ag_pluv" value="{{$infraBasica->vlr_dist_sis_dren_ag_pluv}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div>                                                         
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_dist_energia_eletrica)
                                        <div class="column col-xs-12 col-md-12">  
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxEnergiaEletrica" value="option1" @if($infraBasica->bln_dist_energia_eletrica) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox1">Sistema de distribuição de energia elétrica</label>
                                            </div>
                                        </div>  
                                        
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_dist_ener_elet" value="{{$infraBasica->vlr_dist_sis_dist_ener_elet}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div>                                                         
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_iluminacao_publica)
                                        <div class="column col-xs-12 col-md-12">         
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxIluminacao" value="option2" @if($infraBasica->bln_iluminacao_publica) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox2">Sistema de iluminação pública</label>
                                            </div>
                                        </div>  
                                        
                                        <div class="column col-xs-12 col-md-12">          
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_ilum_pub" value="{{$infraBasica->vlr_dist_sis_ilum_pub}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_guias_sarjetas)
                                        <div class="column col-xs-12 col-md-12">   
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxGuiasSarjetas" value="option3" @if($infraBasica->bln_guias_sarjetas) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Guias e sarjetas</label>
                                            </div>
                                        </div>
                                        <div class="column col-xs-12 col-md-12"> 
                                                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_guias_sarj" value="{{$infraBasica->vlr_dist_sis_guias_sarj}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                
                                        </div>
                                        @endif
                                        @if($infraBasica->bln_pavimentacao)                               
                                        <div class="column col-xs-12 col-md-12">       
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="ckboxPavimentacao" value="option3" @if($infraBasica->bln_pavimentacao) checked @endif  disabled>
                                                <label class="form-check-label" for="inlineCheckbox3">Pavimentação</label>
                                            </div>
                                        </div>   
                                        <div class="column col-xs-12 col-md-12">                                                            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group mb-3">            
                                                        <input type="number" class="form-control" name="vlr_dist_sis_pavim" value="{{$infraBasica->vlr_dist_sis_pavim}}"  disabled>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Metros</span>
                                                        </div>
                                                    </div> 
                                                </div> 
                                            
                                        </div>
                                        @endif                              
                                    </div>   <!-- row-->                                     
                                </div>
                            </div>   <!-- row-->  
                            <div class="row">
                                <div class="column col-xs-12 col-md-5">
                                    <label class="control-label "><strong style="color:grey">3.1 O Município dispõe de transporte público coletivo?</strong></label>
                                    <input id="bln_transporte_publico_coletivo" type="text" class="form-control" name="bln_transporte_publico_coletivo" value="@if($insercaoUrbana->bln_transporte_publico_coletivo) Sim @else Não @endif" disabled>
                                </div> 
                            </div>   <!-- row-->    
                            @if($insercaoUrbana->bln_transporte_publico_coletivo)
                                <label class="control-label "><strong style="color:grey">3.1.1 Se houver transporte público coletivo:</strong></label>
                                <div class="row">
                                        <div class="column col-xs-12 col-md-12">
                                            <label class="control-label ">b) Quantos itinerários estão disponíveis para o ponto mencionado</label>
                                            <input id="num_itinerarios" type="text" class="form-control" name="num_itinerarios" value=" {{$insercaoUrbana->num_itinerarios}}" disabled>
                                        </div> 
                            
                                </div>   <!-- row-->                           
                            @endif  
                            <label class="control-label "><strong style="color:grey">3.2 Informar a distância caminhável ou o tempo de deslocamento por transporte público para os seguintes equipamentos e serviços:</strong></label>
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">                                            
                                    <label class="control-label ">-	Escola pública de educação infantil @if(!$insercaoUrbana->bln_escola_ed_infantil ) <span class="text-danger">(Não possui)</span> @endif</label>
                                </div>                                                     
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Distância</label>
                                    <input id="vlr_dist_mts_ed_inf" type="text" class="form-control" name="vlr_dist_mts_ed_inf" value=" {{$insercaoUrbana->vlr_dist_mts_ed_inf}}" disabled>
                                </div>    
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Tempo</label>
                                    <input id="num_tempo_min_ed_inf" type="text" class="form-control" name="num_tempo_min_ed_inf" value=" {{$insercaoUrbana->num_tempo_min_ed_inf}}" disabled>
                                </div>    
                            </div>   <!-- row-->   
                            <div class="row">
                                <div class="column col-xs-12 col-md-4">                                            
                                    <label class="control-label ">- Escola pública de ensino fundamental (ciclo I) @if(!$insercaoUrbana->bln_escola_ed_fund_ciclo_1 ) <span class="text-danger">(Não possui)</span> @endif</label>
                                </div>
                                        
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Distância</label>
                                    <input id="vlr_dist_mts_ed_fund_c1" type="text" class="form-control" name="vlr_dist_mts_ed_fund_c1" value=" {{$insercaoUrbana->vlr_dist_mts_ed_fund_c1}}" disabled>
                                </div>    
                                <div class="column col-xs-12 col-md-4">
                                    <label class="control-label ">Tempo</label>
                                    <input id="num_tempo_min_ed_fund_c1" type="text" class="form-control" name="num_tempo_min_ed_fund_c1" value=" {{$insercaoUrbana->num_tempo_min_ed_fund_c1}}" disabled>
                                </div>    
                                
                            </div>   <!-- row-->    
                        </div>
                    </td>
                </tr>
                <tr  class="table-secondary" >
                    <td data-toggle="collapse" data-target="#accordion14" class="clickable">e) Estar localizado a uma distância máxima de até 200 quilômetros de aeroporto comercial, tendo em vista o caráter experimental dos empreendimentos.  </td>
                    <td>@if($criteriosHabilitacao->requisitos_habilitacao_id_14) Sim @else Não @endif</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div id="accordion14" class="collapse">   
                            <label class="control-label ">V. Aeroporto Comercial:</label>                                                               
                        <div class="row">
                            <div class="column col-xs-12 col-md-12">
                                <div class="row">                                            
                                        <div class="column col-xs-12 col-md-6">
                                            <label class="control-label ">Distância ao aeroporto comercial mais próximo</label>
                                            <input id="vlr_dist_km_aerop_comercial" type="text" class="form-control" name="vlr_dist_km_aerop_comercial" value=" {{$insercaoUrbana->vlr_dist_km_aerop_comercial}}" disabled>
                                        </div>    
                                        <div class="column col-xs-12 col-md-6">
                                        
                                        </div>    
                                </div>   <!-- row-->                                
                            </div>   <!-- row-->       
                        </div>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>  <!-- row-->  
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="sistema_em_obras">Observações</label>  
            <textarea class="form-control" id="txt_observacao" name="txt_observacao"  rows="10"></textarea>
        </div>
    </div>  <!-- row-->  
</div><!-- form-group-->  


<div class="form-group">
    <div class="row">
        <div class="column col-xs-12 col-md-6">
            <input class="btn btn-lg btn-info btn-block" type="submit" name="finalizar" value="Finalizar Análise">    
        </div>
        <div class="column col-xs-12 col-md-6">
            <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">
        </div>    
    </div>
</div> <!-- form-group -->