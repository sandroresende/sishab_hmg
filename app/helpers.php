<?php
use App\Mod_sishab\OfertaPublica\Contrato;
use App\Mod_sishab\OfertaPublica\FaixaExecucao;


use App\Mod_sishab\Operacoes\PosicaoDados;

use App\Mod_sishab\MedicoesObras\SituacaoMedicoes;

use Illuminate\Support\Facades\Auth;


function getPosicaoDadosOperacoes(){
    $posicaoDados = PosicaoDados::first();
    return Carbon\Carbon::parse($posicaoDados->dte_posicao)->format('d/m/Y');
}

function getPosicaoDadosMedicoes(){
    $posicaoDados = SituacaoMedicoes::max('dte_movimento');
    return Carbon\Carbon::parse($posicaoDados)->format('d/m/Y');
}

function flash($titulo = null, $mensagem = null)
{
	$flash = app('App\Http\Flash');

	if(func_num_args() == 0){
		return $flash;
	}

	return $flash->info($titulo, $mensagem);
}

function sanitizeCPF($cpfBruto) {
	return  str_replace(",", "", str_replace("-", "", str_replace(".", "", trim($cpfBruto))));
}

function getMediaPercProtocolo($protocoloId){
	return Contrato::where('protocolo_id',$protocoloId)->avg('vlr_percentual_obra');        
}



function adicionarDiasData($data, $dias, $meses = 0, $ano = 0)
{
   //passe a data no formato yyyy-mm-dd
   $data = explode("-", $data);
   $newData = date("Y-m-d", mktime(0, 0, 0, $data[1] + $meses, $data[2] + $dias, $data[0] + $ano) );
   return $newData;
}

function convertaDataExtenso($data){
    
    $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

    $diasdasemana = array (1 => "Segunda-Feira",2 => "Terça-Feira",3 => "Quarta-Feira",4 => "Quinta-Feira",5 => "Sexta-Feira",6 => "Sábado",0 => "Domingo");

     $dataConverter = $data;

     $dia = $dataConverter["mday"];
     $mes = $dataConverter["mon"];
     $nomemes = $meses[$mes];
     $ano = $dataConverter["year"];

     $diadasemana = $dataConverter["wday"];
     $nomediadasemana = $diasdasemana[$diadasemana];

     return "$nomediadasemana, $dia de $nomemes de $ano";
} 

function diferenca_datas($data_inicial, $data_final){
    $data_inicio = strtotime($data_inicial);
    $data_fim = strtotime($data_final);

    // Resgata diferença entre as datas
        $dateInterval = $data_fim-$data_inicio;
        return floor($dateInterval / (60 * 60 * 24));
}

function verificaTipoArquivo($arquivo){
    if(($arquivo != 'application/pdf') && ($arquivo != 'image/jpeg') && ($arquivo != 'image/png')){
        return false;
    }else{
        return true;
    }
} 



