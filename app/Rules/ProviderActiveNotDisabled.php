<?php

// ActiveNotDisabledProvider.php

namespace App\Rules;

use App\Models\Provider;
use Illuminate\Contracts\Validation\Rule;

class ProviderActiveNotDisabled implements Rule
{
    public function passes($attribute, $value)
    {
        return Provider::where('id', $value)
            ->where('is_active', true)
            ->where('is_disabled', false)
            ->exists();
    }

    public function message()
    {
        return 'The selected provider is not active or is disabled.';
    }
}
