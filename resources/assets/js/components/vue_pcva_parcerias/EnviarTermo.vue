<template>
    <div class="container">
        <div class="row">  
            <div class="column col-xs-12 col-md-6">
                <label for="txtProtocoloAceite">Protocolo</label>   
                <input type="text" 
                    id="txtProtocoloAceite"   
                    name="txtProtocoloAceite"   
                    class="form-control"
                    required>  
            </div>
            <div class="column col-xs-12 col-md-6">
                <label for="txt_cpf_usuario">CPF do responsável</label>   
                <input type="text" 
                    id="txt_cpf_usuario"   
                    name="txt_cpf_usuario"   
                    class="form-control"
                    required>  
            </div>
        </div>
        <!--fim row-->  
        <div class="row">
            <div class="column col-xs-12 col-md-12">
                <label for="caminho_termo">Anexe a cópia assinada pelo Secretário ou Chefe do Executivo</label>
                <input type="file" 
                    class="form-control-file" 
                    id="txt_caminho_termo" 
                    name="txt_caminho_termo" 
                    accept="application/pdf" 
                    @change="handleFileSelect"
                    required>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['url','css','action','show'],
        data(){
            return{
                txt_caminho_termo:'',
                
            }        
        },
         methods:{
                handleFileSelect(evt) {
                    let tamanhoMaximo = 2 * 1024 * 1024;
                    var files = evt.target.files; // FileList object
                    var valido = true;
                    this.nomeArquivoFile = evt.target.name;
                    
                console.log("Ext:" + files[0].name);

        

                console.log(this.quantArquivos);
                      if(files[0].size > tamanhoMaximo) {
                        this.nomeArquivoFile = 'txt_caminho_termo';
                        $("#txt_caminho_termo").val("");
                        this.textoErroArquivo = "O tamanho máximo é 2MB";                               
                        valido = false;
                    }else{
                         var extPermitidas = ['pdf'];
                        if(this.verificaExtensao(files[0].name, extPermitidas)){
                                    valido = true;
                                }else{
                                    $("#txt_caminho_termo").val("");
                                     this.textoErroArquivo = "Somente Pdfs são aceitos";
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
         },        
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
