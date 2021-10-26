<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modalidade extends Model
{
    protected $connection	= 'pgsql';

    protected $table = 'opc_modalidade';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function selecoes()
    {
       return $this->hasMany(Selecao::class); //possui muitos
    }

    public function contratacaoMcmv()
    {
       return $this->hasMany(ContratacaoMcmv::class); //possui muitos
    }

    public function resumoSelecoes()
    {
       return $this->hasMany(ResumoSelecao::class); //possui muitos
    }

    public function entregas()
    {
       return $this->hasMany(Entregas::class); //possui muitos
    }

    public function operacoes()
    {
       return $this->hasMany(Operacoes::class); //possui muitos
    }
}
