<?php

namespace MVC\Models\Categorias;

use MVC\Base\MVCService;

class CategoriasService extends MVCService
{

    protected Categorias $model;

    public function __construct(Categorias $model)
    {
        $this->model = $model;
    }
}
