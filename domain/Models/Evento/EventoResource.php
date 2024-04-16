<?php

namespace MVC\Models\Evento;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventoResource extends JsonResource
{

    public function toArray($request)
    {
        $hoje          = Carbon::today();
        $dataEvento    = Carbon::parse($this->data);
        $diferencaDias = $hoje->diffInDays($dataEvento, false);

        if ($diferencaDias >= 0 && $diferencaDias <= 6) {
            if ($diferencaDias == 0) {
                $dataFormatada = 'Hoje';
            } else {
                $dataFormatada = ucfirst($dataEvento->locale('pt_BR')->isoFormat('dddd'));
            }
        } else {
            $dataFormatada = $dataEvento->format('d/m/Y');
        }

        $retorno = [
            'uuid'                     => $this->uuid,
            'data'                     => $dataFormatada,
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
