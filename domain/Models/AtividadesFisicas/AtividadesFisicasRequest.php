<?php

namespace MVC\Models\AtividadesFisicas;

use MVC\Base\MVCRequest;

class AtividadesFisicasRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'      => '',
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
