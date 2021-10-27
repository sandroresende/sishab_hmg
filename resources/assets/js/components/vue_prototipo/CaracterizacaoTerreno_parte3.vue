<template>
<div class="form-group">  
    
    <div class="row" v-if="this.dadosplanta.length > 0">
       <label for="caminho_planta">1.11 Plantas do terreno com indicação das coordenadas geográficas (formatos compatíveis: PDF e KMZ. É possível anexar até 3 arquivos.  
       Caso necessite trocar o arquivo, favor excluir o arquivo desejado para upload do novo arquivo.)</label>
        <div class="column col-xs-12 col-md-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nome do Arquivo</th>
                    <th>Arquivo</th>
                    <th>Ação</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="item in dadosplanta">     
                        <td >{{item.id}}</td>
                        <td>{{item.txt_nome_arquivo}}</td>
                        <td><a class="btn btn-link btn-sm" target="_blank" v-bind:href="url + '/'+ item.txt_caminho_planta" ><i class="fas fa-file-image fa-2x"></i></a></td>                        
                        <td><button class="btn btn-outline-danger btn-sm" type="button" @click="onClickExcluir(item.id)"><i class="fas fa-trash-alt fa-2x"></i></button> </td>
                    </tr>                   
                </tbody>
            </table>  
                        
             <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
            ADICIONAR
            </button>                              

        </div>  
    </div>    
    
    <div class="row" v-if="this.dadosplanta.length == 0">
        <div class="column col-xs-12 col-md-12">            
            <label for="caminho_planta">1.11 Anexar planta do terreno com indicação das coordenadas geográficas (formatos compatíveis: PDF e KMZ. É possível anexar até 3 arquivos)</label>
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
            ADICIONAR
            </button>

            
        </div>  
    </div>    
    <div class="linha-separa"></div>
     <div class="row" v-if="this.dadosplanta.length > 0">
             <label for="txt_observacao" class="control-label">1.12	Registre aqui os comentários ou as observações que considere importantes:</label>
             <textarea class="form-control" id="txt_observacao" name="txt_observacao"  rows="10" v-model="txt_observacao"></textarea>
        </div>
        <input v-if="this.dadosplanta.length > 0" class="btn btn-lg btn-info btn-block" type="submit" value="Salvar">      
        

       <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                         <form id="app" v-bind:action="urlarquivo"  method="post" enctype="multipart/form-data">
                                         
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Anexar planta do terreno com indicação das coordenadas geográficas (formatos compatíveis: PDF e KMZ. É possível anexar até 3 arquivos)</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <input v-if="token" type="hidden" name="_token" v-bind:value="token">
                                                <input type="hidden" id="prototipoId" name="prototipoId" v-bind:value="prototipo">
                                                <input type="hidden" id="txt_observacao2" name="txt_observacao2"  v-bind:value="txt_observacao">
                                                <input type="hidden" id="acao" name="acao" v-bind:value="acao">
                                                 <div class="row">
                                                    <div class="column col-xs-12 col-md-12">
                                                         <input type="file" 
                                                                class="form-control-file" 
                                                                id="txt_caminho_planta" 
                                                                name="txt_caminho_planta" 
                                                                accept=" .pdf, .kmz"
                                                                @change="handleFileSelect"
                                                                required>

                                                            

                                                        
                                                    </div>  
                                                </div> 
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Adicionar</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

 </div>
</template>


<script>
    export default {
        props:['url','urlarquivo','dados','dadosplanta','token','prototipo'],
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
                    
               
                    console.log(files[0].size);
                   
                    if(files[0].size > tamanhoMaximo) {
                        this.nomeArquivoFile = 'txt_caminho_planta';
                        $("#txt_caminho_planta").val("");
                        this.textoErroArquivo = "O tamanho máximo é 2MB";                               
                        valido = false;
                    }else{
                        var extPermitidas = ['pdf', 'kmz'];
                        if(this.verificaExtensao(files[0].name, extPermitidas)){
                                    valido = true;
                                }else{
                                    $("#txt_caminho_planta").val("");
                                    this.textoErroArquivo = "Somente Kmzs e Pdfs são aceitos";
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

             console.log(this.dadosplanta.length);
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
            console.log(this.url + '/prototipo/caracterizacaoTerreno/planta/adicionar'); 
         }   

         
    }
</script>
