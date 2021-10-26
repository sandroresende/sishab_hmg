<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BeneficiariosOperacao;
use App\Municipio;
use App\Uf;

class BeneficiarioController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('moduloSishab');

    }

    public function filtro_beneficiarios (){
       
        return view('beneficiarios.consultaBeneficiarios');
    }

    public function consulta_beneficiarios (Request $request){

        //return $request->all();
        
        $where = [];
        $orWhere = [];
        $municipio = [];
        $estado = [];
        $cpfDigitado = $request->cpf;
        $nomeDigitado = $request->nome_digitado;

        if($cpfDigitado){
             $where[] = ['txt_cpf_beneficiario', $request->cpf]; 

             $dadosBeneficiarios = BeneficiariosOperacao::select('txt_sigla_uf','ds_municipio','txt_nome_beneficiario','txt_cpf_beneficiario')
                                                    ->where($where)                                                   
                                                    ->orderBy('txt_nome_beneficiario')
                                                    ->get();
        }elseif($nomeDigitado){
            $nomeDigitado = '%' . strtoupper($request->nome_digitado) . '%';
            $where[] = ['txt_nome_beneficiario','LIKE', $nomeDigitado ]; 

            $dadosBeneficiarios = BeneficiariosOperacao::select('txt_sigla_uf','ds_municipio','txt_nome_beneficiario','txt_cpf_beneficiario')
                                                   ->where($where)                                                   
                                                   ->orderBy('txt_nome_beneficiario')
                                                   ->get();                                                    
            //return $nomeDigitado;
        }else{           

            $municipio = [];
            if($request->municipio){
                $where[] = ['municipio_id', $request->municipio]; 
                $municipio = Municipio::where('id',$request->municipio)->firstOrFail();
                $estado = Uf::where('id',$municipio->uf_id)->firstOrFail();
            }

            $estado = [];
            if($request->estado){
                $where[] = ['uf_id', $request->estado]; 
                $estado = Uf::where('id',$request->estado)->firstOrFail();
            }

             $dadosBeneficiarios = BeneficiariosOperacao::select('txt_uf','ds_municipio','txt_nome_beneficiario','txt_cpf_beneficiario')
                                                    ->where($where)                                                   
                                                    ->orderBy('txt_nome_beneficiario')
                                                    ->get();
        }

        
        
        $cabecalhoTab = ['UF','Municíoio', 'Nome','CPF'];
        
        $count = 0;

        foreach($dadosBeneficiarios as $dados){
            $dadosBeneficiarios[$count]['txt_cpf_beneficiario'] = substr($dados->txt_cpf_beneficiario,0,3) . ".###.###-##";
            
            $count += 1;
        }                                             

        //return $dadosBeneficiarios;
            if(count($dadosBeneficiarios)>0){
                return view('beneficiarios.beneficiarios',compact('cabecalhoTab','dadosBeneficiarios','municipio','estado','cpfDigitado'));
            } else {
                flash()->erro("Erro", "Não existe beneficiário para este CPF.");            
            }
            return back();  
        
    }
}
