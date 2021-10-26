<template>
    <!-- Dados Gerais -->
        <section >
            <div class="form-group">
                <div class="titulo">
                    <h5>DADOS DO PROTÓTIPO {prototipo.id}</h5>                 
                </div>
            </div>    
            
        </section>
</template>

<script>
     export default {
       
         props:['url','prototipo'],
        data() {
            return {
                prototipoDisplay: this.prototipo,
                filtro_ativo: 1,
            }
        },
        computed: {
          
        },
        methods: {
            
        },
        mounted() {
            
        }
    }
</script>
