<?php

namespace MVC\Models\Evento;

use Illuminate\Http\Resources\Json\JsonResource;

class EventoResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'           => $this->uuid,
            'data'           => $this->data,
            'titulo'         => $this->titulo,
            'fk_uuid_aluno'  => $this->fk_uuid_aluno,
            'fk_uuid_status' => $this->fk_uuid_status,
            'status'         => $this->status,
            'cor'            => $this->cor,
            'todos'          => $this->todos
        ];

        return $retorno;
    }
}
