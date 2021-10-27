<?php

namespace App\Mod_pcva_parcerias;

use App\User;

use App\Tab_dominios\SituacaoAdesao;
use App\Tab_dominios\TipoContrapartida;

use Illuminate\Database\Eloquent\Model;

class DadosParcerias extends Model
{
    protected $table = 'tab_dados_parcerias';

         
    public function municipiosBeneficiados()
    {
       return $this->hasMany(MunicipiosBeneficiados::class); //possui muitos
    }

    public function situacaoAdesao()
    {
       return $this->belongsTo(SituacaoAdesao::class); //possui muitos
    } 

    public function tipoContrapartida()
    {
       return $this->belongsTo(TipoContrapartida::class); //possui muitos
    } 

    public function user()
    {
       return $this->belongsTo(User::class); //possui muitos
    }
   // public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
