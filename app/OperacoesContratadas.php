<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperacoesContratadas extends Model
{
    protected $table = 'view_operacoes_contratadas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function empreendimento()
    {
       return $this->belongsTo(EmpreendimentoOperacao::class); //possui muitos
    }

    public function situacaoObra()
    {
       return $this->belongsTo(SituacaoObra::class); //possui muitos
    }

    public function situacaoContrato()
    {
       return $this->belongsTo(SituacaoContrato::class); //possui muitos
    }


    public function operacaoRetomada()
    {
       return $this->belongsTo(OperacaoRetomada::class); //possui muitos
    }

    public function municipio()
    {
       return $this->belongsTo(Municipio::class,'municipio_id','id'); //possui muitos
    }


    public static function posicaoArquivoOperacoes(){
        return Operacao::max('dte_movimento_arquivo');
    }

    public function demandaConsolidada()
    {
       return $this->belongsTo(DemandaConsolidada::class); //possui muitos
    }
}
