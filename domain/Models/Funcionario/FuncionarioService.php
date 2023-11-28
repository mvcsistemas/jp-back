<?php

namespace MVC\Models\Funcionario;

use MVC\Base\MVCService;

class FuncionarioService extends MVCService {

    protected Funcionario $model;

    public function __construct(Funcionario $model)
    {
        $this->model = $model;
    }
}
