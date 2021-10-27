<div class="card" >
    <div class="card-body">
        <div class="row">
            <div class="column col-sm-6">
                <div class="titulo">
                    <h3>Unidades Habitacionais</h3> 
                </div>  
                <div class="row ">                                                    
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">Contratadas</label>
                        <input id="qtd_uh_contratadas" type="text" class="form-control input-relatorio text-center" name="qtd_uh_contratadas" value="{{number_format($operacao->qtd_uh_contratadas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">Distratadas</label>
                        <input id="qtd_uh_distratadas" type="text" class="form-control input-relatorio text-center" name="qtd_uh_distratadas" value="{{number_format($operacao->qtd_uh_distratadas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">Concluídas</label>
                        <input id="qtd_uh_concluidas" type="text" class="form-control input-relatorio text-center" name="qtd_uh_concluidas" value="{{number_format($operacao->qtd_uh_concluidas, 0, ',' , '.')}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio">Entregues</label>
                        <input id="qtd_uh_entregues" type="text" class="form-control input-relatorio text-center" name="qtd_uh_entregues" value="{{number_format($operacao->qtd_uh_entregues, 0, ',' , '.')}}" disabled >
                    </div>            
                </div>
                <div class="row"> 
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio ">Ass. Projeto</label>
                        <input id="dte_assinatura_projeto" type="text" class="form-control input-relatorio text-center" name="dte_assinatura_projeto" value="@if($dadosEmpreendimento->dte_assinatura_projeto) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_assinatura_projeto))}}@endif" disabled >   
                    </div>
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio ">Início Obras</label>
                        <input id="dte_inicio_obras" type="text" class="form-control input-relatorio text-center" name="dte_inicio_obras" value="@if($dadosEmpreendimento->dte_inicio_obras) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_inicio_obras))}}@endif" disabled >   
                    </div> 
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio ">Término Obras</label>
                        <input id="dte_termino_obras" type="text" class="form-control input-relatorio text-center" name="dte_termino_obras" value="@if($dadosEmpreendimento->dte_termino_obras) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_termino_obras))}}@endif" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio ">Última Entrega</label>
                        <input id="dte_ultima_entrega" type="text" class="form-control input-relatorio text-center" name="dte_ultima_entrega" value="@if($dadosEmpreendimento->dte_ultima_entrega) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_ultima_entrega))}}@endif" disabled >
                    </div> 
                </div><!--fim row-->
            </div><!--fim col-sm-6 -->                         
            <div class="column col-sm-6"> 
                <div class="titulo">
                    <h3>Financeiro (R$)</h3> 
                </div>  
                <div class="row">                                                    
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio"> Contratado</label>
                        <input id="vlr_operacao" type="text" class="form-control input-relatorio text-center" name="vlr_operacao" value="{{number_format($operacao->vlr_operacao, 2, ',' , '.')}}" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio"> Projeto</label>
                        <input id="vlr_projeto" type="text" class="form-control input-relatorio text-center" name="vlr_projeto" value="{{number_format($operacao->vlr_projeto, 2, ',' , '.')}}" disabled >
                    </div>                     
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio"> Contrapartida</label>
                        <input id="vlr_contrapartida" type="text" class="form-control  input-relatorio text-center" name="vlr_contrapartida" value="{{number_format($operacao->vlr_contrapartida, 2, ',' , '.')}}" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-3 text-center">
                        <label class="control-label label-relatorio"> Liberado</label>
                        <input id="vlr_projeto" type="text" class="form-control input-relatorio text-center" name="vlr_projeto" value="{{number_format($operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                    </div> 
                </div>
                <div class="row">     
                    <div class="column col-xs-12 col-md-4 text-center">
                        <label class="control-label label-relatorio"> Liberado Obra</label>
                        <input id="vlr_liberado_sisfin" type="text" class="form-control input-relatorio text-center" name="vlr_liberado_sisfin" value="{{number_format($dadosEmpreendimento->vlr_liberado_sisfin, 2, ',' , '.')}}" disabled >
                    </div> 
                    <div class="column col-xs-12 col-md-4 text-center">
                        <label class="control-label label-relatorio"> Liberado Projeto</label>
                        <input id="vlr_projeto" type="text" class="form-control input-relatorio text-center" name="vlr_projeto" value="{{number_format($operacao->vlr_liberado-$dadosEmpreendimento->vlr_liberado_sisfin, 2, ',' , '.')}}" disabled >
                    </div> 
                      
                    <div class="column col-xs-12 col-md-4 text-center">
                        <label class="control-label label-relatorio">A Liberar</label>
                        @if((($operacao->vlr_operacao+$operacao->vlr_projeto)-$operacao->vlr_liberado)<0)
                            <input id="vlr_a_liberar" type="text" class="form-control input-relatorio input-alerta text-center" name="vlr_a_liberar" value="{{number_format(($operacao->vlr_operacao+$operacao->vlr_projeto)-$operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                        @else
                            <input id="vlr_a_liberar" type="text" class="form-control input-relatorio text-center" name="vlr_a_liberar" value="{{number_format(($operacao->vlr_operacao+$operacao->vlr_projeto)-$operacao->vlr_liberado, 2, ',' , '.')}}" disabled >
                        @endif                                    
                    </div>  
                </div>
                <!--fim row-->  
            </div>           <!--fim col-sm-6 -->                         
        </div>    <!--fim row -->   
    </div>
  </div>

  <div class="card" >
    <div class="card-body">
        <div class="titulo">
            <h3>Dados do Empreendimento</h3> 
        </div>
        <div class="row ">                                    
            <div class="column col-xs-12 col-md-2">
                <label class="control-label label-relatorio">APF</label>
                <input id="operacao_id" type="text" class="form-control input-relatorio" name="operacao_id" value="{{$operacao->txt_apf}}" disabled >
            </div>
            <div class="column col-xs-12 col-md-3">
                    <label class="control-label label-relatorio">Situação Obra - GEFUS</label>
                    <input id="operacao_id" type="text" class="form-control input-relatorio" name="operacao_id" value=" {{$operacao->txt_situacao_obra}}" disabled >
                </div>
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio">Fase do Contrato</label>
                <input id="txt_fase_contrato" type="text" class="form-control input-relatorio" name="txt_fase_contrato" value="{{$dadosEmpreendimento->txt_fase_contrato}}" disabled >
            </div>
            <div class="column col-xs-12 col-md-2">
            @if($operacao->dte_assinatura)    
                <label class="control-label label-relatorio ">Data de Contratação</label>
                <input id="dte_assinatura" type="text" class="form-control input-relatorio" name="dte_assinatura" value="@if($operacao->dte_assinatura) {{date('d/m/Y',strtotime($operacao->dte_assinatura))}}@endif" disabled >
            @else
                <label class="control-label label-relatorio ">Ano Assinatura</label>
                <input id="num_ano_assinatura" type="text" class="form-control input-relatorio" name="num_ano_assinatura" value="{{$operacao->num_ano_assinatura}}" disabled >
            @endif
            </div>
            
            <div class="column col-xs-12 col-md-2">
                <label class="control-label label-relatorio"> % de Obras</label>
                <input id="prc_obra_realizado" type="text" class="form-control input-relatorio" name="prc_obra_realizado" value="{{number_format($operacao->prc_obra_realizado, 0, ',' , '.')}}" disabled >
            </div>
           <!--
            <div class="column col-xs-12 col-md-2">
                <label class="control-label label-relatorio">Data de Legalização</label>
                <input id="dte_legalizacao" type="text" class="form-control input-relatorio" name="dte_legalizacao" value="@if($operacao->dte_legalizacao) {{date('d/m/Y',strtotime($operacao->dte_legalizacao))}}@endif" disabled >
            </div>                                                 
        -->
                            
                   
        </div>
        <div class="row">
            
            <div class="column col-xs-12 col-md-4">
                <label class="control-label label-relatorio ">Instituição</label>
                <input id="txt_agente_financeiro" type="text" class="form-control input-relatorio" name="txt_agente_financeiro" value="{{$operacao->txt_agente_financeiro}}" disabled >
            </div>
            <div class="column col-xs-12 col-md-4">
                <label class="control-label label-relatorio">CNPJ/CPF</label>
                <input id="proponente_id" type="text" class="form-control input-relatorio" name="proponente_id" value="{{$operacao->proponente_id}}" disabled >
            </div>
            <div class="column col-xs-12 col-md-4">
                <label class="control-label label-relatorio">Nome Construtora</label>
                <input id="txt_proponente_operacao" type="text" class="form-control input-relatorio" name="txt_proponente_operacao" value="{{$operacao->txt_proponente_operacao}}" disabled >
            </div>
        </div>
        <div class="row">
                <div class="column col-xs-12 col-md-8">
                    <label class="control-label label-relatorio ">Logradouro</label>
                    <input id="txt_endereco_empreendimento" type="text" class="form-control input-relatorio" name="txt_endereco_empreendimento" value="{{$operacao->txt_endereco_empreendimento}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-4">
                    <label class="control-label label-relatorio">Localidade</label>
                    <input id="txt_localidade" type="text" class="form-control input-relatorio" name="txt_localidade" value="{{$operacao->txt_localidade}}" disabled >
                </div>
            </div>
            <!--fim row--> 
            <div class="row">
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label label-relatorio ">UF</label>
                    <input id="txt_sigla_uf" type="text" class="form-control input-relatorio" name="txt_sigla_uf" value="{{$operacao->txt_sigla_uf}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-6">
                    <label class="control-label label-relatorio">Município</label>
                    <input id="ds_municipio" type="text" class="form-control input-relatorio" name="ds_municipio" value="{{$operacao->ds_municipio}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label label-relatorio">CEP</label>
                    <input id="txt_cep" type="text" class="form-control input-relatorio" name="txt_cep" value="{{$operacao->txt_cep}}" disabled >
                </div>
            </div>
            <!--fim row--> 
    </div>
  </div>

