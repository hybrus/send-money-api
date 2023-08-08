<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class NotCurrentUserEmail implements Rule
{
    public function passes($attribute, $value)
    {
        return $value !== Auth::user()->email;
    }

    public function message()
    {
        return 'The :attribute cannot be the same as the authenticated user\'s email.';
    }
}
