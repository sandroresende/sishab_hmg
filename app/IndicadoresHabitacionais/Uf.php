<?php

namespace App\IndicadoresHabitacionais;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    protected $table = 'tab_uf';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function municipios()
    {
       return $this->hasMany(Municipio::class); //possui muitos
    }

    public function regiao()
    {
       return $this->belongsTo(Regiao::class); //possui muitos
    } 

    public function entregas()
    {
       return $this->hasMany(Entregas::class); //possui muitos
    }

}
