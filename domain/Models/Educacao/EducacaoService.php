<?php

namespace MVC\Models\Educacao;

use MVC\Base\MVCService;

class EducacaoService extends MVCService
{

    protected Educacao $model;

    public function __construct(Educacao $model)
    {
        $this->model = $model;
    }

    public function educacaoCategoria()
    {
        return $this->model->index()->get() ->groupBy('categorias.descricao');
    }
}
