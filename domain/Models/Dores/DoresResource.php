<?php

namespace MVC\Models\Dores;

use Illuminate\Http\Resources\Json\JsonResource;

class DoresResource extends JsonResource
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
