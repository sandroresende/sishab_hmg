<template>
<div>
    <slot>

    </slot>
   <div class="form-group">  
          <div class="row">  
            <div class="column col-xs-12 col-md-12">
                <label for="situacao_adesao">Deseja validar esse Termo de Adesão?</label>           
                <select 
                    id="situacao_adesao"
                    class="form-control"  
                    name="situacao_adesao"  
                    v-model="situacao_adesao"     
                    required
                    >
                    <option value="">Escolha uma opção:</option>
                    <option value="4">Não</option>
                    <option value="3">Sim</option>                    
                </select>                        
            </div>
        </div>
        <div class="row"  v-if="situacao_adesao == '4'">
            <div class="column col-xs-12 col-md-12">
                <label for="sistema_em_obras">Justificativa:</label>  
                 <textarea class="form-control" id="txt_justificativa_recusa" name="txt_justificativa_recusa"  rows="10" required></textarea>                 
            </div>   
        </div>       
    </div><!-- form --> 
</div>     
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                situacao_adesao: '',
               
            }        
        },   
        
        methods:{
            
        },
        mounted() {
             this.situacao_adesao = '';
            
        }
    }
</script>
