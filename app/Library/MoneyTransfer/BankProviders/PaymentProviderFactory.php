<?php

namespace App\Library\MoneyTransfer\BankProviders;

use InvalidArgumentException;

class PaymentProviderFactory
{
    public static function createProvider($providerId)
    {
        switch ($providerId) {
            case 1:
                return new InstaPayAdapter();
            case 2:
                return new PesoNetAdapter();
            default:
                throw new InvalidArgumentException("Invalid provider ID: $providerId");
        }
    }
}
