<?php

namespace MVC\Models\Atividade;

use Illuminate\Http\Resources\Json\JsonResource;

class AtividadeResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'      => $this->uuid,
            'descricao' => $this->descricao,
        ];

        return $retorno;
    }
}
