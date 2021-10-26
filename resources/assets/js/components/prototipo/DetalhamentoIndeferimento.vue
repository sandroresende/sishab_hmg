<template>
<div class="form-group">    
  
    <div class="row" >
    <input type="hidden" id="permissao_id" name="permissao_id" v-bind:value="registro">
        <div class="column col-xs-12 col-md-12">
            <label for="detalhamento">Motivo do Indeferimento</label>   
            <select 
                id="tipo_indeferimento"
                class="form-control" 
                name="tipo_indeferimento"               
                v-model="tipo_indeferimento"
                required>
                <option value="" selected>Escolha um Tipo de Indeferimento</option>
                <option v-for="tipo_indeferimento in tipo_indeferimentos" v-text="tipo_indeferimento.txt_tipo_indeferimento" :value="tipo_indeferimento.id" :key="tipo_indeferimento.id"></option>
            </select>    
        </div>       
    </div>
    <div class="row"  v-if='tipo_indeferimento == 99'>
        <div class="column col-xs-12 col-md-12">
                <label for="sistema_em_obras">Outro Tipo de Indeferimento:</label>  
                 <textarea class="form-control" id="outro_tipo_indeferimento" name="outro_tipo_indeferimento"  rows="10" required></textarea>                 
            </div>         
    </div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="sistema_em_obras">Observações</label>  
        <textarea class="form-control" id="txt_observacao" name="txt_observacao"  rows="10"></textarea>
        </div>
    </div>     
    
        <button class="btn btn-success btn-lg btn-block" type="submit" >Indeferir</i></button>     
        <button class="btn-lg btn btn-danger btn-block" onclick="javascript:window.history.go(-1)">Voltar</button>
 </div>
</template>


<script>
    export default {
        props:['url','action', 'registro'],
        data(){
            return{
                tipo_indeferimento: '',
                tipo_indeferimentos: '',
            }        
        },
        methods:{
            onClickEnviar() {   
                             
               
                    Swal({
                        title: 'Atenção!',
                        text: "Deseja Indeferir este registro?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Confirmar',
                        cancelButtonText: 'Cancelar',
                        }).then((result) => {
                            if (result.value ) {
                                   document.getElementById('form_enviar').submit();
                                
                            }else{
                           
                             
                            }
                        })
               
            } 
        },
         mounted() {
              //retorna os tipoUsuarios
            axios.get(this.url + '/api/tipoIndeferimento').then(resposta => {
                //console.log(resposta.data);
                this.tipo_indeferimentos = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 

           
         }    
    }
</script>
