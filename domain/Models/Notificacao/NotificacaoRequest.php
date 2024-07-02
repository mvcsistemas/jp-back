<?php

namespace MVC\Models\Notificacao;

use MVC\Base\MVCRequest;

class NotificacaoRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'            => '',
            'token'           => 'required',
            'fk_uuid_usuario' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'token.required'           => 'O campo Token é obrigatório.',
            'fk_uuid_usuario.required' => 'O campo Usuário é obrigatório.'
        ];
    }
}
