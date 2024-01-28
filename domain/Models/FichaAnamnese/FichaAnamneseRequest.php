<?php

namespace MVC\Models\FichaAnamnese;

use MVC\Base\MVCRequest;

class FichaAnamneseRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                              => '',
            'alimentacao_diaria'                => 'required',
            'alimentacao_diaria_obs'            => '',
            'classificacao_alimentacao'         => 'required',
            'comprometimento_resultado'         => 'required',
            'compulsao_alimentar'               => 'required',
            'compulsao_alimentar_obs'           => '',
            'consome_bebida_alcoolicas'         => 'required',
            'consome_bebida_alcoolicas_obs'     => '',
            'data_realizacao_ultimo_backup'     => 'required',
            'data_realizacao_ultimo_backup_obs' => '',
            'dificuldade_rotina_saudavel'       => 'required',
            'disposicao_diaria'                 => 'required',
            'disposicao_diaria_obs'             => '',
            'drogas_ilicitas'                   => 'required',
            'drogas_ilicitas_obs'               => '',
            'esforco_fisico_desejado'           => 'required',
            'estetica_corporal'                 => 'required',
            'fisico_desejado'                   => 'required',
            'fisico_desejado_obs'               => '',
            'frequencia_atividade_fisica'       => 'required',
            'frequencia_exercicio_fisico'       => 'required',
            'historico_esportivo'               => 'required',
            'idade'                             => 'required',
            'ingestao_agua'                     => 'required',
            'jornada_trabalho'                  => 'required',
            'limitacoes'                        => 'required',
            'limitacoes_obs'                    => '',
            'meio_conhecimento_jp'              => 'required',
            'objetivos_iniciais'                => 'required',
            'patologias'                        => 'required',
            'peso'                              => 'required',
            'predominanca_trabalho'             => 'required',
            'rotina_trabalho'                   => 'required',
            'setor_atuacao'                     => 'required',
            'solucao_musculacao'                => 'required',
            'suplementacao'                     => 'required',
            'tempo_musculacao'                  => 'required',
            'fk_uuid_aluno'                     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'alimentacao_diaria.required'                => 'O campo Alimentação Diária user é obrigatório.',
            'classificacao_alimentacao.required'         => 'O campo Classificação Alimentação é obrigatório.',
            'comprometimento_resultado.required'         => 'O campo Comprometimento Resultado Observação é obrigatório.',
            'compulsao_alimentar.required'               => 'O campo Compulsão Alimentar é obrigatório.',
            'consome_bebida_alcoolicas.required'         => 'O campo Consome Bebidas Alcoólicas é obrigatório.',
            'data_realizacao_ultimo_backup.required'     => 'O campo Data Realização do Último Backup é obrigatório.',
            'dificuldade_rotina_saudavel.required'       => 'O campo Dificuldade Rotina Saudável é obrigatório.',
            'disposicao_diaria.required'                 => 'O campo Disposição Diária é obrigatório.',
            'drogas_ilicitas.required'                   => 'O campo Drogas Ilícitas Observação é obrigatório.',
            'esforco_fisico_desejado.required'           => 'O campo Esforço Físico Desejado é obrigatório.',
            'estetica_corporal.required'                 => 'O campo Estética Corporal  é obrigatório.',
            'fisico_desejado.required'                   => 'O campo Físico Desejado é obrigatório.',
            'frequencia_atividade_fisica.required'       => 'O campo Frequência Atividade Física é obrigatório.',
            'frequencia_exercicio_fisico.required'       => 'O campo Frequência Exercício Físico é obrigatório.',
            'historico_esportivo.required'               => 'O campo Histórico Esportivo é obrigatório.',
            'idade.required'                             => 'O campo Idade é obrigatório.',
            'ingestao_agua.required'                     => 'O campo Ingestão Água é obrigatório.',
            'jornada_trabalho.required'                  => 'O campo Jornada Trabalho é obrigatório.',
            'limitacoes.required'                        => 'O campo Limitações é obrigatório.',
            'meio_conhecimento_jp.required'              => 'O campo Meio Conhecimento JP é obrigatório.',
            'objetivos_iniciais.required'                => 'O campo Objetivos Iniciais é obrigatório.',
            'patologias.required'                        => 'O campo Patologias é obrigatório.',
            'peso.required'                              => 'O campo Peso é obrigatório.',
            'predominanca_trabalho.required'             => 'O campo Predominância Trabalho é obrigatório.',
            'rotina_trabalho.required'                   => 'O campo Rotina Trabalho é obrigatório.',
            'setor_atuacao.required'                     => 'O campo Setor de Atuação é obrigatório.',
            'solucao_musculacao.required'                => 'O campo Solução Musculação é obrigatório.',
            'suplementacao.required'                     => 'O campo Suplementação é obrigatório.',
            'tempo_musculacao.required'                  => 'O campo Tempo Musculação é obrigatório.',
            'fk_uuid_aluno.required'                     => 'O campo Aluno é obrigatório.',
        ];
    }
}
