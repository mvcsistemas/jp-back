<?php

namespace MVC\Models\Evento;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Evento extends MVCModel {

    use HasFactory, HasUuid;

    protected $table      = 'evento';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('evento.*', 'aluno.uuid as fk_uuid_aluno')
                    ->leftJoin('aluno', 'aluno.id', 'evento.fk_id_aluno');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $fk_uuid_aluno   = (string)($params['fk_uuid_aluno'] ?? '');
        $todos           = (int)($params['todos'] ?? -1);
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('evento.uuid', $uuid);
            })
            ->when(in_array($todos, [0, 1]), function ($query) use ($todos) {
                $query->where('evento.todos', $todos);
            })
            ->when($fk_uuid_aluno, function ($query) use ($fk_uuid_aluno) {
                $query->where('aluno.uuid', $fk_uuid_aluno);
            })

            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('evento.data');
            });
    }
}
