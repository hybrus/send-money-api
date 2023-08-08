<?php

namespace App\Library\TransactionDataFormat;

class DataChain
{
    private $handler;

    public function __construct()
    {
        $this->handler = new UserDataHandler();
        $this->handler->setNext(new BankDataHandler());
    }

    public function formatData(array $transactionEntry, int $authenticatedUserId): ?array
    {
        return $this->handler->handle($transactionEntry, $authenticatedUserId);
    }
}
