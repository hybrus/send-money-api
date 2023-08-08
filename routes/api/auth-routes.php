<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', "middleware" => "api"], function () {
    Route::get('me', [AuthController::class, "me"])->name("get-user-details");
    Route::post('login', [AuthController::class, "login"])->name("login");
    Route::post('logout', [AuthController::class, "logout"])->name('logout');
});
