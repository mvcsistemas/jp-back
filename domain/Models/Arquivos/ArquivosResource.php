<?php

namespace MVC\Models\Arquivos;

use Illuminate\Http\Resources\Json\JsonResource;

class ArquivosResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                => $this->uuid,
            'nome_arquivo'        => $this->nome_arquivo,
            'caminho_arquivo'     => $this->caminho_arquivo,
            'fk_uuid_funcionario' => $this->fk_uuid_funcionario,
            'fk_uuid_aluno'       => $this->fk_uuid_aluno,
        ];

        return $retorno;
    }
}
