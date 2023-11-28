<?php

namespace MVC\Models\Calendario;

use MVC\Base\MVCRequest;

class CalendarioRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'          => '',
            'data'          => 'required',
            'observacao'    => 'required',
            'fk_uuid_aluno' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'data.required'          => 'O campo Data é obrigatório.',
            'observacao.required'    => 'O campo Observação é obrigatório.',
            'fk_uuid_aluno.required' => 'O campo Aluno é obrigatório.'
        ];
    }
}
