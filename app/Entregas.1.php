<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entregas extends Model
{
   protected $table = 'tab_entregas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    public function uf()
    {
       return $this->belongsTo(Uf::class,'uf_id'); //possui muitos
    } 

    public function modalidade()
    {
       return $this->belongsTo(Modalidade::class,'modalidade_id'); //possui muitos
    } 

    public function faixaRenda()
    {
       return $this->belongsTo(FaixaRenda::class,'faixa_renda_id'); //possui muitos
    } 

    
}
