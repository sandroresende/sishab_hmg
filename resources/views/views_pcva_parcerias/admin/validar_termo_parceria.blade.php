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
                    :subTitulo4="'Data de Registro: {{date('d/m/Y',strtotime($dadosParceria->created_at))}}'"
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
          
           <div class="form-group">
                <form action="{{ url('admin/pcva_parcerias/termo/validar') }}" method="POST">
                @csrf
                <input class="btn btn-lg btn-info btn-block" type="hidden" name="dados_parceria_id" value="{{$dadosParceria->id}}">     

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
                                            <p>- {{trim($municipios->ds_municipio)}}-{{$municipios->txt_sigla_uf}}</p>
                                        </div>  
                                    @endforeach  
                                    @if($dadosParceria->situacao_adesao_id > 1)   
                                    <div class="titulo">
                                        <h3>1.5 Arquivo com o Termo de Adesão Assinado</h3> 
                                    </div>
                                    <a class="btn btn-link btn-sm" target="_blank" href='{{ url("/$dadosParceria->txt_caminho_termo")}}'><i class="fas fa-file-pdf fa-4x"></i></a>                         
                                    @endif
                                    
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>  

            </div><!-- fechar primeiro form-group-->

            @if($dadosParceria->situacao_adesao_id == 2)
                <validar-termo url='{{ url("/") }}' >     
                </validar-termo>  
            @endif  
            
        <div class="form-group">
            <div class="row">
                <div class="column col-sm-6 col-xs-12"> 
                    @if($dadosParceria->situacao_adesao_id == 2)
                        <input class="btn btn-lg btn-info btn-block" type="submit" name="validar" value="Validar">   
                    @elseif($dadosParceria->situacao_adesao_id == 3)
                        <botao-acao-icone  
                                :url="'{{ url("/admin/pcva_parcerias/termo/cancelar/")}}'" 
                                registro="{{$dadosParceria->id}}"                               
                                mensagem="Deseja cancelar a análise do Termo de Adesão?" 
                                titulo="Atenção!"
                                txtbotaoconfirma="Sim"
                                txtbotaocancela="Cancelar"
                                cssbotao="btn btn-warning btn-lg btn-block"                               
                                cssicone="" 
                                textobotao="Cancelar Análise" 
                            ></botao-acao-icone>
                    @else
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">         
                    @endif
                </div>  
                <div class="column col-sm-6 col-xs-12">                                                            
                    <input class="btn btn-lg btn-danger btn-block" type="button-danger" onclick="javascript:window.history.go(-1)" value="Fechar">     
                </div>  
                
            </div>        
        </div><!-- fechar primeiro form-group-->
      
        </form>   
        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


