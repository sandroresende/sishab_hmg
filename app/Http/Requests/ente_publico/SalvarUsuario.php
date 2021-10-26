<?php

namespace App\Http\Requests\ente_publico;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SalvarUsuario extends FormRequest
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
            'txt_cpf_usuario' => 'required|cpf|unique:users',
            'txt_nome' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',                                
            //
        ];
    }

    public function messages()
    {
        return [
            'txt_cpf_usuario.required' => 'O campo cpf é obrigatório.',
            'txt_cpf_usuario.cpf' =>'O cpf está inválido.',
            'txt_cpf_usuario.unique' =>'O cpf já está em uso.',
            'txt_nome.required' => 'O campo nome é obrigatório',            
            'email.required' => 'O campo email é obrigatório',            
            
        ];
    }
}
