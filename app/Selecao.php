<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selecao extends Model
{
    protected $table = 'tab_selecao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function modalidade()
    {
       return $this->belongsTo(Modalidade::class); //possui muitos
    }

    
    public function propostas()
    {
       return $this->hasMany(Proposta::class); //possui muitos
    }
}
