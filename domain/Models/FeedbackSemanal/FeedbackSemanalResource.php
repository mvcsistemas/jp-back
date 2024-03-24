<?php

namespace MVC\Models\FeedbackSemanal;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackSemanalResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'uuid'                          => $this->uuid,
            'alimentacao'                   => $this->alimentacao,
            'alimentacao_obs'               => $this->alimentacao_obs,
            'ausencia_dor'                  => $this->ausencia_dor,
            'descricao_dor'                 => $this->descricao_dor,
            'fk_uuid_dor'                   => $this->fk_uuid_dor,
            'ausencia_dor_obs'              => $this->ausencia_dor_obs,
            'autoestima'                    => $this->autoestima,
            'autoestima_obs'                => $this->autoestima_obs,
            'disposicao'                    => $this->disposicao,
            'disposicao_obs'                => $this->disposicao_obs,
            'doenca'                        => $this->doenca,
            'descricao_doenca'              => $this->descricao_doenca,
            'fk_uuid_doenca'                => $this->fk_uuid_doenca,
            'doenca_obs'                    => $this->doenca_obs,
            'frequencia_motivacao'          => $this->frequencia_motivacao,
            'frequencia_motivacao_obs'      => $this->frequencia_motivacao_obs,
            'ingestao_agua'                 => $this->ingestao_agua,
            'ingestao_agua_obs'             => $this->ingestao_agua_obs,
            'ingestao_bebida_alcoolica'     => $this->ingestao_bebida_alcoolica,
            'ingestao_bebida_alcoolica_obs' => $this->ingestao_bebida_alcoolica_obs,
            'intensidade_treino'            => $this->intensidade_treino,
            'intensidade_treino_obs'        => $this->intensidade_treino_obs,
            'organizacao'                   => $this->organizacao,
            'organizacao_obs'               => $this->organizacao_obs,
            'sono_quantitativo'             => $this->sono_quantitativo,
            'sono_quantitativo_obs'         => $this->sono_quantitativo_obs,
            'sono_qualitativo'              => $this->sono_qualitativo,
            'sono_qualitativo_obs'          => $this->sono_qualitativo_obs,
            'tabagismo'                     => $this->tabagismo,
            'tabagismo_obs'                 => $this->tabagismo_obs,
            'fk_uuid_aluno'                 => $this->fk_uuid_aluno,
        ];
    }
}
