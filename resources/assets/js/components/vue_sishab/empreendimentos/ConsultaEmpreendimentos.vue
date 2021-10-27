<template>
   <div class="form-group-border">   
        <div class="row" v-if="!(estado || (situacaoObra.length>0 && this.situacaoObra[0] != ''))">
            <label for="cpf" class="col-sm-2 col-form-label">APF</label>
            <div class="col-sm-12">
                <input type="text" class="form-control input-filtro" id="num_apf" name="num_apf" placeholder="Digite o APF sem o ponto e o hífen. Ex.: 123456" v-model="apfdigitado">
            </div>
        </div>

        <div class="row" v-if="!apfdigitado">        
            <div class="column col-xs-12 col-sm-4">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-control input-filtro" 
                    name="estado"
                    
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>        
            <div class="column col-xs-12 col-sm-8">
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
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                </select>    
            </div>
        </div>

        <div class="form-group row" v-if="!apfdigitado">        
             <div class="col-sm-12">
                <!-- Modalidades -->    
                <label for="modalidade">Modalidades</label>
                <select 
                    id="modalidade"
                    class="form-control input-filtro" 
                    name="modalidade" 
                    :disabled="empreendimento != ''"
                    v-model="modalidade">
                    <option value="" v-text="textoEscolhaModalidade"></option>
                    <option v-for="modalidade in modalidades" v-text="modalidade.txt_modalidade" :value="modalidade.id" :key="modalidade.id"></option>
                </select>    
            </div>
        </div>    
        <div class="form-group row" v-if="!apfdigitado">        
             <div class="col-sm-12">
                <label for="empreendimento">Empreendimentos</label>           
                <select 
                    id="empreendimento"
                    class="form-control input-filtro" 
                    name="empreendimento"
                    :disabled="!estado"
                    v-model="empreendimento">
                    <option value="" v-text="textoEscolhaEmpreendimento"></option>
                    <option v-for="empreendimento in empreendimentos" v-text="empreendimento.txt_nome_empreendimento + ' (' + empreendimento.txt_num_apf + ')'" :value="empreendimento.txt_num_apf" :key="empreendimento.txt_num_apf"></option>
                </select>                                  
            </div>    
        </div>   
        <!--
        <div class="form-group row" v-if="!apfdigitado">        
             <div class="col-sm-12">
                <label for="situacaoObra">Situação Obra</label>
                <select 
                multiple
                    id="situacaoObra"
                    class="form-control input-filtro" 
                    name="situacaoObra[]"    
                    :disabled="empreendimento != ''"        
                    v-model="situacaoObra">
                    <option value="" v-text="textoEscolhaSituacaoObra"></option>
                    <option v-for="situacaoObra in situacoesObras" v-text="situacaoObra.txt_situacao_obra" :value="situacaoObra.id" :key="situacaoObra.id"></option>
                </select>  
                </br>
            </div>              
        </div> 
        -->
        <div class="row"  v-if="!apfdigitado">
            <div class="col-xs-12 col-sm-6">
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
            <div class="col-xs-12 col-sm-6">
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
       
       
         <div class="row text-center">
        
            <button type="submit"  :disabled="situacaoObraHab" class="btn btn-primary btn-lg btn-block">Pesquisar</button>
        </div>  

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
                modalidades: '',
                modalidade:'',
                empreendimentos: '',
                empreendimento:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                textoEscolhaEmpreendimento: 'Filtre o Estado',
                textoEscolhaSituacaoObra: 'Escolha uma Situação',                
                textoEscolhaModalidade: 'Escolha uma Modalidade',
                textoEscolhastatusEmpreendimento: 'Escolha um Status de Empreendimento',                
                buscando: false,
                apfdigitado:'',
                nomedigitado:'',
                situacoesObras:'',
                situacaoObra: [],
                statusEmpreendimentos:'',
                statusEmpreendimento:'',
                vigente:''
            }        
        },
        computed: {
            situacaoObraHab() {
                if(this.estado != '')
                       return false;  
                else if(this.modalidade != '')
                
                       return false; 

                else if(this.statusEmpreendimento != '')
                
                       return false; 

                else if(this.vigente != '')
                
                       return false;        

                else if(this.apfdigitado)
                       return false;

                return !(this.situacaoObra.length > 0 && this.situacaoObra[0] != ''); 
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

                    axios.get(this.url + '/api/uf/empreendimentos/' + this.estado).then(resposta => {
                        
                        this.buscando = false;
                        this.empreendimentos = resposta.data;
                         if(this.empreendimentos.length>0){
                            this.textoEscolhaEmpreendimento = "Escolha um Empreendimento:";                         
                        }else{
                            this.textoEscolhaEmpreendimento = "Não possui Empreendimento";                           
                        }
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                    this.textoEscolhaEmpreendimento = "Filtre o Estado"
                }            
            },onChangeMunicipio() {
                this.textoEscolhaEmpreendimento = "Buscando...";
                this.empreendimento = '';
                //this.buscando = true;
                if(this.municipio != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/municipio/empreendimentos/' + this.municipio).then(resposta => {
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
                    
                    axios.get(this.url + '/api/executivo/modalidade/municipio/' + this.municipio).then(resposta => {
                        this.modalidades = resposta.data;
                         
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
            onChangeVigente() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhaMunicipio = "Buscando...";                
                //this.buscando = true;
                if(this.vigente != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/statusEmpreendimento/vigente/' + this.vigente).then(resposta => {
                        //console.log(resposta.data);
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
            //console.log(this.form._token);
             axios.get(this.url + '/api/executivo/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            axios.get(this.url + '/api/situacaoObra').then(resposta => {
                //console.log(resposta.data);
                this.situacoesObras = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            
             axios.get(this.url + '/api/modalidades').then(resposta => {
                //console.log(resposta.data);
                this.modalidades = resposta.data;
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