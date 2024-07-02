<?php

namespace MVC\Models\Notificacao;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificacaoResource extends JsonResource
{
    public function toArray($request)
    {
        $retorno = [
            'uuid'            => $this->uuid,
            'token'           => $this->token,
            'fk_uuid_usuario' => $this->fk_uuid_usuario
        ];

        return $retorno;
    }
}
