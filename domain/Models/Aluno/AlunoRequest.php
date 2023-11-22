<?php

namespace MVC\Models\Aluno;

use MVC\Base\MVCRequest;

class AlunoRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'               => 'required',
            'endereco'           => 'required',
            'altura'             => 'required',
            'profissao'          => 'required',
            'local_trabalho'     => 'required',
            'plano_saude'        => 'required',
            'contato_emergencia' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'uuid.required'               => 'O campo Uuid Empresa é obrigatório.',
            'endereco.required'           => 'O campo Endereço é obrigatório.',
            'altura.required'             => 'O campo Altura é obrigatório.',
            'profissao.required'          => 'O campo Profissão é obrigatório.',
            'local_trabalho.required'     => 'O campo Local de Trabalho é obrigatório.',
            'plano_saude.required'        => 'O campo Plano de Saúde é obrigatório.',
            'contato_emergencia.required' => 'O campo Contato de Emergência é obrigatório.'
        ];
    }
}
