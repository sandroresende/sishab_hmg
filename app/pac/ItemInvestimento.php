<?php

namespace App\pac;

use Illuminate\Database\Eloquent\Model;

class ItemInvestimento extends Model
{
    protected $table = 'opc_item_investimento';
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
