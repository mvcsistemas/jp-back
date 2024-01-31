<?php

namespace MVC\Models\Comunicados;

use MVC\Base\MVCRequest;

class ComunicadosRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'          => '',
            'descricao'     => 'required',
            'fk_uuid_aluno' => '',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo Descrição é obrigatório.'
        ];
    }
}
