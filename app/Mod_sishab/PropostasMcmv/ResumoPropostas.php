<?php

namespace App\Mod_sishab\PropostasMcmv;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class ResumoPropostas extends Model
{
    protected $table = 'view_resumo_propostas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public static function buscaPropostaAPF($txt_num_apf){
        
        return $propostas = DB::table('view_resumo_propostas')->where('num_apf','=',$txt_num_apf)->orderBy('selecao_id', 'asc')->get();
        
    }
}
