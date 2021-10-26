<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motivos extends Model
{
    protected $table = 'view_motivos';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
