<template>
    <div id="portal-breadcrumbs-wrapper">
    <nav id="breadcrumbs" aria-label="Histórico de navegação (Breadcrumbs)">
        <div class="content">
            <span class="sr-only">Você está aqui:</span>
            <span class="home">
                <a v-bind:href=" url ">
                    <span class="fas fa-home" aria-hidden="true"></span>
                    <span class="sr-only">Página Inicial</span>
                </a>
            </span>
            
            <span v-if="link1 || titulo1" dir="ltr" id="breadcrumbs-1">
                <a v-if="link1" v-bind:href=" link1 ">{{titulo1}}</a>
                <a v-if="clickbotao1" href="#" v-bind:onclick="clickbotao1">{{titulo1}}</a>
                <span v-if="titulo1 && (!link1 && !clickbotao1)" id="breadcrumbs-current">{{titulo1}}</span>
            </span>
       
            <span v-if="link2 || titulo2" dir="ltr" id="breadcrumbs-2">
                <a v-if="link2" v-bind:href=" link2 ">{{titulo2}}</a>
                <a v-if="clickbotao2" href="#" v-bind:onclick="clickbotao2">{{titulo2}}</a>
                <span v-if="titulo2 && (!link2 && !clickbotao2)" id="breadcrumbs-current">{{titulo2}}</span>
            </span>

            <span v-if="link3 || titulo3"  dir="ltr" id="breadcrumbs-3">
                <a v-if="link3" v-bind:href=" link3 ">{{titulo3}}</a>
                <a v-if="clickbotao3" href="#" v-bind:onclick="clickbotao3">{{titulo3}}</a>
                <span v-if="titulo3 && (!link3 && !clickbotao3)" id="breadcrumbs-current">{{titulo3}}</span>
            </span>

            <span v-if="link4 || titulo4" dir="ltr" id="breadcrumbs-4">
                <a v-if="link4" v-bind:href=" link4 ">{{titulo4}}</a>
                <a v-if="clickbotao4" href="#" v-bind:onclick="clickbotao4">{{titulo4}}</a>
                <span v-if="titulo4 && (!link4 && !clickbotao4)" id="breadcrumbs-current">{{titulo4}}</span>
            </span>
            <span v-if="titulo5" dir="ltr" id="breadcrumbs-4">
                
                <span id="breadcrumbs-current">{{titulo5}}</span>
            </span>
        </div>
    </nav>
</div>
</template>

<script>
    export default {
        props:['url','link1','titulo1','clickbotao1','link2','titulo2','clickbotao2','link3','titulo3','clickbotao3','link4','titulo4','titulo5','clickbotao4'],
        data(){
            return{
                
            }        
        },
        methods:{

        },    
        mounted() {
            
        }
    }
</script>

