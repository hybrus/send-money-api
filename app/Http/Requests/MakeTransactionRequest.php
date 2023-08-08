<?php

namespace App\Http\Requests;

use App\Constants\TransactionConstant;
use App\Rules\BankActiveNotDisabled;
use App\Rules\NotCurrentUserEmail;
use App\Rules\ProviderActiveNotDisabled;
use App\Rules\ValidBankProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MakeTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "type" => "string|required|in:bank,user",
            "recipient_email" =>  ["email", "required_if:type,user", new NotCurrentUserEmail],

            "provider_id" => [
                "integer",
                "exists:providers,id",
                "required_if:type,bank",
                new ProviderActiveNotDisabled
            ],
            "bank_id" => [
                "integer",
                "exists:banks,id",
                "required_if:type,bank",
                new ValidBankProvider('provider_id'),
                new BankActiveNotDisabled
            ],

            "amount" => "required|numeric|min:" . TransactionConstant::MinAmount,
        ];
    }

    public function messages()
    {
        return [
            'bank_id.exists' => 'The selected bank is not valid for the chosen provider.',
            // Add other custom validation messages as needed
        ];
    }
}
