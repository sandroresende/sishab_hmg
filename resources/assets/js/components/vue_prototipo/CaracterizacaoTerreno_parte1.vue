<template>
<div class="form-group">  
   
    <div class="row" v-if="this.txt_caminho_doc_cartorio">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_doc_cartorio">1.1 Cópia da documentação registrada em cartório com a comprovação da titularidade do terreno:</label>
            <a class="btn btn-link btn-sm" target="_blank" :href="url + '/' + this.txt_caminho_doc_cartorio"><i class="fas fa-file-image fa-3x"></i></a>  
            <input type="file" 
                   class="form-control-file" 
                   id="txt_caminho_doc_cartorio" 
                   name="txt_caminho_doc_cartorio" 
                   accept="image/* , application/pdf"
                   @change="handleFileSelect">                                            
            
        </div>  
    </div>    
    <div class="row" v-if="!this.txt_caminho_doc_cartorio">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_doc_cartorio">1.1 Anexe a cópia da documentação registrada em cartório com a comprovação da titularidade do terreno:</label>
            <input type="file" 
                    class="form-control-file" 
                    id="txt_caminho_doc_cartorio" 
                    name="txt_caminho_doc_cartorio" 
                    accept="image/* , application/pdf" 
                    @change="handleFileSelect"
                    required>

            
        </div>  
    </div>    
    <div class="linha-separa"></div>
    

    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="vlr_coordenadas_terreno">1.2 Quais as coordenadas geográficas do terreno (centro do terreno)? (formato padrão: -15.77026, -47.89317, ferramenta google maps)</label>   
            <input name="vlr_coordenadas_terreno" placeholder="Ex.: -15.770260, -47.893170" class="form-control" v-model="vlr_coordenadas_terreno"  required>
        </div>
    </div>
    <div class="linha-separa"></div>

    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="vlr_area_terreno">1.3 Qual a área do terreno em m²?</label>         
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="vlr_area_terreno" min="1" placeholder="Ex.: 3000" v-model="vlr_area_terreno" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="vlr_area_terreno">m²</span>
                </div>
            </div>
           
        </div>
    </div>
    <div class="linha-separa"></div>

    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="txt_proprietario_terreno">1.4	Quem é o proprietário do terreno?</label>         
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="txt_proprietario_terreno" v-model="txt_proprietario_terreno" required>
                
            </div>
           
        </div>
    </div>
    <div class="linha-separa"></div>

    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="titularidade_terreno">1.5 Qual a situação da titularidade do terreno?</label>   
            <select 
                id="titularidade_terreno"
                class="form-control" 
                name="titularidade_terreno"               
                v-model="titularidade_terreno"
                required>
                <option value="">Escolha uma Situação da Titularidade do Terreno:</option>
                <option v-for="titularidade_terreno in titularidade_terrenos" v-text="titularidade_terreno.txt_titularidade_terreno" :value="titularidade_terreno.id" :key="titularidade_terreno.id"></option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-12" v-if='titularidade_terreno == 3'>
            <label for="terreno_terceiro">1.5.1 Quem é o terceiro?</label>   
            <input type="text" name="txt_terreno_terceiro" class="form-control" v-model="txt_terreno_terceiro" required>
        </div>
    </div>
    <div class="linha-separa"></div>
    <div class="row" >
        <div class="column col-xs-12 col-md-12">
            <label for="terreno_parcelado">1.6 O terreno já foi parcelado ou desmembrado?</label>   
            <select 
                id="terreno_parcelado"
                class="form-control" 
                name="terreno_parcelado"               
                v-model="terreno_parcelado"
                required>
                <option value="" selected>Responda se o terreno já foi parcelado ou desmembrado:</option>
                <option value="1">SIM</option>
                <option value="0">NÃO</option>
            </select>    
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
                        this.nomeArquivoFile = 'txt_caminho_doc_cartorio';
                        $("#txt_caminho_doc_cartorio").val("");
                        this.textoErroArquivo = "O tamanho máximo é 2MB";                               
                        valido = false;
                    }else{
                         var extPermitidas = ['jpg', 'png', 'pdf'];
                        if(this.verificaExtensao(files[0].name, extPermitidas)){
                                    valido = true;
                                }else{
                                    $("#txt_caminho_doc_cartorio").val("");
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
