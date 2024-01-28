<?php

namespace MVC\Models\FeedbackSemanal;

use MVC\Base\MVCRequest;

class FeedbackSemanalRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                          => '',
            'alimentacao'                   => 'required',
            'alimentacao_obs'               => '',
            'atividade_fisica'              => 'required',
            'atividade_fisica_obs'          => '',
            'ausencia_dor'                  => 'required',
            'ausencia_dor_obs'              => '',
            'autoestima'                    => 'required',
            'autoestima_obs'                => '',
            'disposicao'                    => 'required',
            'disposicao_obs'                => '',
            'doenca'                        => 'required',
            'doenca_obs'                    => '',
            'exercicio_fisico'              => 'required',
            'exercicio_fisico_obs'          => '',
            'ingestao_agua'                 => 'required',
            'ingestao_agua_obs'             => '',
            'ingestao_bebida_alcoolica'     => 'required',
            'ingestao_bebida_alcoolica_obs' => '',
            'intensidade_treino'            => 'required',
            'intensidade_treino_obs'        => '',
            'organizacao'                   => 'required',
            'organizacao_obs'               => '',
            'sono'                          => 'required',
            'sono_obs'                      => '',
            'tabagismo'                     => 'required',
            'tabagismo_obs'                 => '',
            'fk_uuid_aluno'                 => 'required'
        ];
    }

    public function messages()
    {
        return [
            'alimentacao.required'                   => 'O campo Alimentação user é obrigatório.',
            'atividade_fisica.required'              => 'O campo Atividade Física é obrigatório.',
            'ausencia_dor.required'                  => 'O campo Ausência Dor é obrigatório.',
            'autoestima.required'                    => 'O campo Autoestima é obrigatório.',
            'disposicao.required'                    => 'O campo Disposição é obrigatório.',
            'doenca.required'                        => 'O campo Doença é obrigatório.',
            'exercicio_fisico.required'              => 'O campo Exercício Físico é obrigatório.',
            'ingestao_agua.required'                 => 'O campo Ingestão Água é obrigatório.',
            'ingestao_bebida_alcoolica.required'     => 'O campo Ingestão de Bebidas Alcoólicas  é obrigatório.',
            'intensidade_treino.required'            => 'O campo Intensidade Treino é obrigatório.',
            'organizacao.required'                   => 'O campo Organização é obrigatório.',
            'sono.required'                          => 'O campo Sono é obrigatório.',
            'tabagismo.required'                     => 'O campo Tabagismo é obrigatório.',
            'fk_uuid_aluno.required'                 => 'O campo Aluno é obrigatório.'
        ];
    }
}
