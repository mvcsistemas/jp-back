<?php

namespace MVC\Models\Calendario;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarioResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'          => $this->uuid,
            'data'          => $this->data,
            'observacao'    => $this->observacao,
            'fk_uuid_aluno' => $this->fk_uuid_aluno,
        ];

        return $retorno;
    }
}
