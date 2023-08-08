<?php

namespace App\Library\MoneyTransfer\Transaction;

class TransactionStrategy
{
    private $transactionEntry;
    private $transactionStrategy;

    public function __construct($transactionEntry, TransactionStrategyInterface $transactionStrategy)
    {
        $this->transactionEntry = $transactionEntry;
        $this->transactionStrategy = $transactionStrategy;
    }

    public function process()
    {
        return $this->transactionStrategy->process($this->transactionEntry);
    }
}
