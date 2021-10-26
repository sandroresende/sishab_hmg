@extends('layouts.app')

@section('content')

<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
            <a href="{{ url('/') }}">Página Inicial</a>
            <span class="breadcrumbSeparator">
                &gt;            
            </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
            <span> Solicitação de registro</span>
    <span class="breadcrumbSeparator">
                &gt;

            </span>
    </span>

   
</div><!-- portal-breadcrumbs -->



<div id="content">
    <br/>
    <br/>
    <div class="text-center">
        <img class="center-block" width='70' src="{{URL::asset('img/brasao_brasil.png')}}"  >
    </div>
  
    
    <div class="linha-separa"></div>
    
    <div id="viewlet-above-content-title"></div>
    <br/>
    <br/>

    <h2 class="documentFirstHeading">
         Solicitação de Permissão
    </h2>

    <br/>
    <br/>
    <br/>

  
    <div id="content-core">
        Permissão Indeferida

        <p>Prezado(a) {{ $permissao->user->nome }} {{ $permissao->user->sobrenome }},</p>
        <p>Infelizmente você não foi aprovado(a) para enviar propostas para o Protótipos para Habitação de Interesse Social através do <strong>SISHAB</strong> conforme o motivo abaixo
            <p>- {{ $permissao->tipoIndeferimento->txt_tipo_indeferimento}}" @if($permissao->tipo_indeferimento_id == 99) : {{$permissao->txt_outro_tipo_indeferimento}} @endif</p>
            <br/>
            
        
        Segue a descrição do analista sobre a inconsistência encontrada em seu cadastro:</p>
        
        <p>"{{ $permissao->txt_observacao }}"</p>
        
        <p>Para que possamos realizar uma nova análise e aprovar seu cadastro, por favor acesse a página "Minhas Permissões" e envie outro ofício.</p>

  
    

   

            

    </div><!-- form-group-->  
            
            <a href='{{ url("/") }}' type="button" class="btn btn-danger btn-lg btn-block">Fechar</a>                    
       
      <!--form-group -->
  
  </div>
   
      

    </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection