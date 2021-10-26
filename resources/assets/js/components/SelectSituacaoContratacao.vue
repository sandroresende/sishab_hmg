<template>
   <div class="form-group">   
        <div class="row">   
            <div class="col-xs-12 col-sm-3">     
                <div v-bind:class="coluf">
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
                </div>  
            </div>

            <div class="col-xs-12 col-sm-6">          
                <div v-bind:class="colmun">
        <!-- municipio -->    
                    <label for="municipio">Município</label>
                    <select 
                        id="municipio"
                        class="form-control" 
                        name="municipio"
                        :disabled="estado == '' || buscando"
                        v-model="municipio">
                        <option value="" v-text="textoEscolhaMunicipio"></option>
                        <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.municipio_id" :key="municipio.municipio_id"></option>
                    </select>    
                </div>
            </div>
            <div class="col-xs-12 col-sm-3">          
                <div v-bind:class="colmun">
        <!-- municipio -->    
                    <label for="situacao">Situação</label>
                    <select 
                        id="situacao"
                        class="form-control" 
                        name="situacao"
                        >
                        <option value="">Escolha uma Situação</option>
                        <option value="0">Não Contratadas</option>
                        <option value="1">Contratadas</option>
                    </select>    
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisa</button>
    </div>    
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','coluf','colmun'],
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
                    axios.get(this.url + '/api/municipios/contratacao/' + this.estado).then(resposta => {
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

            if(this.municipioselecionado){
                 axios.get(this.url + '/api/contratacao/municipio/estado/' + this.municipioselecionado).then(resposta => {
                        this.estado = resposta.data;
                        this.onChangeEstado();
                        this.municipio = this.municipioselecionado;

                    }).catch(error => {
                        console.log(error);
                    });  
            }else{
                this.estado = '';
                this.municipio = '';
            }
        }
    }
</script>
