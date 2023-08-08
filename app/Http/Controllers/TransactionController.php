<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakeTransactionRequest;
use App\Library\MoneyTransfer\Transaction\TransactionFactory;
use App\Library\MoneyTransfer\Transaction\TransactionStrategy;
use App\Library\TransactionDataFormat\DataChain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function all(Request $req)
    {
        $page = $req->get('page') ?? 1;
        $perPage = $req->get('perPage') ?? 10;
        $user = auth()->user();

        $transactions = $user
            ->transactions()
            ->orderBy('created_at', 'desc')
            ->with(['bank', 'provider'])
            ->paginate($perPage, ['*'], 'page', $page)
            ->toArray();

        $descriptionChain = new DataChain();
        $transactions["data"] = collect($transactions["data"])
            ->map(function ($transactionEntry) use ($user, $descriptionChain) {

                return $descriptionChain->formatData($transactionEntry, $user->id);
            });

        return $transactions;
    }

    public function makeTransaction(MakeTransactionRequest $request): JsonResponse
    {
        $type = $request->type;

        $transactionStrategy = TransactionFactory::createStrategy($type);
        $transaction = new TransactionStrategy($request, $transactionStrategy);

        return $transaction->process();
    }
}
