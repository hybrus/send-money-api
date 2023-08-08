<?php

namespace App\Library\MoneyTransfer\Transaction;

use InvalidArgumentException;

class TransactionFactory
{
    public static function createStrategy(string $type): TransactionStrategyInterface
    {
        switch ($type) {
            case "bank":
                return new BankTransactionStrategy();
            case "user":
                return new UserTransactionStrategy();
            default:
                throw new InvalidArgumentException("Invalid Transfer Type: $type");
        }
    }
}
