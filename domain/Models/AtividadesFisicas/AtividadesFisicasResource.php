<?php

namespace MVC\Models\AtividadesFisicas;

use Illuminate\Http\Resources\Json\JsonResource;

class AtividadesFisicasResource extends JsonResource
{

    public function toArray($request)
    {
        $retorno = [
            'uuid'      => $this->uuid,
            'descricao' => $this->descricao,
        ];

        return $retorno;
    }
}
