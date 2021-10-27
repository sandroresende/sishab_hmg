<template>
    <div class="form-group">  
    <div class="row">
        <div class="column col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div id="viewlet-above-content-title"></div>
                    <h3 class="documentFirstHeading text-center">
                Programa Casa Verde e Amarela - Parcerias
                        </h3>
                    <div class="linha-separa"></div>
                    
                    <div class="row">  
                        
                        <blockquote class="blockquote">   
                            <h4>Objetivo</h4>                     
                            <p>
                                - Reduzir a necessidade de entrada das famílias para a aquisição de imóveis;
                            </p>
                            <p>
                               	- Inibir outros empréstimos tomados pelas famílias, além do financiamento habitacional, para arcar com o valor da entrada, adequando seu endividamento à sua real capacidade de pagamento;
                            </p>
                            <p>
                                - Atender à demanda dos entes públicos quanto a alternativas de viabilizar sua participação na linha de atendimento do Programa Casa Verde e Amarela - Aquisição Financiada G1 e G2, por meio da oferta de contrapartidas cumulativas aos benefícios já oferecidos nas operações de financiamento com recursos do FGTS.
                            </p>
                            <br>                         
                            <h4>Famílias </h4>                     
                            <p>
                            Famílias cuja renda mensal bruta esteja limitada a R$ 4.000,00 (quatro mil reais).
                            </p>
                            <br>                                        
                                                
                            <h4>Requisitos</h4>
                            <p>
                                <strong>Ente Federado</strong>: Oferecer contrapartida mínima de 20% (recurso financeiro ou terreno).
                            </p>
                            <p>
                                <strong>Empresas</strong>: Construtora com nível de qualificação no SIAC/PBQP-H.
                            </p>
                            <p>
                                <strong>Famílias</strong>: Capacidade de endividamento..
                            </p>

                    
                        <br>                         
                            <h4>Como funciona  </h4>                     
                            <p>
                            O ente público local interessado deverá firmar Manifestação de Interesse à modalidade junto à Secretaria Nacional de Habitação e submeter proposta 
                            a instituição financeira habilitada para atuar com financiamentos habitacionais FGTS. A contrapartida aportada confere a prerrogativa de 
                            seleção das famílias beneficiárias ao ente público local, que deverá também, na hipótese de doação de terreno, realizar seleção para 
                            contratação da empresa de construção civil que construirá as unidades.
                            </p>
                        <br>                         
                            <h4>Abrangência </h4>                     
                            <p>
                            Território Nacional – áreas urbanas.
                            </p>

                            <br>                         
                            <h4>Política de desconto e taxa de juros </h4>                     
                            <p>
                           Aprovada nova metodologia de desconto complemento, que aumenta o valor do subsídio concedido às famílias, destinado ao pagamento de parte da aquisição ou construção 
                           do imóvel, em especial do G1, foco do Programa Casa Verde e Amarela – Parcerias.  Há ainda a concessão de descontos destinados à redução do valor das prestações, 
                           por meio de taxas de juros diferenciadas. 
                            </p>
                        </blockquote>

                        <blockquote class="blockquote"> 
                        
                            <h4>Passo a passo para registro no sistema:</h4>
                                <p class="text-muted">
                                1. Informe qual modalidade deseja participar</br>                        
                                2. Informe qual Proponente representará;</br>
                                3. Informe os dados do representante máximo do órgão responsável pela proposta;</br>                        
                                4. Informe os dados do usuário responsável pelo Aceite da Manifestação de Interesse;</br>
                                5. Clique em enviar;                           </br>
                                6. Aguarde o envio de confirmação da Manifestação de Interesse por e-mail.</br>    
                                </p>
                        </blockquote>  
                        
                        <blockquote class="blockquote">   
                            <h4>Suporte Técnico:</h4>
                        
                            <p>Encaminhar email para <strong>suporte.sishab@mdr.gov.br</strong></p>
                            
                        </blockquote>                               
                    </div>
                    <!--fim row-->

                </div><!--fim card-body-->
            </div><!--fim card-->
        </div><!--fim column col-sm-6-->
        
        <div class="column col-sm-6">
            <div class="card">
                <div class="card-body">
                <form v-bind:class="css" v-bind:action="action " v-bind:method="metodo" v-bind:enctype="enctype">
                
                <input v-if="token" type="hidden" name="_token" v-bind:value="token">
        
                    <div id="viewlet-above-content-title"></div>

                        <h3 class="documentFirstHeading text-center">
                            Formulário de Manifestação de Interesse 
                        </h3>
                        <div class="linha-separa"></div>
                        <div class="titulo">
                            <h5>Modalidade de Participação</h5> 
                        </div>

                        <div class="row">  
                            <div class="column col-xs-12 col-md-12">
                                <label for="tipo_prototipo">Modalidade de Participação</label>     
                                <select 
                                    id="modalidade_participacao"
                                class="form-control input-filtro"  
                                    name="modalidade_participacao"
                                    v-model="modalidade_participacao" 
                                    required>            
                                    <option for="participacao" value="">Escolha uma modalidade:</option>                
                                    <option v-for="item in modalidades_participacao" v-text="item.txt_modalidade_participacao" :value="item.id" :key="item.id"></option>   
                                    
                                </select>
                            </div>                        
                        </div>
                        <div class="titulo">
                            <h5>Dados do Ente Público</h5> 
                        </div>          
                        <div class="row">  
                            <div class="column col-xs-12 col-md-12">
                                <label for="tipo_proponente">Tipo Ente Público</label>           
                                <select 
                                    id="tipo_proponente_id"
                                    class="form-control"  
                                    name="tipo_proponente_id"  
                                    @change="onChangeTipoProp"  
                                    v-model="tipo_proponente_id"     
                                    required
                                    >
                                    <option value="">Escolha um Tipo:</option>
                                    <option value="6">Distrital</option>
                                    <option value="1">Estadual</option>
                                    <option value="2">Municipal</option>
                                    
                                </select>                        
                            </div>
                        </div>
                        <div class="row">        
                            <div class="column col-xs-12 col-md-4" v-if="tipo_proponente_id != 6">
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
                                <div class="column col-xs-12 col-md-8" v-if="tipo_proponente_id == 2">
                        <!-- municipio -->    
                                    <label for="municipio">Município (Sede do Ente Público)</label>
                                    <select 
                                        id="municipio"
                                        class="form-control" 
                                        name="municipio"
                                        required
                                        :disabled="estado == '' || buscando"
                                        v-model="municipio">
                                        <option value="" v-text="textoEscolhaMunicipio"></option>
                                        <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                                    </select>    
                                </div>
                            </div>
                        <slot>

                        </slot>
                        
                            <div class="linha-separa"></div>
                            <div class="titulo" v-if="tipo_proponente_id == 1">
                                <h5>Município(s) beneficiado(s)</h5> 
                            </div>
                            <!--fim row-->
                            
                            <div class="row" v-if="tipo_proponente_id == 1">     
                                <div class="column col-xs-12 col-md-12">               
                                    <label for="uf">UF</label>           
                                    <select 
                                        id="estado"
                                        class="form-control" 
                                        name="estado"
                                        required
                                        disabled
                                        @change="onChangeEstado"
                                        v-model="estado">
                                        <option value="">Escolha um Estado:</option>
                                        <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                                    </select>                                  
                                </div
                                 <div class="column col-xs-12 col-md-12">
                                    
                                        <!-- municipio -->    
                                    <label for="municipiosbeneficiados" class="control-label label-relatorio">Selecione o(s) Município(s) Beneficiado(s) (segure a tecla Ctrl para selecionar vários municípios)</label>
                                    <select 
                                        multiple
                                        id="municipiosbeneficiados"
                                        class="form-control" 
                                        name="municipiosbeneficiados[]"
                                        required
                                        :disabled="bln_todos_municipios == true">
                                        <option value="" v-text="textoEscolhaMunicipio"></option>
                                        <option v-for="municipio in municipiosbeneficiados" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                                    </select>    
                                    <label>
                                    <input type="checkbox" name="bln_todos_municipios" v-model="bln_todos_municipios">  
                                            Todos os municípios
                                    </label>
                                </div
                                 
                            </div>  

                             <!--fim row-->
                            <div class="titulo">
                                <h5>Dados da Contrapartida</h5> 
                            </div>          
                            <div class="row">  
                                <div class="col-xs-12 col-md-3">
                                    <label for="nome">N° Unidades</label>   
                                       <input name="num_unidades" class="form-control input-relatorio" v-model="num_unidades"  required>
                                </div>
                                
                                <div class="column col-xs-12 col-md-9">
                                    <label for="nome">Valor da Contrapartida Pretendida por Unidade</label>   
                                    <input name="vlr_contrapartida_uh" class="form-control" v-model="vlr_contrapartida_uh"  >
                                </div>
                            </div> 
                            <div class="row">
                                <div class="column col-xs-12 col-md-6" >
                                    <label for="vlr_terreno">Valor da Contrapartida terreno por unidade: </label>   
                                    <input type="text" name="vlr_terreno_uh" class="form-control" v-model="vlr_terreno_uh" >
                                </div>
                                <div class="column col-xs-12 col-md-6" >
                                    <label for="vlr_contrapartida">Valor da contrapartida financeira  por unidade: </label>   
                                    <input type="text" name="vlr_contrapartida_financ_uh" class="form-control" v-model="vlr_contrapartida_financ_uh" >
                                </div>
                            </div>          
                            <div class="row"   v-if="tipo_proponente_id == 2" >
                            <div class="column col-xs-12 col-md-12">
                                <label for="bln_contrapartida_adicional">Há previsão de contrapartida adicional pelo governo do Estado para as mesmas unidades?</label>   
                                <select 
                                    id="bln_contrapartida_adicional"
                                    class="form-control" 
                                    name="bln_contrapartida_adicional"               
                                    v-model="bln_contrapartida_adicional"
                                    >
                                    <option value="" selected>Responda se existe contrapartida adicional:</option>
                                    <option value="1">SIM</option>
                                    <option value="0">NÃO</option>
                                </select>    
                            </div>
                        </div> 

                        <div class="row" v-if='tipo_proponente_id == 2 && bln_contrapartida_adicional == 1'>    
                            <div class="column col-xs-12 col-md-8" >
                                <label for="ocupacao">Qual é a previsão de contrapartida adicional: </label>   
                                <select 
                                        id="tipo_contrapartida"
                                        class="form-control" 
                                        name="tipo_contrapartida"                                        
                                        v-model="tipo_contrapartida">
                                        <option value="">Escolha um tipo_contrapartida:</option>
                                        <option v-for="tipo_contrapartida in tipo_contrapartidas" v-text="tipo_contrapartida.txt_tipo_contrapartida" :value="tipo_contrapartida.id" :key="tipo_contrapartida.id"></option>
                                    </select>  
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label for="ocupacao">Valor previsão por Unidade: </label>   
                                <input type="text" name="vlr_contrapartida_adicional" class="form-control" v-model="vlr_contrapartida_adicional">
                            </div>
                            </div>
                        <!--fim row-->         
                               
                            
                            
                             <div class="linha-separa"></div>
                            <div class="row">
                                <div class="checkbox">
                                    <label>
                                    <input type="checkbox" name="termo" v-model="bln_aceite" required>  
                                            Registro a intenção deste Ente Público em participar do Programa Casa Verde e Amarela
                                             - Parcerias - Recursos FGTS, confirmando a disponibilidade de contrapartida exigida 
                                             pela modalidade de, no mínimo, 20% do valor do investimento por família beneficiada, 
                                             conforme dados preenchidos neste formulário.
                                    </label>
                                </div>   
                            </div><!-- fechar segundo form-group-->    
                            <strong>As informações constantes neste Formulário de Intenção têm validade até 31/12/2022.</strong>
                            <div class="row">
                             <input v-if='bln_aceite == true' class="btn btn-lg btn-primary btn-block" type="submit" value="Enviar">   
                             </div>
                       
                    </form> 
                </div><!--fim card-body-->
            </div><!--fim card-->
        </div><!--fim column col-sm-6-->
    </div>
    <!--fim row--> 
