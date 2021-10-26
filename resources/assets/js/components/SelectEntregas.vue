<template>
    <div class="form-group">   
     <div class="row">  
            <label for="uf">UF</label>           
            <select 
                id="estado"
                class="form-control" 
                name="estado"                     
                @change="onChangeEstado"
                v-model="estado">
                <option value="">Escolha um Estado:</option>
                <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
            </select>  

            <label for="modalidade">Modalidade</label>           
            <select 
                id="modalidade"
                class="form-control" 
                name="modalidade"               
                v-model="modalidade">
                <option value="">Escolha um modalidade:</option>
                <option v-for="modalidade in modalidades" v-text="modalidade.txt_modalidade" :value="modalidade.id" :key="modalidade.id"></option>
            </select>  

            <label for="faixa">Faixa</label>           
            <select 
                id="faixa"
                class="form-control" 
                name="faixa"                       
                v-model="faixa">
                <option value="">Escolha uma Faixa:</option>
                <option v-for="faixa in faixas" v-text="faixa.dsc_faixa" :value="faixa.id" :key="faixa.id"></option>
            </select>
<!--
            <label for="ano">Ano</label>           
            <select 
                id="ano"
                class="form-control" 
                name="ano"                       
                v-model="ano">
                <option value="">Escolha um ano:</option>
                <option v-for="ano in anos" v-text="ano.num_ano_entrega" :value="ano.num_ano_entrega" :key="ano.num_ano_entrega"></option>
            </select>
            -->
        </div>
        <div class="row">
                <button type="submit" class="btn btn-primary btn-lg btn-block">{{tituloBtn}}</button>
        </div>
    
    </div>
    
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                tituloBtn:'Brasil',
                estados:'',
                estado:'',
                modalidades:'',
                modalidade:'',
                faixas:'',
                faixa:'',
                anos:'',
                ano:'',
                buscando: false,                
            }        
        },
        methods:{
            onChangeEstado() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                  

                   
                  
                } else {
                    this.tituloBtn = 'Brasil';
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"

                }            
            }            
        },
        mounted() {
            
            //buscar estados
            axios.get(this.url + '/api/executivo/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

             //buscar modalidadess
            axios.get(this.url + '/api/modalidades').then(resposta => {
                //console.log(resposta.data);
                this.modalidades = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

             //buscar Faixas
            axios.get(this.url + '/api/faixas').then(resposta => {
                //console.log(resposta.data);
                this.faixas = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

             //buscar anos
            axios.get(this.url + '/api/entregas/anos').then(resposta => {
                //console.log(resposta.data);
                this.anos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

        }
    }
</script>
