<template>
<div class="form-group">    
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="transporte_publico_coletivo">3.1 O Município dispõe de transporte público coletivo?</label>   
            <select 
                id="bln_transporte_publico_coletivo"
                class="form-control" 
                name="bln_transporte_publico_coletivo"               
                v-model="bln_transporte_publico_coletivo"
                required>
                <option value="" selected>Responda se dispõe de transporte público coletivo:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
    </div>
 
 <div class="row"  v-if='bln_transporte_publico_coletivo == 1'>
        <div class="column col-xs-12 col-md-12">
            <label for="transporte_publico_coletivo">3.1.1 Se houver transporte público coletivo:</label>   
            <em>* Favor utilizar a ferramenta Google Maps, disponível online, para calcular os valores. Não utilizar a distância em linha reta. Deve ser considerado o
            centro do terreno como ponto de partida.</em>
        </div>    
        <div class="column col-xs-12 col-md-12">
        
                <label for="vlr_distancia_ponto">a) Distância caminhável, <strong>em metros</strong>, do ponto ou terminal de embarque e desembarque de passageiros mais próximo ao terreno</label>   
                <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_distancia_ponto" min="1" v-model="vlr_distancia_ponto" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Metros</span>
                </div>
            </div>

              
            </div>
        <div class="column col-xs-12 col-md-12">
            <label for="num_itinerarios">b) Quantas linhas atendem o ponto mencionado:</label>   
            <input type="number" name="num_itinerarios" class="form-control" min="0" v-model="num_itinerarios">
        </div>
          
    </div> 
    <div class="linha-separa"></div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="transporte_publico_coletivo">3.2 Informar a distância caminhável e/ou o tempo de deslocamento por transporte público para os seguintes equipamentos
             e serviços:</label>   
            <em>* Favor utilizar a ferramenta Google Maps, disponível online, para calcular os valores. Não utilizar a distância em linha reta. Deve ser considerado o centro 
            do terreno como ponto de partida. O tempo de deslocamento por transporte público deve considerar o tempo do trecho de caminhada até o ponto de embarque e após o
             desembarque e ser simulado para partida às 12h00 de uma quarta-feira de dia útil.</em>
        </div>    
                 
    </div>
    
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="estabeleciomento_cotidiano">I.	Estabelecimentos de uso cotidiano:</label> 
        </div>        
    </div>        
    <div class="row" >
        <div class="column col-xs-12 col-md-6">
            <label  class="col-form-label" for="mercadinho_mercado">a) Mercadinho ou mercearia?</label>   
            <select 
                id="bln_mercadinho_mercado"
                class="form-control" 
                name="bln_mercadinho_mercado"               
                v-model="bln_mercadinho_mercado"
                required>
                <option value="" selected>Responda se dispõe de Mercadinho ou mercearia:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
           
        <div class="column col-xs-12 col-md-6" v-if='bln_mercadinho_mercado == 1'>      
            <label class="col-form-label" for="dist_mts_mercadinho">Distância Caminhável</label>         
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_mercadinho" min="1" v-model="vlr_dist_mts_mercadinho" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_mercadinho">Metros</span>
                </div>
            </div>
        </div>  
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-6">
            <label class="col-form-label"  for="padaria">b)	Padaria:</label>   
            <select 
                id="bln_padaria"
                class="form-control" 
                name="bln_padaria"               
                v-model="bln_padaria"
                required>
                <option value="" selected>Responda se dispõe de Padaria:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
        <div class="column col-xs-12 col-md-6" v-if='bln_padaria == 1'>      
            <label class="col-form-label" for="dist_mts_padaria">Distância Caminhável</label>         
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_padaria" min="1" v-model="vlr_dist_mts_padaria" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_padaria">Metros</span>
                </div>
            </div>
        </div>  
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-6">
            <label class="col-form-label" for="farmacia">c) Farmácia ou Drogaria</label>   
            <select 
                id="bln_farmacia"
                class="form-control" 
                name="bln_farmacia"               
                v-model="bln_farmacia"
                required>
                <option value="" selected>Responda se dispõe de Farmácia ou Drogaria:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>  
        <div class="column col-xs-12 col-md-6" v-if='bln_farmacia == 1'>      
            <label class="col-form-label"  for="dist_mts_farmacia">Distância Caminhável</label>         
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_farmacia" min="1" v-model="vlr_dist_mts_farmacia" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_farmacia">Metros</span>
                </div>
            </div>
        </div>  
    </div>
