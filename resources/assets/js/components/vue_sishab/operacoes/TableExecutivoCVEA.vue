<template>
  <!--Tabela MCMV 1-->
            <div>
                
                <div class="table-responsive">		
                    <table class="table table-bordered table-sm tab_executivo">
                    <thead>
                        <tr class="text-center">
                        <th rowspan="2" >Modalidade</th>
                        <th rowspan="2">Faixa</th>
                        <th rowspan="2">Valor Contratado R$</th>
                        <th rowspan="2">Valor Liberado R$</th>
                        <th  rowspan="2">UH Contratadas</th>
                        <th colspan="3">Unidades</th>
                        
                        </tr>
                        <tr>                                         
                        <th class="text-center">Vigentes</th>
                        <th class="text-center">Entregues</th>
                        <th class="text-center">Distratadas</th>
                        
                               
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        <tr v-for="item in dados">                        
                            <td v-if="item.faixa_renda_id == 5" >
                                {{item.txt_modalidade}} - PF
                            <!--    <a v-if="codibge > 0" rel="nofollow" v-bind:href="url + '/executivo/detalhar/modalidade/' 
                                                                                             + item.modalidade_id 
                                                                                             + '/' + item.faixa_renda_id
                                                                                             + '/' + codibge"><i class="fas fa-search"></i></a>
                            -->                                                                 
                            </td>
                            <td v-if="item.faixa_renda_id == 5" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 5" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 5" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_liberado,2)}}</td>
                            <td v-if="item.faixa_renda_id == 5" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>
                            <td v-if="item.faixa_renda_id == 5" class="tabelaNumero text-center">{{formatarValor(item.num_vigentes,0)}}</td>
                            <td v-if="item.faixa_renda_id == 5" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 5" class="tabelaNumero text-center">{{formatarValor(item.num_distratadas,0)}}</td>
                        </tr>
                        <tr v-for="item in dados">                        
                            <td v-if="item.faixa_renda_id == 6" >
                            {{item.txt_modalidade}} - PF
                            
                            </td>
                            <td v-if="item.faixa_renda_id == 6" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 6" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 6" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_liberado,2)}}</td>
                            <td v-if="item.faixa_renda_id == 6" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>         
                            <td v-if="item.faixa_renda_id == 6" class="tabelaNumero text-center">{{formatarValor(item.num_vigentes,0)}}</td>
                            <td v-if="item.faixa_renda_id == 6" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 6" class="tabelaNumero text-center">{{formatarValor(item.num_distratadas,0)}}</td>                   
                        </tr>
                         <tr v-for="item in dados">                        
                            <td v-if="item.faixa_renda_id == 7" >
                            {{item.txt_modalidade}} - PF
                            
                            </td>
                            <td v-if="item.faixa_renda_id == 7" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 7" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 7" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_liberado,2)}}</td>
                            <td v-if="item.faixa_renda_id == 7" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>         
                            <td v-if="item.faixa_renda_id == 7" class="tabelaNumero text-center">{{formatarValor(item.num_vigentes,0)}}</td>
                            <td v-if="item.faixa_renda_id == 7" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 7" class="tabelaNumero text-center">{{formatarValor(item.num_distratadas,0)}}</td>                   
                        </tr>
                        <tr class="totalFaixa" v-if="totalGrupo1.valor > 0">
                            <td colspan="2" class="tabelaNumero">Total Grupo 1, 2 e 3 :</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalGrupo1.valor + totalGrupo3.valor + totalGrupo2.valor,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalGrupo1.valor_liberado + totalGrupo3.valor_liberado + totalGrupo2.valor_liberado,2)}}</td>                            
                            <td class="tabelaNumero text-center">{{formatarValor(totalGrupo1.uh + totalGrupo3.uh + totalGrupo2.uh,0)}}</td>
                             <td class="tabelaNumero text-center">{{formatarValor(totalGrupo1.vigentes + totalGrupo3.vigentes + totalGrupo2.vigentes,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalGrupo1.entregues + totalGrupo3.entregues + totalGrupo2.entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalGrupo1.distratadas + totalGrupo3.distratadas + totalGrupo2.distratadas,0)}}</td>
                        </tr>
                        <tr v-for="item in dados">                        
                            <td v-if="item.faixa_renda_id == 0" >
                                {{item.txt_modalidade}} - Producão/Estoque
                            <!--    <a v-if="codibge > 0" rel="nofollow" v-bind:href="url + '/executivo/detalhar/modalidade/' 
                                                                                             + item.modalidade_id 
                                                                                             + '/' + item.faixa_renda_id
                                                                                             + '/' + codibge"><i class="fas fa-search"></i></a>
                            -->                                                                 
                            </td>
                            
                            <td v-if="item.faixa_renda_id == 0" class="tabelaFaixa">{{item.dsc_faixa}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_total,2)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_vlr_liberado,2)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_uh,0)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_vigentes,0)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_entregues,0)}}</td>
                            <td v-if="item.faixa_renda_id == 0" class="tabelaNumero text-center">{{formatarValor(item.num_distratadas,0)}}</td>
                        </tr>
                         <tr class="totalFaixa" v-if="totalFaixa.valor > 0">
                            <td colspan="2" class="tabelaNumero">Total Producão/Estoque:</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.valor,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.valor_liberado,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.uh,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.vigentes,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(totalFaixa.distratadas,0)}}</td>
                        </tr>
                         <tr class="total">
                            <td colspan="2" class="tabelaNumero">TOTAL:</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresCVEA.valor,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresCVEA.valor_liberado,2)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresCVEA.uh,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresCVEA.vigentes,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresCVEA.entregues,0)}}</td>
                            <td class="tabelaNumero text-center">{{formatarValor(valoresCVEA.distratadas,0)}}</td>
                        </tr>                        
                    </tbody>                                        
                </table>                               

                </div>
        </div>        
