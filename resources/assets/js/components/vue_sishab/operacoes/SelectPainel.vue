<template>

   <div class="form-group-border">    
        <div class="row">
            <div class="column col-xs-12 col-sm-6">
                <label for="regioes">Regiões</label>           
                    <select 
                        id="regiao"
                        class="form-control input-filtro" 
                        name="regiao"       
                        :disabled="rm_ride != ''"      
                        @change="onChangeRegiao"
                        v-model="regiao">
                        <option value="">Escolha uma Regiao:</option>
                        <option v-for="regiao in regioes" v-text="regiao.txt_regiao" :value="regiao.id" :key="regiao.id"></option>
                    </select>
            </div>
            <div class="column col-xs-12 col-sm-6">
            <!-- RIDE -->    
                <label for="ride">RM/RIDE</label>
                    <select 
                        id="rm_ride"
                        class="form-control input-filtro" 
                        name="rm_ride" 
                        @change="onChangeRide"
                        v-model="rm_ride">
                        <option value="" v-text="'Escolha a RM/RIDE'"></option>
                        <option v-for="rm_ride in rm_rides" v-text="rm_ride.txt_rm_ride" :value="rm_ride.txt_rm_ride" :key="rm_ride.txt_rm_ride"></option>
                    </select>   
            </div>
        </div>
        <div class="row">
            <div class="column col-xs-12 col-sm-6">
                <label for="uf">UF</label>           
                    <select 
                        id="estado"
                        class="form-control input-filtro" 
                        name="estado"           
                        :disabled="rm_ride != ''" 
                        @change="onChangeEstado"
                        v-model="estado">
                        <option value="">Escolha um Estado:</option>
                        <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                    </select>    
            </div>
            <div class="column col-xs-12 col-sm-6">
        <!-- municipio -->    
                <label for="municipio">Município</label>
                    <select 
                        id="municipio"
                        class="form-control input-filtro" 
                        name="municipio"            
                        :disabled="estado == '' || buscando || rm_ride != ''"
                        v-model="municipio">
                        <option value="" v-text="textoEscolhaMunicipio"></option>
                        <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                    </select>    
            </div>
        </div>
                       
        <div class="row">
            <div class="column col-xs-12 col-sm-6">
                <label for="periodos_de">Empreendimentos Contratados de</label>
                <select 
                    id="ano_de"
                    class="form-control input-filtro" 
                    name="ano_de" 
                    @change="onChangeAno"
                    v-model="ano_de">
                    <option value="" v-text="'Escolha um ano'"></option>
                    <option v-for="ano in anos" v-text="ano.num_ano_assinatura" :value="ano.num_ano_assinatura" :key="ano.num_ano_assinatura"></option>
                </select>        
            </div>
            <div  v-if="ateano == 'true'" class="column col-xs-12 col-sm-6">
                <label for="periodos_ate">Até</label>
                <select 
                    id="ano_ate"
                    class="form-control input-filtro" 
                    name="ano_ate" 
                     :disabled="ano_de == '' || buscando"
                    v-model="ano_ate">
                    <option value="" v-text="textoEscolhaAno"></option>
                    <option v-for="ano in anos_ate" v-text="ano.num_ano_assinatura" :value="ano.num_ano_assinatura" :key="ano.num_ano_assinatura"></option>
                </select>        
            </div>
        </div> 
        <div v-if="vidvigente == 'true'" class="row">
            <div class="column col-xs-12 col-sm-6">
                <label for="statusEmpreendimento">Empreendimentos Vigentes</label>
                <select 
                id = "bln_vigente"
                 class="form-control input-filtro" 
                    name="bln_vigente"
                     v-model="vigente"
                     @change="onChangeVigente" >
                 <option value="" v-text="'Escolha uma opção'"></option>
                 <option value="true" v-text="'Sim'"></option>
                 <option value="false" v-text="'Não'"></option>

                </select>
            </div>
            <div class="column col-xs-12 col-sm-6">
                <label for="statusEmpreendimento">Status Empreendimentos</label>
                <select 
                multiple
                    id="statusEmpreendimento"
                    class="form-control input-filtro" 
                    name="statusEmpreendimento[]"            
                    v-model="statusEmpreendimento">
                    <option value="" v-text="textoEscolhastatusEmpreendimento"></option>
                    <option v-for="statusEmpreendimento in statusEmpreendimentos" v-text="statusEmpreendimento.txt_status_empreendimento" :value="statusEmpreendimento.id" :key="statusEmpreendimento.id"></option>
                </select>  
             </div>   
        </div>     
        </br>
        <div class="row text-center">
       <button type="submit" class="btn btn-primary btn-lg btn-block">{{tituloBtn}}</button>
        </div>
