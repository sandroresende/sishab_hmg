<template>
    <div class="row">  
            <form enctype="multipart/form-data" :action="urlRegistro" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)" @change="form.errors.clear($event.target.name)">
                <h4 class="tituloFormulario">Dados Pessoais</h4>
                <div class="row">
                    <div class="column col-xs-12 col-md-12">
                        <label for="txt_nome_parceiro_desenv_projeto">4.2 Qual foi o Ente ou parceiro responsável desenvolvimento do projeto?</label>   
                        <input type="text" name="txt_nome_parceiro_desenv_projeto"  class="form-control"  required>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                </div>

                <div class="row">
                    <div class="column col-xs-12 col-md-12">
                        <input type="text" name="nome"  placeholder="Nome"  class="form-control"  required>
                    </div>
                </div>
                 <!-- Nome -->
                <div class="form-group row">
                    <div class="column col-md-12">
                        <input 
                        id="nome"
                        
                        type="text"
                        class="form-control" 
                        name="nome" 
                        autofocus
                        required
                       >                        
                         
                    </div>
                </div>
                

                <!-- Sobrenome -->
                <div class="form-group row">
                    <div class="column col-md-12">
                        <input 
                        id="sobrenome"
                        placeholder="Sobrenome" 
                        type="text"
                        class="form-control" 
                        name="sobrenome"
                        required
                        >                        
                    </div>
                </div>
            </form>
    </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                tituloBtn:'Brasil',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
            }        
        },
        methods:{
            onChangeEstado() {
                this.tituloBtn = "Pesquisar";
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/executivo/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.buscando = false;
                        this.municipios = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

                      //buscar rm e ride
                        axios.get(this.url + '/api/executivo/rides/' + this.estado).then(resposta => {
                            //console.log(resposta.data);
                            this.rm_rides = resposta.data;
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

            //buscar estados
            axios.get(this.url + '/api/executivo/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

        }
    }
</script>
