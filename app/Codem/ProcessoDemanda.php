<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ProcessoDemanda extends Model
{

    protected $table = 'tab_processo_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    protected $fillable = [
        'txt_num_processo', 
        'demanda_id',
        'bln_processo_sei',
        'dte_autuacao',
        'dte_atribuicao_tecnico',
        'dte_atribuicao_assinatura',
        'responsavel_assinatura_id',
        'dte_assinatura',
        'status_processo_id'
    ];

    public function responsavelAssinatura()
    {
       return $this->belongsTo(ResponsavelAssinatura::class); //possui muitos
    }

    public function statusProcesso()
    {
       return $this->belongsTo(StatusProcesso::class); //possui muitos
    }
    
    
}
