@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                    :url="'{{ url('/') }}'"
                    :titulo1="'PCVA - Parcerias'"
                    :titulo2='"Manifestação de Interesse"'
                   
            >
            </historico-navegacao>
            <div class="text-center">
                <img class="center-block" width='70' src="{{URL::asset('img/brasao_brasil.png')}}"  >
            </div>
            <cabecalho-form
                    :subTitulo1="'PROGRAMA CASA VERDE E AMARELA - PARCERIAS'"
                    :subTitulo2="'{{$entePublicoParcerias->txt_ente_publico}}'"
                    :subTitulo3="'{{trim($municipio->ds_municipio)}}-{{$estado->txt_sigla_uf}}'"
                    :barracompartilhar="true"
                    
                    >
                    @if($dadosParceria->situacao_adesao_id == 1)
                        <div class="alert alert-warning text-center" role="alert">
                            <h4>Situação: {{$dadosParceria->situacaoAdesao->txt_situacao_adesao}}</h4>
                        </div>   
                    @elseif($dadosParceria->situacao_adesao_id == 2)
                        <div class="alert alert-primary  text-center" role="alert">
                            <h4>Situação: {{$dadosParceria->situacaoAdesao->txt_situacao_adesao}}</h4>
                        </div>   
                    @elseif($dadosParceria->situacao_adesao_id == 3)
                        <div class="alert alert-success  text-center" role="alert">
                            <h4>Situação: {{$dadosParceria->situacaoAdesao->txt_situacao_adesao}}</h4>
                        </div>   
                    @elseif($dadosParceria->situacao_adesao_id == 4)
                        <div class="alert alert-danger  text-center" role="alert">
                        <h4>Situação: {{$dadosParceria->situacaoAdesao->txt_situacao_adesao}}</h4>
                        </div>   
                    @endif
            </cabecalho-form> 
            <br/>
            <br/>
            <h3 class="documentFirstHeading text-center">
                MANIFESTAÇÃO DE INTERESSE
           </h3>
           <br/>
           <br/>
           <br/>
           <br/>
           <div class="form-group">
                <p>
                    Eu, <strong>{{$entePublicoParcerias->txt_nome_usuario}} {{$entePublicoParcerias->txt_sobrenome_usuario}}, {{$entePublicoParcerias->txt_cargo_usuario}}, 
                    nº CPF {{$entePublicoParcerias->txt_cpf_usuario}},</strong> registro a intenção deste Ente Público em aderir ao Programa Casa Verde e Amarela - Parcerias - Recursos FGTS, 
                    confirmando a disponibilidade de contrapartida exigida pela modalidade de, no mínimo, 20% do valor do investimento por família beneficiada, conforme dados preenchidos neste formulário
                    conforme dados abaixo: 
                </p>

                <div class="well">
                    <div class="box">  
                    <div class="row">
                        <div class="column col-sm-12">
                            <div class="card">
                                <div class="alert alert-primary  text-center" role="alert">
                                    <h4>Protocolo nº {{$dadosParceria->txt_protocolo_aceite}}</h4>
                                </div>
                            
                                <div class="card-body">                                
                                    <div class="titulo">
                                        <h3>1.1 Dados do Ente Público</h3> 
                                    </div> 
                                    <p>
                                        <strong>Ente Público: </strong>{{$entePublicoParcerias->txt_ente_publico}}</br>
                                        <strong>CNPJ: </strong>{{$entePublicoParcerias->txt_cnpj_ente_publico}}</br>
                                        <strong>Tipo de Ente Público: </strong>{{$entePublicoParcerias->tipoProponente->txt_tipo_proponente}}</br>
                                        <strong>Sede do Ente Público: </strong>{{trim($municipio->ds_municipio)}}-{{$estado->txt_sigla_uf}}</br>
                                        <strong>Email: </strong>{{$entePublicoParcerias->txt_email_ente_publico}}</br>
                                        <strong>Nome do Chefe do Executivo: </strong>{{$entePublicoParcerias->txt_nome_chefe_executivo}}</br>
                                        <strong>Cargo do Chefe do Executivo: </strong>{{$entePublicoParcerias->txt_cargo_executivo}}</br>
                                    </p>

                                    <div class="titulo">
                                        <h3>1.2 Responsável pelo preenchimento do formulário de adesão</h3> 
                                    </div>                                    
                                    <p>
                                        <strong>Nome: </strong>{{$entePublicoParcerias->txt_nome_usuario}} {{$entePublicoParcerias->txt_sobrenome_usuario}}</br>
                                        <strong>CPF: </strong>{{$entePublicoParcerias->txt_cpf_usuario}}</br>
                                        <strong>Cargo/função: </strong>{{$entePublicoParcerias->txt_cargo_usuario}}</br>
                                        <strong>Email: </strong>{{$entePublicoParcerias->txt_email_usuario}}</br>
                                        @if($entePublicoParcerias->txt_ddd_fixo && $entePublicoParcerias->txt_telefone_fixo)
                                            <strong>Telefone fixo: </strong>{{$entePublicoParcerias->txt_ddd_fixo}}-{{$entePublicoParcerias->txt_telefone_fixo}}</br>
                                        @endif    
                                        @if($entePublicoParcerias->txt_ddd_movel && $entePublicoParcerias->txt_telefone_movel)
                                            <strong>Telefone móvel: </strong>{{$entePublicoParcerias->txt_ddd_movel}}-{{$entePublicoParcerias->txt_telefone_movel}}</br>
                                        @endif
                                    </p>

                                    <div class="titulo">
                                        <h3>1.3 Dados da Contrapartida</h3> 
                                    </div>
                                    <p>
                                        <strong>N° de Unidades Habitacionais: </strong>{{number_format( ($dadosParceria->num_unidades), 0, ',' , '.')}}</br>
                                        <strong>Valor da contrapartida Pretendida por Unidade: </strong>{{number_format( ($dadosParceria->vlr_contrapartida_uh), 0, ',' , '.')}}</br>
                                        <strong>Valor da Contrapartida terreno por Unidade:  </strong>{{number_format( ($dadosParceria->vlr_terreno_uh), 2, ',' , '.')}}</br>
                                        <strong>Valor da contrapartida financeira por Unidade:  </strong>{{number_format( ($dadosParceria->vlr_contrapartida_munic_uh), 2, ',' , '.')}}</br>
                                 
                                    @if($entePublicoParcerias->tipo_proponente_id == 2)                               
                                        @if($dadosParceria->bln_contrapartida_adicional == true)
                                                <strong>Há previsão de contrapartida adicional por outro Ente Público para as mesmas unidades. </strong></br>
                                                <strong>Previsão de contrapartida adicional:  </strong>{{$dadosParceria->tipoContrapartida->txt_tipo_contrapartida}}</br>
                                                <strong>Valor previsão por Unidade:  </strong>{{number_format( ($dadosParceria->vlr_contrapartida_adicional), 2, ',' , '.')}}</br>
                                        @else                                
                                                <strong>NÃO Há previsão de contrapartida adicional por outro Ente Público para as mesmas unidades. </strong></br>
                                        @endif
                                    @endif   
                                    </p>

                                    <div class="titulo">
                                        <h3>1.4 Município(s) Beneficiado(s)</h3> 
                                    </div>
                                    @foreach($municipiosBeneficiados as $municipios)
                                        <div class="column col-xs-12 col-md-4 col-sm-4">
                                            <p>- {{trim($municipios->ds_municipio)}}-{{$municipios->txt_sigla_uf}}</p></br>
                                        </div>  
                                    @endforeach  
                                    <div class="linha-separa"></div>       
                                    
                                    <br/>
                                    <br/>
                                    <p class="text-center"> {{trim($municipio->ds_municipio)}}-{{$estado->txt_sigla_uf}},  {{date('d/m/Y',strtotime($dadosParceria->created_at))}}.</p>
                                
                            
                                    <p class="text-center">
                                        <strong>{{$entePublicoParcerias->txt_nome_usuario}} {{$entePublicoParcerias->txt_sobrenome_usuario}}</strong></br> 
                                        <small> Responsável pelo preenchimento do formulário de adesão</small> 
                                    </p>  
                                    <br/>
                                    <br/><br/>
                                    <br/>
                                    <strong>- As informações constantes neste Formulário de Intenção têm validade até 31/12/2022.</strong>
                                    <p>- Para continuidade do processo, solicitamos que o referido documento seja assinado pelo chefe do poder Executivo, ou representante por ele designado, e enviado pela 
                                        página <a href='{{ url("/pcva_parcerias/validacao/filtro") }}'>{{ url("/pcva_parcerias/validacao/filtro") }}</a>, para validação.
                                    </p>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>  

            </div><!-- fechar primeiro form-group-->

        <div class="form-group">
            <div class="row">
                <div class="column col-sm-6 col-xs-12">                                        
                    <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">   
                </div>
                <div class="column col-sm-6 col-xs-12">
                    <botao-acao  
                    :url="'{{ url("/")}}'" 
                    registro=""                               
                    cssbotao="btn btn-lg btn-danger btn-block"                               
                    textobotao="Cancelar" 
                    tipobotao="button-danger"
                ></botao-acao>  
                </div>
            </div>        
        </div><!-- fechar primeiro form-group-->

        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


