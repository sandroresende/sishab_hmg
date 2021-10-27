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
                    :titulo2='"Consultar Manifestação de Interesse"'
                   
            >
            </historico-navegacao>

            <cabecalho-form
                    :titulo="'CONSULTAR MANIFESTAÇÃO DE INTERESSE'"
                    :barracompartilhar="true"
                    :linkcompartilhar="'{{ url("/pcva_parcerias/termo/consultar")}}'"
                    >
              
            </cabecalho-form> 
            <!-- form-group-->              
           <div class="form-group">
            <form action="{{ url('/pcva_parcerias/termo/protocolo/') }}" method="POST">
                 @csrf
                 <div class="well">
                     <div class="box">                                                                                 
                         <div class="row">  
                             <div class="column col-xs-12 col-md-12">
                                 <label for="txtProtocoloAceite">Protocolo</label>   
                                 <input type="text" 
                                     id="txtProtocoloAceite"   
                                     name="txtProtocoloAceite"   
                                     class="form-control"
                                     required>
         
                                 
                             </div>
                         </div>
                         <!--fim row-->  
                     </div>
                 </div>    
                 
            

        
            <div class="row">
                <div class="column col-sm-6 col-xs-12">                                        
                    <input class="btn btn-lg btn-info btn-block" type="submit" value="Pesquisar">       
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


