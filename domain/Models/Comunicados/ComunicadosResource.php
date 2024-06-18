<?php

namespace MVC\Models\Comunicados;

use Illuminate\Http\Resources\Json\JsonResource;

class ComunicadosResource extends JsonResource
{

    public function toArray($request)
    {
        $retorno = [
            'uuid'                 => $this->uuid,
            'descricao'            => $this->descricao,
            'fk_uuid_remetente'    => $this->fk_uuid_remetente,
            'nome_remetente'       => $this->nome_remetente,
            'fk_uuid_destinatario' => $this->fk_uuid_destinatario,
            'nome_destinatario'    => $this->nome_destinatario,
        ];

        return $retorno;
    }
}
