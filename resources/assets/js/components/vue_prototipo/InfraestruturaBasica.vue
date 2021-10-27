<template>
<div class="form-group">   
<label for="infraestrututa_basica">2.1 Assinale abaixo quais sistemas de infraestrutura básica <strong> NÃO</strong> estão disponíveis no acesso imediato ao terreno. 
    <strong> Não assinalar obras em andamento</strong>:</label>   
       
    <div class="row"> 
        <div class="column col-xs-12 col-md-12">
            <div class="form-check" >       
                <label class="form-check-label" >
                <input class="form-check-input" 
                       type="checkbox" 
                       id="bln_sistema_abastecimento"
                       name="bln_sistema_abastecimento"
                       :value="sistema_abastecimento"
                       v-model="sistema_abastecimento"
                       :checked="sistema_abastecimento">&nbsp;Sistema de abastecimento de água</label>
           
            </div>
         </div>       
         <div class="column col-xs-12 col-md-12" v-if="sistema_abastecimento">
                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                    <div class="col-sm-7">
                        <div class="input-group mb-3">            
                            <input type="number" class="form-control" name="vlr_dist_sis_abast" v-model="vlr_dist_sis_abast"  min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Metros</span>
                            </div>
                        </div> 
                    </div>                     
            </div>
     
        <div class="column col-xs-12 col-md-12">
            <div class="form-check" >       
                <label class="form-check-label" >
                <input class="form-check-input" 
                       type="checkbox" 
                       id="bln_sistema_coleta_esgoto"
                       name="bln_sistema_coleta_esgoto"
                       :value="sistema_coleta_esgoto"
                       v-model="sistema_coleta_esgoto"
                       :checked="sistema_coleta_esgoto">&nbsp;Sistema de coleta e destinação de esgoto</label>
            </div>
        </div> 
        <div class="column col-xs-12 col-md-12" v-if="sistema_coleta_esgoto">
                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                    <div class="col-sm-7">
                        <div class="input-group mb-3">            
                            <input type="number" class="form-control" name="vlr_dist_sis_coleta" v-model="vlr_dist_sis_coleta"  min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Metros</span>
                            </div>
                        </div> 
                    </div>                     
            </div>
        <div class="column col-xs-12 col-md-12">
            <div class="form-check" >       
                <label class="form-check-label" >
                <input class="form-check-input" 
                       type="checkbox" 
                       id="bln_sistema_coleta_lixo"
                       name="bln_sistema_coleta_lixo"
                       :value="sistema_coleta_lixo"
                       v-model="sistema_coleta_lixo"
                       :checked="sistema_coleta_lixo">&nbsp;Sistema de coleta de lixo</label>
            </div>
        </div> 
        <div class="column col-xs-12 col-md-12" v-if="sistema_coleta_lixo">
                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                    <div class="col-sm-7">
                        <div class="input-group mb-3">            
                            <input type="number" class="form-control" name="vlr_dist_sis_coleta_lixo" v-model="vlr_dist_sis_coleta_lixo"  min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Metros</span>
                            </div>
                        </div> 
                    </div>                     
            </div>    
        <div class="column col-xs-12 col-md-12">
            <div class="form-check" >       
                <label class="form-check-label" >
                <input class="form-check-input" 
                       type="checkbox" 
                       id="bln_sistema_renagem_ag_pluviais"
                       name="bln_sistema_renagem_ag_pluviais"
                       :value="sistema_renagem_ag_pluviais"
                       v-model="sistema_renagem_ag_pluviais"
                       :checked="sistema_renagem_ag_pluviais">&nbsp;Sistema de drenagem de águas pluviais</label>
            </div>
        </div> 
        <div class="column col-xs-12 col-md-12" v-if="sistema_renagem_ag_pluviais">
                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                    <div class="col-sm-7">
                        <div class="input-group mb-3">            
                            <input type="number" class="form-control" name="vlr_dist_sis_dren_ag_pluv" v-model="vlr_dist_sis_dren_ag_pluv"  min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Metros</span>
                            </div>
                        </div> 
                    </div>                     
            </div>
        <div class="column col-xs-12 col-md-12">
            <div class="form-check" >       
                <label class="form-check-label" >
                <input class="form-check-input" 
                       type="checkbox" 
                       id="bln_dist_energia_eletrica"
                       name="bln_dist_energia_eletrica"
                       :value="dist_energia_eletrica"
                       v-model="dist_energia_eletrica"
                       :checked="dist_energia_eletrica">&nbsp;Sistema de distribuição de energia elétrica</label>
            </div>
        </div> 
        <div class="column col-xs-12 col-md-12" v-if="dist_energia_eletrica">
                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                    <div class="col-sm-7">
                        <div class="input-group mb-3">            
                            <input type="number" class="form-control" name="vlr_dist_sis_dist_ener_elet" v-model="vlr_dist_sis_dist_ener_elet"  min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Metros</span>
                            </div>
                        </div> 
                    </div>                     
            </div>
   
        <div class="column col-xs-12 col-md-12">
            <div class="form-check" >       
                <label class="form-check-label" >
                <input class="form-check-input" 
                       type="checkbox" 
                       id="bln_iluminacao_publica"
                       name="bln_iluminacao_publica"
                       :value="iluminacao_publica"
                       v-model="iluminacao_publica"
                       :checked="iluminacao_publica">&nbsp;Sistema de iluminação pública</label>
            </div>
        </div> 
        <div class="column col-xs-12 col-md-12" v-if="iluminacao_publica">
            <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                <div class="col-sm-7">
                    <div class="input-group mb-3">            
                        <input type="number" class="form-control" name="vlr_dist_sis_ilum_pub" v-model="vlr_dist_sis_ilum_pub"  min="1" required>
                        <div class="input-group-append">
                            <span class="input-group-text">Metros</span>
                        </div>
                    </div> 
                </div>                     
        </div>
  
        <div class="column col-xs-12 col-md-12">
            <div class="form-check" >       
                <label class="form-check-label" >
                <input class="form-check-input" 
                       type="checkbox" 
                       id="bln_guias_sarjetas"
                       name="bln_guias_sarjetas"
                       :value="guias_sarjetas"
                       v-model="guias_sarjetas"
                       :checked="guias_sarjetas">&nbsp;Guias e sarjetas</label>
            </div>
        </div> 
        <div class="column col-xs-12 col-md-12" v-if="guias_sarjetas">
                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">Distância em metros do sistema existente ao terreno</label>
                    <div class="col-sm-7">
                        <div class="input-group mb-3">            
                            <input type="number" class="form-control" name="vlr_dist_sis_guias_sarj" v-model="vlr_dist_sis_guias_sarj"  min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Metros</span>
                            </div>
                        </div> 
                    </div>                     
            </div>
        <div class="column col-xs-12 col-md-12">
            <div class="form-check" >       
                <label class="form-check-label" >
                <input class="form-check-input" 
                       type="checkbox" 
                       id="bln_pavimentacao"
                       name="bln_pavimentacao"
                       :value="pavimentacao"
                       v-model="pavimentacao"
                       :checked="pavimentacao">&nbsp;  Pavimentação</label>
            </div>
        </div>
        <div class="column col-xs-12 col-md-12" v-if="pavimentacao">
                <label for="colFormLabelSm" class="col-sm-5 col-form-label col-form-label-sm text-right">  Distância em metros do sistema existente ao terreno</label>
                    <div class="col-sm-7">
                        <div class="input-group mb-3">            
                            <input type="number" class="form-control" name="vlr_dist_sis_pavim" v-model="vlr_dist_sis_pavim"  min="1" required>
                            <div class="input-group-append">
                                <span class="input-group-text">Metros</span>
                            </div>
                        </div> 
                    </div>                     
            </div>
    </div>       
     
        <input class="btn btn-lg btn-info btn-block" type="submit" value="Salvar">   
 </div>
