<?php

namespace MVC\Models\Doencas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Doencas extends MVCModel
{
    use HasFactory, HasUuid;

    protected $table      = 'doencas';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $descricao       = (string)($params['descricao'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('doencas.uuid', $uuid);
            })
            ->when($descricao, function ($query) use ($descricao) {
                $query->where('doencas.descricao', $descricao);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(!$tipo_ordenacao || !$campo_ordenacao, function ($query) {
                $query->orderBy('doencas.descricao');
            });
    }
}
