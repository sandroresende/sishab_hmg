<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExecutivoPj extends Model
{
    protected $connection	= 'pgsql';
    
    protected $table = 'tab_executivo_pj';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function empreendimentos()
    {
       return $this->hasMany(Empreendimentos::class); //possui muitos
    }

    public function municipio()
    {
       return $this->belongsTo(Municipio::class); //possui muitos
    } 


}