</template>


<script>
    export default {
        props:['url','dados'],
        data: function(){
           return {            
                infraestrututa_basica: '',
                infraestrututa_basicas: '',
                sistema_abastecimento:'',
                sistema_coleta_esgoto:'',
                sistema_renagem_ag_pluviais:'',
                dist_energia_eletrica:'',
                iluminacao_publica:'',
                guias_sarjetas:'',
                pavimentacao:'',
                bln_obras_andamento:'',
                infraestrututa_basica_pendentes: '',
                infraestrututa_basicas_pendentes: '',
                sistema_abastecimento_pendentes:'',
                sistema_coleta_esgoto_pendentes:'',
                sistema_coleta_lixo:'',
                sistema_renagem_ag_pluviais_pendentes:'',
                dist_energia_eletrica_pendentes:'',
                iluminacao_publica_pendentes:'',
                guias_sarjetas_pendentes:'',
                pavimentacao_pendentes:'',
                txt_outras_obras_pendentes:'',
                outras_pendentes:'',
                fonte_recurso:'',
                fonte_recursos:'',
                dte_termino_obras:'',
                txt_origem_recurso:'',
                vlr_dist_sis_abast:0,
                vlr_dist_sis_ilum_pub:0,
                vlr_dist_sis_coleta:0,
                vlr_dist_sis_coleta_lixo:0,
                vlr_dist_sis_dren_ag_pluv:0,
                vlr_dist_sis_dist_ener_elet:0,
                vlr_dist_sis_guias_sarj:0,
                vlr_dist_sis_pavim:0,

                }
               
            },        
            filters: {
                formataData: function(valor){
                if(!valor) return '';
                valor = valor.toString();
                if(valor.split('-').length == 3){
                    valor = valor.split('-');
                    return valor[2] + '/' + valor[1]+ '/' + valor[0];
                }

                return valor;
            }
        },
        methods:{
            
        },
         mounted() {


             
             if(this.dados){
                    if(this.dados.bln_sistema_abastecimento == 1){
                            this.sistema_abastecimento = true;
                            this.vlr_dist_sis_abast = this.dados.vlr_dist_sis_abast;
                        }else{
                            this.sistema_abastecimento = false;
                            this.vlr_dist_sis_abast = 0;
                        }

                    if(this.dados.bln_sistema_coleta_esgoto == 1){
                            this.sistema_coleta_esgoto = true;
                            this.vlr_dist_sis_coleta = this.dados.vlr_dist_sis_coleta;
                        }else{
                            this.sistema_coleta_esgoto = false;
                            this.vlr_dist_sis_coleta = 0;
                        }
                    
                    if(this.dados.bln_sistema_coleta_lixo == 1){
                            this.sistema_coleta_lixo = true;
                            this.vlr_dist_sis_coleta_lixo = this.dados.vlr_dist_sis_coleta_lixo;
                        }else{
                            this.sistema_coleta_lixo = false;
                            this.vlr_dist_sis_coleta_lixo = 0;
                        }

                    if(this.dados.bln_sistema_renagem_ag_pluviais == 1){
                            this.sistema_renagem_ag_pluviais = true;
                            this.vlr_dist_sis_dren_ag_pluv = this.dados.vlr_dist_sis_dren_ag_pluv;
                        }else{
                            this.sistema_renagem_ag_pluviais = false;
                            this.vlr_dist_sis_dren_ag_pluv = 0;
                        }
                        
                    if(this.dados.bln_dist_energia_eletrica == 1){
                            this.dist_energia_eletrica = true;
                            this.vlr_dist_sis_dist_ener_elet = this.dados.vlr_dist_sis_dist_ener_elet;
                        }else{
                            this.dist_energia_eletrica = false;
                            this.vlr_dist_sis_dist_ener_elet = 0;
                        }
                    
                    if(this.dados.bln_iluminacao_publica == 1){
                            this.iluminacao_publica = true;
                            this.vlr_dist_sis_ilum_pub = this.dados.vlr_dist_sis_ilum_pub;
                        }else{
                            this.iluminacao_publica = false;
                            this.vlr_dist_sis_ilum_pub = 0;
                        }
                    
                    if(this.dados.bln_guias_sarjetas == 1){
                            this.guias_sarjetas = true;
                            this.vlr_dist_sis_guias_sarj = this.dados.vlr_dist_sis_guias_sarj;
                        }else{
                            this.guias_sarjetas = false;
                            this.vlr_dist_sis_guias_sarj = 0;
                        }
                    
                    if(this.dados.bln_pavimentacao == 1){
                            this.pavimentacao = true;
                            this.vlr_dist_sis_pavim = this.dados.vlr_dist_sis_pavim;
                        }else{
                            this.pavimentacao = false;
                            this.vlr_dist_sis_pavim = 0;
                        }

                    if(this.dados.bln_obras_andamento == 1){
                            this.bln_obras_andamento = 1;

                            if(this.dados.bln_sistema_abastecimento_pendentes == 1){
                                    this.sistema_abastecimento_pendentes = true;
                                }else{
                                    this.sistema_abastecimento_pendentes = false;
                                }

                            if(this.dados.bln_sistema_coleta_esgoto_pendentes == 1){
                                    this.sistema_coleta_esgoto_pendentes = true;
                                }else{
                                    this.sistema_coleta_esgoto_pendentes = false;
                                }
                            
                            if(this.dados.bln_sistema_renagem_ag_pluviais_pendentes == 1){
                                    this.sistema_renagem_ag_pluviais_pendentes = true;
                                }else{
                                    this.sistema_renagem_ag_pluviais_pendentes = false;
                                }
                                
                            if(this.dados.bln_dist_energia_eletrica_pendentes == 1){
                                    this.dist_energia_eletrica_pendentes = true;
                                }else{
                                    this.dist_energia_eletrica_pendentes = false;
                                }
                            
                            if(this.dados.bln_iluminacao_publica_pendentes == 1){
                                    this.iluminacao_publica_pendentes = true;
                                }else{
                                    this.iluminacao_publica_pendentes = false;
                                }
                            
                            if(this.dados.bln_guias_sarjetas_pendentes == 1){
                                    this.guias_sarjetas_pendentes = true;
                                }else{
                                    this.guias_sarjetas_pendentes = false;
                                }
                            
                            if(this.dados.bln_pavimentacao_pendentes == 1){
                                    this.pavimentacao_pendentes = true;
                                }else{
                                    this.pavimentacao_pendentes = false;
                                }

                            if(this.dados.bln_outras_pendentes == 1){
                                    this.outras_pendentes = true;
                                    this.txt_outras_obras_pendentes = this.dados.txt_outras_obras_pendentes;
                                }else{
                                    this.outras_pendentes = false;
                                }    

                        }else{
                            this.bln_obras_andamento = 0;
                        }

                    
                    this.txt_origem_recurso = this.dados.txt_origem_recurso;
                    this.dte_termino_obras = this.dados.dte_termino_obras;
             }


              //retorna os tipoUsuarios
            axios.get(this.url + '/api/infraestrututaBasica').then(resposta => {
                //console.log(resposta.data);
                this.infraestrututa_basicas = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna os tipoRiscos
            axios.get(this.url + '/api/fonteRecurso').then(resposta => {
                //console.log(resposta.data);
                this.fonte_recursos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 
         }    
    }
</script>
