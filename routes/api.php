<?php

use App\Http\Controllers\HourWorkController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('users/create', [UserController::class, 'store']);
Route::get('users/amount-payment', [UserController::class, 'getAmountPayment']);
Route::post('hour-work/create', [HourWorkController::class, 'store']);
Route::put('hour-work/accumulated-amount', [HourWorkController::class, 'paymentAccumulatedAmount']);
