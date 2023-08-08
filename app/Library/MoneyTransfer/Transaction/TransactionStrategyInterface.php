<?php

namespace App\Library\MoneyTransfer\Transaction;

use Illuminate\Http\Request;

interface TransactionStrategyInterface
{
    public function process(Request $request);
}
