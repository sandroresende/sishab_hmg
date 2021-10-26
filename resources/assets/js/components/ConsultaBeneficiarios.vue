<template>
<div>
   <div class="form-group">   
         <div class="form-group row" v-if="!cpfdigitado  && !estado">
            <label for="nome" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-12">
            <input type="text" class="form-control" id="nome_digitado" name="nome_digitado"placeholder="Digite um nome" v-model="nomedigitado">
            </div>
        </div>

        <div class="form-group row" v-if="!nomedigitado  && !estado">
            <label for="cpf" class="col-sm-2 col-form-label">CPF</label>
            <div class="col-sm-12">
            <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11" placeholder="Digite o CPF sem o ponto e o hífen. Ex.: 01234567890" v-model="cpfdigitado">
            </div>
        </div>
        
        <div class="row" v-if="!cpfdigitado && !nomedigitado">        
            <div v-bind:class="coluf">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-control" 
                    name="estado"
                    :required="!cpfdigitado"
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
                    :required="!cpfdigitado"
                    :disabled="estado == '' || buscando"
                    v-model="municipio">
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
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
                cpfdigitado:'',
                nomedigitado:''
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

            if(this.municipioselecionado){
                 axios.get(this.url + '/api/municipio/estado/' + this.municipioselecionado).then(resposta => {
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
