<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumoOficio extends Model
{
    protected $table = 'view_oficios';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
}
