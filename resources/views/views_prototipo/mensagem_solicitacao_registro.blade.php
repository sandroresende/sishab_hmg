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
                    :titulo1="'Protótipo de HIS'"
                    :titulo2='"Solicitação de Permissão"'
                   
            >
            </historico-navegacao>
            <div class="text-center">
                <img class="center-block" width='70' src="{{URL::asset('img/brasao_brasil.png')}}"  >
            </div>
            <cabecalho-form
                    :titulo="''"
                    :subTitulo1="'{{$entePublico->txt_ente_publico}}'"
                    :subTitulo2="'{{$municipio->ds_municipio}}-{{$municipio->txt_sigla_uf}}'"
                    :barracompartilhar="false"
                    
                    >
            </cabecalho-form> 
            <br/>
            <br/>
            <h3 class="documentFirstHeading text-center">
                Solicitação de Permissão
           </h3>
           <br/>
           <br/>
           <br/>
           <br/>
           <div class="form-group">
           <p> 
            O Sr./Sra. <strong>{{$usuario->name}}, {{$usuario->txt_cargo}}, nº CPF {{$usuario->txt_cpf_usuario}},</strong> solicitou permissão para registro das informações sobre 
            as condições do terreno ofertado para o empreendimento em nome da <strong>{{$entePublico->txt_ente_publico}}, inscrita no CNPJ: {{$entePublico->id}} </strong>.
          </p>
            
            <p>
                Assim, faça o login no sistema com a senha padrão "123456" e acesse a página "Minhas Permissões" 
            e acompanhe a análise desta permissão e envio do resultado para o email:<strong> {{$usuario->email}}</strong>.
            </p>

        </div><!-- fechar primeiro form-group-->
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="form-group">
            <div class="row">
                <div class="column col-xs-12 col-md-12">
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


