<template>
<div class="form-group">    
    
     <div class="row" v-if="this.dadosmapa.length > 0">
     <label for="caminho_doc_cartorio">3.3 Mapa(s) da área com a localização do terreno e de todos os equipamentos e serviços informados no item anterior.
            </label>
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
                    <tr v-for="item in dadosmapa">     
                        <td >{{item.id}}</td>
                        <td>{{item.txt_nome_arquivo}}</td>
                        <td><a class="btn btn-link btn-sm" target="_blank" v-bind:href="url + '/'+ item.txt_caminho_mapa" ><i class="fas fa-file-image fa-2x"></i></a></td>                        
                        <td><button class="btn btn-outline-danger btn-sm" type="button" @click="onExcluirMapa(item.id)"><i class="fas fa-trash-alt fa-2x"></i></button> </td>
                    </tr>                   
                </tbody>
            </table>            
              <button v-if="this.dadosmapa.length < 3" type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalMapas">
            ADICIONAR MAPA
            </button>                                            

        </div>  
    </div>    

    <div class="row" v-if="this.dadosmapa.length == 0">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_doc_cartorio">3.3 Anexar mapa(s) (máximo 3) da área com a localização do terreno e de todos os equipamentos e serviços informados no item anterior (formato kmz e/ou pdf). </label>
            
            <button v-if="this.dadosmapa.length < 3" type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalMapas">
            ADICIONAR MAPA
            </button>  
        </div>  
    </div>     
    <div class="linha-separa"></div>   
     <div class="row" v-if="this.dadosrota.length > 0">
        <div class="column col-xs-12 col-md-12">
                
                <label for="caminho_doc_cartorio">3.4 Arquivo com registro das rotas caminháveis e dos tempos de deslocamento por transporte público conforme informado no 
                                item 3.2. Verificar modelo de documento na página inicial do Painel de Controle. </label>
     
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
                    <tr v-for="item in dadosrota">     
                        <td >{{item.id}}</td>
                        <td>{{item.txt_nome_arquivo}}</td>
                        <td><a class="btn btn-link btn-sm" target="_blank" v-bind:href="url + '/'+ item.txt_caminho_rota" ><i class="fas fa-file-image fa-2x"></i></a></td>                        
                        <td><button class="btn btn-outline-danger btn-sm" type="button" @click="onExcluirRota(item.id)"><i class="fas fa-trash-alt fa-2x"></i></button> </td>
                    </tr>                   
                </tbody>
            </table>            
              <button  v-if="this.dadosrota.length < 5" type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalRotas">
            ADICIONAR ROTAS
            </button>                                            

        </div>  
                   

        </div>  
    </div>    

    <div class="row" v-if="this.dadosrota.length == 0">
        <div class="column col-xs-12 col-md-12">
            
            <label for="caminho_registro_rota">3.4. Anexar arquivo com registro das rotas caminháveis e dos 
                tempos de deslocamento por transporte público conforme informado no item 3.2. Verificar modelo de documento na página inicial do Painel de Controle. </label>
            <button v-if="this.dadosrota.length < 5" type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalRotas">
            ADICIONAR ROTAS
            </button>  
        </div>  
    </div>  
         <input v-if="this.dadosmapa.length > 0 && this.dadosrota.length > 0" class="btn btn-lg btn-info btn-block" type="submit" value="Salvar">  
        

        <!-- Modal -->
        <div class="modal fade" id="modalMapas" tabindex="-1" role="dialog" aria-labelledby="modalMapasLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <form id="app" v-bind:action="urlarquivomapa"  method="post" enctype="multipart/form-data">
                    
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalMapasLabel">3.3 Anexar mapa(s) (máximo 3) da área com a localização do terreno e de todos os equipamentos e serviços informados no item anterior (formato kmz e/ou pdf). </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input v-if="token" type="hidden" name="_token" v-bind:value="token">
                        <input type="hidden" name="prototipoId" v-bind:value="prototipo">
                        <input type="hidden" name="acao" v-bind:value="acao">
                            <div class="row">
                            <div class="column col-xs-12 col-md-12">
                                    <input type="file" class="form-control-file" id="txt_caminho_mapa" name="txt_caminho_mapa" 
                                        :required="this.num_arquivos == 0"
                                        accept=".pdf, .kmz, .zip"
                                        @change="handleFileSelect"
                                        :disabled="this.dadosmapa.length >= 3">

                                    

                                
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

        <!-- Modal -->
        <div class="modal fade" id="modalRotas" tabindex="-1" role="dialog" aria-labelledby="modalRotasLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <form id="app" v-bind:action="urlarquivorota"  method="post" enctype="multipart/form-data">
                    
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalRotasLabel">3.4. Anexar arquivo com registro das rotas caminháveis e dos tempos de deslocamento por transporte público conforme informado no item 3.2. Verificar modelo de documento na página inicial do Painel de Controle. </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <input v-if="token" type="hidden" name="_token" v-bind:value="token">
                        <input type="hidden" name="prototipoId" v-bind:value="prototipo">
                        <input type="hidden" name="acao" v-bind:value="acao">
                            <div class="row">
                            <div class="column col-xs-12 col-md-12">
                                    <input type="file" 
                                        class="form-control-file" 
                                        id="txt_caminho_rota" 
                                        name="txt_caminho_rota" 
                                        accept=".pdf, .zip"
                                        @change="handleFileSelect"> 

                                    

                                
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
        props:['url','dados','dadosmapa','dadosrota','token','prototipo','urlarquivomapa','urlarquivorota','acao'],
        data(){
            return{
                files: [],
                bln_transporte_publico_coletivo: '',
                vlr_distancia_ponto: 0, 
                num_itinerarios: 0,
                bln_equip_esporte_cultura: '',
                txt_equip_esporte_cultura: '',
                vlr_dist_mts_eq_esp_cult: 0,
                bln_mercadinho_mercado: '',
                vlr_dist_mts_mercadinho: 0,
                bln_padaria: '',
                vlr_dist_mts_padaria: 0,
                bln_farmacia: '',
                vlr_dist_mts_farmacia: 0,
                bln_supermercado: '',
                vlr_dist_mts_supermercado: 0,
                num_tempo_min_supermercado: 0,
                bln_agencia_bancaria: '',
                vlr_dist_mts_ag_bancaria: 0,
                num_tempo_min_ag_bancaria: 0,
                bln_agencia_correios: '',
                vlr_dist_mts_correios: 0,
                num_tempo_min_correios: 0,
                bln_loterica: '',
                num_tempo_min_loterica: 0, 
                vlr_dist_mts_loterica: 0,
                bln_restaurante_popular: '',
                num_tempo_min_rest_pop: 0, 
                vlr_dist_mts_rest_pop: 0,
                bln_escola_ed_infantil: '',
                num_tempo_min_ed_inf: 0, 
                vlr_dist_mts_ed_inf: 0,
                bln_escola_ed_fund_ciclo_1: '',
                num_tempo_min_ed_fund_c1: 0, 
                vlr_dist_mts_ed_fund_c1: 0,
                bln_escola_ed_fund_ciclo_2: '',
                num_tempo_min_ed_fund_c2: 0, 
                vlr_dist_mts_ed_fund_c2: 0,
                bln_cras: '',
                num_tempo_min_cras: 0, 
                vlr_dist_mts_cras: 0,
                bln_ubs: '',
                num_tempo_min_ubs: 0, 
                vlr_dist_mts_ubs: 0,
                bln_aeroporto_comercial: '',
                vlr_dist_km_aerop_comercial: 0,                 
                radioDisttempSuperm:'',
                radioDisttempAgBancaria:'',
                radioDisttempCorreios:'',
                radioDisttempCenCom:'',
                radioDisttempRestPopular:'',
                radioDisttempEdInf:'',
                radioDisttempEdFund1:'',
                radioDisttempEdFund2:'',
                radioDisttempCras:'',
                radioDisttempUbs:'',
                txt_caminho_mapa:'',
                num_arquivos:0,
                arquivosUpload:0,
                formValidado:0,
                quantArquivos:0,                
                txt_caminho_rota:'',

              
               
            }        
        },
        methods:{
            handleFileSelect(evt) {
                    let tamanhoMaximo = 2 * 1024 * 1024;
                    var files = evt.target.files; // FileList object
                    var valido = true;
                    this.nomeArquivoFile = evt.target.name;
                    console.log(this.nomeArquivoFile);

                    if(files[0].size > tamanhoMaximo) {
                         if(this.nomeArquivoFile == 'txt_caminho_mapa'){     
                            this.nomeArquivoFile = 'txt_caminho_mapa';
                            $("#txt_caminho_mapa").val("");
                            this.textoErroArquivo = "O tamanho máximo é 2MB";                               
                            valido = false;
                         }else if(this.nomeArquivoFile == 'txt_caminho_rota'){     
                            this.nomeArquivoFile = 'txt_caminho_rota';
                            $("#txt_caminho_rota").val("");
                            this.textoErroArquivo = "O tamanho máximo é 2MB";                               
                            valido = false;
                         }   
                    }else{
                        if(this.nomeArquivoFile == 'txt_caminho_mapa'){    
                            var extPermitidas = ['pdf', 'kmz'];
                            if(this.verificaExtensao(files[0].name, extPermitidas)){
                                valido = true;
                            }else{
                                $("#txt_caminho_mapa").val("");
                                this.textoErroArquivo = "Somente Kmzs e Pdfs são aceitos";
                                valido = false;
                            }
                        }else if(this.nomeArquivoFile == 'txt_caminho_rota'){    
                            var extPermitidas = ['pdf', 'zip'];
                            if(this.verificaExtensao(files[0].name, extPermitidas)){
                                valido = true;
                            }else{
                                $("#txt_caminho_rota").val("");
                                this.textoErroArquivo = "Somente PDFs e Zips são aceitos";
                                valido = false;
                            }
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
            onClickSubmit() {   

                             
                    if(this.bln_supermercado == 1){
                        if((this.vlr_dist_mts_supermercado+this.num_tempo_min_supermercado) == 0){
                            this.formValidado = 0;
                            return;
                        }
                    }

                    if(this.bln_agencia_bancaria == 1){
                        if((this.vlr_dist_mts_ag_bancaria+this.num_tempo_min_ag_bancaria) == 0){
                            this.formValidado = 0;
                            return;
                        }
                    }

                     if(this.bln_agencia_correios == 1){
                        if((this.vlr_dist_mts_correios+this.num_tempo_min_correios) == 0){
                            this.formValidado = 0;
                            return;
                        }
                    }

                     if(this.bln_loterica == 1){
                        if((this.num_tempo_min_loterica+this.vlr_dist_mts_loterica) == 0){
                            this.formValidado = 0;
                            return;
                        }
                    }
                    
                    if(this.bln_restaurante_popular == 1){
                            if((this.num_tempo_min_rest_pop+this.vlr_dist_mts_rest_pop) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

                    if(this.bln_escola_ed_infantil == 1){
                            if((this.num_tempo_min_ed_inf+this.vlr_dist_mts_ed_inf) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }
                    
                     if(this.bln_escola_ed_fund_ciclo_1 == 1){
                            if((this.num_tempo_min_ed_fund_c1+this.vlr_dist_mts_ed_fund_c1) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

                        if(this.bln_escola_ed_fund_ciclo_2 == 1){
                            if((this.num_tempo_min_ed_fund_c2+this.vlr_dist_mts_ed_fund_c2) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

                        if(this.bln_cras == 1){
                            if((this.num_tempo_min_cras+this.vlr_dist_mts_cras) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

                         if(this.bln_ubs == 1){
                            if((this.num_tempo_min_ubs+this.vlr_dist_mts_ubs) == 0){
                                this.formValidado = 0;
                            return;
                            }
                        }

       
                       
               console.log(this.num_tempo_min_ubs+this.vlr_dist_mts_ubs);
               
               if(this.formValidado == 0){
                    Swal({
                        title: 'Atenção!',
                        text: "Deseja excluir este registro?",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: '#dc3545',
                        cancelButtonText: 'OK',
                        }).then((result) => {
                            if (result.value ) {
                                 return;
                            }
                        })
               }        
               
            }, 
            onExcluirMapa(arquivo) {   
                             
               
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
                                 window.location.href= this.url + '/prototipo/insercaoUrbana/arquivoMapa/excluir/'+ arquivo;
                            }else{
                             
                            }
                        })
               
            },
            onExcluirRota(arquivo) {   
                             
               
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
                                 window.location.href= this.url + '/prototipo/insercaoUrbana/arquivoRota/excluir/'+ arquivo;
                            }else{
                             
                            }
                        })
               
            }  
        },
         mounted() {
               

             if(this.dados){
                if(this.dados.bln_transporte_publico_coletivo == 1){
                        this.bln_transporte_publico_coletivo = 1;
                        this.vlr_distancia_ponto= this.dados.vlr_distancia_ponto; 
                        this.num_itinerarios= this.dados.num_itinerarios;
                        
                }else{
                    this.bln_transporte_publico_coletivo = 0;                
                }
                
                if(this.dados.bln_equip_esporte_cultura == 1){
                        this.bln_equip_esporte_cultura = 1;
                        this.txt_equip_esporte_cultura= this.dados.txt_equip_esporte_cultura; 
                        this.vlr_dist_mts_eq_esp_cult= this.dados.vlr_dist_mts_eq_esp_cult;
                        
                }else{
                    this.bln_equip_esporte_cultura = 0;                
                }

                if(this.dados.bln_mercadinho_mercado == 1){
                        this.bln_mercadinho_mercado = 1;
                        this.vlr_dist_mts_mercadinho= this.dados.vlr_dist_mts_mercadinho;                     
                }else{
                    this.bln_mercadinho_mercado = 0;                
                }

                if(this.dados.bln_padaria == 1){
                        this.bln_padaria = 1;
                        this.vlr_dist_mts_padaria= this.dados.vlr_dist_mts_padaria;                     
                }else{
                    this.bln_padaria = 0;                
                }

                if(this.dados.bln_farmacia == 1){
                        this.bln_farmacia = 1;
                        this.vlr_dist_mts_farmacia= this.dados.vlr_dist_mts_farmacia;                     
                }else{
                    this.bln_farmacia = 0;                
                }

                if(this.dados.bln_supermercado == 1){
                        this.bln_supermercado = 1;
                        this.vlr_dist_mts_supermercado= this.dados.vlr_dist_mts_supermercado;                     
                        this.num_tempo_min_supermercado= this.dados.num_tempo_min_supermercado;                     
                        if(this.dados.vlr_dist_mts_supermercado > 0){
                            this.radioDisttempSuperm = "distancia";
                        }else{
                            this.radioDisttempSuperm = "tempo";
                        }
                }else{
                    this.bln_supermercado = 0;                
                }

                if(this.dados.bln_agencia_bancaria == 1){
                        this.bln_agencia_bancaria = 1;
                        this.vlr_dist_mts_ag_bancaria= this.dados.vlr_dist_mts_ag_bancaria;                     
                        this.num_tempo_min_ag_bancaria= this.dados.num_tempo_min_ag_bancaria;    
                        if(this.dados.vlr_dist_mts_ag_bancaria > 0){
                            this.radioDisttempAgBancaria = "distancia";
                        }else{
                            this.radioDisttempAgBancaria = "tempo";
                        }                 
                }else{
                    this.bln_agencia_bancaria = 0;                
                }

                if(this.dados.bln_agencia_correios == 1){
                        this.bln_agencia_correios = 1;
                        this.vlr_dist_mts_correios= this.dados.vlr_dist_mts_correios;                     
                        this.num_tempo_min_correios= this.dados.num_tempo_min_correios;     
                        if(this.dados.vlr_dist_mts_correios > 0){
                            this.radioDisttempCorreios = "distancia";
                        }else{
                            this.radioDisttempCorreios = "tempo";
                        }                 
                }else{
                    this.bln_agencia_correios = 0;                
                }

                if(this.dados.bln_loterica == 1){
                    this.bln_loterica = 1;
                    this.vlr_dist_mts_loterica= this.dados.vlr_dist_mts_loterica;                     
                    this.num_tempo_min_loterica= this.dados.num_tempo_min_loterica;      
                    if(this.dados.vlr_dist_mts_loterica > 0){
                            this.radioDisttempCenCom = "distancia";
                        }else{
                            this.radioDisttempCenCom = "tempo";
                        }                    
                }else{
                    this.bln_loterica = 0;                
                }

                if(this.dados.bln_restaurante_popular == 1){
                        this.bln_restaurante_popular = 1;
                        this.vlr_dist_mts_rest_pop= this.dados.vlr_dist_mts_rest_pop;                     
                        this.num_tempo_min_rest_pop= this.dados.num_tempo_min_rest_pop;     
                        if(this.dados.vlr_dist_mts_rest_pop > 0){
                            this.radioDisttempRestPopular = "distancia";
                        }else{
                            this.radioDisttempRestPopular = "tempo";
                        }                 
                }else{
                    this.bln_restaurante_popular = 0;                
                }

                if(this.dados.bln_escola_ed_infantil == 1){
                        this.bln_escola_ed_infantil = 1;
                        this.vlr_dist_mts_ed_inf= this.dados.vlr_dist_mts_ed_inf;                     
                        this.num_tempo_min_ed_inf= this.dados.num_tempo_min_ed_inf;   
                        if(this.dados.vlr_dist_mts_ed_inf > 0){
                            this.radioDisttempEdInf = "distancia";
                        }else{
                            this.radioDisttempEdInf = "tempo";
                        }                    
                }else{
                    this.bln_escola_ed_infantil = 0;                
                }

                if(this.dados.bln_escola_ed_fund_ciclo_1 == 1){
                        this.bln_escola_ed_fund_ciclo_1 = 1;
                        this.vlr_dist_mts_ed_fund_c1= this.dados.vlr_dist_mts_ed_fund_c1;                     
                        this.num_tempo_min_ed_fund_c1= this.dados.num_tempo_min_ed_fund_c1;     
                        if(this.dados.vlr_dist_mts_ed_fund_c1 > 0){
                            this.radioDisttempEdFund1 = "distancia";
                        }else{
                            this.radioDisttempEdFund1 = "tempo";
                        }                 
                }else{
                    this.bln_escola_ed_fund_ciclo_1 = 0;                
                }

                if(this.dados.bln_escola_ed_fund_ciclo_2 == 1){
                        this.bln_escola_ed_fund_ciclo_2 = 1;
                        this.vlr_dist_mts_ed_fund_c2= this.dados.vlr_dist_mts_ed_fund_c2;                     
                        this.num_tempo_min_ed_fund_c2= this.dados.num_tempo_min_ed_fund_c2;      
                        if(this.dados.vlr_dist_mts_ed_fund_c2 > 0){
                            this.radioDisttempEdFund2 = "distancia";
                        }else{
                            this.radioDisttempEdFund2 = "tempo";
                        }                 
                }else{
                    this.bln_escola_ed_fund_ciclo_2 = 0;                
                }

                if(this.dados.bln_cras == 1){
                        this.bln_cras = 1;
                        this.vlr_dist_mts_cras= this.dados.vlr_dist_mts_cras;                     
                        this.num_tempo_min_cras= this.dados.num_tempo_min_cras;   
                        if(this.dados.vlr_dist_mts_cras > 0){
                            this.radioDisttempCras = "distancia";
                        }else{
                            this.radioDisttempCras = "tempo";
                        }                
                }else{
                    this.bln_cras = 0;                
                }

                if(this.dados.bln_ubs == 1){
                        this.bln_ubs = 1;
                        this.vlr_dist_mts_ubs= this.dados.vlr_dist_mts_ubs;                     
                        this.num_tempo_min_ubs= this.dados.num_tempo_min_ubs;       
                        if(this.dados.vlr_dist_mts_ubs > 0){
                            this.radioDisttempUbs = "distancia";
                        }else{
                            this.radioDisttempUbs = "tempo";
                        }                 
                }else{
                    this.bln_ubs = 0;                
                }

                if(this.dados.bln_aeroporto_comercial == 1){
                        this.bln_aeroporto_comercial = 1;
                                                               
                                       
                }else{
                    this.bln_aeroporto_comercial = 0;                
                }

            this.vlr_dist_km_aerop_comercial= this.dados.vlr_dist_km_aerop_comercial;     


             this.txt_caminho_mapa = this.dados.txt_caminho_mapa;    

            

             this.num_arquivos = this.dadosmapa.length
            

            }
         }
               
    }
</script>
