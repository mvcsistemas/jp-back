<?php

namespace MVC\Models\Educacao;

use Illuminate\Http\Resources\Json\JsonResource;

class EducacaoResource extends JsonResource
{

    public function toArray($request)
    {
        $retorno = [
            'uuid'              => $this->uuid,
            'titulo'            => $this->titulo,
            'descricao'         => $this->descricao,
            'link'              => $this->link,
            'fk_uuid_categoria' => $this->fk_uuid_categoria,
            'categoria'         => $this->categoria,
        ];

        return $retorno;
    }
}
