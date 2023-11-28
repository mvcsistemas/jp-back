<?php

namespace MVC\Models\Funcionario;

use MVC\Base\MVCRequest;

class FuncionarioRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'      => '',
            'user_uuid' => 'required',
            'admin'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_uuid.required' => 'O campo Uuid user é obrigatório.',
            'admin.required'     => 'O campo Admin é obrigatório.'
        ];
    }
}
