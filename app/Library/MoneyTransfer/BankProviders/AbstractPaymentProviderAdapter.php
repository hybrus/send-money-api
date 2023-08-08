<?php

namespace App\Library\MoneyTransfer\BankProviders;

abstract class AbstractPaymentProviderAdapter implements PaymentProviderAdapterInterface
{
    protected $fee;


    public function getFee()
    {
        return $this->fee;
    }
}
