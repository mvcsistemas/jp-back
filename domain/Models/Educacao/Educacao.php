<?php

namespace MVC\Models\Educacao;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use MVC\Base\MVCModel;
use MVC\Models\Categorias\Categorias;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Educacao extends MVCModel
{
    use HasFactory, HasUuid;

    protected $table      = 'educacao';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = true;

    public function index(): Builder
    {
        return $this->select('educacao.*', 'categorias.uuid as fk_uuid_categoria', 'categorias.descricao as categoria')
            ->join('categorias', 'educacao.fk_id_categoria', '=', 'categorias.id');
    }

    public function filter(Builder $query, array $params = []): Builder
    {
        $uuid              = (string)($params['uuid'] ?? '');
        $titulo            = (string)($params['titulo'] ?? '');
        $descricao         = (string)($params['descricao'] ?? '');
        $fk_uuid_categoria = (string)($params['fk_uuid_categoria'] ?? '');
        $categoria         = (string)($params['categoria'] ?? '');
        $tipo_ordenacao    = (string)($params['tipo_ordenacao'] ?? '');
        $campo_ordenacao   = (string)($params['campo_ordenacao'] ?? '');

        return $query
            ->when($uuid, function ($query) use ($uuid) {
                $query->where('educacao.uuid', $uuid);
            })
            ->when($titulo, function ($query) use ($titulo) {
                $query->where('educacao.titulo', 'like', "%$titulo%");
            })
            ->when($descricao, function ($query) use ($descricao) {
                $query->where('educacao.descricao', 'like', "%$descricao%");
            })
            ->when($fk_uuid_categoria, function ($query) use ($fk_uuid_categoria) {
                $query->where('categorias.uuid', $fk_uuid_categoria);
            })
            ->when($categoria, function ($query) use ($categoria) {
                $query->where('categorias.descricao', 'like', "%$categoria%");
            })
            ->when($tipo_ordenacao && $campo_ordenacao, function ($query) use ($tipo_ordenacao, $campo_ordenacao) {
                $query->orderBy($campo_ordenacao, $tipo_ordenacao);
            })
            ->when(!$tipo_ordenacao || !$campo_ordenacao, function ($query) {
                $query->orderBy('educacao.descricao');
            });
    }
}
