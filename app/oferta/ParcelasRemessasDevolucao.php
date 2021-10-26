<?php

namespace App\oferta;

use Illuminate\Database\Eloquent\Model;

class ParcelasRemessasDevolucao extends Model
{
    protected $connection	= 'pgsql_bv';
		
        protected $table = 'view_parcelas_remessa_devolucao';

        public $timestamps = false; // tabela não possui coluna de data de criação/atualização

        public function protocolosInstituicao()
	    {
	       return $this->belongsTo(ProtocolosInstituicao::class,'protocolo_id','protocolo_id'); //possui muitos
	    }

	    public function beneficiario()
	    {
	       return $this->belongsTo(Beneficiario::class,'beneficiario_id'); //possui muitos
		}
		

		
}
