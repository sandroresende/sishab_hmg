<template>
<div>
   
   <div class="well"> 
        <div class="form-group">
            <div class="row">
                <div class="column col-md-3">
                    <label for="cod_usuario" class="control-label">Data de Solicitação</label>
                    <input id="dte_solicitacao" type="text" class="form-control" name="dte_solicitacao" :value="this.dte_solicitacao">
                </div>
                <div class="column col-md-3">
                    <label for="situacao" class="control-label">Situação</label>
                    <input id="situacao" type="text" class="form-control" name="situacao" value="Em Análise" disabled>          
                </div>
                <div class="column col-md-3">
                    <label for="tipoDemanda">Tipo de demanda</label>           
                    <select 
                        id="tipo_demanda"
                        class="form-control" 
                        name="tipo_demanda"
                        required
                        v-model="tipoDemanda">
                        <option value="">Escolha um Tipo de demanda:</option>
                        <option v-for="tipoDemanda in tiposDemanda" v-text="tipoDemanda.txt_tipo_demanda" :value="tipoDemanda.id" :key="tipoDemanda.id"></option>
                    </select>                                  
                </div>
                <div class="column col-md-3">
                    <label for="tipo_atendimento">Tipo de Atendimento</label>           
                    <select 
                        id="tipo_atendimento"
                        class="form-control" 
                        name="tipo_atendimento"
                        required
                        v-model="tipoAtendimento">
                        <option value="">Escolha um Tipo de Atendimento:</option>
                        <option v-for="tipoAtendimento in tiposAtendimento" v-text="tipoAtendimento.txt_tipo_atendimento" :value="tipoAtendimento.id" :key="tipoAtendimento.id"></option>
                    </select>   
                </div>                
            </div><!-- fim row -->
            <div class="row">      
             <div class="column col-md-2">
                    <label for="modalidade">Modalidade</label>           
                    <select 
                        id="modalidade"
                        class="form-control" 
                        name="modalidade"
                        required
                        v-model="modalidade">
                        <option value="">Escolha uma Modalidade:</option>
                        <option v-for="modalidade in modalidades" v-text="modalidade.txt_modalidade_demanda" :value="modalidade.id" :key="modalidade.id"></option>
                    </select>     
                </div>              
                <div class="column col-md-3">
                    <label for="tema">Tema</label>           
                    <select 
                        id="tema"
                        class="form-control" 
                        name="tema"
                        required
                         @change="onChangeTema"
                        v-model="tema">
                        <option value="">Escolha um Tema:</option>
                        <option v-for="tema in temas" v-text="tema.txt_tema" :value="tema.id" :key="tema.id"></option>
                    </select>     
                </div>
                <div class="column col-md-7">
                    <label for="subTema">SubTema</label>
                    <select 
                        id="subTema"
                        class="form-control" 
                        name="subTema"
                        required
                        :disabled="tema == '' || buscando"
                        v-model="subTema">
                        <option value="" v-text="textoEscolhaTema"></option>
                        <option v-for="subTema in subTemas" v-text="subTema.txt_sub_tema" :value="subTema.id" :key="subTema.id"></option>
                    </select> 
                </div>                
            </div> 
        </div>            
        <div class="form-group">
             <div class="row">      
             <div class="column col-md-4">
                    <label for="tipoInteressado">Tipo Interessado</label>           
                    <select 
                        id="tipoInteressado"
                        class="form-control" 
                        name="tipoInteressado"
                        required
                        v-model="tipoInteressado">
                        <option value="">Escolha um tipoInteressado:</option>
                        <option v-for="tipoInteressado in tiposInteressado" v-text="tipoInteressado.txt_tipo_interessado" :value="tipoInteressado.id" :key="tipoInteressado.id"></option>
                    </select>     
                </div>
                <div class="column col-md-8">
                      <label for="txt_nome_interessado" class="control-label">Nome do Interessado </label>
                      <input id="txt_nome_interessado" type="text" class="form-control" name="txt_nome_interessado">    
                </div>                
            </div> 
        </div>


         <div class="form-group">
            <div class="row">
                 <div class="column col-md-3">
                   <label for="uf">UF</label>           
                    <select 
                        id="estado"
                        class="form-control" 
                        name="estado"
                        required
                        @change="onChangeEstado"
                        v-model="estado">
                        <option value="">Escolha um Estado:</option>
                        <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                    </select>   
                </div>  
                 <div class="column col-md-9">
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
        <div class="form-group">
             <label for="dsc_demanda" class="control-label">Descrição da Demanda</label>
             <textarea class="form-control" id="txt_descricao_demanda" name="txt_descricao_demanda"  rows="10" placeholder="Nome do Interessado"  required></textarea>
        </div>
        <div class="form-group">
             <div class="row">      
                <div class="column col-md-2">
                    <label for="prioridade">Prioridade</label>           
                    <select 
                        id="prioridade"
                        class="form-control" 
                        name="prioridade"
                        required
                        @change="onChangePrioridade"
                        v-model="prioridade">
                        <option value="">Escolha um Prioridade:</option>
                        <option v-for="prioridade in prioridades" v-text="prioridade.txt_prioridade" :value="prioridade.id" :key="prioridade.id"></option>
                    </select>     
                </div>              
                <div class="column col-md-3">
                    <label for="qtd_dias_conclusao" class="control-label">Qtde Dias </label>
                        <input id="qtd_dias_conclusao" type="text" class="form-control" name="qtd_dias_conclusao" @change="onChangeDias" :value="this.qtd_dias_conclusao">    
                </div>                             
            </div> 
        </div>
    </div>  
