<?php

namespace MVC\Models\Aluno;

use MVC\Base\MVCService;

class AlunoService extends MVCService {

    protected Aluno $model;

    public function __construct(Aluno $model)
    {
        $this->model = $model;
    }
}
