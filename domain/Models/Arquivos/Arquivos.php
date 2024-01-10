<?php

namespace MVC\Models\Arquivos;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Arquivos extends MVCModel {

    use HasFactory, HasUuid;

    protected $table      = 'arquivos';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('arquivos.*')
                    ->join('funcionario', 'funcionario.id', 'arquivos.fk_id_funcionario');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid                = (string)($params['uuid'] ?? '');
        $fk_uuid_funcionario = (string)($params['fk_uuid_funcionario'] ?? '');
        $tipo_ordenacao      = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao     = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('arquivos.uuid', $uuid);
            })
            ->when($fk_uuid_funcionario, function ($query) use ($fk_uuid_funcionario) {
                $query->where('funcionario.uuid', $fk_uuid_funcionario);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderByDesc('arquivos.data');
            });
    }
}
