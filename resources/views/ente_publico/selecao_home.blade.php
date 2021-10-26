
@extends('layouts.app') 

@section('scripts')

<link href="{{ asset('css/relatorio_executivo.css') }}" rel="stylesheet"> 
@endsection 

@section('content')
<div id="content">
    <div class="row">
        <div class="row-content">
            <div class="column col-md-12" data-panel="">
                <div class="tile tile-default" id="fbda622f-0009-4d19-99b0-87f2900529e9">
                    <div class="cover-banner-tile tile-content">
                        <img
                            src='{{ URL::asset("/images/selecao/folder_selecao_beneficiarios.png")}}'
                            width="1150"
                            height="200"
                            class="left"
                            alt=""
                        />

                        <div class="visualClear"><!-- --></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-control">
        <div class="row">    
            <div class="column col-xs-12 col-md-12">
                <div class="tile tile-default" id="f13afd1e-90fe-482d-a568-7da039d46cb7">
                    <div class="cover-richtext-tile tile-content">
                         <h1>
                            <strong>
                                A lista de candidatos, a partir de agora, será gerada pelo Governo  Federal, por meio da base do Cadastro Único.
                            </strong>
                        </h1>
                        <p>
                        Essa mudança confere maior transparência e controle social ao processo, beneficiando os Entes Públicos e a população.
                        </p>
                    </div>
                </div>                
            </div>   
            <div class="column col-xs-12 col-md-12">           
                <div class="tile tile-default" id="dca7ebfc-851b-497d-b9c6-68a71a636a5c">
                    <div class="outstanding-header tile-content">
                        <div class="alert alert-warning" role="alert">
                        Em operações sem indicação de beneficiários.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</br>
    <div class="form-control">
        <div class="row">
             <div class="column col-xs-12 col-md-4">           
               
                    <img   src='{{ URL::asset("/images/selecao/ft3_mcmv.png")}}' class="image-inline"/>
                    <h6><small>http//www.gov.br/cidadania/pt-br/acoes-e-programas/cadastro-unico</small></h6>
               
            </div>
            
            <div class="column col-xs-12 col-md-8">
                <div class="tile tile-default" id="f13afd1e-90fe-482d-a568-7da039d46cb7">
                    <div class="cover-richtext-tile tile-content">
                        <h1>
                            <strong>
                                    Dessa forma, o candidato deve estar inscrito no CadÚnico, com dados atualizados, 
                                    para participar do PMCMV. 
                            </strong>
                        </h1>
                        <p>
                                O Ente Público deve dar publicidade à população e orientar para que se inscrevam ou atualizem os 
                                seus dados no CadÚnico.
                        </p>
                    </div>
                </div>

                <div class="tile tile-default" id="dca7ebfc-851b-497d-b9c6-68a71a636a5c">
                    <div class="outstanding-header tile-content">
                    <!--   
                    <a class="outstanding-link" href="https://www.gov.br/mdr/pt-br/assuntos-nova/habitacao/casa-verde-e-amarela/o-programa">Saiba Mais</a>
    -->
                    </div>
                </div>
            </div>   
           
        </div>
    </div>

    </br>
    <div class="form-control">
        <div class="row">
            
            <div class="column col-xs-12 col-md-12">
                <div class="tile tile-default" id="f13afd1e-90fe-482d-a568-7da039d46cb7">
                    <div class="cover-richtext-tile tile-content">
                        <h1>
                            <strong>
                            Os candidatos da lista atendem a, pelo menos:
                            </strong>
                        </h1>
                        
                    </div>
                </div>

                <div class="tile tile-default" id="dca7ebfc-851b-497d-b9c6-68a71a636a5c">
                    <div class="outstanding-header tile-content">
                    <!--   
                    <a class="outstanding-link" href="https://www.gov.br/mdr/pt-br/assuntos-nova/habitacao/casa-verde-e-amarela/o-programa">Saiba Mais</a>
    -->
                    </div>
                </div>

                <div class="row">
                             <div class="column col-xs-12 col-md-4">
                                <div class="table-responsive">
                                    <table  class="table table-bordered">
                                        <thead>
                                        <!-- On rows -->
                                            <tr class="warning text-center">
                                                <th>UM REQUISITO:</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- On cells (`td` or `th`) -->
                                            <tr class="celulaCorAzul">
                                                <td class="info">Viver em domicílio rústico</td>
                                            </tr>
                                            <tr class="celulaCorAzul">
                                                <td class="info">Viver em domicílio improvisado</td>
                                                </tr>
                                            <tr class="celulaCorAzul">
                                                <td class="info">Viver em coabitação involuntária</td>
                                                </tr>
                                            <tr class="celulaCorAzul">
                                                <td class="info">Viver em adensamento excessivo</td>
                                                </tr>
                                            <tr class="celulaCorAzul">
                                                <td class="info"> Possui ônus excessivo com aluguel</td>
                                                </tr>
                                            <tr class="celulaCorVerde">
                                                <td>
                                                    Estar em situação de rua
                                                <span class="label label-success">
                                                    Único requisito isento de atender aos 5 requisitos
                                                </span>
                                                </td>
                                            
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                             </div>
                             <div class="column col-xs-12 col-md-8">
                                <div class="table-responsive">
                                    <table  class="table table-bordered">
                                        <thead>
                                        <!-- On rows -->
                                            <tr class="warning text-center">
                                                <th colspan="2">CINCO CRITÉRIOS</th> 
                                            </tr>
                                        </thead>
                                        <tbody class="celulaCorAzul">
                                            <!-- On cells (`td` or `th`) -->
                                            <tr >
                                                <td class="info">Viver em domicílio rústico</td>
                                                <td class="info">Beneficiáriodo BPC</td>
                                            </tr>
                                            <tr>
                                                <td class="info">Viver em domicílio improvisado</td>
                                                <td class="info">Dependentede até 6 anos</td>
                                            </tr>
                                            <tr>
                                                
                                                <td class="info">Viver em coabitação involuntária</td>
                                                <td class="info">Dependente entre 6 e 12 anos</td>
                                                </tr>
                                            <tr>
                                                <td class="info">Viver em adensamento excessivo</td>
                                                <td class="info">Pessoa com deficiência na família</td>
                                            </tr>
                                            <tr>
                                                <td class="info">Possui ônus excessivo com aluguel</td>
                                                <td class="info"> Idoso na família</td>
                                            </tr>
                                            <tr>
                                                <td class="info">Mulher responsável familiar</td>
                                                <td class="info"> Negro na família</td>
                                            </tr>
                                            <tr>
                                                <td class="info">Beneficiário do Bolsa Família Grupos</td>
                                                <td class="info"> Populacionais Tradicionais Específicos</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                             </div>
                        </div>
            </div>  
             
           
        </div>
    </div>
