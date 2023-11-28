<?php

namespace MVC\Models\Atividade;

use MVC\Base\MVCRequest;

class AtividadeRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'      => ' ',
            'descricao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo Descrição é obrigatório.'
        ];
    }
}
