<?php

// ActiveNotDisabledProvider.php

namespace App\Rules;

use App\Models\Bank;
use Illuminate\Contracts\Validation\Rule;

class BankActiveNotDisabled implements Rule
{
    public function passes($attribute, $value)
    {
        return Bank::where('id', $value)
            ->where('is_active', true)
            ->where('is_disabled', false)
            ->exists();
    }

    public function message()
    {
        return 'The selected bank is not active or is disabled.';
    }
}
