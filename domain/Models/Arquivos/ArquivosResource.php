<?php

namespace MVC\Models\Arquivos;

use Illuminate\Http\Resources\Json\JsonResource;

class ArquivosResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                => $this->uuid,
            'caminho_arquivo'     => $this->caminho_arquivo,
            'fk_uuid_funcionario' => $this->fk_uuid_funcionario,
        ];

        return $retorno;
    }
}
