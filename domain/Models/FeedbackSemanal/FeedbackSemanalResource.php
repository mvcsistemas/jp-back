<?php

namespace MVC\Models\FeedbackSemanal;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackSemanalResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                          => $this->uuid,
            'alimentacao'                   => $this->alimentacao,
            'alimentacao_obs'               => $this->alimentacao_obs,
            'atividade_fisica'              => $this->atividade_fisica,
            'atividade_fisica_obs'          => $this->atividade_fisica_obs,
            'ausencia_dor'                  => $this->ausencia_dor,
            'ausencia_dor_obs'              => $this->ausencia_dor_obs,
            'autoestima'                    => $this->autoestima,
            'autoestima_obs'                => $this->autoestima_obs,
            'disposicao'                    => $this->disposicao,
            'disposicao_obs'                => $this->disposicao_obs,
            'doenca'                        => $this->doenca,
            'doenca_obs'                    => $this->doenca_obs,
            'exercicio_fisico'              => $this->exercicio_fisico,
            'exercicio_fisico_obs'          => $this->exercicio_fisico_obs,
            'ingestao_agua'                 => $this->ingestao_agua,
            'ingestao_agua_obs'             => $this->ingestao_agua_obs,
            'ingestao_bebida_alcoolica'     => $this->ingestao_bebida_alcoolica,
            'ingestao_bebida_alcoolica_obs' => $this->ingestao_bebida_alcoolica_obs,
            'intensidade_treino'            => $this->intensidade_treino,
            'intensidade_treino_obs'        => $this->intensidade_treino_obs,
            'organizacao'                   => $this->organizacao,
            'organizacao_obs'               => $this->organizacao_obs,
            'sono'                          => $this->sono,
            'sono_obs'                      => $this->sono_obs,
            'tabagismo'                     => $this->tabagismo,
            'tabagismo_obs'                 => $this->tabagismo_obs,
            'fk_id_aluno'                   => $this->fk_id_aluno,
        ];

        return $retorno;
    }
}
