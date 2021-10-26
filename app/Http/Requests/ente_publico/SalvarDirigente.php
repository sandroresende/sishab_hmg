<?php

namespace App\Http\Requests\ente_publico;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SalvarDirigente extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $usuario = Auth::User();
        //se ele e master
        if($usuario->tipo_usuario_id!=8){
            return false;            
        }
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
            'txt_nome_dirigente' => 'required|min:3|max:100',
            'txt_cargo_dirigente' => 'required|min:3|max:100',
            'txt_cpf_dirigente' => 'required|cpf',
            'txt_email_dirigente' => 'required|email|max:50',            
                     
            //
        ];
    }

    public function messages()
    {
        return [
            'txt_nome_dirigente.required' => 'O campo nome do dirigente é obrigatório.',
            'txt_nome_dirigente.min' => 'O campo nome do dirigente deve ter no mínimo 3 caracteres.',
            'txt_nome_dirigente.max' => 'O campo nome do dirigente deve ter no máximo 100 caracteres.',

            'txt_cargo_dirigente.required' => 'O campo cargo do dirigente é obrigatório.',
            'txt_cargo_dirigente.min' => 'O campo cargo do dirigente deve ter no mínimo 3 caracteres.',
            'txt_cargo_dirigente.max' => 'O campo cargo do dirigente deve ter no máximo 100 caracteres.',
            
            'txt_cpf_dirigente.required' => 'O campo CPF é obrigatório.',
            'txt_cpf_dirigente.cpf' =>'O CPF está inválido.',

            
            'txt_email_dirigente.required' => 'O campo email do dirigente é obrigatório.',
            'txt_email_dirigente.email' => 'O campo email do dirigente  é invalido.',
            'txt_email_dirigente.max' => 'O campo  do dirigente deve ter no máximo 50 caracteres.',   
                    
        ];
    }
}
