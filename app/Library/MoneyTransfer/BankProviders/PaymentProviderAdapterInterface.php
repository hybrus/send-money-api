<?php

namespace App\Library\MoneyTransfer\BankProviders;

interface PaymentProviderAdapterInterface
{
    public function processPayment($amount);
}
