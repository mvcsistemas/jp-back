<?php

namespace MVC\Models\FichaAnamnese;

use MVC\Base\MVCService;

class FichaAnamneseService extends MVCService {

    protected FichaAnamnese $model;

    public function __construct(FichaAnamnese $model)
    {
        $this->model = $model;
    }
}
