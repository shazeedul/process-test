<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::get('get-all', [ProcessController::class, 'index'])->name('process.index');
    Route::post('create-process', [ProcessController::class, 'store'])->name('process.store');
    Route::get('get-single/{pid}', [ProcessController::class, 'show'])->name('process.show');
    Route::delete('delete-process/{pid}', [ProcessController::class, 'destroy'])->name('process.destroy');
});
