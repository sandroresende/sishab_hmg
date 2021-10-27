<template>
   <div class="form-group-border">   
        <div class="row" v-if="!(estado || (modalidade) || (tipoLiberacao) || (mesSolicitacao) || (posicao_de) || (posicao_ate) || (mesLiberacao) ||(posicao_deLib) || (posicao_ateLib))">
            <label for="cpf" class="col-sm-2 col-form-label">APF</label>
            <div class="col-sm-12">
                <input type="text" class="form-control input-filtro" id="num_apf" name="num_apf" placeholder="Digite o APF sem o ponto e o hífen. Ex.: 123456" v-model="apfdigitado">
            </div>
        </div>
       
        <div class="row"  v-if="!apfdigitado">
            <div class="col-xs-12 col-sm-4">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-control input-filtro" 
                    name="estado"
                    :disabled="buscandoEstado"
                    @change="onChangeEstado"
                    v-model="estado">
                   <option value="" v-text="textoEscolhaEstado"></option>
                    <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.uf_id" :key="estado.uf_id"></option>
                </select>
            </div>
       
            <div class="col-xs-12 col-sm-8">
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
            </div>
        </div>
        <div class="row" v-if="!apfdigitado">
            <div class="col-xs-12 col-sm-12">
                <!-- municipio -->    
                <label for="modalidade">Modalidade</label>           
                <select 
                    id="modalidade"
                    class="form-control input-filtro" 
                    name="modalidade"  
                     @change="onChangeModalidade"             
                    v-model="modalidade">
                    <option value="">Escolha uma modalidade:</option>
                    <option v-for="modalidade in modalidades" v-text="modalidade.modalidade" :value="modalidade.id" :key="modalidade.id"></option>
                </select>  
            </div>
        </div>

        <div v-if="tipoliberacao == 'true' || !apfdigitado" class="row">
            <div class="col-xs-12 col-sm-12">
                <label for="tipoLiberacao">Tipo Liberação</label>           
                <select 
                    id="tipoLiberacao"
                    class="form-control input-filtro" 
                    name="tipoLiberacao"   
                    @change="onChangeTipo"       
                    :disabled="buscandoTipo"
                    v-model="tipoLiberacao">
                     <option value="" v-text="textoEscolhaTipo"></option>
                    <option v-for="item in tipoLiberacoes" v-text="item.txt_tipo_liberacao" :value="item.id" :key="item.id"></option>
                </select>
            </div>
        </div>
        <div class="row" v-if="!apfdigitado">
            <div class="column col-xs-12 col-sm-4">
                <label for="mesSolicitacao">Mês de Solicitação</label>           
                <select 
                    id="mesSolicitacao"
                    class="form-control input-filtro" 
                    name="mesSolicitacao"   
                    :disabled="buscandoMes"
                    @change="onChangeMesSolic"
                    v-model="mesSolicitacao">
                    <option value="" v-text="textoEscolhaMes"></option>
                    <option v-for="item in mesesSolicitacao" v-text="item.mes_solicitacao +'/' + item.ano_solicitacao" :value="item.num_mes_solicitacao +'-' + item.ano_solicitacao" :key="item.num_mes_solicitacao +'-' + item.ano_solicitacao"></option>
                </select>
            </div>
        
            <div class="column col-xs-12 col-sm-4">
                <label for="periodos_de">De</label>
                <select 
                    id="posicao_de"
                    class="form-control input-filtro" 
                    name="posicao_de" 
                    :disabled="buscandoPosicaoDe"
                    @change="onChangePosicao"
                    v-model="posicao_de"
                    >
                    <option value="" v-text="textoEscolhaPosicaoDe"></option>
                    <option v-for="posicao in posicoes_de" v-text="posicao.dte_posicao_formatada" :value="posicao.dte_solicitacao" :key="posicao.dte_solicitacao"></option>
                </select>        
            </div>
            <div class="column col-xs-12 col-sm-4">
                <label for="periodos_ate">Até</label>
                <select 
                    id="posicao_ate"
                    class="form-control input-filtro" 
                    name="posicao_ate" 
                     :disabled="posicao_de == '' || buscandoPosicaoAte"
                    v-model="posicao_ate"
                    >
                    <option value="" v-text="textoEscolhaPosicaoAte"></option>
                     <option v-for="posicao in posicoes_ate" v-text="posicao.dte_posicao_formatada" :value="posicao.dte_solicitacao" :key="posicao.dte_solicitacao"></option>
                </select>        
            </div>
        </div> 
       
         <div class="row text-center">
        
             <button type="submit" class="btn btn-primary btn-lg btn-block">{{tituloBtn}}</button>     
        </div>     
    </div>    
