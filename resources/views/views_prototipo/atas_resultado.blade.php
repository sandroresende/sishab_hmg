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
                    :titulo2='"Atas de Resultado"'
                   
            >
            </historico-navegacao>
            <div class="text-center">
                <img class="center-block" width='70' src="{{URL::asset('img/brasao_brasil.png')}}"  >
            </div>
            <cabecalho-form
                    
                    :subTitulo1="'Ministério do Desenvolvimento Regional'"
                    :subTitulo2="'Secretaria Nacional da Habitação'"
                    :barracompartilhar="false"
                    
                    >
            </cabecalho-form> 
            <br/>
            <br/>
            <h3 class="documentFirstHeading text-center">
                Atas de Resultado
           </h3>
           <br/>
           <br/>
           <br/>
           <br/>
           <p>
            Resultado sobre os encaminhamentos do processo de seleção de terrenos como definidos no EDITAL DECHAMAMENTO Nº 1, DE 23 DE JUNHO DE 2021, 
            publicado no DIÁRIO OFICIAL DA UNIÃO em: 30/06/2021 | Edição: 121 | Seção:3 | Página: 41, disponível no endereço eletrônico: 
            <a href='https://www.in.gov.br/en/web/dou/-/edital-de-chamamento-n-1-de-23-de-junho-de-2021-328905394' target="_blank">https://www.in.gov.br/en/web/dou/-/edital-de-chamamento-n-1-de-23-de-junho-de-2021-328905394</a>.
        </p>
        <p>
            - <a href='  {{ url("/documents/prototipo/ata_julgamento_3305240.pdf") }}' target="_blank">Ata de julgamento preliminar</a>, 
        </p>
           
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
                    textobotao="Voltar" 
                    tipobotao="button-danger"
                ></botao-acao>  
                </div>
            </div>        
        </div><!-- fechar primeiro form-group-->

        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


