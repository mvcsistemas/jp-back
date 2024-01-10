<?php

namespace MVC\Models\Arquivos;

use MVC\Base\MVCService;

class ArquivosService extends MVCService {

    protected Arquivos $model;

    public function __construct(Arquivos $model)
    {
        $this->model = $model;
    }
}
