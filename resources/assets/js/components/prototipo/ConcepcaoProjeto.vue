<template>
<div class="form-group">    
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="possui_projeto_proposto">4.1 Já foi proposto projeto para a área em questão?</label>   
            <select 
                id="bln_possui_projeto_proposto"
                class="form-control" 
                name="bln_possui_projeto_proposto"               
                v-model="bln_possui_projeto_proposto"
                required>
                <option value="" selected>Responda se já foi proposto projeto para a área em questão:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>       
    </div>
    <div class="linha-separa"></div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="txt_nome_parceiro_desenv_projeto">4.2 Qual foi o Ente ou parceiro responsável desenvolvimento do projeto?</label>   
            <input type="text" name="txt_nome_parceiro_desenv_projeto"  v-model="txt_nome_parceiro_desenv_projeto" class="form-control"  required>
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="num_unidades_hab_propostas">4.3 Quantas unidades habitacionais foram propostas no projeto em questão?</label>   
            <input type="number" name="num_unidades_hab_propostas"   v-model="num_unidades_hab_propostas" min="1"  class="form-control"  required>
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="vlr_area_uh_m2">4.4 Qual a área das unidades habitacionais propostas, em m2?</label>   
            <input type="number" name="vlr_area_uh_m2" v-model="vlr_area_uh_m2"  class="form-control"   min="1" required>
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="tipo_organizacao">4.5 Como o empreendimento foi ou pretende-se que seja organizado?</label>   
            <select 
                id="tipo_organizacao"
                class="form-control" 
                name="tipo_organizacao"               
                v-model="tipo_organizacao"
                required>
                <option value="">Escolha um tipo de organização</option>
                <option v-for="tipo_organizacao in tipo_organizacaos" v-text="tipo_organizacao.txt_tipo_organizacao" :value="tipo_organizacao.id" :key="tipo_organizacao.id"></option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-12" v-if='tipo_organizacao == 3'>
            <label for="num_pavimentos_cond_vertical">4.6 Caso seja condomínio vertical, quantos pavimentos foram previstos?</label>   
            <input type="number" name="num_pavimentos_cond_vertical" class="form-control"  v-model="num_pavimentos_cond_vertical" min="1" required>
        </div>
        <div class="column col-xs-12 col-md-12" v-if='tipo_organizacao >= 3'>
            <label for="txt_estrategia_reducao_custos_cond">4.7 Caso adotado o regime de condomínio, foram previstas estratégias para redução de custos com a administração do condomínio?</label>   
            <textarea class="form-control" id="txt_estrategia_reducao_custos_cond" name="txt_estrategia_reducao_custos_cond"  rows="5" v-model="txt_estrategia_reducao_custos_cond"></textarea>
            
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="destinacao_atividade_comercial">4.8	Há possibilidade de destinação de lote, edificação ou de cessão de área do condomínio para atividades comerciais?</label>   
            <select 
                id="destinacao_atividade_comercial"
                class="form-control" 
                name="destinacao_atividade_comercial"               
                v-model="destinacao_atividade_comercial"
                required>
                <option value="" selected>Responda se há possibilidade de destinação para atividades comerciais:</option>
                <option value="SIM">SIM</option>
                <option value="NÃO">NÃO</option>
                <option value="NÃO APLICA">NÃO APLICA</option>
            </select>    
        </div>
       
    </div>
    
    <div class="linha-separa"></div>
     <div class="row">
             <label for="txt_observacao" class="control-label">4.9 Registre aqui os comentários ou as observações que considere importantes:</label>
             <textarea class="form-control" id="txt_observacao" name="txt_observacao" v-model="txt_observacao"  rows="10" ></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Salvar</button>
 </div>
</template>


<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                bln_possui_projeto_proposto:'',
                tipo_organizacao:'',
                tipo_organizacaos:'',
                destinacao_atividade_comercial:'',
                txt_nome_parceiro_desenv_projeto:'',
                num_unidades_hab_propostas:0,
                vlr_area_uh_m2:0,
                num_pavimentos_cond_vertical:0,
                txt_estrategia_reducao_custos_cond:'',
            }        
        },
        methods:{
            
        },
         mounted() {
              if(this.dados){
                if(this.dados.bln_possui_projeto_proposto == 1){
                        this.bln_possui_projeto_proposto = 1;
                }else{
                    this.bln_possui_projeto_proposto = 0;
                }       
                        this.txt_nome_parceiro_desenv_projeto = this.dados.txt_nome_parceiro_desenv_projeto ; 
                        this.num_unidades_hab_propostas = this.dados.num_unidades_hab_propostas ; 
                        this.vlr_area_uh_m2 = this.dados.vlr_area_uh_m2 ; 
                        this.tipo_organizacao = this.dados.tipo_organizacao_id ; 
                        this.num_pavimentos_cond_vertical = this.dados.num_pavimentos_cond_vertical ; 
                        this.txt_estrategia_reducao_custos_cond = this.dados.txt_estrategia_reducao_custos_cond ; 
                        this.destinacao_atividade_comercial = this.dados.txt_destinacao_atividade_comercial ; 
                        this.txt_observacao = this.dados.txt_observacao ; 

         }
              //retorna os tipoUsuarios
            axios.get(this.url + '/api/tipoOrganizacao').then(resposta => {
                //console.log(resposta.data);
                this.tipo_organizacaos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 

          
         }    
    }
</script>