</br>
<div class="form-control">
        <div class="row">    
            <div class="column col-xs-12 col-md-12">
                <div class="tile tile-default" id="f13afd1e-90fe-482d-a568-7da039d46cb7">
                    <div class="cover-richtext-tile tile-content">
                        <h1>
                            <strong>
                            Ente Público pode atribuir peso dois para até três dos critérios elencados, conforme realidade local.
                            
                            </strong>
                        </h1>
                        <p>
                        Caso o Ente Público utilize essa prerrogativa, deverá hierarquizar os candidatos conforme critérios pontuados, no momento de averiguação da documentação. 
                           
                        </p>
                        <p>
                           Caso não atribua pesos, a lista seguirá a ordem conforme foi gerada inicialmente pelo CadÚnico.
                        </p>
                    </div>
                </div>                
            </div>   
            <div class="column col-xs-12 col-md-12">           
                <div class="tile tile-default" id="dca7ebfc-851b-497d-b9c6-68a71a636a5c">
                    <div class="outstanding-header tile-content">
                    <div class="alert alert-warning" role="alert">
                    Os critérios priorizados devem ser aprovados pelo Conselho de Habitação local.
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br>
<div class="form-control">
        <div class="row">    
            <div class="column col-xs-12 col-md-12">
                <div class="tile tile-default" id="f13afd1e-90fe-482d-a568-7da039d46cb7">
                    <div class="cover-richtext-tile tile-content">
                        <h1>
                            <strong>
                            O Ente Público que possuir sistema auditável para a seleção de beneficiários pode manifestar interesse em continuar as seleções por meio do seu cadastro.
                            </strong>
                        </h1>
                        <p>
                        O Ente Público deve adequar o sistema ao requisitos e critérios descritos na Portaria.
                        </p>
                    </div>
                </div>                
            </div>   
            <div class="column col-xs-12 col-md-12">           
                <div class="tile tile-default" id="dca7ebfc-851b-497d-b9c6-68a71a636a5c">
                    <div class="outstanding-header tile-content">
                        <div class="alert alert-warning" role="alert">
                            Nesse caso, o Ente Público deve enviar ofício ao e-mail cgpe.demanda@mdr.gov.br, até o dia 30 de setembro, declarando possuir sistema auditável para esse fim, com cópia da declaração remetida ao MP competente.
                        </div>
                        <div class="alert alert-success" role="alert">
                        Enviar manifestação conforme modelo de declaração disponibilizado.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div class="form-control">
        <div class="row">    
            <div class="column col-xs-12 col-md-12">
                <div class="tile tile-default" id="f13afd1e-90fe-482d-a568-7da039d46cb7">
                    <div class="cover-richtext-tile tile-content">
                        <h1>
                            <strong>
                            O Ente Público pode, ainda, indicar até 30% das unidades do empreendimento para demanda oriunda de área de risco alto ou muito alto.
                            </strong>
                        </h1>
                        <p>
                        A classificação deve seguir o Plano Municipal de  Redução de Riscos (PNMR), o mapeamento de riscos produzido pelo Serviço Geológico do Brasil ou o laudo da defesa civil estadual ou municipal.
                        </p>
                    </div>
                </div>                
            </div>   
            <div class="column col-xs-12 col-md-12">           
                <div class="tile tile-default" id="dca7ebfc-851b-497d-b9c6-68a71a636a5c">
                    <div class="outstanding-header tile-content">
                        <div class="alert alert-warning" role="alert">
                        Nesse caso, o Ente Público deve formalizar a indicação diretamente ao Agente Financeiro até o dia 30 de setembro.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br>
     </br>
    <div class="form-control">
        <div class="row">    
            <div class="column col-xs-12 col-md-12">
                <div class="tile tile-default" id="f13afd1e-90fe-482d-a568-7da039d46cb7">
                    <div class="cover-richtext-tile tile-content">
                        <h1>
                            <strong>
                            O Ente Público deve indicar três nomes para terem acesso à lista de candidatos que será disponibilizada em plataforma digital pelo MDR.
                            
                            </strong>
                        </h1>
                        <p>
                        Os indicados devem acessar a lista a partir de 16 de novembroe enviar à Caixa para as pesquisas de enquadramento do candidato em 30 dias.
                        
                        </p>
                        <p>
                        
                        A partir de 21/09 é possível acessar o site para que os indicados se cadastrem. 
                        </p>
                    </div>
                </div>                
            </div>   
            <div class="column col-xs-12 col-md-12">           
                <div class="tile tile-default" id="dca7ebfc-851b-497d-b9c6-68a71a636a5c">
                    <div class="outstanding-header tile-content">
                        
                        <div class="alert alert-warning" role="alert">
                        Acesso ao sistema: <strong>http://sishab.mdr.gov.br</strong>
                        </div>

                        <div class="alert alert-danger" role="alert">
                        Email de Suporte para o sistema: <strong>suporte.sishab@mdr.gov.br</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </br>
    <div class="row">
        <div class="well">
            <div class="column col-md-12" data-panel="">
                <div class="tile tile-default" id="eb541af2-186c-43bf-b3cc-fe1e1d803874">
                    <div class="cover-richtext-tile tile-content">
                        <div class="alert alert-warning" role="alert">
                        Ainda neste ano, serão publicadas as primeiras portarias para seleção de propostas de regularização fundiária e melhorias habitacionais.<br />
                            <br />
                            A execução dos serviços e obras será feita por meio de uma linha de financiamento para empresas privadas, que submeterão propostas ao MDR, já com a indicação dos locais. As propostas devem ser apresentadas
                            necessariamente por, no mínimo, duas empresas, sendo uma responsável pelo processo de regularização fundiária como um todo e as demais pelas obras de melhoria habitacional.<br />
                            <br />
                            O processo de seleção e contratação tem início com a adesão do poder público municipal ou distrital e o preenchimento, pelas empresas, de carta-consulta on-line, que deverá contar também com a anuência do poder
                            público. O link para envio do documento será disponibilizado em breve.<br />
                            <br />
                            As propostas selecionadas pelo MDR deverão ser apresentadas pelas empresas aos agentes financeiros habilitados para análise de viabilidade técnica, jurídica e econômico-financeira, visando à contratação da
                            operação do financiamento, que será repassado à família beneficiada a valores subsidiados pelo FDS.<br />
                            <br />
                            <strong>Em breve, serão disponibilizados os normativos e o fluxo completo.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            
            <a type="submit"  class="btn btn-danger btn-lg btn-block"  href='{{ url("/entePublico")}}'>Fechar</a>

        </div>
</div>    
</div>

<!-- content-->



@endsection