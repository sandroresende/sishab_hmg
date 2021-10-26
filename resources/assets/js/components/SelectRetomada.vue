<template>
   <div class="form-group">                    
        <label for="uf">UF</label>           
        <select 
            id="estado"
            class="form-control" 
            name="estado"            
            @change="onChangeEstado"
            v-model="estado">
            <option value="">Escolha um Estado:</option>
            <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.uf_id" :key="estado.uf_id"></option>
        </select>                                  
    
        </br>
<!-- municipio -->    
        <label for="municipio">Município</label>
        <select 
            id="municipio"
            class="form-control" 
            name="municipio"
             @change="onChangeMunicipio"
            :disabled="estado == '' || buscando"
            v-model="municipio">
            <option value="" v-text="textoEscolhaMunicipio"></option>
            <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.municipio_id" :key="municipio.municipio_id"></option>
        </select>  
<!-- municipio -->    
        <label for="statusSNH">Status SNH</label>
        <select 
            id="statusSNH"
            class="form-control" 
            name="statusSNH"                        
            v-model="statusSNH">
            <option value="0" v-text="textoEscolhaStatusSNH"></option>
            <option v-for="item in statusSNHs" v-text="item.txt_status_snh" :value="item.id" :key="item.id"></option>
        </select>            

    </div>    
</template>

<script>
    export default {
        props:['url','ufId','municipioId','situacaoId'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
                textoEscolhaStatusSNH: 'Escolha um Status',
                statusSNHs: '',
                statusSNH: 0,
            }        
        },
        computed:{
            defineSituacao:function(){
                    if(this.situacaoId>0){
                        return this.situacaoId;
                    }
                    return 1
            }
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/retomada/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.buscando = false;
                        this.municipios = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

                                //console.log(this.form._token);
                    axios.get(this.url + '/api/statusSNH/estado/' + this.estado).then(resposta => {
                        //console.log(resposta.data);
                        this.statusSNHs = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"

                                //console.log(this.form._token);
                    axios.get(this.url + '/api/statusSNH').then(resposta => {
                        //console.log(resposta.data);
                        this.statusSNHs = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });
                }            
            },
            onChangeMunicipio() {
               
                if(this.municipio != '') {                  

                    axios.get(this.url + '/api/statusSNH/municipio/' + this.municipio).then(resposta => {
                        //console.log(resposta.data);
                        this.statusSNHs = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"

                                //console.log(this.form._token);
                                //console.log(this.form._token);
                    axios.get(this.url + '/api/statusSNH/estado/' + this.estado).then(resposta => {
                        //console.log(resposta.data);
                        this.statusSNHs = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });
                }            
            }
        },
        mounted() {            
            //console.log(this.form._token);
            axios.get(this.url + '/api/retomada/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //console.log(this.form._token);
            axios.get(this.url + '/api/statusSNH').then(resposta => {
                //console.log(resposta.data);
                this.statusSNHs = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
