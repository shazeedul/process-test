<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('processes', ProcessController::class);
