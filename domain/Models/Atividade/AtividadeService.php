<?php

namespace MVC\Models\Atividade;

use MVC\Base\MVCService;

class AtividadeService extends MVCService {

    protected Atividade $model;

    public function __construct(Atividade $model)
    {
        $this->model = $model;
    }
}
