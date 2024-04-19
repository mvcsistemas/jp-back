<?php

namespace MVC\Models\Evento;

use MVC\Base\MVCRequest;

class EventoRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                     => '',
            'data'                     => 'required',
            'titulo'                   => 'required',
            'fk_uuid_aluno'            => '',
            'fk_uuid_status'           => '',
            'fk_uuid_atividade_fisica' => '',
            'data_inicio'              => '',
            'data_fim'                 => '',
            'dias_semana'              => '',
            'todos'                    => 'required',
            'evento_aluno'             => '',
        ];
    }

    public function messages()
    {
        return [
            'data.required'   => 'O campo Data é obrigatório.',
            'titulo.required' => 'O campo Título é obrigatório.',
            'todos.required'  => 'O campo Todos é obrigatório.',
        ];
    }
}
