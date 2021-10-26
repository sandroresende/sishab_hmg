<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retomada extends Model
{
    protected $table = 'tab_retomada';

    public function operacaoRetomada()
    {
       return $this->belongsTo(OperacaoRetomada::class); //possui muitos
    }

    public function resumoOperacaoRetomada()
    {
       return $this->belongsTo(ResumoOperacoesRetomadas::class,'operacao_retomada_id','operacao_retomada_id'); //possui muitos
    }

    public function oficios()
    {
       return $this->belongsToMany(Oficio::class,'tab_oficio_retomada'); //possui muitos
    }

    public function observacoes()
    {
       return $this->hasMany(Observacao::class); //possui muitos
    }
}
