<?php

namespace MVC\Models\FichaAnamnese;

use Illuminate\Http\Resources\Json\JsonResource;

class FichaAnamneseResource extends JsonResource {

    public function toArray($request)
    {
        $retorno = [
            'uuid'                              => $this->uuid,
            'alimentacao_diaria'                => $this->alimentacao_diaria,
            'alimentacao_diaria_obs'            => $this->alimentacao_diaria_obs,
            'classificacao_alimentacao'         => $this->classificacao_alimentacao,
            'comprometimento_resultado'         => $this->comprometimento_resultado,
            'compulsao_alimentar'               => $this->compulsao_alimentar,
            'compulsao_alimentar_obs'           => $this->compulsao_alimentar_obs,
            'consome_bebida_alcoolicas'         => $this->consome_bebida_alcoolicas,
            'consome_bebida_alcoolicas_obs'     => $this->consome_bebida_alcoolicas_obs,
            'data_realizacao_ultimo_backup'     => $this->data_realizacao_ultimo_backup,
            'data_realizacao_ultimo_backup_obs' => $this->data_realizacao_ultimo_backup_obs,
            'dificuldade_rotina_saudavel'       => $this->dificuldade_rotina_saudavel,
            'disposicao_diaria'                 => $this->disposicao_diaria,
            'disposicao_diaria_obs'             => $this->disposicao_diaria_obs,
            'drogas_ilicitas'                   => $this->drogas_ilicitas,
            'drogas_ilicitas_obs'               => $this->drogas_ilicitas_obs,
            'esforco_fisico_desejado'           => $this->esforco_fisico_desejado,
            'estetica_corporal'                 => $this->estetica_corporal,
            'fisico_desejado'                   => $this->fisico_desejado,
            'fisico_desejado_obs'               => $this->fisico_desejado_obs,
            'frequencia_atividade_fisica'       => $this->frequencia_atividade_fisica,
            'frequencia_exercicio_fisico'       => $this->frequencia_exercicio_fisico,
            'historico_esportivo'               => $this->historico_esportivo,
            'idade'                             => $this->idade,
            'ingestao_agua'                     => $this->ingestao_agua,
            'jornada_trabalho'                  => $this->jornada_trabalho,
            'limitacoes'                        => $this->limitacoes,
            'limitacoes_obs'                    => $this->limitacoes_obs,
            'meio_conhecimento_jp'              => $this->meio_conhecimento_jp,
            'objetivos_iniciais'                => $this->objetivos_iniciais,
            'patologias'                        => $this->patologias,
            'peso'                              => $this->peso,
            'predominanca_trabalho'             => $this->predominanca_trabalho,
            'rotina_trabalho'                   => $this->rotina_trabalho,
            'setor_atuacao'                     => $this->setor_atuacao,
            'solucao_musculacao'                => $this->solucao_musculacao,
            'suplementacao'                     => $this->suplementacao,
            'tempo_musculacao'                  => $this->tempo_musculacao,
            'fk_uuid_user'                      => $this->fk_uuid_user,
        ];

        return $retorno;
    }
}
