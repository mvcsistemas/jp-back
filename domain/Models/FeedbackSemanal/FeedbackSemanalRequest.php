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
            'alimentacao_obs'               => 'required',
            'atividade_fisica'              => 'required',
            'atividade_fisica_obs'          => 'required',
            'ausencia_dor'                  => 'required',
            'ausencia_dor_obs'              => 'required',
            'autoestima'                    => 'required',
            'autoestima_obs'                => 'required',
            'disposicao'                    => 'required',
            'disposicao_obs'                => 'required',
            'doenca'                        => 'required',
            'doenca_obs'                    => 'required',
            'exercicio_fisico'              => 'required',
            'exercicio_fisico_obs'          => 'required',
            'ingestao_agua'                 => 'required',
            'ingestao_agua_obs'             => 'required',
            'ingestao_bebida_alcoolica'     => 'required',
            'ingestao_bebida_alcoolica_obs' => 'required',
            'intensidade_treino'            => 'required',
            'intensidade_treino_obs'        => 'required',
            'organizacao'                   => 'required',
            'organizacao_obs'               => 'required',
            'sono'                          => 'required',
            'sono_obs'                      => 'required',
            'tabagismo'                     => 'required',
            'tabagismo_obs'                 => 'required',
            'fk_uuid_aluno'                 => 'required'
        ];
    }

    public function messages()
    {
        return [
            'alimentacao.required'                   => 'O campo Alimentação user é obrigatório.',
            'alimentacao_obs.required'               => 'O campo Alimentação Observação é obrigatório.',
            'atividade_fisica.required'              => 'O campo Atividade Física é obrigatório.',
            'atividade_fisica_obs.required'          => 'O campo Atividade Física Observação é obrigatório.',
            'ausencia_dor.required'                  => 'O campo Ausência Dor é obrigatório.',
            'ausencia_dor_obs.required'              => 'O campo Ausência Dor Observação é obrigatório.',
            'autoestima.required'                    => 'O campo Autoestima é obrigatório.',
            'autoestima_obs.required'                => 'O campo Autoestima Observação é obrigatório.',
            'disposicao.required'                    => 'O campo Disposição é obrigatório.',
            'disposicao_obs.required'                => 'O campo Disposição Observação é obrigatório.',
            'doenca.required'                        => 'O campo Doença é obrigatório.',
            'doenca_obs.required'                    => 'O campo Doença Observação é obrigatório.',
            'exercicio_fisico.required'              => 'O campo Exercício Físico é obrigatório.',
            'exercicio_fisico_obs.required'          => 'O campo Exercício Físico Observação é obrigatório.',
            'ingestao_agua.required'                 => 'O campo Ingestão Água é obrigatório.',
            'ingestao_agua_obs.required'             => 'O campo Ingestão Água Observação é obrigatório.',
            'ingestao_bebida_alcoolica.required'     => 'O campo Ingestão de Bebidas Alcoólicas  é obrigatório.',
            'ingestao_bebida_alcoolica_obs.required' => 'O campo Ingestão de Bebidas Alcoólicas Observação é obrigatório.',
            'intensidade_treino.required'            => 'O campo Intensidade Treino é obrigatório.',
            'organizacao.required'                   => 'O campo Organização é obrigatório.',
            'organizacao_obs.required'               => 'O campo Organização Observação é obrigatório.',
            'sono.required'                          => 'O campo Sono é obrigatório.',
            'sono_obs.required'                      => 'O campo Sono Observação é obrigatório.',
            'tabagismo.required'                     => 'O campo Tabagismo é obrigatório.',
            'tabagismo_obs.required'                 => 'O campo Tabagismo Observação é obrigatório.',
            'fk_uuid_aluno.required'                 => 'O campo Aluno é obrigatório.'
        ];
    }
}
