<?php

namespace App\pac;

use Illuminate\Database\Eloquent\Model;

class MunicipiosBeneficiados extends Model
{
    protected $table = 'tab_municipios_beneficiados';
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
