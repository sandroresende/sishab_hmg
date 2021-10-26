<template>
   <div class="form-group">                    
        <label for="uf">UF</label>           
        <select 
            id="estado"
            class="form-control" 
            name="estado"
            required
            @change="onChangeEstado"
            v-model="estado">
            <option value="">Escolha um Estado:</option>
            <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
        </select>                                  
    
        </br>
<!-- municipio -->    
        <label for="municipio">Município</label>
        <select 
            multiple
            id="municipio"
            class="form-control" 
            name="municipio[]"
            required
            :disabled="estado == '' || buscando"
            v-model="municipio">
            <option value="" v-text="textoEscolhaMunicipio"></option>
            <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
        </select>    

    </div>    
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false
            }        
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.buscando = false;
                        this.municipios = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            }
        },
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
