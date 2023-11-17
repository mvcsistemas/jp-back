<?php

namespace MVC\Models\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest {

    public function rules()
    {
        return [
            'id'                => '',
            'uuid'              => '',
            'nome'              => 'required',
            'email'             => ['required', Rule::unique('users')->where(function ($query) {
                return $query->where('uuid', '<>', request()->uuid);
            })],
            'password'          => '',
            'ativo'            => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => 'O campo Nome é obrigatório.',
            'email.required'  => 'O campo E-mail é obrigatório.',
            'ativo.required' => 'O campo Ativo é obrigatório.'
        ];
    }
}
