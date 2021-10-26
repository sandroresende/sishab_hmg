<template>
<div class="form-group">    
    <div class="row">
        <div class="column col-xs-12 col-md-6">
            <label for="modulo_sistema">Módulo Sistema</label>           
            <select 
                id="modulo_sistema"
                class="form-control" 
                name="modulo_sistema"               
                v-model="modulo_sistema"
                 @change="onChangeModulo"
                required>
                <option value="">Escolha um Módulo de Sistema:</option>
                <option v-for="modulo_sistema in modulo_sistemas" v-text="modulo_sistema.txt_modulo_sistema" :value="modulo_sistema.id" :key="modulo_sistema.id"></option>
            </select>     
        </div>
        <div class="column col-xs-12 col-md-6">
            <label for="tipo_usuario">Tipo Usuário</label>           
            <select 
                id="tipo_usuario"
                class="form-control" 
                name="tipo_usuario"    
                v-model="tipo_usuario"
                :disabled="modulo_sistema == '' || buscando"
                required>
                <option value="" v-text="textoEscolhaModulo"></option>
                <option v-for="tipo_usuario in tipo_usuarios" v-text="tipo_usuario.txt_tipo_usuario" :value="tipo_usuario.id" :key="tipo_usuario.id"></option>
            </select>     
        </div>            
    </div>  
      
    <div class="row">                    
        <div class="column col-xs-12 col-md-6">
            <label for="txt_nome" class="control-label">Nome Responsável</label>
            <input id="txt_nome" type="text" class="form-control" name="txt_nome"  required>          
        </div>    
        <div class="column col-xs-12 col-md-6">
            <label for="txt_email" class="control-label">Email</label>
            <input id="txt_email" type="email" class="form-control" name="txt_email"  required>
        </div>   
    </div>  
    <div class="row" v-if="modulo_sistema == 3" > 
        <div class="column col-xs-12 col-md-6" >
            <label for="txt_cpf_usuario" class="control-label">CPF/Função</label>
            <input id="txt_cpf_usuario" type="text" class="form-control" name="txt_cpf_usuario"  required>          
        </div>  
        <div class="column col-xs-12 col-md-6" >
            <label for="txt_cargo" class="control-label">Cargo/Função</label>
            <input id="txt_cargo" type="text" class="form-control" name="txt_cargo"  required>          
        </div>                
        
    </div>                 
    <div class="row" v-if="modulo_sistema == 3">                
        <div class="column col-xs-12 col-md-2">
            <label for="txt_ddd_fixo" class="control-label">DDD</label>
            <input id="txt_ddd_fixo" type="text" class="form-control" name="txt_ddd_fixo"  required>
        </div>
        <div class="column col-xs-12 col-md-4">
            <label for="txt_telefone_fixo" class="control-label">Telefone Fixo</label>
            <input id="txt_telefone_fixo" type="text" class="form-control" name="txt_telefone_fixo"  required>
        </div>
        <div class="column col-xs-12 col-md-2">
            <label for="txt_ddd_movel" class="control-label">DDD</label>
            <input id="txt_ddd_movel" type="text" class="form-control" name="txt_ddd_movel"  required>
        </div>
        <div class="column col-xs-12 col-md-4">
            <label for="txt_telefone_movel" class="control-label">Telefone Móvel</label>
            <input id="txt_telefone_movel" type="text" class="form-control" name="txt_telefone_movel"  required>
        </div>
    </div>                 
    <div class="titulo" v-if="modulo_sistema == 3">
        <h5>Dados do Ente Público </h5>         
    </div>
     <div class="row" v-if="modulo_sistema > 1">        
           <div class="column col-xs-12 col-md-3">
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
           <div class="column col-xs-12 col-md-9">
    <!-- municipio -->    
                <label for="municipio">Município</label>
                <select 
                    id="municipio"
                    class="form-control" 
                    name="municipio"
                    required
                    @change="onChangeMunicipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio">
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                </select>    
            </div>
        </div>
         <div class="row" v-if="modulo_sistema == 2">            
        
        <div class="column col-xs-12 col-md-12">
            <label for="ente_publico">Ente Público</label>           
            <select 
                id="ente_publico"
                class="form-control" 
                name="ente_publico"               
                v-model="ente_publico"
                required>
                <option value="">Escolha um Ente Público:</option>
                <option v-for="ente_publico in ente_publicos" v-text="ente_publico.txt_ente_publico" :value="ente_publico.id" :key="ente_publico.id"></option>
            </select>     
        </div>
    </div>  
    <div class="row" v-if="modulo_sistema == 3">            
        <div class="column col-xs-12 col-md-3">
            <label for="txt_cnpj" class="control-label">CNPJ</label>
            <input id="txt_cnpj" type="text" class="form-control" name="txt_cnpj"  required>           
        </div>
        <div class="column col-xs-12 col-md-6">
            <label for="ente_publico">Ente Público</label>           
            <input id="txt_ente_publico" type="text" class="form-control" name="txt_ente_publico"  required>       
        </div>
        <div class="column col-xs-12 col-md-3">
            <label for="tipo_ente_publico">Tipo de Ente</label>           
            <select 
                id="tipo_ente_publico"
                class="form-control" 
                name="tipo_ente_publico"               
                v-model="tipo_ente_publico"
                required>
                <option value="">Escolha um Tipo Ente Público:</option>
                <option v-for="tipo_ente_publico in tipo_ente_publicos" v-text="tipo_ente_publico.txt_tipo_ente_publico" :value="tipo_ente_publico.id" :key="tipo_ente_publico.id"></option>
            </select>     
        </div>
    </div>
    <div class="row" v-if="modulo_sistema == 3">            
        <div class="column col-xs-12 col-md-8">
            <label for="nome_chefe_executivo">Nome do Chefe do Poder Executivo (Prefeito ou Governador)</label>           
            <input id="txt_nome_chefe_executivo" type="text" class="form-control" name="txt_nome_chefe_executivo"  required>       
        </div>
        <div class="column col-xs-12 col-md-4">
            <label for="cargo_executivo">Cargo</label>           
            <select 
                id="cargo_executivo"
                class="form-control" 
                name="cargo_executivo"               
                v-model="cargo_executivo"
                required>
                <option value="">Escolha um cargo:</option>
                <option value="Governador">Governador</option>
                <option value="Prefeito">Prefeito</option>
                
            </select>     
        </div>
    </div>  

    <button type="submit" class="btn btn-primary btn-lg btn-block">Salvar</button>
