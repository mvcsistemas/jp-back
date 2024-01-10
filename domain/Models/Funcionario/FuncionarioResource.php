<?php

namespace MVC\Models\Funcionario;

use Illuminate\Http\Resources\Json\JsonResource;

class FuncionarioResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'            => $this->user_uuid,
            'admin'           => $this->admin,
            'nome'            => $this->nome,
            'email'           => $this->email,
            'sexo'            => $this->sexo,
            'cpf'             => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'telefone'        => $this->telefone,
            'ativo'           => $this->ativo,
        ];

        return $retorno;
    }
}
