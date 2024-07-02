<?php

namespace MVC\Models\Notificacao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MVC\Base\MVCModel;
use YourAppRocks\EloquentUuid\Traits\HasUuid;

class Notificacao extends MVCModel
{
    use HasFactory, HasUuid;

    protected $table      = 'notificacao_token';
    protected $primaryKey = 'id';
    protected $guarded    = [''];
    public    $timestamps = false;
}
