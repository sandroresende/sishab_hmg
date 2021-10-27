<template>
<div>
    <div class="form-group" v-if="this.blnpesquisaprot == 'true'">
        <div class="row" v-if="!(estado)">
            <label for="cpf" class="col-sm-2 col-form-label">APF</label>
            <div class="col-sm-12">
            <input type="text" class="form-control" id="num_protocolo" name="num_protocolo" placeholder="Digite o APF sem o ponto e o hífen. Ex.: 123456" v-model="protocolodigitado">
            </div>
        </div>    
    </div>
   <div class="form-group">   
        <div class="row" v-if="!protocolodigitado">        
            <div v-bind:class="coluf">
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
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                </select>    
            </div>
        </div>         
    </div>   
    <div class="form-group" v-if="this.blnpesquisasituac == 'true'">   
        <div class="row" v-if="!protocolodigitado">        
            <label for="situacao">Situação</label>           
            <select 
                id="situacao_adesao_id"
                class="form-control" 
                name="situacao_adesao_id"
                v-model="situacao">
                <option value="">Escolha uma Situação:</option>
                <option v-for="situacao in situacoes" v-text="situacao.txt_situacao_adesao" :value="situacao.id" :key="situacao.id"></option>
            </select>                                             
        </div>    
     </div>     
     <div class="row">
                <div class="column col-sm-6 col-xs-12">                                        
                    <input :disabled="habilitarBotao" class="btn btn-lg btn-info btn-block" type="submit" value="Pesquisar">       
                </div>
                <div class="column col-sm-6 col-xs-12">
                    <input class="btn btn-lg btn-danger btn-block" type="button-danger" onclick="javascript:window.history.go(-1)" value="Fechar">    
                </div>
            </div>    
    
</div>     
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','coluf','colmun','blnpesquisaprot','blnpesquisasituac'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',                
                buscando: false,
                protocolodigitado:'',
                situacao:'',
                situacoes:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                

               
            }        
        },   
        computed: {
            habilitarBotao() {
                if(this.estado != '')
                       return false;  
                else if(this.situacao != '')                
                       return false;        
                else if(this.protocolodigitado)
                       return false;               

                return true;       
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
                    this.textoEscolhaEmpreendimento = "Filtre o Estado"
                }            
            },
        },
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            axios.get(this.url + '/api/situacao_adesao').then(resposta => {
                //console.log(resposta.data);
                this.situacoes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
            
            
        }
    }
</script>
