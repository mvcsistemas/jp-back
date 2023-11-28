<?php

namespace MVC\Models\CalendarioAtividade;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class CalendarioAtividade extends MVCModel {

    use HasFactory, HasUuid;

    protected $table      = 'calendario_atividade';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('calendario_atividade.*', 'calendario.uuid as fk_uuid_calendario', 'atividade.uuid as fk_uuid_atividade', 'atividade.descricao as descricao_atividade')
                    ->join('calendario', 'calendario.id', 'calendario_atividade.fk_id_calendario')
                    ->join('atividade', 'atividade.id', 'calendario_atividade.fk_id_atividade');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid               = (string)($params['uuid'] ?? '');
        $fk_uuid_calendario = (string)($params['fk_uuid_calendario'] ?? '');
        $fk_uuid_atividade  = (string)($params['fk_uuid_atividade'] ?? '');
        $tipo_ordenacao     = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao    = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('calendario_atividade.uuid', $uuid);
            })
            ->when($fk_uuid_calendario, function ($query) use ($fk_uuid_calendario) {
                $query->where('calendario.uuid', $fk_uuid_calendario);
            })
            ->when($fk_uuid_atividade, function ($query) use ($fk_uuid_atividade) {
                $query->where('atividade.uuid', $fk_uuid_atividade);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderBy('atividade.descricao');
            });
    }
}
