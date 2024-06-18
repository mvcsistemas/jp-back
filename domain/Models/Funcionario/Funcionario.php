<?php

namespace MVC\Models\Funcionario;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use MVC\Models\User\User;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Funcionario extends MVCModel
{

    use HasFactory, HasUuid;

    protected $table      = 'funcionario';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public static function boot()
    {
        parent::boot();

        self::deleted(function ($model) {
            User::find($model->id)->delete();
        });
    }

    public function index(): Builder
    {
        return $this->select('funcionario.*', 'users.uuid as user_uuid', 'users.*')
            ->join('users', 'funcionario.id', 'users.id');
    }

    public function lookup(): Collection
    {
        return $this->index()->select('users.uuid', 'users.nome')->get();
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid            = (string)($params['uuid'] ?? '');
        $tipo_ordenacao  = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('funcionario.uuid', $uuid);
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(!$tipo_ordenacao || !$campo_ordenacao, function ($query) {
                $query->orderByDesc('users.nome');
            });
    }

    /**
     * Sobrescreve o método para evitar a geração automática do UUID (pega do cadastro original do usuário).
     *
     * @return string|null
     */
    protected function generateUuid(): ?string
    {
        return User::find($this->id)->uuid;
    }
}
