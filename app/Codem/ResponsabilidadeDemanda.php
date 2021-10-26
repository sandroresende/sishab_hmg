<?php

namespace App\Codem;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ResponsabilidadeDemanda extends Model
{

    protected $table = 'tab_responsabilidade_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    protected $fillable = [
        'demanda_id', 
        'user_id',
        'dte_atribuicao_demanda'
    ];



    
}
