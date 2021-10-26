@component('mail::message')
# Permissão Indeferida

<p>Prezado(a) {{ $permissao->user->nome }} {{ $permissao->user->sobrenome }},</p>
<p>Infelizmente você não foi aprovado(a) para enviar propostas para o Protótipos para Habitação de Interesse Social através do <strong>SISHAB</strong> conforme o motivo abaixo@auth
    <p>- {{ $permissao->tipoIndeferimento->txt_tipo_indeferimento}}" @if($permissao->tipo_indeferimento_id == 99) : {{$permissao->txt_outro_tipo_indeferimento}} @endif</p>
    <br/>
    

Segue a descrição do analista sobre a inconsistência encontrada em seu cadastro:</p>

<p>"{{ $permissao->txt_observacao }}"</p>

<p>Para que possamos realizar uma nova análise e aprovar seu cadastro, por favor acesse a página "Minhas Permissões" e envie outro ofício.</p>

@component('mail::button', ['url' => $url])
Acessar SISHAB
@endcomponent

Att,<br>
<strong>Secretaria Nacional de Habitação</strong>

<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: <a href="{{ $url }}">{{ $url }}</a></small></p>
@endcomponent
