<template>
 <div class="autocomplete">
    <div class="input-group">
        <input type="text" name="txt_nis" placeholder="Ex.: 012345678900" 
            v-model="query" v-on:keyup="autoComplete" class="form-control" autocomplete="off" required>
        <div class="input-group-append">
            <button class="btn btn-primary" type="button" @click="onClickEnviar(results,query)"><i class="fas fa-search"></i></button>
        </div>      
    </div>          
  <div class="panel-footer" v-if="results.length">

   <ul class="list-group autocomplete-results"
      id="autocomplete-results"
      v-show="isOpen">
    <li class="list-group-item autocomplete-result" 
    
        @click="setResult(result)"
        v-for="result in results" required>{{ result.txt_nis_titular }}</li>
   </ul>
  </div>
 </div>
</template>


<script>
    export default {
        props:['url'],
        data(){
            return{
                isOpen: true,
                query: '',
                results: []
            }        
        },
        methods:{
            autoComplete() {
                this.results = [];
                if(this.query.length > 2){
                    axios.get(this.url + '/api/contrato/search/' + this.query).then(response => {
                        this.results = response.data;
                    }).catch(error => {
                        console.log(error);
                    });        
                }
            },
            setResult(result) {
                this.query = result.txt_nis_titular;  

                 this.isOpen = false;
            },
            onClickEnviar(results,query) {   
                             
                if (results.length == 2) {
                    Swal({
                        title: 'Atenção!',
                        text: "Esse NIS pertence a duas etapas do Oferta Pública.  Para qual delas deseja pesquisar?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: 'green',
                        confirmButtonText: 'Oferta 2009',
                        cancelButtonText: 'Oferta 2012',
                        }).then((result) => {
                            if (result.value ) {
                                window.location.href= this.url + '/contrato/1/' + query;                           
                            }else{
                                window.location.href= this.url + '/contrato/2/' + query;                           
                            }
                        })
                } else {
                   let formId = 'form_enviar';
                    document.getElementById(formId).submit();
                }
            }        
        }
    }
</script>