<div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="equip_uso_eventual">II.	Estabelecimentos de uso eventual:</label> 
        </div>        
    </div>        
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label" for="supermercado">a) Supermercado?</label>   
            <select 
                id="bln_supermercado"
                class="form-control" 
                name="bln_supermercado"               
                v-model="bln_supermercado"
                required>
                <option value="" selected>Responda se dispõe de Supermercado:</option>
                <option value="1" >SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
  
            
        <div class="column col-xs-12 col-md-4" v-if='bln_supermercado == 1'>    
            <label class="col-form-label" for="inlineCheckbox1">Distância Caminhável</label>
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_supermercado" min="1" v-model="vlr_dist_mts_supermercado" >
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_supermercado">Metros</span>
                </div>
            </div>
        </div>    
        <div class="column col-xs-12 col-md-4" v-if='bln_supermercado == 1'> 
            <label class="col-form-label" for="inlineCheckbox1">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_supermercado" v-model="num_tempo_min_supermercado" min="0" >
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_supermercado">Minutos</span>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label" for="agencia_bancaria">b) Agência bancária?</label>   
            <select 
                id="bln_agencia_bancaria"
                class="form-control" 
                name="bln_agencia_bancaria"               
                v-model="bln_agencia_bancaria"
                required>
                <option value="" selected>Responda se dispõe de Agência bancária:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>         
            
        <div class="column col-xs-12 col-md-4" v-if='bln_agencia_bancaria == 1'> 
            <label class="col-form-label" for="dist_mts_ag_bancaria">Distância Caminhável</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_ag_bancaria" v-model="vlr_dist_mts_ag_bancaria" min="1"  >
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ag_bancaria">Metros</span>
                </div>
            </div>
        </div>    
        
        <div class="column col-xs-12 col-md-4" v-if='bln_agencia_bancaria == 1'>     
            <label class="col-form-label" for="tempo_min_ag_bancaria">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ag_bancaria" v-model="num_tempo_min_ag_bancaria" min="0"  >
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ag_bancaria">Minutos</span>
                </div>
            </div>
        </div>        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label" for="agencia_correios">c) Agência dos Correios?</label>   
            <select 
                id="bln_agencia_correios"
                class="form-control" 
                name="bln_agencia_correios"               
                v-model="bln_agencia_correios"
                required>
                <option value="" selected>Responda se dispõe de Agência dos Correios:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
        <div class="column col-xs-12 col-md-4" v-if='bln_agencia_correios == 1'>   
           <label class="col-form-label" for="dist_mts_correios">Distância Caminhável</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_correios" v-model="vlr_dist_mts_correios"  min="1"  >
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_correios">Metros</span>
                </div>
            </div>
        </div>    
        <div class="column col-xs-12 col-md-4" v-if='bln_agencia_correios == 1'>     
            <label class="col-form-label" for="tempo_min_correios">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_correios" v-model="num_tempo_min_correios" min="0" >
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_correios">Minutos</span>
                </div>
            </div>
        </div>        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label"  for="loterica">d) Lotérica?</label>   
            <select 
                id="bln_loterica"
                class="form-control" 
                name="bln_loterica"               
                v-model="bln_loterica"
                required>
                <option value="" selected>Responda se dispõe de Lotérica:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
        <div class="column col-xs-12 col-md-4" v-if='bln_loterica == 1'>   
            <label class="col-form-label" for="dist_mts_loterica">Distância Caminhável</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_loterica" v-model="vlr_dist_mts_loterica" min="1" >
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_loterica">Metros</span>
                </div>
            </div>
        </div>    
        <div class="column col-xs-12 col-md-4" v-if='bln_loterica == 1'>  
            <label class="col-form-label" for="tempo_min_loterica">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_loterica" v-model="num_tempo_min_loterica" min="0" >
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_loterica">Minutos</span>
                </div>
            </div>
        </div>        
    </div>
 
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="equip_pulic">III. Equipamentos Públicos Comunitários:</label> 
        </div>        
    </div>        
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label" for="escola_ed_infantil">a) Escola pública de educação infantil?</label>   
            <select 
                id="bln_escola_ed_infantil"
                class="form-control" 
                name="bln_escola_ed_infantil"               
                v-model="bln_escola_ed_infantil"
                required>
                <option value="" selected>Responda se dispõe de Escola pública de educação infantil:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
        <div class="column col-xs-12 col-md-4" v-if='bln_escola_ed_infantil == 1'>    
           <label class="col-form-label" for="dist_mts_ed_inf">Distância Caminhável</label>
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_ed_inf" 
                    v-model="vlr_dist_mts_ed_inf"  min="1">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ed_inf">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-4" v-if='bln_escola_ed_infantil == 1'> 
        <!--
            <label class="col-form-label" for="tempo_min_ed_inf">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ed_inf" 
                v-model="num_tempo_min_ed_inf" min="0">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ed_inf">Minutos</span>
                </div>
            </div>
            -->
        </div>        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label" for="escola_ed_fund_ciclo_1">b)	Escola pública de ensino fundamental (ciclo I)?</label>   
            <select 
                id="bln_escola_ed_fund_ciclo_1"
                class="form-control" 
                name="bln_escola_ed_fund_ciclo_1"               
                v-model="bln_escola_ed_fund_ciclo_1"
                required>
                <option value="" selected>Responda se dispõe de Agência bancária:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
        <div class="column col-xs-12 col-md-4"  v-if='bln_escola_ed_fund_ciclo_1 == 1'>    
            <label class="col-form-label" for="dist_mts_ed_fund_c1">Distância Caminhável</label>
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_ed_fund_c1" 
                    v-model="vlr_dist_mts_ed_fund_c1"  min="1">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ed_fund_c1">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-4"  v-if='bln_escola_ed_fund_ciclo_1 == 1'> 
