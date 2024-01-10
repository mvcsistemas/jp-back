<?php

namespace MVC\Models\Aluno;

use Illuminate\Http\Resources\Json\JsonResource;

class AlunoResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'               => $this->user_uuid,
            'nome'               => $this->nome,
            'email'              => $this->email,
            'sexo'               => $this->sexo,
            'cpf'                => $this->cpf,
            'data_nascimento'    => $this->data_nascimento,
            'telefone'           => $this->telefone,
            'ativo'              => $this->ativo,
            'endereco'           => $this->endereco,
            'altura'             => $this->altura,
            'profissao'          => $this->profissao,
            'local_trabalho'     => $this->local_trabalho,
            'plano_saude'        => $this->plano_saude,
            'contato_emergencia' => $this->contato_emergencia
        ];

        return $retorno;
    }
}
