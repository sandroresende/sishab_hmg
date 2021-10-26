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
    
    <h3 class="text-center">{{$entePublico->txt_ente_publico}}</h3>   
    <h4 class="text-center">{{$municipio->ds_municipio}}-{{$municipio->txt_sigla_uf}}</h4>   
    
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

       
        
        @csrf
        <div class="form-group">
            O Sr./Sra. <strong>{{$usuario->name}}, {{$usuario->txt_cargo}}, nº CPF {{$usuario->txt_cpf_usuario}},</strong> solicitou permissão para registro das informações sobre 
            as condições do terreno ofertado para o empreendimento em nome da <strong>{{$entePublico->txt_ente_publico}}, inscrita no CNPJ: {{$entePublico->id}} </strong>.
            
            Assim, aguarde a análise desta permissão e  envio do resultado para o email: {{$usuario->email}}.

        </div><!-- fechar primeiro form-group-->

  
    

   

            

    </div><!-- form-group-->  
            
            <a href='{{ url("/") }}' type="button" class="btn btn-danger btn-lg btn-block">Fechar</a>                    
       
      <!--form-group -->
  
  </div>
   
      

    </div>
    <!-- content-core-->
</div>
<!-- content-->




@endsection