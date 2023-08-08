<?php

namespace App\Library\MoneyTransfer\Transaction;

use App\Constants\TransactionConstant;
use App\Library\MoneyTransfer\BankProviders\PaymentProviderFactory;
use Illuminate\Http\JsonResponse;

class BankTransactionStrategy extends AbstractTransactionStrategy
{
    public function process($request): JsonResponse
    {

        $transactionEntry  = $request->all();

        $paymentProvider  = PaymentProviderFactory::createProvider($transactionEntry["provider_id"]);

        $paymentProvider->getFee();

        $fee = $paymentProvider->getFee();
        $transactionEntry["fee"] = $fee;

        if ($this->isInsufficient($transactionEntry["amount"], $fee)) {
            return response()->json(["message" => TransactionConstant::InsufficientBalanceMesssage], 400);
        }

        $providerResult = $paymentProvider->processPayment($transactionEntry["amount"]);

        if (!$providerResult["ok"]) {
            return response()->json(["message" => TransactionConstant::ProviderUnvailabilityMessage], 424);
        }

        return $this->makeTransaction($transactionEntry);
    }
}
