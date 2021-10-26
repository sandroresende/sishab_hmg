<template>
<div class="form-group">  
<div class="row">
    <div class="column col-sm-6">
        <div class="card">
            <div class="card-body">
                <div id="viewlet-above-content-title"></div>
                <h3 class="documentFirstHeading text-center">
                Solicitar Acesso
                    </h3>
                <div class="linha-separa"></div>
                
                <div class="row">  
                    
                    <blockquote class="blockquote">   
                        <h5>Quais são as modalidades de participação?                            </h5>                     
                        <footer class="blockquote-footer">Modalidade I - Protótipos para a concepção e implementação de empreendimentos inovadores; e 
                        </footer>
                         <footer class="blockquote-footer">
                            Modalidade II - Protótipos para implementação de empreendimentos cuja concepção será proveniente de projetos selecionados em concurso de ideias.
                        </footer>
                        <footer class="blockquote-footer">  
                            Para maiores informações consultar a portaria de regulamentação.
                        </footer>
                         
                        <h5>Quem pode enviar propostas?</h5>                     
                        <footer class="blockquote-footer">
                            Entes Públicos locais (municípios, estados e Distrito Federal) direta ou indiretamente, por meio de companhias, autarquias ou agências habitacionais, detentores de terrenos para doação.
                        </footer>
                        <footer class="blockquote-footer">
                            Para a modalidade II, podem participar apenas aqueles associados à Associação Brasileira de COHABS e Agentes Públicos de Habitação (ABC).
                        </footer>
                        <footer class="blockquote-footer">
                            Os interessados devem optar por uma das modalidades para participação.
                        </footer>
                                         
                                               
                        <h5>Como se registrar para acessar o sistema?</h5>
                        <footer class="blockquote-footer">
                            Deve ser enviado Ofício assinado pelo Chefe do Poder Executivo com a indicação do responsável pelo encaminhamento da proposta e e-mail institucional para cadastro e homologação. Para a modalidade II, deve ser enviado também Ofício assinado pelo Presidente da companhia, autarquia ou agência habitacional associada à ABC.
                        </footer>
                        <footer class="blockquote-footer">    
                            Os documentos devem ser elaborados em papel timbrado, digitalizados e enviados por intermédio do sistema, conforme os modelos disponibilizados abaixo:

                        </footer>
                        
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
                            1. Modelo de Ofício Entes Públicos Locais</a>
                            
                            
                            <a 
                            class="modeloOficio" 
                            v-bind:href="show + '/modelo_oficio_COHAB.pdf'"
                            target="_blank">
                            2. Modelo de Ofício Ofício companhias, autarquias e agências de habitação </a>

                            <a 
                            class="modeloOficio" 
                            v-bind:href="show + '/modelo_oficio_prefeitura_2.pdf'"
                            target="_blank">
                            3. Modelo de Oficio Entes Públicos Locais, quando a proposta for de companhias, autarquias e agências de habitação.
  </a>
                        </div>
                    </div>  
                    <blockquote class="blockquote">   
                        <h5>Passo a passo para cadastramento de propostas:</h5>
                    
                        <footer class="blockquote-footer">1. Informe seus dados pessoais no Formulário de Registro;</footer>
                        <footer class="blockquote-footer">2. Informe qual Proponente representará;</footer>
                        <footer class="blockquote-footer">3. Informe qual modalidade deseja participar;</footer>
                        <footer class="blockquote-footer">4. Anexe os ofícios necessários conforme a modalidade desejada. Verifique o conteúdo necessário conforme os modelos disponibilizados acima.
                        </footer>
                        <footer class="blockquote-footer">5. Clique em enviar.                            </footer>
                        <footer class="blockquote-footer">6. Aguarde o envio de confirmação de aprovação do cadastro por e-mail.
                        </footer>
                        <footer class="blockquote-footer">7. Acesse o SISHAB para cadastrar propostas.</footer>
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
       
                    <slot>

                    </slot>

                    <div class="row">  
                        <div class="column col-xs-12 col-md-12">
                            <label for="tipo_prototipo">Modalidade de Participação</label>     
                            <select 
                                id="modalidade_participacao"
                                class="form-control" 
                                name="modalidade_participacao"
                                v-model="modalidade_participacao" 
                                required>
                                <option value="">Escolha uma modalidade:</option>
                                <option v-for="modalidade_participacao in modalidades_participacao" v-text="modalidade_participacao.txt_modalidade_participacao" :value="modalidade_participacao.id" :key="modalidade_participacao.id"></option>
                        </select>
                            

                        <!--
                        
                            <span v-if="this.errorshas" class="invalid-feedback">
                                <strong>{{this.errorsfirst}}</strong>
                            </span>
                        -->
                        </div>
                    </div>
                    <!--fim row-->
                    <div class="row">
                        <div class="column col-xs-12 col-md-12">
                            <label for="caminho_doc_cartorio">Anexar Ofício Assinado Entes Públicos Locais</label>
                            <input type="file" class="form-control-file" id="txt_caminho_oficio" name="txt_caminho_oficio" accept="image/* , application/pdf" required>
                        </div>
                        <div class="column col-xs-12 col-md-12" v-if='modalidade_participacao == 2'>
                            <label for="caminho_doc_cartorio">Anexar Ofício Assinado companhias, autarquias e agências de habitação </label>
                            <input type="file" class="form-control-file" id="txt_caminho_oficio_cohab" name="txt_caminho_oficio_cohab" accept="image/* , application/pdf" required>
                        </div>
                    </div> 

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Enviar</button>
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
                modalidade_participacao:'',
                modalidades_participacao:'',
                
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
