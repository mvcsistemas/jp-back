<?php

namespace MVC\Models\Comunicados;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Comunicados extends MVCModel
{

    use HasFactory, HasUuid;

    protected $table      = 'comunicados';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('comunicados.*', 'remetente.uuid as fk_uuid_remetente', 'remetente.nome as nome_remetente', 'destinatario.uuid as fk_uuid_destinatario', 'destinatario.nome as nome_destinatario')
            ->join('users as remetente', 'remetente.id', 'comunicados.fk_id_remetente')
            ->join('users as destinatario', 'destinatario.id', 'comunicados.fk_id_destinatario');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid                 = (string)($params['uuid'] ?? '');
        $fk_uuid_remetente    = (string)($params['fk_uuid_remetente'] ?? '');
        $fk_uuid_destinatario = (string)($params['fk_uuid_destinatario'] ?? '');
        $tipo_ordenacao       = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao      = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('comunicados.uuid', $uuid);
            })
            ->when($fk_uuid_remetente, function ($query) use ($fk_uuid_remetente) {
                $query->where('remetente.uuid', $fk_uuid_remetente);
            })
            ->when($fk_uuid_destinatario, function ($query) use ($fk_uuid_destinatario) {
                $query->where('destinatario.uuid', $fk_uuid_destinatario);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(!$tipo_ordenacao || !$campo_ordenacao, function ($query) {
                $query->orderBy('comunicados.created_at');
            });
    }
}
