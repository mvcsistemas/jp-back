<?php

namespace MVC\Models\CalendarioAtividade;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarioAtividadeResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                => $this->uuid,
            'fk_uuid_calendario'  => $this->fk_uuid_calendario,
            'descricao_atividade' => $this->descricao_atividade,
            'fk_uuid_atividade'   => $this->fk_uuid_atividade,
        ];

        return $retorno;
    }
}