<!--
            <label class="col-form-label" for="tempo_min_ed_fund_c1">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ed_fund_c1" 
                v-model="num_tempo_min_ed_fund_c1" min="0">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ed_fund_c1">Minutos</span>
                </div>
            </div>
--> 
        </div>
       
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label" for="escola_ed_fund_ciclo_2">c) Escola pública de ensino fundamental (ciclo II)?</label>   
            <select 
                id="bln_escola_ed_fund_ciclo_2"
                class="form-control" 
                name="bln_escola_ed_fund_ciclo_2"               
                v-model="bln_escola_ed_fund_ciclo_2"
                required>
                <option value="" selected>Responda se dispõe de Escola pública de ensino fundamental (ciclo II):</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
        <div class="column col-xs-12 col-md-4" v-if='bln_escola_ed_fund_ciclo_2 == 1'>    
            <label class="col-form-label" for="dist_mts_ed_fund_c2">Distância Caminhável</label>
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_ed_fund_c2" 
                    v-model="vlr_dist_mts_ed_fund_c2"  min="1">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ed_fund_c2">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-4" v-if='bln_escola_ed_fund_ciclo_2 == 1'> 
            <label class="col-form-label" for="tempo_min_ed_fund_c2">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ed_fund_c2" 
                v-model="num_tempo_min_ed_fund_c2" min="0">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ed_fund_c2">Minutos</span>
                </div>
            </div>
        </div>    
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label" for="cras">d) Centro de Referência de Assistência Social (CRAS)?</label>   
            <select 
                id="bln_cras"
                class="form-control" 
                name="bln_cras"               
                v-model="bln_cras"
                required>
                <option value="" selected>Responda se dispõe de CRAS:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
        <div class="column col-xs-12 col-md-4" v-if='bln_cras == 1'>    
            <label class="col-form-label" for="dist_mts_cras">Distância Caminhável</label>
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_cras" 
                    v-model="vlr_dist_mts_cras"  min="1">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_cras">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-4" v-if='bln_cras == 1'> 
            <label class="col-form-label" for="tempo_min_cras">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_cras" 
                v-model="num_tempo_min_cras" min="0">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_cras">Minutos</span>
                </div>
            </div>
        </div>       
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-4">
            <label class="col-form-label" for="ubs">e)	Unidade Básica de Saúde (UBS)?</label>   
            <select 
                id="bln_ubs"
                class="form-control" 
                name="bln_ubs"               
                v-model="bln_ubs"
                required>
                <option value="" selected>Responda se dispõe de UBS:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
        <div class="column col-xs-12 col-md-4" v-if='bln_ubs == 1'>    
            <label class="col-form-label" for="dist_mts_ubs">Distância Caminhável</label>
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_ubs" 
                    v-model="vlr_dist_mts_ubs"  min="1">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ubs">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-4" v-if='bln_ubs == 1'> 
            <label class="col-form-label" for="tempo_min_ubs">Tempo (por transporte público)</label>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ubs" 
                v-model="num_tempo_min_ubs" min="0">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ubs">Minutos</span>
                </div>
            </div>
        </div>  
    </div>
    <div class="linha-separa"></div>
    
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="equip_esporte_cultura">IV.	Possui Equipamentos de esporte, cultura e lazer?</label>   
            <select 
                id="bln_equip_esporte_cultura"
                class="form-control" 
                name="bln_equip_esporte_cultura"               
                v-model="bln_equip_esporte_cultura"
                required>
                <option value="" selected>Responda se dispõe de equipamentos de esporte, cultura e lazer:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
    </div>

 <div class="row"  v-if='bln_equip_esporte_cultura == 1'>    
        <div class="column col-xs-12 col-md-8">
                <label for="equip_esporte_cultura">Qual(is):</label>   
                 <div class="input-group mb-3">
                <input type="text" class="form-control"  name="txt_equip_esporte_cultura" v-model="txt_equip_esporte_cultura" required>
                <div class="input-group-append">
                   
                </div>
            </div>
        </div>    
        <div class="column col-xs-12 col-md-4">      
            <label for="dist_mts_eq_esp_cult">Distância Caminhável</label>         
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_eq_esp_cult" min="1" v-model="vlr_dist_mts_eq_esp_cult" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Metros</span>
                </div>
            </div>
        </div>    
    </div>
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="equip_pulic">V. Aeroporto Comercial:</label> 
        </div>        
    </div>        
    <div class="row" >
          
        <div class="column col-xs-12 col-md-12">    
           <label class="col-form-label" for="dist_mts_aerop_comercial">Distância ao aeroporto comercial mais próximo</label>
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_km_aerop_comercial" 
                    v-model="vlr_dist_km_aerop_comercial"  min="1">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_km_aerop_comercial">quilômetros</span>
                </div>
            </div>
        </div> 
 
    </div>
     
    
    
         <input class="btn btn-lg btn-info btn-block" type="submit" value="Salvar">  
 </div>
