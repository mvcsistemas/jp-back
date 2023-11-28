<?php

namespace MVC\Models\Funcionario;

use Illuminate\Http\Resources\Json\JsonResource;

class FuncionarioResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'      => $this->uuid,
            'user_uuid' => $this->user_uuid,
            'admin'     => $this->admin
        ];

        return $retorno;
    }
}
