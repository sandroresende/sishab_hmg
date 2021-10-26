<?php

namespace App\Http\Requests\codem;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class SalvarArquivo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
 
        return [

            'txt_nome_arquivo' => 'required|validar_extensao_arq_codem',
            'txt_caminho_arquivo' => 'required'

            //
        ];
    }

    public function messages()
    {   
        session()->put('ativarAba', 'arquivos');
        
        
        return [
            'txt_nome_arquivo.required' => 'O campo Nome do Arquivo é obrigatório.',
            'txt_nome_arquivo.validar_extensao_arq_codem' => 'Extensão inválida.',
            'txt_caminho_arquivo.required' => 'O campo Caminho do Arquivo é obrigatório.'
        ];
    }
}
