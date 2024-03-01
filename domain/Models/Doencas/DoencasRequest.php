<?php

namespace MVC\Models\Doencas;

use MVC\Base\MVCRequest;

class DoencasRequest extends MVCRequest
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
