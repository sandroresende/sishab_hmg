@component('mail::message')
# Permissão Deferida

<p>Prezado(a) {{ $permissao->user->nome }} {{ $permissao->user->sobrenome }},</p>
<p>Parabéns, você foi aprovado(a) para enviar propostas para o Protótipos para Habitação de Interesse Social através do <strong>SISHAB</strong>. 
Faça o login no sistema e acesse a página de seleções para iniciar o cadastramento de sua proposta.</p>

@component('mail::button', ['url' => $url])
Acessar SISHAB
@endcomponent

Att,<br>
<strong>Secretaria Nacional de Habitação</strong>

<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: <a href="{{ $url }}">{{ $url }}</a></small></p>
@endcomponent