</template>


<script>
    export default {
        props:['url','dados','dadosmapa'],
        data(){
            return{
                files: [],
                bln_transporte_publico_coletivo: '',
                vlr_distancia_ponto: 0, 
                num_itinerarios: 0,
                bln_equip_esporte_cultura: '',
                txt_equip_esporte_cultura: '',
                vlr_dist_mts_eq_esp_cult: 0,
                bln_mercadinho_mercado: '',
                vlr_dist_mts_mercadinho: 0,
                bln_padaria: '',
                vlr_dist_mts_padaria: 0,
                bln_farmacia: '',
                vlr_dist_mts_farmacia: 0,
                bln_supermercado: '',
                vlr_dist_mts_supermercado: 0,
                num_tempo_min_supermercado: 0,
                bln_agencia_bancaria: '',
                vlr_dist_mts_ag_bancaria: 0,
                num_tempo_min_ag_bancaria: 0,
                bln_agencia_correios: '',
                vlr_dist_mts_correios: 0,
                num_tempo_min_correios: 0,
                bln_loterica: '',
                num_tempo_min_loterica: 0, 
                vlr_dist_mts_loterica: 0,
                bln_restaurante_popular: '',
                num_tempo_min_rest_pop: 0, 
                vlr_dist_mts_rest_pop: 0,
                bln_escola_ed_infantil: '',
                num_tempo_min_ed_inf: 0, 
                vlr_dist_mts_ed_inf: 0,
                bln_escola_ed_fund_ciclo_1: '',
                num_tempo_min_ed_fund_c1: 0, 
                vlr_dist_mts_ed_fund_c1: 0,
                bln_escola_ed_fund_ciclo_2: '',
                num_tempo_min_ed_fund_c2: 0, 
                vlr_dist_mts_ed_fund_c2: 0,
                bln_cras: '',
                num_tempo_min_cras: 0, 
                vlr_dist_mts_cras: 0,
                bln_ubs: '',
                num_tempo_min_ubs: 0, 
                vlr_dist_mts_ubs: 0,
                bln_aeroporto_comercial: '',
                vlr_dist_km_aerop_comercial: 0,                 
                radioDisttempSuperm:'',
                radioDisttempAgBancaria:'',
                radioDisttempCorreios:'',
                radioDisttempCenCom:'',
                radioDisttempRestPopular:'',
                radioDisttempEdInf:'',
                radioDisttempEdFund1:'',
                radioDisttempEdFund2:'',
                radioDisttempCras:'',
                radioDisttempUbs:'',
                txt_caminho_mapa:'',
                num_arquivos:0,
                arquivosUpload:0,
                formValidado:0,
                quantArquivos:0,                
                txt_caminho_registro_rota:'',

              
               
            }        
        },
        methods:{
            handleFileSelect(evt) {
                    let tamanhoMaximo = 4 * 1024 * 1024;
                    var files = evt.target.files; // FileList object
                    var valido = true;
                    this.nomeArquivoFile = evt.target.name;
                    console.log('teste');

                      if(this.dadosmapa){
                        this.quantArquivos = this.dadosmapa.length + files.length;
                    }else{
                        this.quantArquivos = files.length;
                    }

console.log(this.quantArquivos);

                    for (var i = 0, f; f = files[i]; i++) {                        
                        if(this.quantArquivos > 3){
                            this.textoErroArquivo = "São permitidos apenas 3 arquivos.";
                            valido = false;
                            $("#txt_caminho_mapa").val("");
                            this.formValidado = 0;
                        }else if(files[i].size > tamanhoMaximo) {
                              this.textoErroArquivo = "O tamanho máximo é 4MB";  
                              
                              if(this.nomeArquivoFile == 'txt_caminho_mapa[]'){                               
                                valido = false;
                                $("#txt_caminho_mapa").val("");  
                                this.formValidado = 1;
                              }else if(this.nomeArquivoFile == 'txt_caminho_registro_rota'){ 
                                   valido = false;                                                                  
                                    $("#txt_caminho_registro_rota").val("");  
                                this.formValidado = 0;
                              }    

                        }else{     

                            if(this.nomeArquivoFile == 'txt_caminho_mapa[]'){                                                                                      
                                var extPermitidas = ['pdf', 'kmz','zip'];

                                if(this.verificaExtensao(files[i].name, extPermitidas)){
                                    valido = true;
                                    this.formValidado = 1;
                                }else{
                                    $("#txt_caminho_mapa").val("");
                                    this.textoErroArquivo = "Somente Kmz, Pdf e zip são aceitos";
                                    valido = false;
                                    this.formValidado = 0;
                                    break;
                                }
                            }else{
                                 var extPermitidas = ['pdf','zip'];
                                if(this.verificaExtensao(files[i].name, extPermitidas)){
                                    valido = true;
                                    this.formValidado = 1;
                                }else{
                                   
                                    this.textoErroArquivo = "Somente pdf e zip são aceitos";
                                     $("#txt_caminho_registro_rota").val("");
                                    valido = false;
                                    this.formValidado = 0;
                                    break;
                                }

                            }    
                                
                            } 
                        }                        
                     
                    
                    if(!valido){
                     Swal({
                            title: 'Atenção!',
                            text: this.textoErroArquivo,
                            type: 'warning',
                            showCancelButton: false,
                            cancelButtonColor: '#dc3545',
                            cancelButtonText: 'OK',
                            }).then((result) => {
                                if (result.value ) {                                   
                                    return;
                                }
                            })
                    }        
                },
                verificaExtensao($arquivo, $extPermitidas) {
                    
                    var extArquivo = $arquivo.split("\\").pop().substring($arquivo.split("\\").pop().lastIndexOf('.')+1, $arquivo.split("\\").pop().length) || $arquivo.split("\\").pop();
                   
                    if(typeof $extPermitidas.find(function(ext){ return extArquivo == ext; }) == 'undefined') {
                        return false;
                    } else {
                        return true;
                    }
                },
            onClickSubmit() {   

                             
                    if(this.bln_supermercado == 1){
                        if((this.vlr_dist_mts_supermercado+this.num_tempo_min_supermercado) == 0){
                            this.formValidado = 0;
                            return;
                        }
                    }

                    if(this.bln_agencia_bancaria == 1){
                        if((this.vlr_dist_mts_ag_bancaria+this.num_tempo_min_ag_bancaria) == 0){
                            this.formValidado = 0;
                            return;
                        }
                    }

                     if(this.bln_agencia_correios == 1){
                        if((this.vlr_dist_mts_correios+this.num_tempo_min_correios) == 0){
                            this.formValidado = 0;
                            return;
                        }
                    }

                     if(this.bln_loterica == 1){
                        if((this.num_tempo_min_loterica+this.vlr_dist_mts_loterica) == 0){
                            this.formValidado = 0;
                            return;
                        }
                    }
                    
                    if(this.bln_restaurante_popular == 1){
                            if((this.num_tempo_min_rest_pop+this.vlr_dist_mts_rest_pop) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

                    if(this.bln_escola_ed_infantil == 1){
                            if((this.num_tempo_min_ed_inf+this.vlr_dist_mts_ed_inf) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }
                    
                     if(this.bln_escola_ed_fund_ciclo_1 == 1){
                            if((this.num_tempo_min_ed_fund_c1+this.vlr_dist_mts_ed_fund_c1) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

                        if(this.bln_escola_ed_fund_ciclo_2 == 1){
                            if((this.num_tempo_min_ed_fund_c2+this.vlr_dist_mts_ed_fund_c2) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

                        if(this.bln_cras == 1){
                            if((this.num_tempo_min_cras+this.vlr_dist_mts_cras) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

                         if(this.bln_ubs == 1){
                            if((this.num_tempo_min_ubs+this.vlr_dist_mts_ubs) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

       
                       
               console.log(this.num_tempo_min_ubs+this.vlr_dist_mts_ubs);
               
               if(this.formValidado == 0){
                    Swal({
                        title: 'Atenção!',
                        text: "Deseja excluir este registro?",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#dc3545',
                        cancelButtonText: 'OK',
                        }).then((result) => {
                            if (result.value ) {
                                 return;
                            }
                        })
               }        
               
            }, 
            onClickEnviar(arquivo) {   
                             
               
                    Swal({
                        title: 'Atenção!',
                        text: "Deseja excluir este registro?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Sim',
                        cancelButtonText: 'Não',
                        }).then((result) => {
                            if (result.value ) {
                                 window.location.href= this.url + '/prototipo/insercaoUrbana/arquivo/excluir/'+ arquivo;
                            }else{
                             
                            }
                        })
               
            } 
        },
         mounted() {
               

             if(this.dados){
                if(this.dados.bln_transporte_publico_coletivo == 1){
                        this.bln_transporte_publico_coletivo = 1;
                        this.vlr_distancia_ponto= this.dados.vlr_distancia_ponto; 
                        this.num_itinerarios= this.dados.num_itinerarios;
                        
                }else{
                    this.bln_transporte_publico_coletivo = 0;                
                }
                
                if(this.dados.bln_equip_esporte_cultura == 1){
                        this.bln_equip_esporte_cultura = 1;
                        this.txt_equip_esporte_cultura= this.dados.txt_equip_esporte_cultura; 
                        this.vlr_dist_mts_eq_esp_cult= this.dados.vlr_dist_mts_eq_esp_cult;
                        
                }else{
                    this.bln_equip_esporte_cultura = 0;                
                }

                if(this.dados.bln_mercadinho_mercado == 1){
                        this.bln_mercadinho_mercado = 1;
                        this.vlr_dist_mts_mercadinho= this.dados.vlr_dist_mts_mercadinho;                     
                }else{
                    this.bln_mercadinho_mercado = 0;                
                }

                if(this.dados.bln_padaria == 1){
                        this.bln_padaria = 1;
                        this.vlr_dist_mts_padaria= this.dados.vlr_dist_mts_padaria;                     
                }else{
                    this.bln_padaria = 0;                
                }

                if(this.dados.bln_farmacia == 1){
                        this.bln_farmacia = 1;
                        this.vlr_dist_mts_farmacia= this.dados.vlr_dist_mts_farmacia;                     
                }else{
                    this.bln_farmacia = 0;                
                }

                if(this.dados.bln_supermercado == 1){
                        this.bln_supermercado = 1;
                        this.vlr_dist_mts_supermercado= this.dados.vlr_dist_mts_supermercado;                     
                        this.num_tempo_min_supermercado= this.dados.num_tempo_min_supermercado;                     
                        if(this.dados.vlr_dist_mts_supermercado > 0){
                            this.radioDisttempSuperm = "distancia";
                        }else{
                            this.radioDisttempSuperm = "tempo";
                        }
                }else{
                    this.bln_supermercado = 0;                
                }

                if(this.dados.bln_agencia_bancaria == 1){
                        this.bln_agencia_bancaria = 1;
                        this.vlr_dist_mts_ag_bancaria= this.dados.vlr_dist_mts_ag_bancaria;                     
                        this.num_tempo_min_ag_bancaria= this.dados.num_tempo_min_ag_bancaria;    
                        if(this.dados.vlr_dist_mts_ag_bancaria > 0){
                            this.radioDisttempAgBancaria = "distancia";
                        }else{
                            this.radioDisttempAgBancaria = "tempo";
                        }                 
                }else{
                    this.bln_agencia_bancaria = 0;                
                }

                if(this.dados.bln_agencia_correios == 1){
                        this.bln_agencia_correios = 1;
                        this.vlr_dist_mts_correios= this.dados.vlr_dist_mts_correios;                     
                        this.num_tempo_min_correios= this.dados.num_tempo_min_correios;     
                        if(this.dados.vlr_dist_mts_correios > 0){
                            this.radioDisttempCorreios = "distancia";
                        }else{
                            this.radioDisttempCorreios = "tempo";
                        }                 
                }else{
                    this.bln_agencia_correios = 0;                
                }

                if(this.dados.bln_loterica == 1){
                    this.bln_loterica = 1;
                    this.vlr_dist_mts_loterica= this.dados.vlr_dist_mts_loterica;                     
                    this.num_tempo_min_loterica= this.dados.num_tempo_min_loterica;      
                    if(this.dados.vlr_dist_mts_loterica > 0){
                            this.radioDisttempCenCom = "distancia";
                        }else{
                            this.radioDisttempCenCom = "tempo";
                        }                    
                }else{
                    this.bln_loterica = 0;                
                }

                if(this.dados.bln_restaurante_popular == 1){
                        this.bln_restaurante_popular = 1;
                        this.vlr_dist_mts_rest_pop= this.dados.vlr_dist_mts_rest_pop;                     
                        this.num_tempo_min_rest_pop= this.dados.num_tempo_min_rest_pop;     
                        if(this.dados.vlr_dist_mts_rest_pop > 0){
                            this.radioDisttempRestPopular = "distancia";
                        }else{
                            this.radioDisttempRestPopular = "tempo";
                        }                 
                }else{
                    this.bln_restaurante_popular = 0;                
                }

                if(this.dados.bln_escola_ed_infantil == 1){
                        this.bln_escola_ed_infantil = 1;
                        this.vlr_dist_mts_ed_inf= this.dados.vlr_dist_mts_ed_inf;                     
                        this.num_tempo_min_ed_inf= this.dados.num_tempo_min_ed_inf;   
                        if(this.dados.vlr_dist_mts_ed_inf > 0){
                            this.radioDisttempEdInf = "distancia";
                        }else{
                            this.radioDisttempEdInf = "tempo";
                        }                    
                }else{
                    this.bln_escola_ed_infantil = 0;                
                }

                if(this.dados.bln_escola_ed_fund_ciclo_1 == 1){
                        this.bln_escola_ed_fund_ciclo_1 = 1;
                        this.vlr_dist_mts_ed_fund_c1= this.dados.vlr_dist_mts_ed_fund_c1;                     
                        this.num_tempo_min_ed_fund_c1= this.dados.num_tempo_min_ed_fund_c1;     
                        if(this.dados.vlr_dist_mts_ed_fund_c1 > 0){
                            this.radioDisttempEdFund1 = "distancia";
                        }else{
                            this.radioDisttempEdFund1 = "tempo";
                        }                 
                }else{
                    this.bln_escola_ed_fund_ciclo_1 = 0;                
                }

                if(this.dados.bln_escola_ed_fund_ciclo_2 == 1){
                        this.bln_escola_ed_fund_ciclo_2 = 1;
                        this.vlr_dist_mts_ed_fund_c2= this.dados.vlr_dist_mts_ed_fund_c2;                     
                        this.num_tempo_min_ed_fund_c2= this.dados.num_tempo_min_ed_fund_c2;      
                        if(this.dados.vlr_dist_mts_ed_fund_c2 > 0){
                            this.radioDisttempEdFund2 = "distancia";
                        }else{
                            this.radioDisttempEdFund2 = "tempo";
                        }                 
                }else{
                    this.bln_escola_ed_fund_ciclo_2 = 0;                
                }

                if(this.dados.bln_cras == 1){
                        this.bln_cras = 1;
                        this.vlr_dist_mts_cras= this.dados.vlr_dist_mts_cras;                     
                        this.num_tempo_min_cras= this.dados.num_tempo_min_cras;   
                        if(this.dados.vlr_dist_mts_cras > 0){
                            this.radioDisttempCras = "distancia";
                        }else{
                            this.radioDisttempCras = "tempo";
                        }                
                }else{
                    this.bln_cras = 0;                
                }

                if(this.dados.bln_ubs == 1){
                        this.bln_ubs = 1;
                        this.vlr_dist_mts_ubs= this.dados.vlr_dist_mts_ubs;                     
                        this.num_tempo_min_ubs= this.dados.num_tempo_min_ubs;       
                        if(this.dados.vlr_dist_mts_ubs > 0){
                            this.radioDisttempUbs = "distancia";
                        }else{
                            this.radioDisttempUbs = "tempo";
                        }                 
                }else{
                    this.bln_ubs = 0;                
                }

                if(this.dados.bln_aeroporto_comercial == 1){
                        this.bln_aeroporto_comercial = 1;
                                                               
                                       
                }else{
                    this.bln_aeroporto_comercial = 0;                
                }

            this.vlr_dist_km_aerop_comercial= this.dados.vlr_dist_km_aerop_comercial;     


             this.txt_caminho_mapa = this.dados.txt_caminho_mapa;    

              this.txt_caminho_registro_rota = this.dados.txt_caminho_registro_rota;

             this.num_arquivos = this.dadosmapa.length
            

            }
         }
               
    }
</script>
