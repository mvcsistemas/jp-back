<?php

namespace MVC\Models\FeedbackSemanal;

use MVC\Base\MVCRequest;
use MVC\Rules\TravaSemanalRule;

class FeedbackSemanalRequest extends MVCRequest
{

    public function rules()
    {
        $rules = [
            'uuid'                          => '',
            'alimentacao'                   => 'required',
            'alimentacao_obs'               => '',
            'atividade_fisica'              => 'required',
            'fk_uuid_atividade_fisica'      => 'required',
            'atividade_fisica_obs'          => '',
            'ausencia_dor'                  => 'required',
            'fk_uuid_dor'                   => 'required',
            'ausencia_dor_obs'              => '',
            'autoestima'                    => 'required',
            'autoestima_obs'                => '',
            'disposicao'                    => 'required',
            'disposicao_obs'                => '',
            'doenca'                        => 'required',
            'fk_uuid_doenca'                => 'required',
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
            'sono_quantitativo'             => 'required',
            'sono_quantitativo_obs'         => '',
            'sono_qualitativo'              => 'required',
            'sono_qualitativo_obs'          => '',
            'tabagismo'                     => 'required',
            'tabagismo_obs'                 => '',
            'fk_uuid_aluno'                 => 'required'
        ];

        if (request()->method() == 'POST') {
            $rules['fk_uuid_aluno'] = ['required', new TravaSemanalRule()];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'alimentacao.required'               => 'O campo Alimentação user é obrigatório.',
            'atividade_fisica.required'          => 'O campo Atividade Física é obrigatório.',
            'fk_uuid_atividade_fisica.required'  => 'O campo Tipo de Atividade Física é obrigatório.',
            'ausencia_dor.required'              => 'O campo Ausência Dor é obrigatório.',
            'fk_uuid_dor.required'               => 'O campo Tipo de Dor é obrigatório.',
            'autoestima.required'                => 'O campo Autoestima é obrigatório.',
            'disposicao.required'                => 'O campo Disposição é obrigatório.',
            'doenca.required'                    => 'O campo Doença é obrigatório.',
            'fk_uuid_doenca.required'            => 'O campo Tipo de Doença é obrigatório.',
            'exercicio_fisico.required'          => 'O campo Exercício Físico é obrigatório.',
            'ingestao_agua.required'             => 'O campo Ingestão Água é obrigatório.',
            'ingestao_bebida_alcoolica.required' => 'O campo Ingestão de Bebidas Alcoólicas  é obrigatório.',
            'intensidade_treino.required'        => 'O campo Intensidade Treino é obrigatório.',
            'organizacao.required'               => 'O campo Organização é obrigatório.',
            'sono_quantitativo.required'         => 'O campo Sono Quantitativo é obrigatório.',
            'sono_qualitativo.required'          => 'O campo Sono Qualitativo é obrigatório.',
            'tabagismo.required'                 => 'O campo Tabagismo é obrigatório.',
            'fk_uuid_aluno.required'             => 'O campo Aluno é obrigatório.'
        ];
    }
}
