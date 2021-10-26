<template>
<div class="form-group">  
    <div class="row" v-if="this.txt_caminho_doc_cartorio">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_doc_cartorio">1.1 Cópia da documentação registrada em cartório com a comprovação da titularidade do terreno:</label>
            <a class="btn btn-link btn-sm" target="_blank" :href="url + '/' + this.txt_caminho_doc_cartorio"><i class="fas fa-file-pdf fa-3x"></i></a>  
            <input type="file" class="form-control-file" id="txt_caminho_doc_cartorio_edit" name="txt_caminho_doc_cartorio_edit" accept="image/* , application/pdf">                                            
            
        </div>  
    </div>    
    <div class="row" v-if="!this.txt_caminho_doc_cartorio">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_doc_cartorio">1.1 Anexe a cópia da documentação registrada em cartório com a comprovação da titularidade do terreno:</label>
            <input type="file" class="form-control-file" id="txt_caminho_doc_cartorio" name="txt_caminho_doc_cartorio" accept="image/* , application/pdf" required>
        </div>  
    </div>    
    <div class="linha-separa"></div>
    <div class="row" v-if="this.txt_caminho_dec_interesse">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_doc_cartorio">1.2 Declaração demonstrando o interesse dessa em participar da iniciativa, além do tempo estimado para efetivar a doação do terreno:</label>
            <a class="btn btn-link btn-sm" target="_blank" :href="url + '/' + this.txt_caminho_dec_interesse"><i class="fas fa-file-pdf fa-3x"></i></a>    
            <input type="file" class="form-control-file" id="txt_caminho_dec_interesse_edit" name="txt_caminho_dec_interesse_edit" accept="image/* , application/pdf">                     
            
        </div>  
    </div>    
    <div class="row" v-if="!this.txt_caminho_dec_interesse">
        <div class="column col-xs-12 col-md-12">
            <label for="bln_parceria">1.2 Existe parceria com Companhias de Habitação (Cohabs) ou com a Secretaria do Patrimônio da União (SPU)?</label>   
            <select 
                id="bln_parceria"
                class="form-control" 
                name="bln_parceria"               
                v-model="bln_parceria"
                required>
                <option value="" selected>Escolha uma opção:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>        
    </div>
    
    <div class="row" v-if="bln_parceria == 1 && !this.txt_caminho_dec_interesse">
        <div class="column col-xs-12 col-md-12">        
            <label for="caminho_dec_interesse">Em caso de parceria anexar uma declaração demonstrando o interesse dessa em participar da iniciativa, além do tempo estimado para efetivar a doação do terreno:</label>
            <input type="file" class="form-control-file" id="txt_caminho_dec_interesse" name="txt_caminho_dec_interesse" accept="image/* , application/pdf" required>
        </div>  
    </div>  
    
    <div class="linha-separa"></div> 
    
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="vlr_area_terreno">1.3 Qual a área do terreno em m²?</label>   
            <input type="number" name="vlr_area_terreno" placeholder="Ex.: 3000" class="form-control" v-model="vlr_area_terreno"  required>
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="titularidade_terreno">1.4 Qual a titularidade do terreno??</label>   
            <select 
                id="titularidade_terreno"
                class="form-control" 
                name="titularidade_terreno"               
                v-model="titularidade_terreno"
                required>
                <option value="">Escolha uma Titularidade do Terreno:</option>
                <option v-for="titularidade_terreno in titularidade_terrenos" v-text="titularidade_terreno.txt_titularidade_terreno" :value="titularidade_terreno.id" :key="titularidade_terreno.id"></option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-12" v-if='titularidade_terreno == 3'>
            <label for="terreno_terceiro">Quem é o terceiro?</label>   
            <input type="text" name="txt_terreno_terceiro" class="form-control" v-model="txt_terreno_terceiro" required>
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="terreno_ocupado">1.5 O terreno está ocupado?</label>   
            <select 
                id="terreno_ocupado"
                class="form-control" 
                name="terreno_ocupado"               
                v-model="terreno_ocupado"
                required>
                <option value="" selected>Responda se o terreno esta ocupado:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-12" v-if='terreno_ocupado == 1'>
            <label for="ocupacao">Qual é a ocupação: </label>   
            <input type="text" name="txt_ocupacao" class="form-control" v-model="txt_ocupacao" required>
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="terreno_area_risco">1.6 O terreno está em área de risco de deslizamento, inundação ou de contaminação??</label>   
            <select 
                id="terreno_area_risco"
                class="form-control" 
                name="terreno_area_risco"               
                v-model="terreno_area_risco"
                required>
                <option value="" selected>Responda se o terreno esta em área de risco:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
                <option value="2">NÃO SEI</option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-12"  v-if='terreno_area_risco == 1'>
            <label for="tipo_risco">Qual é a area de risco: </label>   
            <select 
                id="tipo_risco"
                class="form-control" 
                name="tipo_risco"               
                v-model="tipo_risco"
                required>
                <option value="">Escolha um Tipo de Risco:</option>
                <option v-for="tipo_risco in tipo_riscos" v-text="tipo_risco.txt_tipo_risco" :value="tipo_risco.id" :key="tipo_risco.id"></option>
            </select>   
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="terreno_reis_ociosidade">1.7 O terreno encontra-se em Zona Especial de Interesse Social (ZEIS) ou é proveniente de aplicação de medidas de controle de ociosidade?</label>   
            <select 
                id="bln_terreno_reis_ociosidade"
                class="form-control" 
                name="bln_terreno_reis_ociosidade"               
                v-model="bln_terreno_reis_ociosidade"
                required>
                <option value="" selected>Escolha uma opção:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>        
    </div>
    <div class="linha-separa"></div>
     <div class="row">
             <label for="txt_observacao" class="control-label">1.8	Registre aqui os comentários ou as observações que considere importantes:</label>
             <textarea class="form-control" id="txt_observacao" name="txt_observacao"  rows="10" v-model="txt_observacao"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Salvar</button>
        
 </div>
