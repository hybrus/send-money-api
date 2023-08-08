<?php

namespace App\Library\TransactionDataFormat;

interface DataHandlerInterface
{
    public function setNext(DataHandlerInterface $handler): DataHandlerInterface;
    public function handle(array $transactionEntry, int $authenticatedUserId): ?array;
}