<!-- Período --> 
          
    </div>    
    

</template>

<script>
    export default {
        props:['url','vidvigente','ateano'],
        data(){
            return{
                tituloBtn:'Brasil',
                regioes:'',
                regiao:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                rm_rides:'',
                rm_ride:'',
                statusEmpreendimentos:'',
                statusEmpreendimento:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                textoEscolhastatusEmpreendimento: 'Escolha um Status de Empreendimento',
                buscando: false,
                ano_de:'',
                ano_ate:'',
                anos:'',
                anos_ate:'',
                textoEscolhaAno:'Escolha o ano inicial',
                vigente:''
            }        
        },
        methods:{
            onChangeEstado() {
                this.tituloBtn = "Pesquisar";
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

                      //buscar rm e ride
                        axios.get(this.url + '/api/executivo/rides/' + this.estado).then(resposta => {
                            //console.log(resposta.data);
                            this.rm_rides = resposta.data;
                        }).catch(erro => {
                            console.log(erro);
                        });
                  
                } else {
                    this.tituloBtn = 'Brasil';
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"

                     //buscar rm e ride
                        axios.get(this.url + '/api/executivo/rides').then(resposta => {
                            //console.log(resposta.data);
                            this.rm_rides = resposta.data;
                        }).catch(erro => {
                            console.log(erro);
                        });
                }            
            },
            onChangeRegiao() {
                this.tituloBtn = "Pesquisar";
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

                     //buscar rm e ride
                        axios.get(this.url + '/api/executivo/rides/regiao/' + this.regiao).then(resposta => {
                            //console.log(resposta.data);
                            this.rm_rides = resposta.data;
                        }).catch(erro => {
                            console.log(erro);
                        });
                  
                } else {
                    this.tituloBtn = 'Brasil';
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
            onChangeRide(){
                this.tituloBtn = "Pesquisar";
               if(this.rm_ride != ''){
                    this.municipio = '';
                    this.estado = '';
                    this.regiao = '';
                }else{
                    this.tituloBtn = "Brasil";
                     //buscar regiao
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

                         //buscar rm e ride
                        axios.get(this.url + '/api/executivo/rides').then(resposta => {
                            //console.log(resposta.data);
                            this.rm_rides = resposta.data;
                        }).catch(erro => {
                            console.log(erro);
                        });
                }
            },
            onChangeAno() {
                this.textoEscolhaAno = "Buscando...";
                this.ano_ate = '';
                this.buscando = true;
                if(this.ano_de != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/anos/' + this.ano_de).then(resposta => {
                        this.textoEscolhaAno = "Escolha um ano:";
                        this.buscando = false;
                        this.anos_ate = resposta.data;
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
            onChangeVigente() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhastatusEmpreendimento = "Buscando...";                
                this.buscando = true;
                if(this.vigente != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/statusEmpreendimento/vigente/' + this.vigente).then(resposta => {
                        //console.log(resposta.data);
                         this.buscando = false;
                        this.statusEmpreendimentos = resposta.data;
                       
                    }).catch(erro => {
                        console.log(erro);
                    });
                  
                } else {
                    this.tituloBtn = 'Brasil';
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"

                     //buscar rm e ride
                        axios.get(this.url + '/api/executivo/rides').then(resposta => {
                            //console.log(resposta.data);
                            this.rm_rides = resposta.data;
                        }).catch(erro => {
                            console.log(erro);
                        });
                }            
            }
        },
        mounted() {
            //buscar regiao
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

             //buscar rm e ride
            axios.get(this.url + '/api/executivo/rides').then(resposta => {
                //console.log(resposta.data);
                this.rm_rides = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            axios.get(this.url + '/api/executivo/anos').then(resposta => {
                //console.log(resposta.data);
                this.anos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            axios.get(this.url + '/api/statusEmpreendimento').then(resposta => {
                //console.log(resposta.data);
                this.statusEmpreendimentos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