</template>


<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                txt_caminho_doc_cartorio: '',
                txt_caminho_dec_interesse: '',
                vlr_area_terreno: 0,
                titularidade_terreno: '',
                titularidade_terrenos: '',
                terreno_ocupado:'',
                txt_ocupacao:'',
                tipo_risco:'',
                tipo_riscos:'',
                terreno_area_risco:'',
                bln_terreno_reis_ociosidade:'',
                bln_parceria:'',
                txt_terreno_terceiro:'',
                txt_observacao:'',
                
            }        
        },
        methods:{
            
        },
         mounted() {

             console.log(this.dados);
               if(this.dados){
                    this.txt_caminho_doc_cartorio = this.dados.txt_caminho_doc_cartorio;

                    if(this.dados.txt_caminho_dec_interesse){
                        this.bln_parceria = 1;
                    }else{
                        this.bln_parceria = 0;
                    }
                    this.txt_caminho_dec_interesse = this.dados.txt_caminho_dec_interesse;
                    this.titularidade_terreno = this.dados.titularidade_terreno_id;
                    
                    this.vlr_area_terreno = this.dados.vlr_area_terreno;
                    this.txt_terreno_terceiro = this.dados.txt_terreno_terceiro;
                    
                    if(this.dados.bln_terreno_ocupado == true){
                        this.terreno_ocupado = 1;
                        this.txt_ocupacao = this.dados.txt_ocupacao;
                    }else{
                        this.terreno_ocupado = 0;
                    }

                    this.tipo_risco = this.dados.tipo_risco_id;
                    this.terreno_area_risco = this.dados.txt_terreno_area_risco;

                if(this.dados.bln_terreno_reis_ociosidade == true){
                        this.bln_terreno_reis_ociosidade = 1;                    
                    }else{
                        this.bln_terreno_reis_ociosidade = 0;
                    }
                
                this.txt_observacao = this.dados.txt_observacao;
            }
              //retorna os tipoUsuarios
            axios.get(this.url + '/api/titularidadeTerreno').then(resposta => {
                //console.log(resposta.data);
                this.titularidade_terrenos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna os tipoRiscos
            axios.get(this.url + '/api/tipoRisco').then(resposta => {
                //console.log(resposta.data);
                this.tipo_riscos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 
         }    
    }
</script>
