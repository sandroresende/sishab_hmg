<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Config\App;

use App\Mod_Sishab\Operacoes\ViewOperacoesContratadas;
use App\Mod_Sishab\Operacoes\ViewOperacoesContratadasAno;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirecionar');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $whereMcmv = [];
        $whereMcmv[]  = ['programa_id', 1];


        $operacoesContratadasMcmv = ViewOperacoesContratadas::dadosRelatorioExecutivo($whereMcmv);
        $resumoContratadasProgramaMcmv = ViewOperacoesContratadas::resumoContratadasPrograma($whereMcmv);
         $dadosRelatorioExecutivoPorAnoMcmv = ViewOperacoesContratadasAno::dadosRelatorioExecutivoPorAno($whereMcmv);
         $resumoRelatorioExecutivoPorAnoMcmv = ViewOperacoesContratadasAno::resumoRelatorioExecutivoPorAno($whereMcmv);
        //$resumoContratadasProgramaMcmv->sum('num_entregues');    

        $whereCvea = [];
        $whereCvea[]  = ['programa_id', 2];
        $operacoesContratadasCvea = ViewOperacoesContratadas::dadosRelatorioExecutivo($whereCvea);
        $resumoContratadasProgramaCvea = ViewOperacoesContratadas::resumoContratadasPrograma($whereCvea);
        $dadosRelatorioExecutivoPorAnoCvea = ViewOperacoesContratadasAno::dadosRelatorioExecutivoPorAno($whereCvea);
        $resumoRelatorioExecutivoPorAnoCvea = ViewOperacoesContratadasAno::resumoRelatorioExecutivoPorAno($whereCvea);

        //$resumoContratadasProgramaCvea->sum('num_entregues');   
        
        $where = [];
        $mostrarPeriodo = true;
        
        
         return view('home',compact('resumoContratadasProgramaCvea',
         'resumoContratadasProgramaMcmv','operacoesContratadasMcmv','operacoesContratadasCvea','mostrarPeriodo',
        'dadosRelatorioExecutivoPorAnoMcmv','dadosRelatorioExecutivoPorAnoCvea',
    'resumoRelatorioExecutivoPorAnoMcmv','resumoRelatorioExecutivoPorAnoCvea')); 
        
    }

    public function dadosPrograma()
    {
        return view('views_gerais.menus.dados_programa.dados_programa');
    }
}
