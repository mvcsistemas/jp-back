<?php

namespace MVC\Models\Evento;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Evento extends MVCModel
{

    use HasFactory, HasUuid;

    protected $table      = 'evento';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('evento.*', 'aluno.uuid as fk_uuid_aluno', 'status.uuid as fk_uuid_status', 'status.descricao as status', 'status.cor', 'atividades_fisicas.uuid as fk_uuid_atividade_fisica', 'atividades_fisicas.descricao as atividade_fisica')
            ->leftJoin('aluno', 'aluno.id', 'evento.fk_id_aluno')
            ->leftJoin('status', 'status.id', 'evento.fk_id_status')
            ->leftJoin('atividades_fisicas', 'atividades_fisicas.id', 'evento.fk_id_atividade_fisica');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid                     = (string)($params['uuid'] ?? '');
        $competencia              = (string)($params['competencia'] ?? '');
        $fk_uuid_aluno            = (string)($params['fk_uuid_aluno'] ?? '');
        $fk_uuid_status           = (string)($params['fk_uuid_status'] ?? '');
        $fk_uuid_atividade_fisica = (string)($params['fk_uuid_atividade_fisica'] ?? '');
        $todos                    = (bool)($params['todos'] ?? false);
        $tipo_ordenacao           = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao          = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('evento.uuid', $uuid);
            })
            ->when($competencia, function ($query) use ($competencia) {
                list($ano, $mes) = explode('-', $competencia);

                $query->whereYear('evento.data', $ano)
                    ->whereMonth('evento.data', $mes);
            })
            ->when($todos, function ($query) use ($todos) {
                $query->where('evento.todos', $todos);
            })
            ->when($fk_uuid_aluno, function ($query) use ($fk_uuid_aluno) {
                $query->where('aluno.uuid', $fk_uuid_aluno);
            })
            ->when($fk_uuid_status, function ($query) use ($fk_uuid_status) {
                $query->where('status.uuid', $fk_uuid_status);
            })
            ->when($fk_uuid_atividade_fisica, function ($query) use ($fk_uuid_atividade_fisica) {
                $query->where('atividades_fisicas.uuid', $fk_uuid_atividade_fisica);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(!$tipo_ordenacao || !$campo_ordenacao, function ($query) {
                $query->orderByDesc('evento.data');
            });
    }
}
