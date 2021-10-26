<template>
   <div class="form-group">   
           <div class="row">
            <div class="column col-xs-12 col-sm-6">
                <label for="periodos_de">De</label>
                <select 
                    id="posicao_de"
                    class="form-control" 
                    name="posicao_de" 
                    :disabled="buscando"

                    @change="onChangePosicao"
                    v-model="posicao_de"
                    required>
                    <option value="" v-text="'Escolha a posição inicial da base'"></option>
                    <option v-for="posicao in posicoes_de" v-text="posicao.dte_posicao_formatada" :value="posicao.dte_posicao_arquivo" :key="posicao.dte_posicao_arquivo"></option>
                </select>        
            </div>
            <div class="column col-xs-12 col-sm-6">
                <label for="periodos_ate">Até</label>
                <select 
                    id="posicao_ate"
                    class="form-control" 
                    name="posicao_ate" 
                     :disabled="posicao_de == '' || buscando"
                    v-model="posicao_ate"
                    required>
                    <option value="" v-text="'Escolha a posição final da base'"></option>
                     <option v-for="posicao in posicoes_ate" v-text="posicao.dte_posicao_formatada" :value="posicao.dte_posicao_arquivo" :key="posicao.dte_posicao_arquivo"></option>
                </select>        
            </div>
        </div> 
<!-- Período -->                  
        <label for="regioes">Regiões</label>           
        <select 
            id="regiao"
            class="form-control" 
            name="regiao"       
            :disabled="rm_ride != '' || posicao_ate == '' "      
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
            :disabled="rm_ride != '' || posicao_ate == '' " 
            @change="onChangeEstado"
            v-model="estado">
            <option value="">Escolha um Estado:</option>
            <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
        </select>                                      
        
<!-- municipio -->    
        <label for="municipio">Município</label>
        <select 
            id="municipio"
            class="form-control" 
            name="municipio"            
            :disabled="estado == '' || buscando || rm_ride != ''"
            v-model="municipio">
            <option value="" v-text="textoEscolhaMunicipio"></option>
            <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
        </select>    

<!-- RIDE -->    
        <label for="ride">RM/RIDE</label>
        <select 
            id="rm_ride"
            class="form-control" 
            name="rm_ride" 
            :disabled="posicao_ate == '' "      
            v-model="rm_ride">
            <option value="" v-text="'Escolha a RM/RIDE'"></option>
            <option v-for="rm_ride in rm_rides" v-text="rm_ride.txt_rm_ride" :value="rm_ride.txt_rm_ride" :key="rm_ride.txt_rm_ride"></option>
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
                rm_rides:'',
                rm_ride:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
                posicao_de:'',
                posicao_ate:'',
                posicoes_de:'',
                posicoes_ate:'',
                textoEscolhaAno:'Escolha o ano inicial',
                textoEscolhaposicao:'Escolha a posição inicial da base'
            }        
        },
        methods:{
            formatarData(data) {
                if (data) {    
                    var dataFormatada = new Date(data)+1;                
                    var dia=dataFormatada.getDate();
                    if (dia < 10){
                        dia = "0" + dia
                    }

                    
                        
                    var mes=dataFormatada.getMonth();
                    mes = mes+1
                    if (mes < 10){
                        mes = "0" + mes
                    }
                    var ano=dataFormatada.getFullYear();
                   
                    return dia + '/' + (mes) + '/' + ano;
                    //return new Date(data).toLocaleString().substr(0, 10)
                } else {
                    return '';
                }
            },
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/municipios/' + this.estado).then(resposta => {
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
            onChangePosicao() {
                this.textoEscolhaPosicao = "Buscando...";
                this.posicao_ate = '';
                this.buscando = true;
                if(this.posicao_de != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/posicao/' + this.posicao_de).then(resposta => {
                        this.textoEscolhaPosicao = "Escolha a posição inicial da base:";
                        this.buscando = false;
                        this.posicoes_ate = resposta.data;
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

            axios.get(this.url + '/api/executivo/posicoes').then(resposta => {
                //console.log(resposta.data);
                this.posicoes_de = resposta.data;
                this.buscando = false;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
