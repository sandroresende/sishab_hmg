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
 <div class="linha-separa"></div>
 <div class="row"  v-if='bln_transporte_publico_coletivo == 1'>
        <div class="column col-xs-12 col-md-12">
            <label for="transporte_publico_coletivo">3.2 Se houver transporte público coletivo:</label>   
        </div>    
        <div class="column col-xs-12 col-md-12">
                <label for="vlr_distancia_ponto">a) Distância do ponto ou terminal de embarque e desembarque de passageiros mais próximo</label>   
                <input type="text" name="vlr_distancia_ponto" class="form-control" min="1" v-model="vlr_distancia_ponto" required>
            </div>
        <div class="column col-xs-12 col-md-12">
            <label for="num_itinerarios">b) Quantos itinerários estão disponíveis para o ponto mencionado:</label>   
            <input type="number" name="num_itinerarios" class="form-control" min="1" v-model="num_itinerarios" required>
        </div>
          
    </div> 
    <div class="linha-separa"></div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="transporte_publico_coletivo">3.3 Informar a distância caminhável ou o tempo de deslocamento por transporte público para os seguintes equipamentos e serviços:</label>   
            <em>* Sugere-se utilizar a ferramenta Google Maps, disponível online, para calcular os valores. Não utilizar a distância em linha reta. Deve ser considerado o centro do terreno como ponto de partida. O tempo de deslocamento por transporte deve considerar o tempo do trecho de caminhada até o ponto de embarque e após o desembarque.</em>
        </div>    
                 
    </div>
    <div class="linha-separa"></div>
    
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="equip_esporte_cultura">I.	Possui Equipamentos de esporte, cultura e lazer?</label>   
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
            <label for="dist_mts_eq_esp_cult">Distância</label>         
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
            <label for="estabeleciomento_cotidiano">II.	Estabelecimentos de uso cotidiano:</label> 
        </div>        
    </div>        
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="mercadinho_mercado">a) Mercadinho ou mercearia?</label>   
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
    </div>
    <div class="row"  v-if='bln_mercadinho_mercado == 1'>    
            
        <div class="column col-xs-12 col-md-12">      
            <label for="dist_mts_mercadinho">Distância</label>         
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_mercadinho" min="1" v-model="vlr_dist_mts_mercadinho" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_mercadinho">Metros</span>
                </div>
            </div>
        </div>  
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="padaria">b)	Padaria:</label>   
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
    </div>
    <div class="row"  v-if='bln_padaria == 1'>    
            
        <div class="column col-xs-12 col-md-12">      
            <label for="dist_mts_padaria">Distância</label>         
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_padaria" min="1" v-model="vlr_dist_mts_padaria" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_padaria">Metros</span>
                </div>
            </div>
        </div>  
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="farmacia">c) Farmácia ou Drogaria</label>   
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
    </div>
    <div class="row"  v-if='bln_farmacia == 1'>    
            
        <div class="column col-xs-12 col-md-12">      
            <label for="dist_mts_farmacia">Distância</label>         
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
            <label for="equip_uso_eventual">III.	Estabelecimentos de uso eventual:</label> 
        </div>        
    </div>        
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="supermercado">a) Supermercado?</label>   
            <select 
                id="bln_supermercado"
                class="form-control" 
                name="bln_supermercado"               
                v-model="bln_supermercado"
                required>
                <option value="" selected>Responda se dispõe de Supermercado:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
    </div>
    <div class="row"  v-if='bln_supermercado == 1'>    
            
        <div class="column col-xs-12 col-md-6">    
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempSuperm" v-model="radioDisttempSuperm" id="radioDistSuperm" value="distancia" checked>
                <label class="form-check-label" for="inlineCheckbox1">Distância (por transporte público)</label>
            </div>              
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_supermercado" v-model="vlr_dist_mts_supermercado"  min="1" :disabled="radioDisttempSuperm == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_supermercado">Metros</span>
                </div>
            </div>
        </div>    
        <div class="column col-xs-12 col-md-6"> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempSuperm" v-model="radioDisttempSuperm" id="radioTempSuperm" value="tempo">
                <label class="form-check-label" for="inlineCheckbox1">Tempo (por transporte público)</label>
            </div>     
                     
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_supermercado" v-model="num_tempo_min_supermercado" min="1"  :disabled="radioDisttempSuperm == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_supermercado">Minutos</span>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="agencia_bancaria">b) Agência bancária?</label>   
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
    </div>
    <div class="row"  v-if='bln_agencia_bancaria == 1'>    
            
        <div class="column col-xs-12 col-md-6"> 
             <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempAgBancaria" v-model="radioDisttempAgBancaria" id="radioDistBanc" value="distancia" checked>
                <label class="form-check-label" for="dist_mts_ag_bancaria">Distância (por transporte público)</label>
            </div>  
                
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_ag_bancaria" v-model="vlr_dist_mts_ag_bancaria" min="1" :disabled="radioDisttempAgBancaria == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ag_bancaria">Metros</span>
                </div>
            </div>
        </div>    
        <div class="column col-xs-12 col-md-6">     
          <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempAgBancaria" v-model="radioDisttempAgBancaria" id="radioTempBanc" value="tempo">
                <label class="form-check-label" for="tempo_min_ag_bancaria">Tempo (por transporte público)</label>
            </div>   
              
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ag_bancaria" v-model="num_tempo_min_ag_bancaria" min="1" :disabled="radioDisttempAgBancaria == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ag_bancaria">Minutos</span>
                </div>
            </div>
        </div>        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="agencia_correios">c) Agência dos Correios?</label>   
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
    </div>
    <div class="row"  v-if='bln_agencia_correios == 1'>    
            
        <div class="column col-xs-12 col-md-6">   
           <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempCorreios" v-model="radioDisttempCorreios" id="radioDistCorr" value="distancia" checked>
                <label class="form-check-label" for="dist_mts_correios">Distância (por transporte público)</label>
            </div>  
                
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_correios" v-model="vlr_dist_mts_correios"  min="1" :disabled="radioDisttempCorreios == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_correios">Metros</span>
                </div>
            </div>
        </div>    
        <div class="column col-xs-12 col-md-6">     
        <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempCorreios" v-model="radioDisttempCorreios" id="radioTempCorr" value="tempo" checked>
                <label class="form-check-label" for="tempo_min_correios">Tempo (por transporte público)</label>
            </div>   
               
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_correios" v-model="num_tempo_min_correios" min="1"  :disabled="radioDisttempCorreios == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_correios">Minutos</span>
                </div>
            </div>
        </div>        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="centro_comercial">d) Centro comercial?</label>   
            <select 
                id="bln_centro_comercial"
                class="form-control" 
                name="bln_centro_comercial"               
                v-model="bln_centro_comercial"
                required>
                <option value="" selected>Responda se dispõe de Centro comercial:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
    </div>
    <div class="row"  v-if='bln_centro_comercial == 1'>    
            
        <div class="column col-xs-12 col-md-6">   
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempCenCom" v-model="radioDisttempCenCom" id="radioDistCenCom" value="distancia" checked>
                <label class="form-check-label" for="dist_mts_cent_comerc">Distância (por transporte público)</label>
            </div>     
               
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_dist_mts_cent_comerc" v-model="vlr_dist_mts_cent_comerc"  min="1" :disabled="radioDisttempCenCom == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_cent_comerc">Metros</span>
                </div>
            </div>
        </div>    
        <div class="column col-xs-12 col-md-6">  
        <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempCenCom" v-model="radioDisttempCenCom" id="radioTempCenCom" value="tempo">
                <label class="form-check-label" for="tempo_min_cent_comerc">Tempo (por transporte público)</label>
            </div>      
            
              
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_cent_comerc" v-model="num_tempo_min_cent_comerc" min="1"  :disabled="radioDisttempCenCom == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_cent_comerc">Minutos</span>
                </div>
            </div>
        </div>        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="restaurante_popular">e) Restaurante popular?</label>   
            <select 
                id="bln_restaurante_popular"
                class="form-control" 
                name="bln_restaurante_popular"               
                v-model="bln_restaurante_popular"
                required>
                <option value="" selected>Responda se dispõe de Restaurante popular:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
    </div>
    <div class="row"  v-if='bln_restaurante_popular == 1'>    
            
        <div class="column col-xs-12 col-md-6">    
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempRestPopular" 
                        v-model="radioDisttempRestPopular" id="radioDistRestPop" value="distancia" checked>
                <label class="form-check-label" for="dist_mts_rest_pop">Distância (por transporte público)</label>
            </div>              
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_rest_pop" 
                    v-model="vlr_dist_mts_rest_pop"  min="1" :disabled="radioDisttempRestPopular == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_rest_pop">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-6"> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempRestPopular" 
                    v-model="radioDisttempRestPopular" id="radioTempRestPop" value="tempo">
                <label class="form-check-label" for="tempo_min_rest_pop">Tempo (por transporte público)</label>
            </div>     
                     
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_rest_pop" 
                v-model="num_tempo_min_rest_pop" min="1"  :disabled="radioDisttempRestPopular == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_rest_pop">Minutos</span>
                </div>
            </div>
        </div>     
    </div>
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="equip_pulic">IV. Equipamentos Públicos Comunitários:</label> 
        </div>        
    </div>        
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="escola_ed_infantil">a) Escola pública de educação infantil?</label>   
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
    </div>
    <div class="row"  v-if='bln_escola_ed_infantil == 1'>    
            
        <div class="column col-xs-12 col-md-6">    
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempEdInf" 
                        v-model="radioDisttempEdInf" id="radioDistEdInf" value="distancia" checked>
                <label class="form-check-label" for="dist_mts_ed_inf">Distância (por transporte público)</label>
            </div>              
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_ed_inf" 
                    v-model="vlr_dist_mts_ed_inf"  min="1" :disabled="radioDisttempEdInf == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ed_inf">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-6"> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempEdInf" 
                    v-model="radioDisttempEdInf" id="radioTempEdInf" value="tempo">
                <label class="form-check-label" for="tempo_min_ed_inf">Tempo (por transporte público)</label>
            </div>     
                     
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ed_inf" 
                v-model="num_tempo_min_ed_inf" min="1"  :disabled="radioDisttempEdInf == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ed_inf">Minutos</span>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="escola_ed_fund_ciclo_1">b)	Escola pública de ensino fundamental (ciclo I)?</label>   
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
    </div>
    <div class="row"  v-if='bln_escola_ed_fund_ciclo_1 == 1'>    
            
        <div class="column col-xs-12 col-md-6">    
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempEdFund1" 
                        v-model="radioDisttempEdFund1" id="radioDistEdFund1" value="distancia" checked>
                <label class="form-check-label" for="dist_mts_ed_fund_c1">Distância (por transporte público)</label>
            </div>              
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_ed_fund_c1" 
                    v-model="vlr_dist_mts_ed_fund_c1"  min="1" :disabled="radioDisttempEdFund1 == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ed_fund_c1">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-6"> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempEdFund1" 
                    v-model="radioDisttempEdFund1" id="radioTempEdFund1" value="tempo">
                <label class="form-check-label" for="tempo_min_ed_fund_c1">Tempo (por transporte público)</label>
            </div>     
                     
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ed_fund_c1" 
                v-model="num_tempo_min_ed_fund_c1" min="1"  :disabled="radioDisttempEdFund1 == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ed_fund_c1">Minutos</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="escola_ed_fund_ciclo_2">c) Escola pública de ensino fundamental (ciclo II)?</label>   
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
    </div>
    <div class="row"  v-if='bln_escola_ed_fund_ciclo_2 == 1'>    
            
        <div class="column col-xs-12 col-md-6">    
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempEdFund2" 
                        v-model="radioDisttempEdFund2" id="radioDistEdFund2" value="distancia" checked>
                <label class="form-check-label" for="dist_mts_ed_fund_c2">Distância (por transporte público)</label>
            </div>              
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_ed_fund_c2" 
                    v-model="vlr_dist_mts_ed_fund_c2"  min="1" :disabled="radioDisttempEdFund2 == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ed_fund_c2">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-6"> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempEdFund2" 
                    v-model="radioDisttempEdFund2" id="radioTempEdFund2" value="tempo">
                <label class="form-check-label" for="tempo_min_ed_fund_c2">Tempo (por transporte público)</label>
            </div>     
                     
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ed_fund_c2" 
                v-model="num_tempo_min_ed_fund_c2" min="1"  :disabled="radioDisttempEdFund2 == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ed_fund_c2">Minutos</span>
                </div>
            </div>
        </div>    
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="cras">d) Centro de Referência de Assistência Social (CRAS)?</label>   
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
    </div>
    <div class="row"  v-if='bln_cras == 1'>    
            
        <div class="column col-xs-12 col-md-6">    
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempCras" 
                        v-model="radioDisttempCras" id="radioDistCras" value="distancia">
                <label class="form-check-label" for="dist_mts_cras">Distância (por transporte público)</label>
            </div>              
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_cras" 
                    v-model="vlr_dist_mts_cras"  min="1" :disabled="radioDisttempCras == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_cras">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-6"> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempCras" 
                    v-model="radioDisttempCras" id="radioTempCras" value="tempo">
                <label class="form-check-label" for="tempo_min_cras">Tempo (por transporte público)</label>
            </div>     
                     
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_cras" 
                v-model="num_tempo_min_cras" min="1"  :disabled="radioDisttempCras == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_cras">Minutos</span>
                </div>
            </div>
        </div>       
    </div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="ubs">e)	Unidade Básica de Saúde (UBS)?</label>   
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
    </div>
    <div class="row"  v-if='bln_ubs == 1'>    
            
        <div class="column col-xs-12 col-md-6">    
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempUbs" 
                        v-model="radioDisttempUbs" id="radioDistUbs" value="distancia" checked>
                <label class="form-check-label" for="dist_mts_ubs">Distância (por transporte público)</label>
            </div>              
            <div class="input-group mb-3">            
                <input type="number" class="form-control" name="vlr_dist_mts_ubs" 
                    v-model="vlr_dist_mts_ubs"  min="1" :disabled="radioDisttempUbs == 'tempo'">
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_dist_mts_ubs">Metros</span>
                </div>
            </div>
        </div>   

        <div class="column col-xs-12 col-md-6"> 
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="radioDisttempUbs" 
                    v-model="radioDisttempUbs" id="radioTempUbs" value="tempo">
                <label class="form-check-label" for="tempo_min_ubs">Tempo (por transporte público)</label>
            </div>     
                     
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="num_tempo_min_ubs" 
                v-model="num_tempo_min_ubs" min="1"  :disabled="radioDisttempUbs == 'distancia'">
                <div class="input-group-append">
                    <span class="input-group-text" id="num_tempo_min_ubs">Minutos</span>
                </div>
            </div>
        </div>  
    </div>
     <div class="linha-separa"></div>   
     <div class="row" v-if="this.txt_caminho_mapa">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_doc_cartorio">3.4	Mapa da área com a localização de todos os equipamentos e serviços informados no item anterior.</label>
            <a class="btn btn-link btn-sm" target="_blank" :href="url + '/' + this.txt_caminho_mapa"><i class="fas fa-file-pdf fa-3x"></i></a>  
            <input type="file" class="form-control-file" id="txt_caminho_mapa_edit" name="txt_caminho_mapa_edit" accept="image/* , application/pdf">                                            
            
        </div>  
    </div>    
    <div class="row" v-if="!this.txt_caminho_mapa">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_doc_cartorio">3.4	Anexe um mapa da área com a localização de todos os equipamentos e serviços informados no item anterior.</label>
            <input type="file" class="form-control-file" id="txt_caminho_mapa" name="txt_caminho_mapa" accept="image/* , application/pdf" required>
        </div>  
    </div>       
    
    
        
 </div>
</template>


<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                
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
                bln_centro_comercial: '',
                num_tempo_min_cent_comerc: 0, 
                vlr_dist_mts_cent_comerc: 0,
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

              
               
            }        
        },
        methods:{
            
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

                if(this.dados.bln_centro_comercial == 1){
                    this.bln_centro_comercial = 1;
                    this.vlr_dist_mts_cent_comerc= this.dados.vlr_dist_mts_cent_comerc;                     
                    this.num_tempo_min_cent_comerc= this.dados.num_tempo_min_cent_comerc;      
                    if(this.dados.vlr_dist_mts_cent_comerc > 0){
                            this.radioDisttempCenCom = "distancia";
                        }else{
                            this.radioDisttempCenCom = "tempo";
                        }                    
                }else{
                    this.bln_centro_comercial = 0;                
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

             this.txt_caminho_mapa = this.dados.txt_caminho_mapa;                     
            }
         }
               
    }
</script>
