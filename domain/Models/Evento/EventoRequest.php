<?php

namespace MVC\Models\Evento;

use MVC\Base\MVCRequest;

class EventoRequest extends MVCRequest
{

    public function rules()
    {
        return [
            'uuid'                     => '',
            'data'                     => 'required_if:data_inicio,null',
            'titulo'                   => 'required',
            'fk_uuid_aluno'            => '',
            'fk_uuid_status'           => '',
            'fk_uuid_atividade_fisica' => '',
            'data_inicio'              => 'required_if:data,null',
            'data_fim'                 => 'required_unless:data_inicio,null',
            'dias_semana'              => 'required_unless:data_inicio,null',
            'todos'                    => 'required',
            'evento_aluno'             => '',
        ];
    }

    public function messages()
    {
        return [
            'data.required_if'            => 'O campo Data é obrigatório.',
            'data_inicio.required_if'     => 'O campo Data Início é obrigatório.',
            'data_fim.required_unless'    => 'O campo Data Fim é obrigatório.',
            'dias_semana.required_unless' => 'O campo Dias da Semana é obrigatório.',
            'titulo.required'             => 'O campo Título é obrigatório.',
            'todos.required'              => 'O campo Todos é obrigatório.',
        ];
    }
}
