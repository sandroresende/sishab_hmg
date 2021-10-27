<template>
<div class="form-group">  
    
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="terreno_ocupado">1.7 O terreno está ocupado?</label>   
            <select 
                id="terreno_ocupado"
                class="form-control" 
                name="terreno_ocupado"               
                v-model="terreno_ocupado"
                required>
                <option value="" selected>Responda se o terreno esta ocupado:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-12" v-if='terreno_ocupado == 1'>
            <label for="ocupacao">1.7.1 Qual é a ocupação: </label>   
            <input type="text" name="txt_ocupacao" class="form-control" v-model="txt_ocupacao" required>
        </div>
        <div class="column col-xs-12 col-md-12" v-if='terreno_ocupado == 1'>
                <div class="linha-separa"></div>
                <div class="row" v-if="this.txt_caminho_dec_reassent" >
                    <div class="column col-xs-12 col-md-12">
                        
                        <label for="caminho_doc_cartorio">1.7.1 Declaração assinada pelo chefe do poder executivo comprometendo-se a elaborar e 
                        executar plano de reassentamento e de medidas compensatórias, cujo cronograma de remoção das famílias seja prévio ao início de obras do empreendimento 
                        habitacional:</label>
                        <a class="btn btn-link btn-sm" target="_blank" :href="url + '/' + this.txt_caminho_dec_reassent"><i class="fas fa-file-image fa-3x"></i></a>    
                        <input type="file" class="form-control-file" id="txt_caminho_dec_reassent" name="txt_caminho_dec_reassent" accept="image/* , application/pdf" @change="handleFileSelect">                     
                        
                    </div>  
                </div>    
                                
                <div class="row" v-if="terreno_ocupado == 1 && !this.txt_caminho_dec_reassent">
                    <div class="column col-xs-12 col-md-12">        
                        <label for="caminho_dec_interesse">1.7.1 Em caso afirmativo, anexar uma declaração assinada pelo chefe do poder executivo comprometendo-se a elaborar e 
                        executar plano de reassentamento e de medidas compensatórias, cujo cronograma de remoção das famílias seja prévio ao início de obras do empreendimento 
                        habitacional:</label>
                        <input type="file" class="form-control-file" id="txt_caminho_dec_reassent" name="txt_caminho_dec_reassent" accept="image/* , application/pdf" @change="handleFileSelect" required>
                    </div>  
                </div> 
        </div>
    </div>   
    
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="terreno_area_risco">1.8 O terreno está em área de risco de deslizamento, inundação, contaminação ou processos geológicos ou hidrológicos correlatos?</label>   
            <select 
                id="terreno_area_risco"
                class="form-control" 
                name="terreno_area_risco"               
                v-model="terreno_area_risco"
                required>
                <option value="" selected>Responda se o terreno esta em área de risco:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
                <option value="2">NÃO SEI</option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-12"  v-if='terreno_area_risco == 1'>
            <label for="tipo_risco">Qual é o risco: </label>   
            <select 
                id="tipo_risco"
                class="form-control" 
                name="tipo_risco"               
                v-model="tipo_risco"
                required>
                <option value="">Escolha um Tipo de Risco:</option>
                <option v-for="tipo_risco in tipo_riscos" 
                        v-text="tipo_risco.txt_tipo_risco" 
                        :value="tipo_risco.id" :key="tipo_risco.id"></option>
            </select>   
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="terreno_reis_ociosidade">1.9 O terreno encontra-se em Zona Especial de Interesse Social (ZEIS) ou é proveniente de aplicação de medidas de controle de ociosidade pelo Estatuto da Cidade ou outro instrumento?</label>   
            <select 
                id="bln_terreno_zeis_ociosidade"
                class="form-control" 
                name="bln_terreno_zeis_ociosidade"               
                v-model="bln_terreno_zeis_ociosidade"
                required>
                <option value="" selected>Escolha uma opção:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
        </div>  
         <div class="column col-xs-12 col-md-12" v-if='bln_terreno_zeis_ociosidade == 1'>
            <label for="ocupacao">1.9.1 Indicar legislação e artigo(s) pertinente(s): </label>   
            <input type="text" name="txt_legislacao_zeis" class="form-control" v-model="txt_legislacao_zeis" required>
        </div>      
    </div>


    
    <div class="linha-separa"></div>
    <div class="row" >        
        <label for="terreno_reis_ociosidade">1.10 Assinale abaixo em qual das situações o terreno proposto se encontra:</label>   
            <div class="form-check column col-xs-12 col-md-12" v-for="item in situacao_terrenos">
            <input class="form-check-input" 
                    type="radio" 
                    name="situacao_terreno_id" 
                    :id="'exampleRadios' + item.id" 
                    v-model="situacao_terreno"
                    :value="item.id"
                    :key="item.id"
                    >
            <label class="form-check-label" v-if="item.id != 99" for="exampleRadios1">
                {{item.txt_situacao_terreno}}
            </label>
            
            <div class="column col-xs-12 col-md-12">
                <label class="form-check-label form-inline" v-if="item.id == 99" for="exampleRadios1">
                    {{item.txt_situacao_terreno}} 
                
                </label>
            </div>    
        </div>             
        <div class="column col-xs-12 col-md-12" v-if="situacao_terreno == 99">
            <label for="origem_recurso">Especifique a situação: </label>   
            <textarea  class="form-control" id="txt_outra_situacao_terreno" name="txt_outra_situacao_terreno"  rows="3" v-model="txt_outra_situacao_terreno" placeholder="Especifique" required></textarea>
        </div>       
        <div class="column col-xs-12 col-md-12">
            <label for="origem_recurso">1.10.1 Indicar legislação e artigo(s) pertinente(s): </label>   
            <textarea  class="form-control" id="txt_legislacao_artigos" name="txt_legislacao_artigos"  rows="3" v-model="txt_legislacao_artigos" required></textarea>
        </div>       
    </div>
    
       <input class="btn btn-lg btn-info btn-block" type="submit" value="Salvar">   
        
 </div>
