<?php

namespace MVC\Models\CalendarioAtividade;

use MVC\Base\MVCRequest;

class CalendarioAtividadeRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'               => '',
            'fk_uuid_calendario' => 'required',
            'fk_uuid_atividade'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fk_uuid_calendario.required' => 'O campo Calendário é obrigatório.',
            'fk_uuid_atividade.required'  => 'O campo Atividade é obrigatório.',
        ];
    }
}
