<?php

namespace MVC\Models\Comunicados;

use Illuminate\Http\Resources\Json\JsonResource;

class ComunicadosResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'          => $this->uuid,
            'descricao'     => $this->descricao,
            'fk_uuid_aluno' => $this->fk_uuid_aluno
        ];

        return $retorno;
    }
}
