<?php

namespace MVC\Models\DoresFeedback;

use Illuminate\Http\Resources\Json\JsonResource;

class DoresFeedbackResource extends JsonResource
{

    public function toArray($request)
    {
        $retorno = [
            'fk_uuid_dor'      => $this->uuid,
            'ausencia_dor'     => $this->ausencia_dor,
            'fk_id_dor'        => $this->fk_id_dor,
            'ausencia_dor_obs' => $this->ausencia_dor_obs,
            'descricao'        => $this->descricao,
        ];

        return $retorno;
    }
}
