@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
            
                :url="'{{ url('/selecao_beneficiarios') }}'"                
                :titulo1="'Dados Programa'"
                        >
            </historico-navegacao>  

          
            
  <div id="content">
   <div>
      <div id="viewlet-above-content-title"></div>
      <h1 class="documentFirstHeading">Dados Programa</h1>
      <div id="viewlet-below-content-title"></div>
      <div id="viewlet-above-content-body"></div>
      <div id="content-core">
         <div class="govbr-cards centralizar-cars">
            <div class="wrapper">
               <div class="card">
                  <a class="govbr-card-content" target="_blank" href="https://www.gov.br/mdr/pt-br/assuntos/habitacao/casa-verde-e-amarela">
                  <span class="front">
                  <span class="titulo">Empreendimentos</span>
                  </span>
                  </a>
               </div>
               <div class="card">
                  <a class="govbr-card-content" target="_blank" href="https://www.gov.br/mdr/pt-br/assuntos/habitacao/minha-casa-minha-vida">
                  <span class="front">
                  <span class="titulo">Relatórios</span>
                  </span>
                  </a>
               </div>
                        
            </div>
         </div>
      </div>
   </div>
</div>
</div>


    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


