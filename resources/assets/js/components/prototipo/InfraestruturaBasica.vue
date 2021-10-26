<template>
<div class="form-group">   
<label for="infraestrututa_basica">2.1 Assinale abaixo quais sistemas de infraestrutura básica estão disponíveis no acesso ao terreno. <strong> Não assinalar obras em andamento</strong>):</label>   
       
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
                       :checked="sistema_abastecimento">Sistema de abastecimento de água</label>
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
                       :checked="sistema_coleta_esgoto">Sistema de coleta e destinação de esgoto</label>
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
                       :checked="sistema_renagem_ag_pluviais">Sistema de drenagem de águas pluviais</label>
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
                       :checked="dist_energia_eletrica">Sistema de distribuição de energia elétrica</label>
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
                       :checked="iluminacao_publica">Sistema de iluminação pública</label>
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
                       :checked="guias_sarjetas">Guias e sarjetas</label>
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
                       :checked="pavimentacao">Pavimentação</label>
            </div>
        </div>
    </div>       
    
       
 
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="obras_andamento">2.2 Existem obras em andamento para a execução da infraestrutura que servirá ao terreno? Se sim, citar:</label>   
            <select 
                id="bln_obras_andamento"
                class="form-control" 
                name="bln_obras_andamento"               
                v-model="bln_obras_andamento"
                required>
                <option value="" selected>Responda se existem obras em andamento:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
    </div>
    <div class="row"  v-if='bln_obras_andamento == 1'>
        <div class="column col-xs-12 col-md-12">
                <label for="sistema_em_obras">a) Qual(is) sistema(s):</label>   
                <input type="text" name="txt_sistema_em_obras" class="form-control" v-model="txt_sistema_em_obras" required>
            </div>
        <div class="column col-xs-12 col-md-12">
            <label for="origem_recurso">b) Origem do recurso:</label>   
            <input type="text" name="txt_origem_recurso" class="form-control" v-model="txt_origem_recurso" required>
        </div>
        <div class="column col-xs-12 col-md-12">
            <label for="termino_obras">c) Prazo para o término das obras: </label>   
            <input type="date" name="dte_termino_obras" class="form-control" v-model="dte_termino_obras" required>
        </div>    
    </div>
    
        <button type="submit" class="btn btn-primary btn-lg btn-block">Salvar</button>
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
                fonte_recurso:'',
                fonte_recursos:'',
                dte_termino_obras:'',
                txt_origem_recurso:'',

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
                        }else{
                            this.sistema_abastecimento = false;
                        }

                    if(this.dados.bln_sistema_coleta_esgoto == 1){
                            this.sistema_coleta_esgoto = true;
                        }else{
                            this.sistema_coleta_esgoto = false;
                        }
                    
                    if(this.dados.bln_sistema_renagem_ag_pluviais == 1){
                            this.sistema_renagem_ag_pluviais = true;
                        }else{
                            this.sistema_renagem_ag_pluviais = false;
                        }
                        
                    if(this.dados.bln_dist_energia_eletrica == 1){
                            this.dist_energia_eletrica = true;
                        }else{
                            this.dist_energia_eletrica = false;
                        }
                    
                    if(this.dados.bln_iluminacao_publica == 1){
                            this.iluminacao_publica = true;
                        }else{
                            this.iluminacao_publica = false;
                        }
                    
                    if(this.dados.bln_guias_sarjetas == 1){
                            this.guias_sarjetas = true;
                        }else{
                            this.guias_sarjetas = false;
                        }
                    
                    if(this.dados.bln_pavimentacao == 1){
                            this.pavimentacao = true;
                        }else{
                            this.pavimentacao = false;
                        }

                    if(this.dados.bln_obras_andamento == 1){
                            this.bln_obras_andamento = 1;
                        }else{
                            this.bln_obras_andamento = 0;
                        }

                    this.txt_sistema_em_obras = this.dados.txt_sistema_em_obras;
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
