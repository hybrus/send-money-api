<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ValidBankProvider implements Rule
{
    private $paramAttr = null;

    public function __construct(string $paramAttr)
    {
        $this->paramAttr = $paramAttr;
    }

    public function passes($attribute, $value)
    {
        $paramValue = request()->input($this->paramAttr);
        return DB::table('bank_provider')->where([$this->paramAttr => $paramValue, $attribute => $value])->exists();
    }

    public function message()
    {
        return 'The selected bank is not valid for the chosen provider.';
    }
}
