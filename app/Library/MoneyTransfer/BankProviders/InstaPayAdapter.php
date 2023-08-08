<?php

namespace App\Library\MoneyTransfer\BankProviders;

use App\Constants\TransactionConstant;

class InstaPayAdapter extends AbstractPaymentProviderAdapter
{

    protected $fee = TransactionConstant::InstaPayFee;

    public function processPayment($amount): array
    {
        //for demoo purpose only, mockup api default return

        return [
            "ok" => true,
            "message" => "success",
        ];
    }
}
