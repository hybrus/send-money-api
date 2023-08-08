<?php

namespace App\Library\MoneyTransfer\Transaction;

use App\Constants\TransactionConstant;
use Illuminate\Http\JsonResponse;

abstract class AbstractTransactionStrategy implements TransactionStrategyInterface
{
    protected $user;
    protected $account;

    public function __construct()
    {
        $this->user = auth()->user();
        $this->account = $this->user->getAccount();
    }

    protected function getNextBalance(float $amount, float $fee): float
    {
        return $this->account->available_balance - ($amount + $fee);
    }

    protected function isInsufficient(float $amount, float $fee): bool
    {
        return $this->getNextBalance($amount, $fee) < 0;
    }

    protected function updateUserBalance(float $amount): void
    {
        $this->account->decrement("available_balance", $amount);
    }

    protected function makeTransaction(array $transactionEntry): JsonResponse
    {
        $amount = $transactionEntry["amount"];
        $fee = $transactionEntry["fee"];

        $transaction = [
            ...$transactionEntry,
            "sender_previous_balance" => $this->account->available_balance
        ];

        $this->user->sentTransactions()->create($transaction);
        $this->updateUserBalance($amount + $fee);

        return response()->json(["message" => TransactionConstant::SuccessMessage], 200);
    }
}
