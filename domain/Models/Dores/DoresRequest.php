<?php

namespace MVC\Models\Dores;

use MVC\Base\MVCRequest;

class DoresRequest extends MVCRequest
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