</template>


<script>
    export default {
        props:['url','dados','dadosplanta'],
        data(){
            return{
                txt_caminho_doc_cartorio: '',
                txt_caminho_dec_interesse: '',
                vlr_area_terreno: '',
                vlr_coordenadas_terreno: '',
                txt_proprietario_terreno: '',
                titularidade_terreno: '',
                titularidade_terrenos: '',
                terreno_parcelado:'',
                terreno_ocupado:'',
                txt_ocupacao:'',
                txt_caminho_dec_reassent:'',
                tipo_risco:'',
                tipo_riscos:'',
                item:'',
                situacao_terreno:'',
                situacao_terrenos:'',
                txt_outra_situacao_terreno:'',
                txt_legislacao_artigos:'',
                terreno_area_risco:'',
                bln_terreno_zeis_ociosidade:'',
                txt_legislacao_zeis:'',
                bln_parceria:'',
                txt_terreno_terceiro:'',
                txt_observacao:'',
                bln_arquivo_valido:'false',
                textoValidadeOficio:'',
                 txt_caminho_planta:'',
                 textoErroArquivo:'',
                 nomeArquivoFile:'',
                 quantArquivos:0,
              

            }        
        },
        methods:{
            handleFileSelect(evt) {
                    let tamanhoMaximo = 2 * 1024 * 1024;
                    var files = evt.target.files; // FileList object
                    var valido = true;
                    this.nomeArquivoFile = evt.target.name;
                    
               

                    if(this.dadosplanta){
                        this.quantArquivos = this.dadosplanta.length + files.length;
                    }else{
                        this.quantArquivos = files.length;
                    }

                console.log(this.quantArquivos);
                    if(files[0].size > tamanhoMaximo) {
                        this.nomeArquivoFile = 'txt_caminho_dec_reassent';
                        $("#txt_caminho_dec_reassent").val("");
                        this.textoErroArquivo = "O tamanho máximo é 2MB";                               
                        valido = false;
                    }else{
                         var extPermitidas = ['jpg', 'png', 'pdf'];
                        if(this.verificaExtensao(files[0].name, extPermitidas)){
                                    valido = true;
                                }else{
                                    $("#txt_caminho_dec_reassent").val("");
                                     this.textoErroArquivo = "Somente Jpegs, Pngs e Pdfs são aceitos";
                                    valido = false;
                                }
                    }   
                    
                    
                    if(!valido){
                     Swal({
                            title: 'Atenção!',
                            text: this.textoErroArquivo,
                            type: 'warning',
                            showCancelButton: false,
                            cancelButtonColor: '#dc3545',
                            cancelButtonText: 'OK',
                            }).then((result) => {
                                if (result.value ) {
                                    this.textoErroArquivo = '';
                                    return;
                                }
                            })
                    }        
                },
                verificaExtensao($arquivo, $extPermitidas) {
                    
                    var extArquivo = $arquivo.split("\\").pop().substring($arquivo.split("\\").pop().lastIndexOf('.')+1, $arquivo.split("\\").pop().length) || $arquivo.split("\\").pop();
                   
                    if(typeof $extPermitidas.find(function(ext){ return extArquivo == ext; }) == 'undefined') {
                        return false;
                    } else {
                        return true;
                    }
                },
                onClickExcluir(arquivo) {   
                                    
                    
                            Swal({
                                title: 'Atenção!',
                                text: "Deseja excluir este registro?",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#28a745',
                                cancelButtonColor: '#dc3545',
                                confirmButtonText: 'Sim',
                                cancelButtonText: 'Não',
                                }).then((result) => {
                                    if (result.value ) {
                                        window.location.href= this.url + '/prototipo/caracTerreno/arquivo/excluir/'+ arquivo;
                                    }else{
                                    
                                    }
                                })
                    
                    } 
                },
         mounted() {

             console.log(this.dados);
               if(this.dados){
                    this.txt_caminho_doc_cartorio = this.dados.txt_caminho_doc_cartorio;

                    if(this.dados.txt_caminho_dec_interesse){
                        this.bln_parceria = 1;
                    }else{
                        this.bln_parceria = 0;
                    }
                    this.txt_caminho_dec_interesse = this.dados.txt_caminho_dec_interesse;
                    this.titularidade_terreno = this.dados.titularidade_terreno_id;
                    
                    this.vlr_area_terreno = this.dados.vlr_area_terreno;
                    this.vlr_coordenadas_terreno = this.dados.vlr_coordenadas_terreno;
                    this.txt_proprietario_terreno = this.dados.txt_proprietario_terreno;
                    this.txt_terreno_terceiro = this.dados.txt_terreno_terceiro;
                    

                    if(this.dados.bln_terreno_parcelado == true){
                        this.terreno_parcelado = 1;                        
                    }else{
                        this.terreno_parcelado = 0;
                    }

                    if(this.dados.bln_terreno_ocupado == true){
                        this.terreno_ocupado = 1;
                        this.txt_ocupacao = this.dados.txt_ocupacao;
                        this.txt_caminho_dec_reassent = this.dados.txt_caminho_dec_reassent
                    }else{
                        this.terreno_ocupado = 0;
                    }

                    this.tipo_risco = this.dados.tipo_risco_id;
                    this.terreno_area_risco = this.dados.txt_terreno_area_risco;

                if(this.dados.bln_terreno_zeis_ociosidade == true){
                        this.bln_terreno_zeis_ociosidade = 1;     
                        this.txt_legislacao_zeis = this.dados.txt_legislacao_zeis;               
                    }else{
                        this.bln_terreno_zeis_ociosidade = 0;
                    }
                 this.txt_caminho_planta = this.dados.txt_caminho_planta;

                 this.situacao_terreno = this.dados.situacao_terreno_id;
                this.txt_outra_situacao_terreno = this.dados.txt_outra_situacao_terreno;
                this.txt_legislacao_artigos = this.dados.txt_legislacao_artigos;

                this.txt_observacao = this.dados.txt_observacao;
            }

              //retorna os tipoUsuarios
            axios.get(this.url + '/api/titularidadeTerreno').then(resposta => {
                //console.log(resposta.data);
                this.titularidade_terrenos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna os tipoRiscos
            axios.get(this.url + '/api/tipoRisco').then(resposta => {
                //console.log(resposta.data);
                this.tipo_riscos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna os situacao Terreno
            axios.get(this.url + '/api/situacaoTerreno').then(resposta => {
                //console.log(resposta.data);
                this.situacao_terrenos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 
         }    
    }
</script>