</template>

<script>
    export default {
        props:['url','tipoliberacao'],
        data(){
            return{
                tituloBtn:'Brasil',                
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',      
                tipoLiberacao:'',          
                tipoLiberacoes:'', 
                mesesSolicitacao:'',
                mesSolicitacao:'',                 
                mesesLiberacao:'',
                mesLiberacao:'',                
                textoEscolhaMunicipio: 'Filtre o Estado',
                textoEscolhaTipo: "Buscando...",
                textoEscolhaMes: "Buscando...",
                textoEscolhaMesLib: "Buscando...",
                textoEscolhaPosicaoDe:"Buscando...",
                textoEscolhaPosicaoDeLib:"Buscando...",
                textoEscolhaEstado: "Buscando...",
                textoEscolhaPosicaoAte:'Filtre uma data inicial de solicitação',
                textoEscolhaPosicaoAteLib:'Filtre uma data inicial de liberacao',
                textoEscolhaLiberacoes:'Buscando...',
                buscando: false,
                buscandoTipo: true,
                buscandoMes: true,
                buscandoMesLib: true,
                buscandoEstado: true,
                buscandoPosicaoDe: true,
                buscandoPosicaoDeLib: true,
                buscandoPosicaoAte: true,
                buscandoPosicaoAteLib: true,
                buscandoLiberacoes: true,
                posicao_de:'',
                posicao_ate:'',
                posicoes_de:'',
                posicoes_ate:'',
                posicao_deLib:'',
                posicao_ateLib:'',
                posicoes_deLib:'',
                posicoes_ateLib:'',                
                textoEscolhaAno:'Escolha o ano inicial',
                textoEscolhaposicao:'Escolha a posição inicial da base',
                 modalidades:[{"id":"2","modalidade":"Entidades"}, {"id":"3","modalidade":"FAR"}, {"id":"6","modalidade":"Rural"}] ,
                modalidade:'',
                apfdigitado:''
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
            },onChangeEstado() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhaMunicipio = "Buscando...";
                this.textoEscolhaTipo = "Buscando...";
                this.textoEscolhaMes = "Buscando...";
                this.textoEscolhaPosicaoDe = "Buscando...";
                this.municipio = '';
                this.tipoLiberacao = '';
                this.mesSolicitacao = '',
                this.posicoes_de = '',
                this.buscando = true;
                this.buscandoTipo = true;
                this.buscandoMes = true;
                this.buscandoPosicaoDe = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/solicitacoes/pagamento/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.municipios = resposta.data;
                        this.buscando = false;
                    }).catch(error => {
                        console.log(error);
                    });   

                     //buscar tipo liberações
                    axios.get(this.url + '/api/tipoLiberacao/uf/' + this.estado).then(resposta => {
                        this.textoEscolhaTipo = "Escolha um Tipo";
                        this.tipoLiberacoes = resposta.data;
                        this.buscandoTipo = false;
                    }).catch(erro => {
                        console.log(erro);
                    });  

                      //buscar tipo liberações
                    axios.get(this.url + '/api/mes/uf/' + this.estado).then(resposta => {
                        this.textoEscolhaMes = "Escolha um Mês";
                        this.mesesSolicitacao = resposta.data;
                        this.buscandoMes = false;
                    }).catch(erro => {
                        console.log(erro);
                    });    

                    axios.get(this.url + '/api/posicoesDe/uf/' + this.estado).then(resposta => {
                        //console.log(resposta.data);
                        this.posicoes_de = resposta.data;
                        this.buscandoPosicaoDe = false;
                        this.textoEscolhaPosicaoDe = "Escolha uma data Inicial de Solicitação:";
                    }).catch(erro => {
                        console.log(erro);
                    });
                                
                   this.textoEscolhaMes = "Escolha um Mês";
                } else {
                    this.tituloBtn = 'Brasil';
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                    this.textoEscolhaTipo = "Escolha um Tipo";
                    this.textoEscolhaMes = "Escolha um Mês";
                    this.textoEscolhaPosicaoDe = "Escolha uma data Inicial de Solicitação:";
                     this.buscandoTipo = false;
                    this.buscandoMes = false;
                    this.buscandoPosicaoDe = false;
                }    
                    
            },onChangeMunicipio() {
                this.textoEscolhaTipo = "Buscando...";
                this.textoEscolhaMes = "Buscando...";
                this.textoEscolhaPosicaoDe = "Buscando...";
                this.tipoLiberacao = '';
                this.textoEscolhaMes = '',
                this.posicoes_de = '',
                this.buscando = true;
                this.buscandoTipo = true;
                this.buscandoMes = true;
                this.buscandoPosicaoDe = true;
                if(this.municipio != '') {
                    //Implementação correta após arrumar tabela dos municipios
                      //buscar tipo liberações
                    axios.get(this.url + '/api/tipoLiberacao/municipio/' + this.municipio).then(resposta => {
                        this.textoEscolhaTipo = "Escolha um Tipo";
                        this.tipoLiberacoes = resposta.data;
                        this.buscandoTipo = false;
                    }).catch(erro => {
                        console.log(erro);
                    });  

                      //buscar tipo liberações
                    axios.get(this.url + '/api/mes/municipio/' + this.municipio).then(resposta => {
                        this.textoEscolhaMes = "Escolha um Mês";
                        this.mesesSolicitacao = resposta.data;
                        this.buscandoMes = false;
                    }).catch(erro => {
                        console.log(erro);
                    });    

                    axios.get(this.url + '/api/posicoesDe/municipio/' + this.municipio).then(resposta => {
                        //console.log(resposta.data);
                        this.posicoes_de = resposta.data;
                        this.buscandoPosicaoDe = false;
                        this.textoEscolhaPosicaoDe = "Escolha uma data Inicial de Solicitação:";
                    }).catch(erro => {
                        console.log(erro);
                    });
                   this.buscando = false;
                  
                } else {
                    this.buscando = false;
                    this.empreendimento = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado";
                   
                }            
            },onChangeTipo() {
                this.textoEscolhaMes = "Buscando...";
                this.textoEscolhaPosicaoDe = "Buscando...";
                this.textoEscolhaMes = "Buscando...";
                this.posicoes_de = '',
                this.posicoes_ate = '',
                this.buscandoMes = true;
                this.buscandoPosicaoDe = true;
                if(this.tipoLiberacao != '') {
                    //Implementação correta após arrumar tabela dos municipios
                   
                      //buscar tipo liberações
                     if((this.estado == '') && (this.municipio == '')) {
                         
                         axios.get(this.url + '/api/mes_tipo/tipoLiberacao/' + this.tipoLiberacao).then(resposta => {
                            this.textoEscolhaMes = "Escolha um Mês";
                            this.mesesSolicitacao = resposta.data;
                            this.buscandoMes = false;
                        }).catch(erro => {
                            console.log(erro);
                        });    

                        axios.get(this.url + '/api/posicoesDe_tipo/tipoLiberacao/' + this.tipoLiberacao).then(resposta => {
                            //console.log(resposta.data);
                            this.posicoes_de = resposta.data;
                            this.buscandoPosicaoDe = false;
                            this.textoEscolhaPosicaoDe = "Escolha uma data Inicial de Solicitação:";
                        }).catch(erro => {
                            console.log(erro);
                        });
                     } else if((this.$estado!= '') && (this.municipio == '') ){
                         
                         axios.get(this.url + '/api/mes_tipo/uf/' + this.estado +
                                                            '/tipoLiberacao/' + this.tipoLiberacao).then(resposta => {
                            this.textoEscolhaMes = "Escolha um Mês";
                            this.mesesSolicitacao = resposta.data;
                            this.buscandoMes = false;
                        }).catch(erro => {
                            console.log(erro);
                        });    

                        axios.get(this.url + '/api/posicoesDe_tipo/uf/' + this.estado +                                                            
                                                            '/tipoLiberacao/' + this.tipoLiberacao).then(resposta => {
                            //console.log(resposta.data);
                            this.posicoes_de = resposta.data;
                            this.buscandoPosicaoDe = false;
                            this.textoEscolhaPosicaoDe = "Escolha uma data Inicial de Solicitação:";
                        }).catch(erro => {
                            console.log(erro);
                        });
                     }else if(this.municipio != '') {  
                        axios.get(this.url + '/api/mes_tipo/municipio/' + this.municipio +
                                                            '/tipoLiberacao/' + this.tipoLiberacao).then(resposta => {
                            this.textoEscolhaMes = "Escolha um Mês";
                            this.mesesSolicitacao = resposta.data;
                            this.buscandoMes = false;
                        }).catch(erro => {
                            console.log(erro);
                        });    

                        axios.get(this.url + '/api/posicoesDe_tipo/municipio/' + this.municipio +                                                            
                                                            '/tipoLiberacao/' + this.tipoLiberacao).then(resposta => {
                            //console.log(resposta.data);
                            this.posicoes_de = resposta.data;
                            this.buscandoPosicaoDe = false;
                            this.textoEscolhaPosicaoDe = "Escolha uma data Inicial de Solicitação:";
                        }).catch(erro => {
                            console.log(erro);
                        });
                     }
                   this.buscando = false;
                  
                } else {
                    this.buscando = false;
                    this.empreendimento = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado";
                   
                }            
            },
            onChangePosicao() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhaPosicaoAte = "Buscando...";
                this.posicao_ate = '';
                this.buscandoPosicaoAte = true;
                if(this.posicao_de != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    if(this.mesSolicitacao != ''){
                        axios.get(this.url + '/api/mesSolicitacao/'+ this.mesSolicitacao +'/posicoesAte/' + this.posicao_de).then(resposta => {
                            this.textoEscolhaPosicaoAte = "Escolha uma data final de solicitação";
                            this.buscandoPosicaoAte = false;
                            this.posicoes_ate = resposta.data;
                        }).catch(error => {
                            console.log(error);
                        });
                    }else{
                        axios.get(this.url + '/api/posicoesAte/' + this.posicao_de).then(resposta => {
                            this.textoEscolhaPosicaoAte = "Escolha uma data final de solicitação";
                            this.buscandoPosicaoAte = false;
                            this.posicoes_ate = resposta.data;
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                    
                  
                } else {
                    this.textoEscolhaPosicaoDe = "Buscando...";
                    this.posicao_ate = '';
                    this.buscandoPosicaoAte = true;
                }            
            },
            onChangeMesSolic() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhaPosicaoDe = "Buscando...";
                this.textoEscolhaPosicaoAte = "Buscando...";
                this.posicao_de = '';
                this.buscandoPosicaoDe = true;     
                 this.posicao_ate = '';
                this.buscandoPosicaoAte = true;           
                    
                if(this.mesSolicitacao != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/posicoesDe/mesSolicitacao/'+this.mesSolicitacao).then(resposta => {
                        this.textoEscolhaPosicaoDe = "Escolha uma data inicial de solicitação";
                        this.textoEscolhaPosicaoAte = "Escolha uma data Final de solicitação";
                        this.buscandoPosicaoDe = false;
                        this.posicoes_de = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.textoEscolhaMes = "Buscando...";
                    this.posicao_de = '';
                    this.buscandoPosicaoDe = true;
                }            
            },
            onChangeMesLiber() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhaPosicaoDeLib = "Buscando...";
                this.textoEscolhaPosicaoAteLib = "Escolha uma data inicial de liberação";
                this.posicao_deLib = '';
                this.posicao_ateLib = '';
                this.buscandoPosicaoDeLib = true;                
                this.buscandoPosicaoAteLib = true;                
                  
                if(this.mesLiberacao != '') {                    
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/posicoesDeLib/mesLiberacao/'+this.mesLiberacao).then(resposta => {
                        this.textoEscolhaPosicaoDeLib = "Escolha uma data inicial de liberação";
                        this.buscandoPosicaoDeLib = false;
                        this.posicoes_deLib = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.textoEscolhaMesLib = "Buscando...";
                    this.posicao_deLib = '';
                    this.buscandoPosicaoDeLib = true;
                    this.posicao_ateLib = '';
                    this.buscandoPosicaoAteLib = true;
                }            
            },
            onChangePosicaoLib() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhaPosicaoAteLib = "Buscando...";
                this.posicao_ateLib = '';
                this.buscandoPosicaoAteLib = true;
                if(this.posicao_deLib != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    if(this.mesLiberacao != ''){
                        axios.get(this.url + '/api/mesLiberacao/'+ this.mesLiberacao +'/posicoesAteLib/' + this.posicao_deLib).then(resposta => {
                            this.textoEscolhaPosicaoAteLib = "Escolha uma data final de liberacao";
                            this.buscandoPosicaoAteLib = false;
                            this.posicoes_ateLib = resposta.data;
                        }).catch(error => {
                            console.log(error);
                        });
                    }else{
                        axios.get(this.url + '/api/posicoesAteLib/' + this.posicao_deLib).then(resposta => {
                            this.textoEscolhaPosicaoAteLib = "Escolha uma data final de liberacao";
                            this.buscandoPosicaoAteLib = false;
                            this.posicoes_ateLib = resposta.data;
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                    
                  
                } else {
                    this.textoEscolhaPosicaoDe = "Buscando...";
                    this.posicao_ate = '';
                    this.buscandoPosicaoAte = true;
                }            
            },
            onChangeModalidade() {
                this.tituloBtn = "Pesquisar";
                
                
            }
            
        },
        mounted() {
            
            //buscar estados
            axios.get(this.url + '/api/solicitacoes/pagamento/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.buscandoEstado = false;
                this.textoEscolhaEstado = "Escolha um estado:";
            }).catch(erro => {
                console.log(erro);
            });

             //buscar tipo liberações
            axios.get(this.url + '/api/tipoLiberacao').then(resposta => {
                //console.log(resposta.data);
                this.tipoLiberacoes = resposta.data;
                this.buscandoTipo = false;
                this.textoEscolhaTipo = "Escolha um Tipo";
            }).catch(erro => {
                console.log(erro);
            });
            
             //buscar Meses
            axios.get(this.url + '/api/mesesSolicitacao').then(resposta => {
                //console.log(resposta.data);
                this.mesesSolicitacao = resposta.data;
                this.buscandoMes = false;
                this.textoEscolhaMes = "Escolha um Mês";
            }).catch(erro => {
                console.log(erro);
            });

             //buscar Meses
            axios.get(this.url + '/api/posicoesDe').then(resposta => {
                //console.log(resposta.data);
                this.posicoes_de = resposta.data;
                this.buscandoPosicaoDe = false;
                this.textoEscolhaPosicaoDe = "Escolha uma data Inicial de Solicitação:";
            }).catch(erro => {
                console.log(erro);
            });

           
            
        }
    }
</script>
