<?php

namespace App\Http\Requests\codem;

use Illuminate\Foundation\Http\FormRequest;

class SalvarDemanda extends FormRequest
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
            'dte_solicitacao' => 'required|date',
            'situacao_demanda' => 'required',            
            'tipo_demanda' => 'required',
            'tipo_atendimento' => 'required',
            'tema' => 'required',
            'subTema' => 'required',
            'prioridade' => 'required',
            'qtd_dias_conclusao' => 'required|integer|max:100',
            'dte_previsao_conclusao' => 'required|date',
            'txt_nome_interessado' => 'required|min:3|max:255',
            'txt_descricao_demanda' => 'required|min:10|max:1000',
            //
        ];
    }

    public function messages()
    {
        return [
            'dte_solicitacao.required' => 'O campo Data de Solicitação é obrigatório.',
            'dte_solicitacao.dare' => 'Data Inválida',
            'situacao_demanda.required' => 'O campo Situação é obrigatório.',
            'tipo_demanda.required' => 'O campo Tipo de Demanda é obrigatório.',
            'tipo_atendimento.required' => 'O campo Tipo de Atendimento é obrigatório.',
            'tema.required' => 'O campo Tema é obrigatório.',
            'subTema.required' => 'O campo Subtema é obrigatório.',
            'prioridade.required' => 'O campo Prioridade é obrigatório.',
            'qtd_dias_conclusao.required' => 'O campo Qtde de dias para conclusão é obrigatório.',
            'qtd_dias_conclusao.max' => 'O campo Qtde de dias para conclusão não deve ser maior que 100.',
            'dte_previsao_conclusao.required' => 'O campo Data de Previsão da Conclusão é obrigatório.',
            'dte_previsao_conclusao.dare' => 'Data Inválida',
            'txt_nome_interessado.required' => 'O campo Nome do Interessado é obrigatório.',
            'txt_nome_interessado.min' => 'O campo Nome do Interessado deve conter no mínimo 3 caracteres.',
            'txt_nome_interessado.max' => 'O campo Nome do Interessado não deve ser maior que 255.',
            'txt_descricao_demanda.required' => 'O campo Descrição da Demanda é obrigatório.',
            'txt_descricao_demanda.min' => 'O campo Descrição da Demanda  deve conter no mínimo 10 caracteres.',
            'txt_descricao_demanda.max' => 'O campo Descrição da Demanda não deve ser maior que 255.',



            'num_percentual_atual.max' => 'O campo % Atualizado não deve ser maior que 100.',
            'txt_motivo_inviabilidade.required' => 'O campo Motivo da inviabilidade é obrigatório',            
            'txt_motivo_inviabilidade.min' => 'O campo Motivo da inviabilidade deve conter no mínimo 10 caracteres',            
            
        ];
    }
}