</template>

<script>
    export default {
      props:['dados','url','codibge','posicoes'],
      data() {
            return {
               totalFaixa: {uh: 0, vigentes: 0, valor: 0, entregues: 0, distratadas: 0, valor_liberado: 0},     
               totalGrupo1: {uh: 0, vigentes: 0, valor: 0, entregues: 0, distratadas: 0, valor_liberado: 0},     
               totalGrupo2: {uh: 0, vigentes: 0, valor: 0, entregues: 0, distratadas: 0, valor_liberado: 0},  
               totalGrupo3: {uh: 0, vigentes: 0, valor: 0, entregues: 0, distratadas: 0, valor_liberado: 0},               
               valoresCVEA: {uh: 0, vigentes: 0, valor: 0, entregues: 0, distratadas: 0, valor_liberado: 0}
            }

          

      }, 
      methods:{
           formatarValor(valor,casas) {
                if (valor) {
                    let val = (valor/1).toFixed(casas).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                } else {
                    return '0.00';
                }
            },
             formatarData(data) {
                if (data) {    
                    var dataFormatada = new Date(data)+1;                
                    var dia=dataFormatada.getDate();
                    if (dia < 10){
                        dia = "0" + dia
                    }

                    
                        
                    var mes=dataFormatada.getMonth();
                    mes = mes+1
                    if (mes < 10){
                        mes = "0" + mes
                    }
                    var ano=dataFormatada.getFullYear();
                   
                    return dia + '/' + (mes) + '/' + ano;
                    //return new Date(data).toLocaleString().substr(0, 10)
                } else {
                    return '';
                }
            } 
      },     
      mounted() {
            
             for(var i = 0; i < this.dados.length; i++){
                if(this.dados[i].faixa_renda_id == 0){
                    this.totalFaixa.uh += parseInt(this.dados[i].num_uh);
                    this.totalFaixa.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.totalFaixa.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.totalFaixa.entregues += parseInt(this.dados[i].num_entregues);                
                    this.totalFaixa.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.totalFaixa.distratadas += parseInt(this.dados[i].num_distratadas);
                }else if(this.dados[i].faixa_renda_id == 5){
                     this.totalGrupo1.uh += parseInt(this.dados[i].num_uh);
                    this.totalGrupo1.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.totalGrupo1.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.totalGrupo1.entregues += parseInt(this.dados[i].num_entregues);                
                    this.totalGrupo1.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.totalGrupo1.distratadas += parseInt(this.dados[i].num_distratadas);
                }else if(this.dados[i].faixa_renda_id == 6){
                     this.totalGrupo2.uh += parseInt(this.dados[i].num_uh);
                    this.totalGrupo2.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.totalGrupo2.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.totalGrupo2.entregues += parseInt(this.dados[i].num_entregues);                
                    this.totalGrupo2.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.totalGrupo2.distratadas += parseInt(this.dados[i].num_distratadas);
                }else{
                     this.totalGrupo3.uh += parseInt(this.dados[i].num_uh);
                    this.totalGrupo3.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.totalGrupo3.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.totalGrupo3.entregues += parseInt(this.dados[i].num_entregues);                
                    this.totalGrupo3.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.totalGrupo3.distratadas += parseInt(this.dados[i].num_distratadas);       
                }
                     this.valoresCVEA.uh += parseInt(this.dados[i].num_uh);
                    this.valoresCVEA.valor += parseFloat(this.dados[i].num_vlr_total);
                    this.valoresCVEA.vigentes += parseInt(this.dados[i].num_vigentes);
                    this.valoresCVEA.entregues += parseInt(this.dados[i].num_entregues);                
                    this.valoresCVEA.valor_liberado += parseFloat(this.dados[i].num_vlr_liberado);                    
                    this.valoresCVEA.distratadas += parseInt(this.dados[i].num_distratadas);  
             }        
        }

    }
</script>
