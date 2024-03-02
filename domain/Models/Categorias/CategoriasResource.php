<?php

namespace MVC\Models\Categorias;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriasResource extends JsonResource
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
