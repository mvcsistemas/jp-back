<?php

namespace MVC\Models\Comunicados;

use MVC\Base\MVCService;

class ComunicadosService extends MVCService {

    protected Comunicados $model;

    public function __construct(Comunicados $model)
    {
        $this->model = $model;
    }
}
