<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoSelecao extends Model
{
    protected $table = 'view_resumo_selecao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function modalidade()
    {
       return $this->belongsTo(Modalidade::class); //possui muitos
    }
}
