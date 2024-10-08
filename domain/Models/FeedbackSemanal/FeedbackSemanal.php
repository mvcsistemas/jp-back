<?php

namespace MVC\Models\FeedbackSemanal;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MVC\Base\MVCModel;
use MVC\Models\DoresFeedback\DoresFeedback;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class FeedbackSemanal extends MVCModel
{
    use HasFactory, HasUuid;

    protected $table      = 'feedback_semanal';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('feedback_semanal.*', 'aluno.uuid as fk_uuid_aluno', 'doencas.uuid as fk_uuid_doenca', 'doencas.descricao as descricao_doenca')
            ->join('users as aluno', 'aluno.id', 'feedback_semanal.fk_id_aluno')
            ->join('doencas', 'doencas.id', 'feedback_semanal.fk_id_doenca');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $fk_uuid_aluno   = (string)($params['fk_uuid_aluno'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('feedback_semanal.uuid', $uuid);
            })
            ->when($fk_uuid_aluno, function ($query) use ($fk_uuid_aluno) {
                $query->where('aluno.uuid', $fk_uuid_aluno);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(!$tipo_ordenacao || !$campo_ordenacao, function ($query) {
                $query->orderByDesc('feedback_semanal.id');
            });
    }

    public function dores(): HasMany
    {
        return $this->hasMany(DoresFeedback::class, 'fk_id_feedback', 'id')
            ->join('dores', 'dores.id', 'dores_feedback.fk_id_dor');
    }
}
