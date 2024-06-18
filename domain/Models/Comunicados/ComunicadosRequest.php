<?php

namespace MVC\Models\Comunicados;

use MVC\Base\MVCRequest;

class ComunicadosRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                 => '',
            'descricao'            => 'required',
            'fk_uuid_remetente'    => 'required',
            'fk_uuid_destinatario' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required'            => 'O campo Descrição é obrigatório.',
            'fk_uuid_remetente.required'    => 'O campo Remetente é obrigatório.',
            'fk_uuid_destinatario.required' => 'O campo Destinatário é obrigatório.',
        ];
    }
}
