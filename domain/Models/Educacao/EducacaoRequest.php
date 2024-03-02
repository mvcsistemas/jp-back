<?php

namespace MVC\Models\Educacao;

use MVC\Base\MVCRequest;

class EducacaoRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'              => '',
            'titulo'            => 'required',
            'descricao'         => '',
            'link'              => 'required',
            'fk_uuid_categoria' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required'            => 'O campo Título é obrigatório.',
            'link.required'              => 'O campo Link é obrigatório.',
            'fk_uuid_categoria.required' => 'O campo Categoria é obrigatório.',
        ];
    }
}
