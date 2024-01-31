<?php

namespace MVC\Models\Status;

use MVC\Base\MVCRequest;

class StatusRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'      => '',
            'descricao' => 'required',
            'cor'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo Descrição é obrigatório.',
            'cor.required'       => 'O campo Cor é obrigatório.',
        ];
    }
}