</div>


</template>

<script>
    export default {
        props:['url','errorshas','errorsfirst', 'token','enctype','metodo','css','action','show'],
        data(){
            return{
                modalidade_participacao:3,
                modalidades_participacao:'',
                tipo_contrapartidas:'',
                tipo_contrapartida:'',               
                tipo_proponente_id:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                municipiosbeneficiados: '',
                municipiobeneficiado:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
                num_unidades:'',
                vlr_contrapartida_uh:0,
                tipo_contrapartida:'',
                bln_contrapartida:'',
                vlr_contrapartida_financ_uh:0,
                vlr_terreno_uh:0,
                bln_contrapartida_adicional:0,
                contrapartida_adicional:'',
                vlr_contrapartida_adicional:0,
                bln_aceite:'',
                bln_todos_municipios:''

                
                
            }        
        },
        methods:{
            onChangeEstado() {
                    this.estado = 53;
            },    
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
                        this.municipiosbeneficiados = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.municipiobaneficiado = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            }
        },
        mounted() {
            axios.get(this.url + '/api/modalidade_participacao').then(resposta => {
                console.log(resposta.data);
                this.modalidades_participacao = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

             axios.get(this.url + '/api/tipo_contrapartida').then(resposta => {
                console.log(resposta.data);
                this.tipo_contrapartidas = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

        console.log(this.errorshas);
        }
    }
</script>
