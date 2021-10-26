<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Uf;
use App\Regiao;
use App\Municipio;
use App\ResumoPropostas;


class ApiExecutivoController extends Controller
{
    
    public function buscarRegioes(){        
        return Regiao::orderBy('txt_regiao')->get();
    }

    public function buscarRides(){        
        return BrasilComRm::select('txt_rm_ride')
                        ->orderBy('txt_rm_ride', 'asc')
                        ->where('txt_rm_ride','<>','' )
                        ->groupBy('txt_rm_ride')
                        ->get();
    }
    
}
