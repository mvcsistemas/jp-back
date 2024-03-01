<?php

namespace MVC\Models\Doencas;

use MVC\Base\MVCService;

class DoencasService extends MVCService
{

    protected Doencas $model;

    public function __construct(Doencas $model)
    {
        $this->model = $model;
    }
}
