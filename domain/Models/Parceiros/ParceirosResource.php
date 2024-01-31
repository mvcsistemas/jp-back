<?php

namespace MVC\Models\Parceiros;

use Illuminate\Http\Resources\Json\JsonResource;

class ParceirosResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'         => $this->uuid,
            'nome_empresa' => $this->nome_empresa,
            'descricao'    => $this->descricao,
            'link'         => $this->link,
            'telefone'     => $this->telefone
        ];

        return $retorno;
    }
}
