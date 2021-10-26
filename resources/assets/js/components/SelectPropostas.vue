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
            <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.uf_id" :key="estado.uf_id"></option>
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

<!-- modalidade -->    
        <label for="modalidade">Modalidade</label>
        <select 
            id="modalidade"
            class="form-control" 
            name="modalidade"
            :disabled="estado == '' || buscandoEstado"
            @change="onChangeModalidade"
            v-model="modalidade">
            <option value="" v-text="textoEscolhaModalidade"></option>
            <option v-for="modalidade in modalidades" v-text="modalidade.txt_modalidade" :value="modalidade.modalidade_id" :key="modalidade.modalidade_id"></option>
        </select>                  

<!-- seleção -->    
        <label for="selecao">Seleção</label>
        <select 
            id="selecao"
            class="form-control" 
            name="selecao"
            :disabled="estado == '' || buscandoEstado"
            v-model="selecao">
            <option value="" v-text="textoEscolhaSelecao"></option>
            <option v-for="selecao in selecoes" v-text="selecao.num_selecao +'ª seleção de ' + selecao.num_ano_selecao +' - '+ selecao.txt_modalidade" :value="selecao.selecao_id" :key="selecao.selecao_id"></option>
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
                modalidades: '',
                modalidade:'',
                textoEscolhaModalidade: 'Filtre o Estado',
                selecoes: '',
                selecao:'',
                textoEscolhaSelecao: 'Filtre o Estado',
                buscando: false,
                buscandoEstado: false
            }        
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;

                this.textoEscolhaModalidade = "Buscando...";
                this.modalidade = '';
                this.buscandoEstado = true;
                
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/propostas/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Todos";
                        this.buscando = false;
                        this.municipios = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

                    axios.get(this.url + '/api/modalidade/estado/' + this.estado).then(resposta => {
                        this.textoEscolhaModalidade = "Todas";
                        this.buscandoEstado = false;
                        this.modalidades = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

                    axios.get(this.url + '/api/selecao/estado/' + this.estado).then(resposta => {
                        this.textoEscolhaSelecao = "Todas";
                        this.buscandoEstado = false;
                        this.selecoes = resposta.data;
                    
                    }).catch(error => {
                        console.log(error);
                    });


                     

                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                    
                    this.buscandoEstado = false;
                    this.modalidade = '';
                    this.textoEscolhaModalidade = "Filtre o Estado";
                    
                    

                }            
            },
            onChangeMunicipio() {
                this.textoEscolhaModalidade = "Buscando...";
                this.modalidade = '';
                this.buscandoEstado = true;
                
                if(this.municipio != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/modalidade/municipio/' + this.municipio).then(resposta => {
                        this.textoEscolhaModalidade = "Todas";
                        this.buscandoEstado = false;
                        this.modalidades = resposta.data;
                        console.log(this.modalidades);
                    }).catch(error => {
                        console.log(error);
                    });

                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/selecao/municipio/' + this.municipio).then(resposta => {
                        this.textoEscolhaModalidade = "Todas";
                        this.buscandoEstado = false;
                        this.selecoes = resposta.data;                        
                    }).catch(error => {
                        console.log(error);
                    });   
                } else {                    
                    this.buscandoEstado = false;
                    this.modalidade = '';
                    this.textoEscolhaModalidade = "Filtre o Estado";
                }            
            },
            onChangeModalidade() {
                this.textoEscolhaSelecao = "Buscando...";
                this.selecao = '';
                this.buscandoEstado = true;

                 if(this.municipio != '') {
                                     

                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/selecao/modalidade/' + this.modalidade).then(resposta => {
                        this.textoEscolhaSelecao = "Todas";
                        this.buscandoEstado = false;
                        this.selecoes = resposta.data;                        
                    }).catch(error => {
                        console.log(error);
                    });   
                } else {                    
                    this.buscandoEstado = false;
                    this.selecao = '';
                    this.textoEscolhaSelecao = "Filtre o Estado";
                } 
            }    
        },
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/selecao/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
