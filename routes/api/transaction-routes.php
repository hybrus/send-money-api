<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'transaction', "middleware" => "auth"], function () {
    Route::get('/', [TransactionController::class, "all"])->name("get-transactions");
    Route::post('/', [TransactionController::class, "makeTransaction"])->name("make-transaction");
});
