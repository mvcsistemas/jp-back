<?php

namespace MVC\Models\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'  => $this->uuid,
            'nome'  => $this->nome,
            'email' => $this->email,
            'ativo' => $this->ativo
        ];

        return $retorno;
    }
}
