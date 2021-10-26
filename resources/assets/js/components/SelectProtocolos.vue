<template>
   <div class="form-group">                    
        <label for="uf">UF</label>           
        <select 
            id="estado"
            class="form-control" 
            name="estado"
            required
            :disabled="buscando"
            @change="onChangeEstado"
            v-model="estado">
            <option value="" v-text="textoEscolhaEstado"></option>
            <option v-for="estado in estados" v-text="estado.sg_uf" :value="estado.id_uf" :key="estado.id_uf"></option>
        </select>                                  
    
        </br>
<!-- municipio -->    
        <label for="municipio">Município</label>
        <select 
            id="municipio"
            class="form-control" 
            name="municipio"
            required
            :disabled="estado == '' || buscando"
            v-model="municipio">
            <option value="" v-text="textoEscolhaMunicipio"></option>
            <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id_municipio" :key="municipio.id_municipio"></option>
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
                textoEscolhaEstado: 'Carregando...',
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
                    axios.get(this.url + '/api/protocolos/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.municipios = resposta.data;
                        this.buscando = false;
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
                        
            this.buscando = true;
            axios.get(this.url + '/api/protocolos/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.textoEscolhaEstado = 'Filtre o Estado'
                this.buscando = false;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
