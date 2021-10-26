<template>
    <div class="form-group">   
     <div class="row">  
            <label for="uf">Ação</label>           
            <select 
                id="acao"
                class="form-control" 
                name="acao"                     
                @change="onChangeAcao"
                v-model="acao">
                <option value="">Escolha uma Ação:</option>
                <option v-for="acao in acoes" v-text="acao.txt_sigla_modalidade + ' (' + acao.txt_cod_acao + ')'" :value="acao.id" :key="acao.id"></option>
            </select>  
            <label for="ano">Ano</label>           
            <select 
                id="ano"
                class="form-control" 
                name="ano"                       
                v-model="ano">
                <option value="">Escolha um ano:</option>
                <option v-for="ano in anos" v-text="ano.num_ano_exercicio" :value="ano.num_ano_exercicio" :key="ano.num_ano_exercicio"></option>
            </select>
        </div>
        <div class="row">
                <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
        </div>
    
    </div>
    
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                
                acoes:'',
                acao:'',
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
                   
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"

                }            
            }            
        },
        mounted() {
            
            //buscar estados
            axios.get(this.url + '/api/orcamento/acoesGoverno').then(resposta => {
                //console.log(resposta.data);
                this.acoes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

             //buscar anos
            axios.get(this.url + '/api/orcamento/anos').then(resposta => {
                //console.log(resposta.data);
                this.anos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

        }
    }
</script>
