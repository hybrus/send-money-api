<?php

namespace App\Library\MoneyTransfer\Transaction;

use App\Constants\TransactionConstant;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserTransactionStrategy extends AbstractTransactionStrategy
{
    public function process($request): JsonResponse
    {
        $transactionEntry  = $request->all();

        $fee = TransactionConstant::UserFee;
        $transactionEntry["fee"] = $fee;

        if ($this->isInsufficient($transactionEntry["amount"], $fee)) {
            return response()->json(["message" => TransactionConstant::InsufficientBalanceMesssage], 400);
        }

        $recipient = User::where('email', $transactionEntry['recipient_email'])->first();

        if (is_null($recipient)) {
            //handle not existing recpient
        }

        //handle existing recipient
        if (isset($recipient)) {
            $transactionEntry['recipient_user_id'] = $recipient->id;
            $recipientAccount = $recipient->getAccount();
            $transactionEntry['recipient_previous_balance'] = $recipientAccount['available_balance'];
            $recipientAccount->increment('available_balance', $transactionEntry['amount']);
        }

        return $this->makeTransaction($transactionEntry);
    }
}
