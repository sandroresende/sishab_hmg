<template>
<div class="row">
                                
                <div v-bind:class="coltema">
                    <label for="tema">Tema</label>           
                    <select 
                        id="tema"
                        class="form-control" 
                        name="tema"
                        required
                         @change="onChangeTema"
                        v-model="tema">
                        <option value="">Escolha um Tema:</option>
                        <option v-for="tema in temas" v-text="tema.txt_tema" :value="tema.id" :key="tema.id"></option>
                    </select>     
                </div>
                <div v-bind:class="colsubtema">
                    <label for="subTema">SubTema</label>
                    <select 
                        id="subTema"
                        class="form-control" 
                        name="subTema"
                        required
                        :disabled="tema == '' || buscando"
                        v-model="subTema">
                        <option value="" v-text="textoEscolhaTema"></option>
                        <option v-for="subTema in subTemas" v-text="subTema.txt_sub_tema" :value="subTema.id" :key="subTema.id"></option>
                    </select> 
                </div>                
 
</div>    
</template>

<script>
    export default {
        props:['url','dados','subtemaselecionado','coltema','colsubtema'],
        data(){
            return{
                buscando: false,
                tema:'',
                temas:'',
                subTema:'',
                subTemas:'',
                textoEscolhaTema: 'Filtre o Tema',                
            }        
        },
        computed:{
            
        },
        methods:{
            onChangeTema(){
                this.textoEscolhaTema = "Buscando...";
                this.subTema = '';
                this.buscando = true;

                if(this.tema != ''){
                     //retorna os temas
                    axios.get(this.url + '/api/subTema/' + this.tema).then(resposta => {
                        this.textoEscolhaTema = "Escolha um SubTema:";
                        this.buscando = false;
                        this.subTemas = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });

                }else{
                    this.buscando = false;                      
                    this.subTema = '';
                    this.textoEscolhaTema = "Filtre o Tema";                    
                }
            },
            
        },
        mounted() {
           
            //retorna os temas
            axios.get(this.url + '/api/tema').then(resposta => {
                //console.log(resposta.data);
                this.temas = resposta.data;

            }).catch(erro => {
                console.log(erro);
            });

             axios.get(this.url + '/api/tema/subTema/' + this.subtemaselecionado).then(resposta => {
                this.tema = resposta.data;
                this.onChangeTema();
                this.subTema = this.subtemaselecionado;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
