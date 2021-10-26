<template>
<div>    
    <button class="btn btn-outline-danger btn-sm" type="button" @click="onClickEnviar()"><i class="fas fa-trash-alt"></i></button>    
</div>
</template>


<script>
    export default {
        props:['url','registro'],
        methods:{
            onClickEnviar() {   
                             
               
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
                                 window.location.href= this.url + '/'+ this.registro;
                            }else{
                             
                            }
                        })
               
            }        
        }
    }
</script>
