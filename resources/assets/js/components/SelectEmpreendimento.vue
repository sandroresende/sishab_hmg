<template>
   <div class="form-group">     
    <label for="regioes">Regiões</label>           
        <select 
            id="regiao"
            class="form-control" 
            name="regiao"                   
            @change="onChangeRegiao"
            v-model="regiao">
            <option value="">Escolha uma Regiao:</option>
            <option v-for="regiao in regioes" v-text="regiao.txt_regiao" :value="regiao.id" :key="regiao.id"></option>
        </select>                
        <label for="uf">UF</label>           
        <select 
            id="estado"
            class="form-control" 
            name="estado"           
            @change="onChangeEstado"
            v-model="estado"            
            >
            <option value="">Escolha um Estado:</option>
            <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
        </select>                                      
        
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

<!-- Modalidades -->    
        <label for="modalidade">Modalidades</label>
        <select 
            id="modalidade"
            class="form-control" 
            name="modalidade" 
            @change="onChangeModalidade"
            :disabled="municipio == '' || buscando"
            v-model="modalidade">
            <option value="" v-text="textoEscolhaModalidade"></option>
            <option v-for="modalidade in modalidades" v-text="modalidade.txt_modalidade" :value="modalidade.modalidade_id" :key="modalidade.modalidade_id"></option>
        </select>    
<!-- Empreendimentos -->    
        <label for="empreendimento">Empreendimentos</label>
        <select 
            id="empreendimento"
            class="form-control" 
            name="empreendimento" 
            :disabled="municipio == '' || buscando || empreendimentos == ''"
            v-model="empreendimento">
            <option value="" v-text="textoEscolhaEmpreendimento"></option>
            <option v-for="empreendimento in empreendimentos" v-text="empreendimento.txt_nome_empreendimento" :value="empreendimento.cod_operacao" :key="empreendimento.cod_operacao"></option>
        </select>    

    </div>    
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                regioes:'',
                regiao:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                empreendimentos:'',
                empreendimento:'',
                modalidades:'',
                modalidade:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                textoEscolhaEmpreendimento: 'Filtre o Município',
                textoEscolhaModalidade: 'Filtre o Município',
                buscando: false
            }        
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.textoEscolhaEmpreendimento = "Filtre o Município";
                this.empreendimento = '';
                 this.textoEscolhaModalidade = "Filtre o Município";
                this.modalidade = '';
                this.buscando = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/empreendimento/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.buscando = false;
                        this.municipios = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

                    axios.get(this.url + '/api/executivo/modalidade/estado/' + this.estado).then(resposta => {
                        this.modalidades = resposta.data;
                        this.buscando = false;
                        console.log(resposta);
                        if(this.modalidades.length>0){
                            this.textoEscolhaModalidade = "Escolha um Modalidade";                           
                        }else{
                            this.textoEscolhaModalidade = "Não possui Modalidade";                           
                        }
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            },
            onChangeMunicipio() {
                this.textoEscolhaEmpreendimento = "Buscando...";
                this.empreendimento = '';
                this.buscando = true;
                if(this.municipio != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/empreendimento/' + this.municipio).then(resposta => {
                        this.empreendimentos = resposta.data;
                        this.buscando = false;
                        console.log(resposta);
                        if(this.empreendimentos.length>0){
                            this.textoEscolhaEmpreendimento = "Escolha um Empreendimento";                           
                        }else{
                            this.textoEscolhaEmpreendimento = "Não possui empreendimentos";                           
                        }
                    }).catch(error => {
                        console.log(error);
                    });

                    axios.get(this.url + '/api/executivo/modalidade/' + this.municipio).then(resposta => {
                        this.modalidades = resposta.data;
                        this.buscando = false;
                        console.log(resposta);
                        if(this.modalidades.length>0){
                            this.textoEscolhaModalidade = "Escolha um Modalidade";                           
                        }else{
                            this.textoEscolhaModalidade = "Não possui Modalidade";                           
                        }
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.empreendimento = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado";
                    this.textoEscolhaEmpreendimento = "Filtre o Município";
                    this.textoEscolhaModalidade = "Filtre o Município"; 

                }            
            },
            onChangeRegiao() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.estado = '';
                this.buscando = true;
                if(this.regiao != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/ufs/' + this.regiao).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.buscando = false;
                        this.estados = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                     //buscar estados
                    axios.get(this.url + '/api/executivo/ufs').then(resposta => {
                        //console.log(resposta.data);
                        this.estados = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });
                }            
            },
            onChangeModalidade() {
                this.textoEscolhaEmpreendimento = "Buscando...";
                this.empreendimento = '';
                this.buscando = true;                
                if(this.modalidade != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/empreendimento/' + this.municipio+ '/' + this.modalidade).then(resposta => {
                        this.empreendimentos = resposta.data;
                        this.buscando = false;
                        console.log(resposta);
                        if(this.empreendimentos.length>0){
                            this.textoEscolhaEmpreendimento = "Escolha um Empreendimento";                           
                        }else{
                            this.textoEscolhaEmpreendimento = "Não possui empreendimentos";                           
                        }
                    }).catch(error => {
                        console.log(error);
                    });
                } else {
                    this.buscando = false;
                    this.empreendimento = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado";
                    this.textoEscolhaEmpreendimento = "Filtre o Município";
                    this.textoEscolhaModalidade = "Filtre o Município"; 

                }            
            },
        },
        mounted() {
             axios.get(this.url + '/api/executivo/regioes').then(resposta => {
                //console.log(resposta.data);
                this.regioes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
            //buscar estados
            axios.get(this.url + '/api/executivo/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
