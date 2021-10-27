<template>
   <div class="form-group">                    
<!-- estado -->   
<label for="regiao">Região</label>           
        <select 
            id="regiao"
            class="form-control input-filtro" 
            name="regiao"            
            @change="onChangeRegiao"
            v-model="regiao">
            <option value="">Escolha uma Região:</option>
            <option v-for="regiao in regioes" v-text="regiao.txt_regiao" :value="regiao.regiao_id" :key="regiao.regiao_id"></option>
        </select>                                   

<!-- estado -->   
        <label for="uf">UF</label>           
        <select 
            id="estado"
            class="form-control input-filtro" 
            name="estado"            
            @change="onChangeEstado"
            v-model="estado">
            <option value="">Escolha um Estado:</option>
            <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.uf_id" :key="estado.uf_id"></option>
        </select>                                   

<!-- municipio -->    
        <label for="municipio">Município</label>
        <select 
            id="municipio"
            class="form-control input-filtro" 
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
            class="form-control input-filtro" 
            name="modalidade"
            
            @change="onChangeModalidade"
            v-model="modalidade">
            <option value="" v-text="textoEscolhaModalidade"></option>
            <option v-for="modalidade in modalidades" v-text="modalidade.txt_modalidade" :value="modalidade.modalidade_id" :key="modalidade.modalidade_id"></option>
        </select>                 
<!-- ano seleção -->    
        <label for="ano_selecao">Ano Seleção</label>
        <select 
            id="ano_selecao"
            class="form-control input-filtro" 
            name="ano_selecao"
            v-model="anoSelecao">
            <option value="" v-text="textoEscolhaAnoSelecao"></option>
            <option v-for="anoSelecao in anosSelecao" v-text="anoSelecao.num_ano_selecao" :value="anoSelecao.num_ano_selecao" :key="anoSelecao.num_ano_selecao"></option>
        </select> 

        <label for="demanda_fechada">Demanda Fechada?</label>
        <select 
            id="demanda_fechada"
            class="form-control input-filtro" 
            name="demanda_fechada"
            v-model="demanda_fechada">
            <option value="" >Todas</option>
            <option value="false" >Não</option>
            <option value="true" >Sim</option>
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
                textoEscolhaMunicipio: 'Filtre o Estado',
                modalidades: '',
                modalidade:'',
                textoEscolhaModalidade: 'Escolha uma Modalidade',
                selecoes: '',
                selecao:'',
                anosSelecao: '',
                anoSelecao:'',
                textoEscolhaSelecao: 'Filtre o Estado',
                textoEscolhaAnoSelecao: 'Escolha um Ano',
                buscando: false,
                buscandoEstado: false,
                buscandoModalidade: false,
                buscandoAno: false,
                demanda_fechada:''
            }        
        },
        methods:{
            onChangeRegiao() {
                this.textoEscolhaEstado = "Buscando...";
                this.estado = '';
                this.buscandoEstado = true;

               this.textoEscolhaModalidade = "Buscando...";
                this.modalidade = '';
                this.buscandoModalidade = true;

                this.textoEscolhaAnoSelecao = "Buscando...";
                this.anoSelecao = '';
                this.buscandoAno = true;

                if(this.regiao != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/contratadas/estados/' + this.regiao).then(resposta => {
                        this.textoEscolhaEstado = "Todos";
                        this.buscandoEstado = false;
                        this.estados = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    }); 

                     //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/contratadas/modalidades/' + this.regiao).then(resposta => {
                        this.textoEscolhaModalidade = "Todos";
                        this.buscandoModalidade = false;
                        this.modalidades = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });   

                    axios.get(this.url + '/api/contratadas/ano/regiao/' + this.regiao).then(resposta => {
                        this.textoEscolhaAnoSelecao = "Todos";
                        this.buscandoAno = false;
                        this.anosSelecao = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });                   

                } else {
                    
                    this.buscandoEstado = false;
                    this.estado = '';
                    this.textoEscolhaEstado = "Filtre o Estado";

                    this.buscandoModalidade = false;
                    this.modalidade = '';
                    this.textoEscolhaModalidade = "Filtre a região ou o Estado";
                }            

                console.log(regiao + '/' + estado + '/' + buscandoEstado + '/'+ buscandoModalidade)
            },
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;

                this.textoEscolhaModalidade = "Buscando...";
                this.modalidade = '';
                this.buscandoEstado = true;

                this.textoEscolhaAnoSelecao = "Buscando...";
                this.anoSelecao = '';
                this.buscandoAno = true;
                
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/contratadas/municipios/' + this.estado).then(resposta => {
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

                    axios.get(this.url + '/api/contratadas/ano/estado/' + this.estado).then(resposta => {
                        this.textoEscolhaAnoSelecao = "Todos";
                        this.buscandoAno = false;
                        this.anosSelecao = resposta.data;
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

                
                this.textoEscolhaAnoSelecao = "Buscando...";
                this.anoSelecao = '';
                this.buscandoAno = true;
                
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

                    axios.get(this.url + '/api/contratadas/ano/municipio/' + this.municipio).then(resposta => {
                        this.textoEscolhaAnoSelecao = "Todos";
                        this.buscandoAno = false;
                        this.anosSelecao = resposta.data;
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
                this.textoEscolhaAnoSelecao = "Buscando...";
                this.anoSelecao = '';
                this.buscandoAno = true;

                this.textoEscolhaSelecao = "Buscando...";
                this.selecao = '';
                this.buscandoEstado = true;

                 if(this.modalidade != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/selecao/modalidade/' + this.modalidade).then(resposta => {
                        this.textoEscolhaSelecao = "Todas";
                        this.buscandoEstado = false;
                        this.selecoes = resposta.data;                        
                    }).catch(error => {
                        console.log(error);
                    });   

                    axios.get(this.url + '/api/contratadas/ano/modalidade/' + this.modalidade).then(resposta => {
                        this.textoEscolhaAnoSelecao = "Todos";
                        this.buscandoAno = false;
                        this.anosSelecao = resposta.data;
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
            axios.get(this.url + '/api/contratadas/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            axios.get(this.url + '/api/contratadas/regioes').then(resposta => {
                //console.log(resposta.data);
                this.regioes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            axios.get(this.url + '/api/contratadas/modalidades').then(resposta => {
                //console.log(resposta.data);
                this.modalidades = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            axios.get(this.url + '/api/contratadas/anosSelecao').then(resposta => {
                //console.log(resposta.data);
                this.anosSelecao = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });


        },
    }
</script>
