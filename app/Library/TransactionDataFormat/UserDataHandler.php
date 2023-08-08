<?php

namespace App\Library\TransactionDataFormat;

class UserDataHandler implements DataHandlerInterface
{
    private $nextHandler;

    public function setNext(DataHandlerInterface $handler): DataHandlerInterface
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(array $transactionEntry, int $authenticatedUserId): ?array
    {
        if ($transactionEntry['type'] === 'user') {
            if ($transactionEntry['sender_user_id'] === $authenticatedUserId) {
                return [
                    "id" => $transactionEntry['id'],
                    "amount" => (-$transactionEntry['amount']),
                    "previous_balance" => $transactionEntry['sender_previous_balance'],
                    "created_at" => $transactionEntry['created_at'],
                    "action" => "sub",
                    "description" => "Sent Money to User: " . $transactionEntry['recipient_email']
                ];
            } else {
                return [
                    "id" => $transactionEntry['id'],
                    "amount" => (+$transactionEntry['amount']),
                    "previous_balance" => $transactionEntry['recipient_previous_balance'],
                    "created_at" => $transactionEntry['created_at'],
                    "action" => "add",
                    "description" => "Received Money from User: " . $transactionEntry['recipient_email']
                ];
            }
        }

        if ($this->nextHandler !== null) {
            return $this->nextHandler->handle($transactionEntry, $authenticatedUserId);
        }

        return null;
    }
}
