<?php

namespace MVC\Models\Evento;

use Illuminate\Http\Resources\Json\JsonResource;

class EventoResource extends JsonResource
{

    public function toArray($request)
    {
        $retorno = [
            'uuid'                     => $this->uuid,
            'data'                     => $this->data,
            'titulo'                   => $this->titulo,
            'fk_uuid_aluno'            => $this->fk_uuid_aluno,
            'fk_uuid_status'           => $this->fk_uuid_status,
            'fk_uuid_atividade_fisica' => $this->fk_uuid_atividade_fisica,
            'atividade_fisica'         => $this->atividade_fisica,
            'status'                   => $this->status,
            'cor'                      => $this->cor,
            'todos'                    => $this->todos
        ];

        return $retorno;
    }
}
