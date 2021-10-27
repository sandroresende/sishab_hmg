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
                    :titulo2='"Validar Manifestação de Interesse"'
                   
            >
            </historico-navegacao>

            <cabecalho-form
                    :titulo="'VALIDAR MANIFESTAÇÃO DE INTERESSE'"
                    :barracompartilhar="true"
                    :linkcompartilhar="'{{ url("/pcva_parcerias/termo/consultar")}}'"
                    >
              
            </cabecalho-form> 
            <!-- form-group-->              
           <div class="form-group">
          



               <form action="{{ url('/pcva_parcerias/termo/validar/') }}" method="POST"  enctype="multipart/form-data" >
                    @csrf
                    <div class="well">
                        <div class="box">                                                                                 
                            <enviar-termo
                            id="formregistro" 
                            css="" 
                            url='{{ url("/") }}' 
                            >
                            </enviar-termo>    
                        </div>
                    </div>    
                 
            

        
            <div class="row">
                <div class="column col-sm-6 col-xs-12">                                        
                    <input class="btn btn-lg btn-info btn-block" type="submit" value="Enviar">       
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
        </form> 
             
        </div><!-- fechar primeiro form-group-->

        </div><!-- content-core -->
</div>    
<!-- content -->
@endsection