</div>    
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
                tipoDemanda:'',
                tiposDemanda:'',
                tipoAtendimento:'',
                tiposAtendimento:'',
                tema:'',
                temas:'',
                subTema:'',
                subTemas:'',
                textoEscolhaTema: 'Filtre o Tema',
                prioridade:1,
                prioridades:'',
                dte_previsao_conclusao: '',
                qtd_dias_conclusao: 30,
                dte_solicitacao:'',
                tipoInteressado:'',
                tiposInteressado:'',                
                nomeInteressado:'',                
                modalidade:'',
                modalidades:'',
            }        
        },
        computed:{
            adicionarDiasData: function(){
                let hoje        = new Date();
                let dataVenc    = new Date(hoje.getTime() + (this.qtd_dias_conclusao * 24 * 60 * 60 * 1000));
                let novaData = dataVenc.getDate() + "/" + (dataVenc.getMonth() + 1) + "/" + dataVenc.getFullYear();
                this.dte_previsao_conclusao = novaData;
                return novaData;
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
            },
            onChangeTema(){
                this.textoEscolhaTema = "Buscando...";
                this.subTema = '';
                this.buscando = true;

                if(this.tema != ''){
                     //retorna os temas
                    axios.get(this.url + '/api/subTema/' + this.tema).then(resposta => {
                        this.textoEscolhaTema = "Escolha um SubTema:";
                        this.buscando = false;
                        this.subTemas = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });

                }else{
                    this.buscando = false;                      
                    this.subTema = '';
                    this.textoEscolhaTema = "Filtre o Tema";                    
                }
            },
            onChangePrioridade(){
                   if(this.prioridade != ''){
                     //retorna os temas
                    axios.get(this.url + '/api/prioridade/' + this.prioridade).then(resposta => {
                        this.qtd_dias_conclusao = resposta.data;                                          
                        this.dte_previsao_conclusao = this.adicionarDiasData();
                    }).catch(erro => {
                        console.log(erro);
                    });

                }else{
                    this.qtd_dias_conclusao = 30;
                    this.dte_previsao_conclusao = this.adicionarDiasData();
                }

                
            },
            onChangeDias(){
                  this.dte_previsao_conclusao = this.adicionarDiasData();
            }
        },
        mounted() {

                       
            
              
            // data atual
            var data = new Date();
            this.dte_solicitacao = data.getDate() + '/' + (data.getMonth()+1) + '/' + data.getFullYear();
          // this.dte_previsao_conclusao = this.adicionarDiasData(this.qtd_dias_conclusao);
            
           
            //retorna as ufs
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os tipos de demanda
            axios.get(this.url + '/api/tipoDemanda').then(resposta => {
                //console.log(resposta.data);
                this.tiposDemanda = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os tipos de Atendimento
            axios.get(this.url + '/api/tipoAtendimento').then(resposta => {
                //console.log(resposta.data);
                this.tiposAtendimento = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os temas
            axios.get(this.url + '/api/tema').then(resposta => {
                //console.log(resposta.data);
                this.temas = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os prioridades
            axios.get(this.url + '/api/prioridade').then(resposta => {
                //console.log(resposta.data);
                this.prioridades = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os tipos de interessados
            axios.get(this.url + '/api/tipo_interessado').then(resposta => {
                //console.log(resposta.data);
                this.tiposInteressado = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

             //retorna os tipos de interessados
            axios.get(this.url + '/api/modalidade_demanda').then(resposta => {
                //console.log(resposta.data);
                this.modalidades = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
        }
    }
</script>
