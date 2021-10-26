<template>
<div>
   <div class="form-group">   

        <div class="form-group row" v-if="!estado">
            <label for="cpf" class="col-sm-2 col-form-label">Código do PAC</label>
            <div class="col-sm-12">
            <input type="text" class="form-control" id="projeto_pac_id" name="projeto_pac_id" placeholder="Digite o código do projeto sem o ponto e o hífen. Ex.: 123456" v-model="apfdigitado">
            </div>
        </div>
        
        <div class="row" v-if="!apfdigitado">        
            <div v-bind:class="coluf">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-control" 
                    name="estado"
                    :required="!apfdigitado"
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>        
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
                
    </div>   
     <button type="submit" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
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
                buscando: false,
                apfdigitado:'',
                nomedigitado:'',
            }        
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/vinculadas/municipios/' + this.estado).then(resposta => {
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
                    this.textoEscolhaEmpreendimento = "Filtre o Estado"
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
