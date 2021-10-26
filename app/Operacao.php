<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operacao extends Model
{
    protected $connection	= 'pgsql';
    protected $table = 'tab_operacoes';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function modalidade()
    {
       return $this->belongsTo(Modalidade::class); //possui muitos
    }

    public function faixaRenda()
    {
       return $this->belongsTo(FaixaRenda::class); //possui muitos
    }    
    public static function posicaoArquivoOperacoes(){
        return Operacao::max('dte_movimento_arquivo');
    }
}
