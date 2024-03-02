<?php

namespace MVC\Models\Categorias;

use MVC\Base\MVCRequest;

class CategoriasRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'      => '',
            'descricao' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo Descrição é obrigatório.'
        ];
    }
}
