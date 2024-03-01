<?php

namespace MVC\Models\AtividadesFisicas;

use MVC\Base\MVCService;

class AtividadesFisicasService extends MVCService
{

    protected AtividadesFisicas $model;

    public function __construct(AtividadesFisicas $model)
    {
        $this->model = $model;
    }
}
