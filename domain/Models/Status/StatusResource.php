<?php

namespace MVC\Models\Status;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'      => $this->uuid,
            'descricao' => $this->descricao,
            'cor'       => $this->cor
        ];

        return $retorno;
    }
}
