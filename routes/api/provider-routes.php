<?php

use App\Http\Controllers\ProviderController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'provider', "middleware" => "auth"], function () {
    Route::get('/', [ProviderController::class, "all"])->name("get-providers");
});
