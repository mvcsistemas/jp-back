<?php

namespace MVC\Models\FichaAnamnese;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use MVC\Models\User\User;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class FichaAnamnese extends MVCModel {

    use HasFactory, HasUuid;

    protected $table      = 'ficha_anamnese';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index (): Builder
    {
        return $this->select('ficha_anamnese.*', 'aluno.uuid as fk_uuid_aluno')
                    ->join('users as aluno', 'aluno.id', 'ficha_anamnese.fk_id_aluno');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('ficha_anamnese.uuid', $uuid);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(! $tipo_ordenacao || ! $campo_ordenacao, function ($query) {
                $query->orderByDesc('ficha_anamnese.id');
            });
    }
}
