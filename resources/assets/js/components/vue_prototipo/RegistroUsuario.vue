<template>
<div class="form-group">  
<div class="row">
    <div class="column col-sm-6">
        <div class="card">
            <div class="card-body">
                <div id="viewlet-above-content-title"></div>
                <h3 class="documentFirstHeading text-center">
              Processos seletivos SisHab
                    </h3>
                <div class="linha-separa"></div>
               


                <div class="row">  
                    
                    <blockquote class="blockquote">   
                        <h4>Quais são as modalidades de participação?                            </h4>                     
                        <p><strong>Modalidade I - </strong> Protótipos para a concepção e implementação de empreendimentos inovadores <strong>(AGUARDANDO  CHAMAMENTO)</strong>; e </p>
                        
                        
                         <p>
                            <strong>Modalidade II - Edital de Chamamento às COHABs e Agentes Públicos de Habitação associadas a ABC</strong>: seleção de terrenos para implantação de estudo 
                            preliminar de projeto urbanístico e projeto executivo de conjunto arquitetônico de habitação de interesse social, pelos vencedores do concurso de ideias em 
                            arquitetura "Habitação de Interesse Sustentável”.<strong>(ABERTO)</strong></br>
                            <em>*  Para maiores informações consultar o edital de chamamento.</em>
                        </p>
                         
                        <h4>Quem pode enviar propostas?</h4>                     
                        <p>
                           Entes Públicos subnacionais (municípios, estados e Distrito Federal) direta ou indiretamente, por meio de companhias, autarquias ou agências habitacionais, 
                           associados à Associação Brasileira de COHABS e Agentes Públicos de Habitação (ABC). 
                        </p>
                        
                                         
                                               
                        <h4>Como se registrar para acessar o sistema?</h4>
                        <p>
                            Deve ser enviado Ofício assinado pelo Chefe do Poder Executivo com a indicação do responsável pelo encaminhamento da proposta e e-mail institucional para cadastro 
                            e homologação. No caso em que o responsável pelo encaminhamento da proposta for vinculado a órgão da administração direta, deve ser enviado também Ofício assinado 
                            pelo Presidente da companhia, autarquia ou agência habitacional associada à ABC. Os documentos devem ser elaborados em papel timbrado, 
                            digitalizados e enviados por intermédio do sistema, conforme os modelos disponibilizados abaixo:
                        </p>
                        
                    </blockquote>
                    <!-- Modelo de Ofício -->
                    <div class="card text-white">
                        <div class="card-header header-secundario">
                            <h4><i class="fas fa-file-alt"></i> <b>Modelos de Ofício</b></h4> 
                        </div>
                        <div class="card-body">
                            
                            <a 
                            class="modeloOficio" 
                            v-bind:href="show + '/modelo_oficio_prefeitura_1.pdf'"
                            target="_blank">
                            1. 	Modelo de Ofício Entes Públicos Locais (Subnacionais)</a>
                            
                            
                            <a 
                            class="modeloOficio" 
                            v-bind:href="show + '/modelo_oficio_COHAB.pdf'"
                            target="_blank">
                            2. Modelo de Ofício companhias, autarquias e agências de habitação </a>

                            
                           
                        </div>
                    </div>  
                    <blockquote class="blockquote"> 
                     
                        <h4>Passo a passo para registro no sistema:</h4>
                            <p class="text-muted">
                            1. Informe qual modalidade deseja participar</br>                        
                            2. Informe qual Proponente representará;</br>
                            3. Informe os dados do representante máximo do órgão responsável pela proposta;</br>                        
                            4. Informe os dados do usuário responsável pelo cadastramento da proposta;</br>
                            5. Anexe o(s) ofício(s) necessários conforme vínculo direto ou indireto com a administração do órgão responsável pela proposta 
                            (Verifique o conteúdo necessário conforme os modelos disponibilizados acima)</br>
                            6. Clique em enviar;                           </br>
                            7. Aguarde o envio de confirmação de aprovação do cadastro por e-mail;</br>
                            8. Acesse o SISHAB e redefina a senha padrão para cadastrar propostas.
                            </p>
                    </blockquote>  
                    <blockquote class="blockquote">   
                        <h4>Dúvidas sobre preenchimento da proposta:</h4>
                    
                        <p>- Encaminhar email para <strong>cct-snh@mdr.gov.br</strong></p>
                        <p>- <a 
                            class="modeloOficio" 
                            v-bind:href="url + '/documents/prototipo/manual_uso_sistema.pdf'"
                            target="_blank">Manual de Utilização do Sistema </a></p>
                    </blockquote> 
                    <blockquote class="blockquote">   
                        <h4>Suporte Técnico:</h4>
                    
                        <p>- Encaminhar email para <strong>suporte.sishab@mdr.gov.br</strong></p>
                        
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
                        Registro
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
                            class="form-control"  
                                name="modalidade_participacao"
                                v-model="modalidade_participacao" 
                                required>            
                                <option for="participacao" value="">Escolha uma modalidade:</option>                
                                <option v-for="item in modalidades_participacao" v-text="item.txt_modalidade_participacao" :value="item.id" :key="item.id"></option>   
                                       
                            </select>
                        </div>                        
                    </div>
                    <div class="row" >  
                        <div class="column col-xs-12 col-md-12">
                            <label for="adm_indireta">O Órgão responsável é COHAB, Agência ou Órgão da Adm Indireta?</label>     
                            <select 
                                id="bln_adm_indireta"
                            class="form-control"  
                                name="bln_adm_indireta"
                                v-model="bln_adm_indireta" 
                                required>
                                <option value="">Escolha uma resposta:</option>

                                <option value="0">Não</option>
                                <option value="1">Sim</option>                
                            
                            </select>
                        </div>               
                    </div>
                    <slot>

                    </slot>

                    <!--fim row-->
                    <div class="row">
                        <div class="column col-xs-12 col-md-12">
                            <label for="caminho_doc_cartorio">Anexar Ofício Assinado Entes Públicos Subnacionais</label>
                            <input type="file" class="form-control-file" id="txt_caminho_oficio" name="txt_caminho_oficio" accept="image/* , application/pdf" required>
                        </div>
                        <div class="column col-xs-12 col-md-12" v-if='modalidade_participacao == 2 && bln_adm_indireta == 1'>
                            <label for="caminho_doc_cartorio">Anexar Ofício Assinado Companhias, autarquias e agências de habitação</label>
                            <input type="file" class="form-control-file" id="txt_caminho_oficio_cohab" name="txt_caminho_oficio_cohab" accept="image/* , application/pdf" required>
                        </div>
                    </div> 
                    
   
                    <div class="row">

                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Enviar">   
                    
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
                modalidade_participacao:2,
                modalidades_participacao:'',
                bln_adm_indireta:''
                
            }        
        },
        methods:{
            
        },
        mounted() {
            axios.get(this.url + '/api/modalidade_participacao').then(resposta => {
                console.log(resposta.data);
                this.modalidades_participacao = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

        console.log(this.errorshas);
        }
    }
</script>
