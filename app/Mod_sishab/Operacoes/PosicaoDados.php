<?php

namespace App\Mod_sishab\Operacoes;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class PosicaoDados extends Model
{
    protected $table = 'operacoes._tab_posicao_dados';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização



    public static function PosicaoDadosTabOperacoes()
    {


        return $posicaoDados = DB::table('operacoes._tab_posicao_dados')
                        ->select('dte_posicao')
                        ->get();
        
                                             
    } 
                                                  

}
