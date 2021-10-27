<?php

namespace App\Mod_pcva_parcerias;

use Illuminate\Database\Eloquent\Model;

class MunicipiosBeneficiadosParcerias extends Model
{
    protected $table = 'tab_municipios_beneficiados_parcerias';

    
    public function dadosParcerias()
    {
       return $this->belongsTo(DadosParcerias::class); //possui muitos
    }     
    
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
