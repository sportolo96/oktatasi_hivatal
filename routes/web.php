<?php

use App\Http\Controllers\CalculatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('calculate', CalculatorController::class);
