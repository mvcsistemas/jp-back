<?php

namespace MVC\Models\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'            => $this->uuid,
            'nome'            => $this->nome,
            'email'           => $this->email,
            'password'        => $this->password,
            'sexo'            => $this->sexo,
            'cpf'             => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'telefone'        => $this->telefone,
            'ativo'           => $this->ativo,
            'remember_token'  => $this->remember_token,
        ];

        return $retorno;
    }
}