@if($dadosEmpreendimento->nu_apf_nao_obra)
<div class="card">
    <div class="card-body">
        @if($dadosEmpreendimento->fase_contrato_id == 1)
                <div class="titulo">
                    <h3>Dados do Projeto</h3> 
                </div>
                <div class="row">
                    
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">APF Projeto</label>
                        <input id="nu_apf_nao_obra" type="text" class="form-control input-relatorio" name="nu_apf_nao_obra" value="{{$dadosEmpreendimento->nu_apf_nao_obra}}" disabled >
                    </div>
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio ">Data Assinatura do Projeto</label>
                        <input id="dte_assinatura_projeto" type="text" class="form-control input-relatorio" name="dte_assinatura_projeto" value="@if($dadosEmpreendimento->dte_assinatura_projeto) {{date('d/m/Y',strtotime($dadosEmpreendimento->dte_assinatura_projeto))}}@endif" disabled >
                    </div>
                    
                    <div class="column col-xs-12 col-md-4">
                        <label class="control-label label-relatorio">Valor do Projeto</label>
                        <input id="vlr_projeto" type="text" class="form-control  input-relatorio" name="vlr_projeto" value="{{number_format($dadosEmpreendimento->vlr_projeto, 2, ',' , '.')}}" disabled >
                    </div>
                </div>
        @endif        

    </div><!--fim card-body -->                