</div>    
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                 tituloBtn:'Brasil',
                 buscando: false,
                 tipo_usuario:'',
                 tipo_usuarios:'',
                 modulo_sistema:'',
                 modulo_sistemas:'',
                 ente_publico:'',
                 ente_publicos:'',
                 tipo_ente_publico:'',
                 tipo_ente_publicos:'',
                 textoEscolhaModulo: 'Filtre o Módulo',
                 estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                cargo_executivo:''              
            }        
        },
        computed:{
            
        },
        methods:{
            onChangeModulo(){
                this.textoEscolhaModulo = "Buscando...";
                this.tipo_usuario = '';
                this.buscando = true;

                if(this.modulo_sistema != ''){
                    console.log(this.modulo_sistema);
                     //retorna os temas
                    axios.get(this.url + '/api/tipoUsuario/' + this.modulo_sistema).then(resposta => {
                        this.textoEscolhaModulo = "Escolha um Tipo de Usuário:";
                        this.buscando = false;
                        this.tipo_usuarios = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });

                }else{
                    this.buscando = false;                      
                   this.tipo_usuario = '';
                    this.textoEscolhaModulo = 'Filtre o Módulo';                    
                }
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
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            },
            onChangeMunicipio() {
                if(this.municipio){
                    this.municipioselecionado = this.municipio;
                }
                
            }
            
        },
        mounted() {
           
            //retorna os tipoUsuarios
            axios.get(this.url + '/api/tipoUsuario').then(resposta => {
                //console.log(resposta.data);
                this.tipo_usuarios = resposta.data;

            }).catch(erro => {
                console.log(erro);
            });            

            //retorna os modulosSistema
            axios.get(this.url + '/api/moduloSistema').then(resposta => {
                //console.log(resposta.data);
                this.modulo_sistemas = resposta.data;

            }).catch(erro => {
                console.log(erro);
            });

            //retorna os entePublico
            axios.get(this.url + '/api/entePublico').then(resposta => {
                //console.log(resposta.data);
                this.ente_publicos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            });

            //retorna os tipoEntePublico
            axios.get(this.url + '/api/tipoEntePublico').then(resposta => {
                //console.log(resposta.data);
                this.tipo_ente_publicos = resposta.data;

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
                this.estado = '';
                this.municipio = '';
            if(this.municipioselecionado || this.municipio){
                 axios.get(this.url + '/api/municipio/estado/' + this.municipioselecionado).then(resposta => {
                        this.estado = resposta.data;
                        this.onChangeEstado();
                        this.municipio = this.municipioselecionado;

                    }).catch(error => {
                        console.log(error);
                    });  
            }else{
                this.estado = '';
                this.municipio = '';
            }
        }
    }
</script>
