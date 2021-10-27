<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-body">
                        <canvas > id="lineChart" width="600" height="400"></canvas>
                          <div id="lineLegend"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['dados','url'],
        data: function(){
            return {
                legenda:'' ,
                linhas:'' ,
            }
        },
         methods:{
           criarGrafico(){
                           
                    var dados = [
                        {
                        fillColor : "#3492dc",
                        strokeColor : "#3490dc",
                        pointColor : "#3490dc",
                        pointStrokeColor : "fff",
                        data : [0, 0, 0, 0, 0, 0, 192, 3, 0, 0, 2, 2],
                        label : "2011"
                        },
                        {
                        fillColor : "#6573cd",
                        strokeColor : "#6574cd",
                        pointColor : "#6574cd",
                        pointStrokeColor : "fff",
                        data : [1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        label : "2012"
                        }
                        ];

                        var meses = ["Janeiro2","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto",'Setembro',"Outubro","Novembro","Dezembro"]

                    var data = {
                        labels : meses,
                        datasets : dados
                    };

                    var ctx = document.getElementById("lineChart");
                    new Chart(ctx).Line(data);

                    legend(document.getElementById("lineLegend"), data);
                
           }
         },   
        computed:{
             
        },    
        mounted() {

                    this.criarGrafico();

                    var entregas = [];

                    for(var i = 0; i < this.dados.length; i++){
                        entregas.push(this.dados[i]);
                    }
                   console.log(entregas);
                    
                    }           
                

            
    }
</script>
