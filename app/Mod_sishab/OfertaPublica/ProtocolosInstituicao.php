<?php

namespace App\Mod_sishab\OfertaPublica;

use Illuminate\Database\Eloquent\Model;

class ProtocolosInstituicao extends Model
{
        protected $connection	= 'pgsql_bv';
		
        protected $table = 'view_protocolos_instituicao';

        public $timestamps = false; // tabela não possui coluna de data de criação/atualização

        public function contrato()
	    {
	       return $this->belongsTo(Contrato::class,  'protocolo_id'); //possui muitos
	    }

	    public function parcelasRemessasDevolucao()
	    {
	       return $this->belongsTo(ParcelasRemessasDevolucaoContratos::class, 'protocolo_id'); //possui muitos
	    }


}
