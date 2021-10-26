@extends('layouts.app')

@section('content')
<div id="portal-breadcrumbs">
    <span id="breadcrumbs-you-are-here">Você está aqui:</span>
    <span id="breadcrumbs-home">
        <a href="{{ url('/home') }}">Página Inicial</a>
        <span class="breadcrumbSeparator">
            &gt;            
        </span>
    </span>

    <span dir="ltr" id="breadcrumbs-1">        
        <span>Briefing </span>
        <span class="breadcrumbSeparator">
            &gt;
            
        </span>
    </span>
   
    <span dir="ltr" id="breadcrumbs-2">
        <span id="breadcrumbs-current">Consulta Briefing Novo</span>
    </span>
</div> 

<div id="content">
    
    <div id="viewlet-above-content-title"></div>
        <h2  class="documentFirstHeading text-center">
        Briefing Novo
        </h2>
        <span class="documentFirstHeadingSpan">Selecione os dados para realização do filtro.</span>   
        <div class="linha-separa"></div>


    <div id="content-core">
      <!-- form-group-->              
      <div class="form-group">
          <form action="{{ url('briefing/novo/dados/') }}" method="POST">
              @csrf
                                                                                       
                     <select-uf-municipio 
                        :url="'{{ url('/') }}'"
                        coluf="column col-md-4"
                        colmun="column col-md-8"
                        requeruf="true"
                        requermunicipio="true"
                        ufselecionada = ""
                        ></select-uf-municipio>
            
            <button type="submit" name="pergunta" value="0" class="btn btn-success btn-lg btn-block">
              
            Situação dos Empreendimentos do MDR - Tabela

            </button>
              <button type="submit" name="pergunta" value="1" class="btn btn-primary btn-lg btn-block">
              
                1. Quantos contratos de financiamento (oneroso e não oneroso) estão vigentes no estado? </br>
                Qual o valor total dos financiamentos e quantos municípios estão contemplados?.

              </button>
              <button type="submit" name="pergunta" value="2" class="btn btn-primary btn-lg btn-block">
              2. Quantos instrumentos de repasse (oneroso e não oneroso) estão vigentes no estado? </br>
              Qual o valor total dos repasses e quantos municípios estão contemplados? 
              
              </button>
              <button type="submit" name="pergunta" value="3" class="btn btn-secondary btn-lg btn-block">
              3. Dos contratos de financiamento em execução (ativos) no estado, quais tiveram liberações em 2019? </br>
              Para cada um desses, qual o valor financiado e qual o valor liberado em 2019, </br>
              qual objeto e quais municípios contemplados? 
              
              </button>
              <button type="submit" name="pergunta" value="4" class="btn btn-secondary btn-lg btn-block">
              4.	Dos contratos de repasse em execução (ativos) no estado, quais tiveram pagamentos em 2019? </br>
              Para cada um desses, qual o valor total dos repasses em 2019? </br>
              Qual objeto e quais municípios contemplados? 
              
              </button>
              <button type="submit" name="pergunta" value="5" class="btn btn-success btn-lg btn-block">
              5. Dos contratos em execução, quais tiveram obras entregues em 2019? </br>
              Qual a estimativa da população beneficiada e de empregos gerados?. 
              
              </button>
              <button type="submit" name="pergunta" value="6" class="btn btn-info btn-lg btn-block">
              6. Quantos empreendimentos foram contratados em 2019? 
              
              </button>
              <button type="submit" name="pergunta" value="9" class="btn btn-danger btn-lg btn-block">
              9. Quantas obras estão paralisadas?? 
              
              </button>
              <button type="submit" name="pergunta" value="10" class="btn btn-danger btn-lg btn-block">
              10. Quais as solicitações de pagamento estão em aberto? 
              
              </button>
          </form> 
          </div><!--form-group -->
    </div><!-- content-core-->
</div><!-- content-->


@endsection
