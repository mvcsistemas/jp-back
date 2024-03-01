<?php

namespace MVC\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TravaSemanalRule implements Rule {

    public function passes($attribute, $value)
    {
        $userId = Auth::id();
        $hoje = Carbon::now();
        dd($hoje->isWednesday());
    }

    public function message()
    {
        return 'A Data Fim deve ser maior que a Data Início';
    }
}
