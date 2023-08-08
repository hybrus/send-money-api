<?php

namespace App\Library\TransactionDataFormat;

class BankDataHandler implements DataHandlerInterface
{
    private $nextHandler;

    public function setNext(DataHandlerInterface $handler): DataHandlerInterface
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(array $transactionEntry, int $authenticatedUserId): ?array
    {
        if ($transactionEntry['type'] === 'bank') {
            return [
                "id" => $transactionEntry['id'],
                "amount" => (-$transactionEntry['amount']),
                "previous_balance" => $transactionEntry['sender_previous_balance'],
                "action" => "sub",
                "created_at" => $transactionEntry['created_at'],
                "description" => "Sent Money to Bank: " . $transactionEntry['bank']['name'] . " via " . $transactionEntry['provider']['name']
            ];
        }

        if ($this->nextHandler !== null) {
            return $this->nextHandler->handle($transactionEntry, $authenticatedUserId);
        }

        return null;
    }
}
