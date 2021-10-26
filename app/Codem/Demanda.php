<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;

class Demanda extends Model
{

    protected $table = 'tab_demanda';

    protected $fillable = [
        'txt_descricao_demanda', 
        'dte_solicitacao', 
        'qtd_dias_conclusao', 
        'dte_previsao_conclusao', 
        'dte_conclusao', 
        'modalidade_demanda_id', 
        'tipo_demanda_id', 
        'bln_processo_sei',
        'tipo_atendimento_id',
        'subtema_id', 
        'prioridade_id', 
        'situacao_id', 
        'uf_id', 
        'municipio_id', 
        'tipo_interessado_id', 
        'txt_nome_interessado', 
        'user_id',
        'created_at',
        'updated_at',
        'bln_visualizada'
    ];

    
}