</div><!--fim card -->                
@endif

<div class="card">
    <div class="card-body"> 
        <div class="titulo">
            <h3>Dados do Gerais</h3> 
        </div> 
        <div class="row">
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio ">Contrapartida Serviço</label>
                <input id="bln_contrapartida_servico" type="text" class="form-control input-relatorio" name="bln_contrapartida_servico" value="@if(empty($dadosEmpreendimento->bln_contrapartida_servico))  @elseif($dadosEmpreendimento->bln_terreno_doado == true) Sim @elseif($dadosEmpreendimento->bln_terreno_doado == false) Não @endif" disabled >
            </div>
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio ">Contrapartida Financeira</label>
                <input id="bln_contrapartida_financeira" type="text" class="form-control input-relatorio" name="bln_contrapartida_financeira" value="@if(empty($dadosEmpreendimento->bln_contrapartida_financeira))  @elseif($dadosEmpreendimento->bln_terreno_doado == true) Sim @elseif($dadosEmpreendimento->bln_terreno_doado == false) Não @endif" disabled >
            </div>

            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio ">Aquecimento Solar</label>
                <input id="bln_aquecimento_solar" type="text" class="form-control input-relatorio" name="bln_aquecimento_solar" value="@if(empty($dadosEmpreendimento->bln_aquecimento_solar))  @elseif($dadosEmpreendimento->bln_terreno_doado == true) Sim @elseif($dadosEmpreendimento->bln_terreno_doado == false) Não @endif" disabled >
            </div>
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio ">Terreno Doado</label>
                <input id="bln_terreno_doado" type="text" class="form-control input-relatorio" name="bln_terreno_doado" value="@if(empty($dadosEmpreendimento->bln_terreno_doado))  @elseif($dadosEmpreendimento->bln_terreno_doado == true) Sim @elseif($dadosEmpreendimento->bln_terreno_doado == false) Não @endif" disabled >
            </div>                                    
        </div>
        
    </div> 
</div>
