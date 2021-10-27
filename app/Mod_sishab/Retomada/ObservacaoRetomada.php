<?php

namespace App\Mod_sishab\Retomada;

use Illuminate\Database\Eloquent\Model;

class ObservacaoRetomada extends Model
{
    protected $table = 'tab_observacao_retomada';

    protected $guarded = [];

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function user()
    {
       return $this->belongsTo(User::class); //possui muitos
    }
}
